<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Products.php ]
 */
class Products extends CRUD_Controller
{

	private $per_page;
	private $another_js;
	private $another_css;
	private $upload_store_path;
	private $file_allow;
	private $file_allow_type;
	private $file_allow_mime;
	private $file_check_name;

	public function __construct()
	{
		parent::__construct();

		chkUserPerm();

		$this->per_page = 30;
		$this->num_links = 6;
		$this->uri_segment = 4;
		$this->load->model('products/Products_model', 'Products');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->data['page_url'] = site_url('products/products');

		$this->data['page_title'] = 'จัดการร้านอาหาร';
		$this->upload_store_path = './assets/uploads/products/';
		$this->file_allow = array(
			'application/pdf' => 'pdf',
			'application/msword' => 'doc',
			'application/vnd.ms-msword' => 'doc',
			'application/vnd.ms-excel' => 'xls',
			'application/powerpoint' => 'ppt',
			'application/vnd.ms-powerpoint' => 'ppt',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
			'application/vnd.oasis.opendocument.text' => 'odt',
			'application/vnd.oasis.opendocument.spreadsheet' => 'ods',
			'application/vnd.oasis.opendocument.presentation' => 'odp',
			'image/bmp' => 'bmp',
			'image/png' => 'png',
			'image/pjpeg' => 'jpeg',
			'image/jpeg' => 'jpg'
		);
		$this->file_allow_type = array_values($this->file_allow);
		$this->file_allow_mime = array_keys($this->file_allow);
		$this->file_check_name = '';
		$js_url = 'assets/js_modules/products/products.js?ft=' . filemtime('assets/js_modules/products/products.js');
		$this->another_js = '<script src="' . base_url($js_url) . '"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->list_all();
	}

	// ------------------------------------------------------------------------

