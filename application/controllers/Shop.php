<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Shop.php ]
 */
class Shop extends CI_Controller
{

	private $data;
	private $per_page;
	private $breadcrumb_data;
	private $left_sidebar_data;
	private $another_js;
	private $another_css;
	public $PAGE;

	public function __construct()
	{
		parent::__construct();
        // Load cart library
		chkMemberPerm();
		$this->load->model("Shop_model");
    	$this->load->library("pagination");
		$this->load->library('cart');

		// Load product model
		$this->load->model('product_model', 'product');

		$data['base_url'] = base_url();
		$data['site_url'] = site_url();

		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_cookie_name'] = $this->config->item('csrf_cookie_name');
		$data['csrf_protection_field'] = insert_csrf_field(true);

		$this->per_page = 12;
		$this->num_links = 6;
		$this->uri_segment = 3;

		$this->data = $data;
		$this->breadcrumb_data = $data;
		$this->left_sidebar_data = $data;

		$this->another_js .= '<script src="' . base_url('assets/themes/sb-admin/vendor/chart.js/Chart.min.js') . '"></script>';
		$this->another_js .= '<script src="' . base_url('assets/themes/sb-admin/js/sb-admin-charts.min.js') . '"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Render this controller page
	 * @param String path of controller
	 * @param Integer total record
	 */
	private function render_view($path)
	{
		$this->data['page_header'] = $this->parser->parse('template/frontend/headerView', $this->data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['page_footer'] = $this->parser->parse('template/frontend/footerView', $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/frontend/indexView', $this->data);
	}
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

	public function index()
	{
		$config = array();
        $config["base_url"] = base_url() . "shop/index";
        $config["total_rows"] = $this->Shop_model->record_count();
        $config["per_page"] = 12;
		$config["uri_segment"] = 3;

		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['first_link']       = false;
		$config['last_link']        = false;
		$config['full_tag_open']    = '<ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul>';
		$config['attributes']       = ['class' => 'page-link'];
		$config['first_tag_open']   = '<li class="page-item">';
		$config['first_tag_close']  = '</li>';
		$config['prev_tag_open']    = '<li class="page-item">';
		$config['prev_tag_close']   = '</li>';
		$config['next_tag_open']    = '<li class="page-item">';
		$config['next_tag_close']   = '</li>';
		$config['last_tag_open']    = '<li class="page-item">';
		$config['last_tag_close']   = '</li>';
		$config['cur_tag_open']     = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open']     = '<li class="page-item">';
		$config['num_tag_close']    = '</li>';
		$this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['products'] = $this->Shop_model->
            fetch_product($config["per_page"], $page);
		$this->data['links'] = $this->pagination->create_links();
		$this->render_view('shop');
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
	}

	public function shop_details($product_id)
	{
		$query = $this->db->query('SELECT * FROM products WHERE product_id ='.$product_id);
        $this->data['products'] = $query->result_array();
        $this->data['language'] = $this->session->userdata('language');

		$this->render_view('shop_details');
	}
	public function addToCart($proID){
		// Fetch specific product by ID
		$size=$this->input->post('size');

        $product = $this->product->getRows($proID);

		// Add product to the cart
		$data = array(
            'id'    => $product['product_id'],
            'qty'    => 1,
            'price'    => $product['price'],
            'name'    => $product['product_name_en'],
			'image' => $product['product_img1'],
			'size' => $size,
        );
        $this->cart->insert($data);

        // Redirect to the cart page
        redirect('cart');
	}
	public function change($type)
	{
		$this->langlib->chooseLang($type); // ใช้สำหรับเปลี่ยนภาษาในทุก ๆ controller
	}
	public function pg()
	{
		$config = array();
        $config["base_url"] = base_url() . "shop/pg";
        $config["total_rows"] = $this->Shop_model->record_count();
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Shop_model->
            fetch_product($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view("welcome_message", $data);
  }

}
/*---------------------------- END Controller Class --------------------------------*/
