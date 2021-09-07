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
		$this->file_allow_type = @array_values($this->file_allow);
		$this->file_allow_mime = @array_keys($this->file_allow);
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
		$this->data['top_navbar'] = $this->parser->parse('template/backend/navbarView', $this->top_navbar_data, TRUE);
		$this->data['left_sidebar'] = $this->parser->parse('template/backend/sidebarView', $this->left_sidebar_data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/backend/indexView', $this->data);
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
		// $this->setPreviewFormat($results);

		// 		print_r($this->db->last_query());
		// die();

		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);

// 		echo '<pre>';
// 		print_r($list_data);
// echo '</pre>';
// 		exit;


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
		$this->data['products_types_option_list'] = $this->Products->returnOptionList("tb_products_types", "product_type_id", "product_type_name");
		$this->data['product_unit_id_option_list'] = $this->Products->returnOptionList("tb_products_units", "product_unit_id", "product_unit_name");
		$this->data['product_pro_id_option_list'] = $this->Products->returnOptionList("tb_promotions", "promotion_id", "promotion_name");
		$this->data['banner_type_option_list'] = $this->Products->returnOptionList("tb_banners", "banner_id", "banner_name");
		$this->render_view('products/products/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
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
		$this->data['products_types_option_list'] = $this->Products->returnOptionList("tb_products_types", "product_type_id", "product_type_name");
		$this->data['product_unit_id_option_list'] = $this->Products->returnOptionList("tb_products_units", "product_unit_id", "product_unit_name");
		$this->data['product_pro_id_option_list'] = $this->Products->returnOptionList("tb_promotions", "promotion_id", "promotion_name");
		$this->data['banner_type_option_list'] = $this->Products->returnOptionList("tb_banners", "banner_id", "banner_name");
		$this->data['preview_product_img1'] = '<div id="div_preview_product_img1" class="py-3 div_file_preview" style="clear:both"><img id="product_img1_preview" style="object-fit:contain ; width: 100%; height: 320px;"/></div>';
		$this->data['record_product_img1_label'] = '';

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
				$frm->set_rules('product_img1', 'รูปภาพสินค้า', 'trim|required');
			}
		}

		$frm->set_rules('product_name', 'ชื่อสินค้า', 'trim|required');
		$frm->set_rules('product_type', 'ประเภทสินค้า', 'trim|required');
		$frm->set_rules('price', 'ราคา', 'trim|required|is_natural');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('product_name');
			$message .= form_error('product_type');
			$message .= form_error('price');
			$message .= form_error('fag_allow');
			$message .= form_error('product_img1');
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
				$frm->set_rules('product_img1', 'รูปภาพสินค้า', 'trim|required');
			}
		}

		$frm->set_rules('product_name', 'ชื่อสินค้า', 'trim|required');
		$frm->set_rules('product_type', 'ประเภทสินค้า', 'trim|required');
		$frm->set_rules('price', 'ราคา', 'trim|required|is_natural');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('product_name');
			$message .= form_error('product_type');
			$message .= form_error('price');
			$message .= form_error('fag_allow');
			$message .= form_error('product_img1');
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
			$frm->set_rules('product_img1', 'รูปภาพสินค้า', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('product_img1');
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
		// $message .= $this->formValidate();
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {

			$post = $this->input->post(NULL, TRUE);
			// die(print_r($post));
			$upload_error = 0;
			$upload_error_msg = '';
			$arr = $this->uploadFile('product_img1');
			if ($arr['result'] == TRUE) {
				$post['product_img1'] = $arr['file_path'];
			}
			// else {
			// 	$upload_error++;
			// 	$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
			// }
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
	public function upload($dir = '')
	{
		sleep(3);
		if ($dir != '' && substr($dir, 0, 1) != '/') {
			$dir = '/' . $dir;
		}
		$path = $this->upload_store_path . $dir;

		if ($_FILES["files"]["name"] != '') {
			$output = '';
			$config['upload_path']          = $path;
			$config['allowed_types']        = $this->file_allow_type;
			$config['encrypt_name']		= TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			for ($count = 0; $count < count($_FILES["files"]["name"]); $count++) {
				$_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
				$_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
				$_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
				$_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
				$_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
				if ($this->upload->do_upload('file')) {
					$encrypt_name = $this->upload->file_name;
					$orig_name = $this->upload->orig_name;
					$this->FileUpload->create($encrypt_name, $orig_name);
					$file_path = $path . '/' . $encrypt_name; //ไม่ต้องใช้ Path เต็ม
					$this->Products->create_file_img($file_path);
					$data = $this->upload->data();
	// 				$output .= '
    //  <div class="col-md-3">
	//  <p style="text-align: center;">
	// 	Upload File Success
	// </p>
	//  </div>
    //  ';
				}
			}
			echo $output;
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
				$this->data['products_types_option_list'] = $this->Products->returnOptionList("tb_products_types", "product_type_id", "product_type_name");
				$this->data['product_unit_id_option_list'] = $this->Products->returnOptionList("tb_products_units", "product_unit_id", "product_unit_name");
				$this->data['product_pro_id_option_list'] = $this->Products->returnOptionList("tb_promotions", "promotion_id", "promotion_name");
				$this->data['banner_type_option_list'] = $this->Products->returnOptionList("tb_banners", "banner_id", "banner_name");

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

	/**
	 * Update Record
	 */
	public function updateAjax() {
		$message = '';
		$post = $this->input->post(NULL, TRUE);
		// die(print_r($post));
		$result = $this->Products->updateAjax($post);
		if ($result == false) {
			$message = $this->Products->error_message;
			$ok = FALSE;
		} else {
			$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Products->error_message;
			$ok = TRUE;
		}
			$json = json_encode(array(
				'is_successful' => $ok,
				'message' => $message
			));
			echo $json;
	}
	public function update()
	{
		$message = '';
		// $message .= $this->formValidateWithFile();
		// $message .= $this->formValidateUpdate();
		$post = $this->input->post(NULL, TRUE);
		// die(print_r($post));
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
				}
				// else {
				// 	$upload_error++;
				// 	$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
				// }
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
			$data[$i]['record_product_id'] = $data[$i]['product_id'];
			$data[$i]['record_product_type'] = $data[$i]['product_type'];
			$data[$i]['record_banner_type'] = $data[$i]['banner_type'];
			$data[$i]['record_product_unit_id'] = $data[$i]['product_unit_id'];
			$data[$i]['record_product_pro_id'] = $data[$i]['product_pro_id'];
			$data[$i]['product_type_name'] = $data[$i]['product_type_name'];
			$data[$i]['record_banner_type'] = $data[$i]['banner_type'];
			$data[$i]['record_product_unit_name'] = $data[$i]['product_unit_name'];
			$data[$i]['record_promotion_name'] = $data[$i]['promotion_name'];
			$data[$i]['record_banner_name'] = $data[$i]['banner_name'];
			$data[$i]['preview_fag_allow'] = $this->setFagAllowSubject($data[$i]['fag_allow']);
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);
			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
			$arr = explode('/', $data[$i]['product_img1']);
			$encrypt_file_name = end($arr);
			$filename = $this->Products->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_file_name'", $this->db);
			$data[$i]['preview_product_img1'] = setAttachLink('product_img1', $data[$i]['product_img1'], $filename);
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



		$this->data['record_product_code'] = $data['product_code'];
		$this->data['record_product_name'] = $data['product_name'];
		$rows = rowArray($this->common_model->custom_query("select tb_products_types.product_type_name FROM tb_products LEFT JOIN tb_products_types ON tb_products.product_type = tb_products_types.product_type_id WHERE tb_products.fag_allow != 'delete' and tb_products.product_id =" .$data['product_id']));
		$this->data['record_product_type_name'] = $rows['product_type_name'];
		$this->data['record_product_type'] = $data['product_type'];
		$this->data['record_banner_type'] = $data['banner_type'];
		$this->data['record_product_unit_id'] = $data['product_unit_id'];
		$this->data['record_product_pro_id'] = $data['product_pro_id'];

		$this->data['record_price'] = $data['price'];
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
	}
}
/*---------------------------- END Controller Class --------------------------------*/