	/**
	 * Render this controller page
	 * @param String path of controller
	 * @param Integer total record
	 */
	protected function render_view($path)
	{
		$this->data['top_navbar'] = $this->parser->parse('template/majestic/top_navbar_view', $this->top_navbar_data, TRUE);
		$this->data['left_sidebar'] = $this->parser->parse('template/majestic/left_sidebar_view', $this->left_sidebar_data, TRUE);
		$this->data['breadcrumb_list'] = $this->parser->parse('template/majestic/breadcrumb_view', $this->breadcrumb_data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/majestic/homepage_view', $this->data);
	}

	/**
	 * Set up pagination config
	 * @param String path of controller
	 * @param Integer total record
	 */
	public function create_pagination($page_url, $total)
	{
		$this->load->library('pagination');
		$config['base_url'] = $page_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $this->per_page;
		$config['num_links'] = $this->num_links;
		$config['uri_segment'] = $this->uri_segment;
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	// ------------------------------------------------------------------------

	/**
	 * List all record
	 */
	public function list_all()
	{
		$this->session->unset_userdata($this->Products->session_name . '_search_field');
		$this->session->unset_userdata($this->Products->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Products->session_name . '_search_field' => $search_field, $this->Products->session_name . '_value' => $value);
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Products->session_name . '_search_field');
			$value = $this->session->userdata($this->Products->session_name . '_value');
		}

		$start_row = $this->uri->segment($this->uri_segment, '0');
		if (!is_numeric($start_row)) {
			$start_row = 0;
		}
		$per_page = $this->per_page;
		$order_by =  $this->input->post('order_by', TRUE);
		if ($order_by != '') {
			$arr = explode('|', $order_by);
			$field = $arr[0];
			$sort = $arr[1];
			switch ($sort) {
				case 'asc':
					$sort = 'ASC';
					break;
				case 'desc':
					$sort = 'DESC';
					break;
			}
			$this->Products->order_field = $field;
			$this->Products->order_sort = $sort;
		}
		$results = $this->Products->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('products/products');
		$pagination = $this->create_pagination($page_url . '/search', $search_row);
		$end_row = $start_row + $per_page;
		if ($search_row < $per_page) {
			$end_row = $search_row;
		}

		if ($end_row > $search_row) {
			$end_row = $search_row;
		}

		$this->data['data_list']	= $list_data;
		$this->data['search_field']	= $search_field;
		$this->data['txt_search']	= $value;
		$this->data['current_page_offset'] = $start_row;
		$this->data['start_row']	= $start_row + 1;
		$this->data['end_row']	= $end_row;
		$this->data['order_by']	= $order_by;
		$this->data['total_row']	= $total_row;
		$this->data['search_row']	= $search_row;
		$this->data['page_url']	= $page_url;
		$this->data['pagination_link']	= $pagination;
		$this->data['csrf_protection_field']	= insert_csrf_field(true);

		$this->render_view('products/products/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ข้อมูลร้านอาหาร', 'url' => site_url('products/products')),
			array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Products->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('products/products/preview_view');
			}
		}
	}


	// ------------------------------------------------------------------------
	/**
	 * Add form
	 */
	public function add()
	{
		$this->data['count_image'] = 1;
		$this->data['data_id'] = 0;

		$this->data['preview_product_img1'] = '<div id="div_preview_product_img1" class="py-3 div_file_preview" style="clear:both"><img id="product_img1_preview" style="object-fit:contain ; width: 100%; height: 420px;"/></div>';
		$this->data['record_product_img1_label'] = '';
		$this->data['preview_product_img2'] = '<div id="div_preview_product_img2" class="py-3 div_file_preview" style="clear:both"><img id="product_img2_preview" style="object-fit:contain ; width: 100%; height: 420px;"/></div>';
		$this->data['record_product_img2_label'] = '';
		$this->data['preview_product_img3'] = '<div id="div_preview_product_img3" class="py-3 div_file_preview" style="clear:both"><img id="product_img3_preview" style="object-fit:contain ; width: 100%; height: 420px;"/></div>';
		$this->data['record_product_img3_label'] = '';
		$this->data['preview_product_img4'] = '<div id="div_preview_product_img4" class="py-3 div_file_preview" style="clear:both"><img id="product_img4_preview" style="object-fit:contain ; width: 100%; height: 420px;"/></div>';
		$this->data['record_product_img4_label'] = '';
		$this->data['preview_product_img5'] = '<div id="div_preview_product_img5" class="py-3 div_file_preview" style="clear:both"><img id="product_img5_preview" style="object-fit:contain ; width: 100%; height: 420px;"/></div>';
		$this->data['record_product_img5_label'] = '';

		$this->render_view('products/products/add_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Default Validation
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		//file upload
		$check_file = FALSE;
		if ($this->input->post('product_img1_label') == '') {
			$check_file = TRUE;
		}
		if ($check_file == TRUE) {
			if (empty($_FILES['product_img1']['name'])) {
				$frm->set_rules('product_img1', 'รูปภาพสินค้าที่ 1 (รูปหลัก) ', 'trim|required');
			}
		}
		//file upload
		$check_file = FALSE;
		if ($this->input->post('product_img2_label') == '') {
			$check_file = TRUE;
		}
		if ($check_file == TRUE) {
			if (empty($_FILES['product_img2']['name'])) {
				$frm->set_rules('product_img2', 'รูปภาพสินค้าที่ 2', 'trim|required');
			}
		}

		$frm->set_rules('product_code', 'รหัสสินค้า', 'trim|required');
		$frm->set_rules('product_name_th', 'ชื่อสินค้า ภาษาไทย', 'trim|required');
		$frm->set_rules('description_th', 'คำอธิบาย ภาษาไทย', 'trim|required');
		$frm->set_rules('price', 'ราคา', 'trim|required|is_natural');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('product_code');
			$message .= form_error('product_name_th');
			$message .= form_error('description_th');
			$message .= form_error('price');
			$message .= form_error('product_img1');
			$message .= form_error('product_img2');
			$message .= form_error('fag_allow');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Default Validation for Update
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidateUpdate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		//file upload
		$check_file = FALSE;
		if ($this->input->post('product_img1_label') == '') {
			$check_file = TRUE;
		}
		if ($check_file == TRUE) {
			if (empty($_FILES['product_img1']['name'])) {
				$frm->set_rules('product_img1', 'รูปภาพสินค้าที่ 1', 'trim|required');
			}
		}
		//file upload
		$check_file = FALSE;
		if ($this->input->post('product_img2_label') == '') {
			$check_file = TRUE;
		}
		if ($check_file == TRUE) {
			if (empty($_FILES['product_img2']['name'])) {
				$frm->set_rules('product_img2', 'รูปภาพสินค้าที่ 2', 'trim|required');
			}
		}

		$frm->set_rules('product_code', 'รหัสสินค้า', 'trim|required');
		$frm->set_rules('product_name_th', 'ชื่อสินค้า ภาษาไทย', 'trim|required');
		$frm->set_rules('description_th', 'คำอธิบาย ภาษาไทย', 'trim|required');
		$frm->set_rules('price', 'ราคา', 'trim|required|is_natural');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('product_code');
			$message .= form_error('product_name_th');
			$message .= form_error('description_th');
			$message .= form_error('price');
			$message .= form_error('product_img1');
			$message .= form_error('product_img2');
			$message .= form_error('fag_allow');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	public function formValidateWithFile()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;
		$message = '';
		if (!empty($_FILES['product_img1']['name'])) {
			$this->file_check_name = 'product_img1';
			$frm->set_rules('product_img1', 'รูปภาพสินค้าที่ 1', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('product_img1');
			}
		}
		if (!empty($_FILES['product_img2']['name'])) {
			$this->file_check_name = 'product_img2';
			$frm->set_rules('product_img2', 'รูปภาพสินค้าที่ 2', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('product_img2');
			}
		}
		if (!empty($_FILES['product_img3']['name'])) {
			$this->file_check_name = 'product_img3';
			$frm->set_rules('product_img3', 'รูปภาพสินค้าที่ 3', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('product_img3');
			}
		}
		if (!empty($_FILES['product_img4']['name'])) {
			$this->file_check_name = 'product_img4';
			$frm->set_rules('product_img4', 'รูปภาพสินค้าที่ 4', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('product_img4');
			}
		}
		if (!empty($_FILES['product_img5']['name'])) {
			$this->file_check_name = 'product_img5';
			$frm->set_rules('product_img5', 'รูปภาพสินค้าที่ 5', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('product_img5');
			}
		}
		return $message;
	}
	public function file_check()
	{
		$allowed_mime_type_arr = $this->file_allow_mime;
		$mime = get_mime_by_extension($_FILES[$this->file_check_name]['name']);
		if (isset($_FILES[$this->file_check_name]['name']) && $_FILES[$this->file_check_name]['name'] != '') {
			if (in_array($mime, $allowed_mime_type_arr)) {
				return true;
			} else {
				$this->form_validation->set_message('file_check', '- กรุณาเลือกประเภทไฟล์  ' . implode(" | ", $this->file_allow_type) . ' เท่านั้นครับ');
				return false;
			}
		} else {
			$this->form_validation->set_message('file_check', '- กรุณาเลือกไฟล์ %s');
			return false;
		}
	}
	private function uploadFile($file_name, $dir = '')
	{
		if ($dir != '' && substr($dir, 0, 1) != '/') {
			$dir = '/' . $dir;
		}
		$path = $this->upload_store_path . $dir;
		//เปิดคอนฟิก Auto ชื่อไฟล์ใหม่ด้วย
		$config['upload_path']          = $path;
		$config['allowed_types']        = $this->file_allow_type;
		$config['encrypt_name']		= TRUE;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload($file_name)) {
			$encrypt_name = $this->upload->file_name;
			$orig_name = $this->upload->orig_name;
			$this->FileUpload->create($encrypt_name, $orig_name);
			$file_path = $path . '/' . $encrypt_name; //ไม่ต้องใช้ Path เต็ม
			$data = array(
				'result' => TRUE,
				'file_path' => $file_path,
				'error' => ''
			);
		} else {
			$data = array(
				'result' => FALSE,
				'error' => $this->upload->display_errors()
			);
		}
		return $data;
	}
	private function removeFile($file_path)
	{
		if ($file_path != '') {
			if (file_exists($file_path)) {
				unlink($file_path);
			}
		}
	}
	/**
	 * Create new record
	 */
	public function save()
	{

		$message = '';
		// $message .= $this->formValidateWithFile();
		$message .= $this->formValidate();
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {

			$post = $this->input->post(NULL, TRUE);

			$upload_error = 0;
			$upload_error_msg = '';
			$arr = $this->uploadFile('product_img1');
			if ($arr['result'] == TRUE) {
				$post['product_img1'] = $arr['file_path'];
			} else {
				$upload_error++;
				$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
			}

			$arr = $this->uploadFile('product_img2');
			if ($arr['result'] == TRUE) {
				$post['product_img2'] = $arr['file_path'];
			} else {
				$upload_error++;
				$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
			}

			$arr = $this->uploadFile('product_img3');
			if ($arr['result'] == TRUE) {
				$post['product_img3'] = $arr['file_path'];
			} else {
				$post['product_img3'] = '';
				// $upload_error++;
				// $upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
			}

			$arr = $this->uploadFile('product_img4');
			if ($arr['result'] == TRUE) {
				$post['product_img4'] = $arr['file_path'];
			} else {
				$post['product_img4'] = '';
				// $upload_error++;
				// $upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
			}

			$arr = $this->uploadFile('product_img5');
			if ($arr['result'] == TRUE) {
				$post['product_img5'] = $arr['file_path'];
			} else {
				$post['product_img5'] = '';
				// $upload_error++;
				// $upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
			}
			// die(print_r($arr = $this->uploadFile('product_img3')));

			$encrypt_id = '';
			if ($upload_error == 0) {
				$success = TRUE;
				$id = $this->Products->create($post);
				$encrypt_id = encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			} else {
				$success = FALSE;
				$message = $upload_error_msg;
			}

			$json = json_encode(array(
				'is_successful' => $success,
				'encrypt_id' =>  $encrypt_id,
				'message' => $message
			));
			echo $json;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Load data to form
	 * @param String encrypt id
	 */
	public function edit($encrypt_id = '')
	{
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Products->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);
				$this->setPreviewFormat($results);
				$this->data['data_id'] = $id;

				$this->render_view('products/products/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$product_id = ci_decrypt($data['encrypt_product_id']);
		if ($product_id == '') {
			$error .= '- รหัส product_id';
		}
		return $error;
	}

	public function setProductImages()
	{
		$post = $this->input->post(NULL, TRUE);
		$message = '<strong>ตั้งค่า shop image สำเร็จ</strong>';
		$upload_error = 0;
		$upload_error_msg = '';
		$success = TRUE;
		//$encrypt_id = '';
		$encrypt_name = '';
		$id = '';
		$data = array();

		if (isset($post['data'])) {
			$arr = json_decode($post['data']);
			foreach ($arr as $key => $value) {
				$this->load->model('common_model');
				$id = $this->common_model->update(
					'shop_images',
					array(
						'user_update' => get_session('user_id'),
						'datetime_update' => date("Y-m-d H:i:s"),
						'shop_id' => $post['shop_id']
					),
					array('image_id' => $value)
				);
			}
		} else {
			$success = FALSE;
			$message = '<strong>ตั้งค่า shop image ล้มเหลว</strong>';
		}
		$json = json_encode(array(
			'is_successful' => $success,
			//'encrypt_id' =>  $encrypt_id,
			'message' => $message,
			'id' => $id,
			'data' => $data,
		));
		echo $json;
	}

	public function uploadfile1()
	{
		$message = '<strong>อัปโหลดสำเร็จ</strong>';
		$upload_error = 0;
		$upload_error_msg = '';
		$success = TRUE;
		//$encrypt_id = '';
		$encrypt_name = '';
		$id = '';

		$post = $this->input->post(NULL, TRUE);
		$filename = $post['filename'];


		//$path = $this->upload_store_path .(date('Y')+543);
		$path = $this->upload_store_path;

		$blob = $post['blob'];

		$blob = str_replace("[removed]", 'data:image/png;base64,', $blob);
		$blob = str_replace("\\", '', $blob);
		$blob = str_replace(" ", '+', $blob);

		$arr = explode('.', $post['filename']);
		$encrypt_name = uniqid() . '.' . $arr[count($arr) - 1];

		$file = @fopen($path . '/' . $encrypt_name, "wb");
		if ($file) {
			$data = explode(',', $blob);
			fwrite($file, base64_decode($data[1]));
			fclose($file);

			$this->load->model('common_model');
			$id = $this->common_model->insert(
				'shop_images',
				array(
					'user_add' => get_session('user_id'),
					'datetime_add' => date("Y-m-d H:i:s"),
					'encrypt_name' => $path . $encrypt_name,
					'filename' => $filename,
					'shop_id' => $post['shop_id']
				)
			);
		} else {
			$success = FALSE;
			$message = "File Path Error!";
		}

		$json = json_encode(array(
			'is_successful' => $success,
			//'encrypt_id' =>  $encrypt_id,
			'message' => $message,
			'id' => $id,
			'path' => $path,
			'encrypt_name' => $encrypt_name,
			'filename' => $filename
		));
		echo $json;
	}
	public function deleteShopImage()
	{
		$post = $this->input->post(NULL, TRUE);
		$message = '<strong>ลบ shop image สำเร็จ</strong>';
		$upload_error = 0;
		$upload_error_msg = '';
		$success = TRUE;
		//$encrypt_id = '';
		$encrypt_name = '';
		$id = $post['image_id'];
		$data = array();

		if ($id != '') {
			$this->load->model('common_model');
			$row = rowArray($this->common_model->custom_query("select * from shop_images where image_id='" . $id . "'"));
			if (isset($row['datetime_add'])) {
				//$year = substr($row['datetime_add'],0,4);
				$this->removeFile1($row['encrypt_name']);
				$this->common_model->update('shop_images', array('user_delete' => get_session('user_id'), 'datetime_delete' => date("Y-m-d H:i:s"), 'fag_allow' => 'delete'), array('image_id' => $id));
			}
		} else {
			$success = FALSE;
			$message = '<strong>ลบ shop image ล้มเหลว</strong>';
		}

		$json = json_encode(array(
			'is_successful' => $success,
			//'encrypt_id' =>  $encrypt_id,
			'message' => $message,
			'id' => $id,
			'data' => $data,
		));
		echo $json;
	}

	/*
	public function __destruct() {
		$this->db->query('UNLOCK TABLES');
		$this->db->close();
	}
	*/

	private function removeFile1($file_path)
	{
		if ($file_path != '') {
			if (file_exists($file_path)) {
				unlink($file_path);
			}
		}
	}

	/**
	 * Update Record
	 */
	public function update()
	{
		$message = '';
		$message .= $this->formValidateWithFile();
		$message .= $this->formValidateUpdate();
		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "รหัสอ้างอิงที่ใช้สำหรับอัพเดตข้อมูลไม่ถูกต้อง";
		}
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {

			$upload_error = 0;
			$upload_error_msg = '';
			if (!empty($_FILES['product_img1']['name'])) {
				$arr = $this->uploadFile('product_img1');
				if ($arr['result'] == TRUE) {
					$post['product_img1'] = $arr['file_path'];
					$this->removeFile($post['product_img1_old_path']);
					$arr = explode('/', $post['product_img1_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				} else {
					$upload_error++;
					$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
				}
			}
			if (!empty($_FILES['product_img2']['name'])) {
				$arr = $this->uploadFile('product_img2');
				if ($arr['result'] == TRUE) {
					$post['product_img2'] = $arr['file_path'];
					$this->removeFile($post['product_img2_old_path']);
					$arr = explode('/', $post['product_img2_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				} else {
					$upload_error++;
					$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
				}
			}
			if (!empty($_FILES['product_img3']['name'])) {
				$arr = $this->uploadFile('product_img3');
				if ($arr['result'] == TRUE) {
					$post['product_img3'] = $arr['file_path'];
					$this->removeFile($post['product_img3_old_path']);
					$arr = explode('/', $post['product_img3_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				} else {
					$upload_error++;
					$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
				}
			}
			if (!empty($_FILES['product_img4']['name'])) {
				$arr = $this->uploadFile('product_img4');
				if ($arr['result'] == TRUE) {
					$post['product_img4'] = $arr['file_path'];
					$this->removeFile($post['product_img4_old_path']);
					$arr = explode('/', $post['product_img4_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				} else {
					$upload_error++;
					$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
				}
			}
			if (!empty($_FILES['product_img5']['name'])) {
				$arr = $this->uploadFile('product_img5');
				if ($arr['result'] == TRUE) {
					$post['product_img5'] = $arr['file_path'];
					$this->removeFile($post['product_img5_old_path']);
					$arr = explode('/', $post['product_img5_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				} else {
					$upload_error++;
					$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
				}
			}

			if ($upload_error == 0) {
				$result = $this->Products->update($post);
				if ($result == false) {
					$message = $this->Products->error_message;
					$ok = FALSE;
				} else {
					$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Products->error_message;
					$ok = TRUE;
				}
			} else {
				$ok = FALSE;
				$message = $upload_error_msg;
			}
			$json = json_encode(array(
				'is_successful' => $ok,
				'message' => $message
			));

			echo $json;
		}
	}

	/**
	 * Delete Record
	 */
	public function del()
	{
		//$delete_remark = $this->input->post('delete_remark', TRUE);
		$message = '';
		/*
		if ($delete_remark == '') {
			$message .= 'ระบุเหตุผล';
		}
		*/

		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "รหัสอ้างอิงที่ใช้สำหรับลบข้อมูลไม่ถูกต้อง";
		}
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {
			$result = $this->Products->delete($post);
			if ($result == false) {
				$message = $this->Products->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>ลบข้อมูลเรียบร้อย</strong>';
				$ok = TRUE;
			}
			$json = json_encode(array(
				'is_successful' => $ok,
				'message' => $message
			));
			echo $json;
		}
	}


	/**
	 * SET array data list
	 */
	private function setDataListFormat($lists_data, $start_row = 0)
	{
		$data = $lists_data;
		$count = count($lists_data);
		for ($i = 0; $i < $count; $i++) {
			$start_row++;
			$data[$i]['record_number'] = $start_row;
			$pk1 = $data[$i]['product_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if ($pk1 != '') {
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_product_id'] = $pk1;
			$data[$i]['preview_fag_allow'] = $this->setFagAllowSubject($data[$i]['fag_allow']);
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);
			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
			$arr = explode('/', $data[$i]['product_img1']);
			$encrypt_file_name = end($arr);
			$filename = $this->Products->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_file_name'", $this->db);
			$data[$i]['preview_product_img1'] = setAttachLink('product_img1', $data[$i]['product_img1'], $filename);
			$arr = explode('/', $data[$i]['product_img2']);
			$encrypt_file_name = end($arr);
			$filename = $this->Products->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_file_name'", $this->db);
			$data[$i]['preview_product_img2'] = setAttachLink('product_img2', $data[$i]['product_img2'], $filename);
		}
		return $data;
	}

	/**
	 * SET choice subject
	 */
	private function setFagAllowSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'allow':
				$subject = 'เผยแพร่';
				break;
			case 'block':
				$subject = 'ไม่เผยแพร่';
				break;
			case 'delete':
				$subject = 'ลบ';
				break;
		}
		return $subject;
	}

	/**
	 * SET array data list
	 */
	private function setPreviewFormat($row_data)
	{
		$data = $row_data;
		$pk1 = $data['product_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if ($pk1 != '') {
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_product_id'] = $pk1;

		$this->data['record_product_id'] = $data['product_id'];

		$this->load->model('common_model');

		$arr = explode('/', $data['product_img1']);
		$encrypt_name = end($arr);
		$filename = $this->Products->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		$this->data['record_product_img1_label'] = $filename;
		$this->data['preview_product_img1'] = setAttachPreview('product_img1', $data['product_img1'], $filename);

		$arr = explode('/', $data['product_img2']);
		$encrypt_name = end($arr);
		$filename = $this->Products->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		$this->data['record_product_img2_label'] = $filename;
		$this->data['preview_product_img2'] = setAttachPreview('product_img2', $data['product_img2'], $filename);

		$arr = explode('/', $data['product_img3']);
		$encrypt_name = end($arr);
		$filename = $this->Products->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		$this->data['record_product_img3_label'] = $filename;
		if ($data['product_img3'] == '') {
			$this->data['preview_product_img3'] = '<div id="div_preview_product_img3" class="py-3 div_file_preview" style="clear:both"><img id="product_img3_preview" style="object-fit:contain ; width: 100%; height: 420px;"/></div>';
			$this->data['preview_products_img3'] = '';
		}
		else {
			$this->data['preview_product_img3'] = setAttachPreview('product_img3', $data['product_img3'], $filename);
			$this->data['preview_products_img3'] = setAttachProductPreview('product_img3', $data['product_img3'], $filename);

		}

		$arr = explode('/', $data['product_img4']);
		$encrypt_name = end($arr);
		$filename = $this->Products->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		$this->data['record_product_img4_label'] = $filename;
		if ($data['product_img4'] == '') {
			$this->data['preview_product_img4'] = '<div id="div_preview_product_img4" class="py-4 div_file_preview" style="clear:both"><img id="product_img4_preview" style="object-fit:contain ; width: 100%; height: 420px;"/></div>';
			$this->data['preview_products_img4'] = '';
		}
		else {
			$this->data['preview_product_img4'] = setAttachPreview('product_img4', $data['product_img4'], $filename);
			$this->data['preview_products_img4'] = setAttachProductPreview('product_img4', $data['product_img4'], $filename);
		}

		$arr = explode('/', $data['product_img5']);
		$encrypt_name = end($arr);
		$filename = $this->Products->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		$this->data['record_product_img5_label'] = $filename;
		if ($data['product_img5'] == '') {
			$this->data['preview_product_img5'] = '<div id="div_preview_product_img5" class="py-5 div_file_preview" style="clear:both"><img id="product_img5_preview" style="object-fit:contain ; width: 100%; height: 420px;"/></div>';
			$this->data['preview_products_img5'] = '';
		}
		else {
			$this->data['preview_product_img5'] = setAttachPreview('product_img5', $data['product_img5'], $filename);
			$this->data['preview_products_img5'] = setAttachProductPreview('product_img5', $data['product_img5'], $filename);

		}


		$this->data['record_product_code'] = $data['product_code'];
		$this->data['record_product_name_th'] = $data['product_name_th'];
		$this->data['record_product_name_en'] = $data['product_name_en'];
		$this->data['record_description_th'] = $data['description_th'];
		$this->data['record_description_en'] = $data['description_en'];
		$this->data['record_price'] = $data['price'];
		$this->data['record_keyword'] = $data['keyword'];
		$this->data['record_user_delete'] = $data['user_delete'];
		$this->data['record_datetime_delete'] = $data['datetime_delete'];
		$this->data['record_user_add'] = $data['user_add'];
		$this->data['record_datetime_add'] = $data['datetime_add'];
		$this->data['record_user_update'] = $data['user_update'];
		$this->data['record_datetime_update'] = $data['datetime_update'];
		$this->data['preview_fag_allow'] = $this->setFagAllowSubject($data['fag_allow']);
		$this->data['record_fag_allow'] = $data['fag_allow'];

		$this->data['record_datetime_delete'] = setThaiDate($data['datetime_delete']);
		$this->data['record_datetime_add'] = setThaiDate($data['datetime_add']);
		$this->data['record_datetime_update'] = setThaiDate($data['datetime_update']);


		$this->data['preview_products_img1'] = setAttachProductPreview('product_img1', $data['product_img1'], $filename);
		$this->data['preview_products_img2'] = setAttachProductPreview('product_img2', $data['product_img2'], $filename);
	}
}
/*---------------------------- END Controller Class --------------------------------*/
