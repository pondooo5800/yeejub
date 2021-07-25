<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : About.php ]
 */
class About extends CI_Controller
{

	private $data;
	private $per_page;
	private $breadcrumb_data;
	private $left_sidebar_data;
	private $another_js;
	private $another_css;

	public function __construct()
	{
		parent::__construct();
		check_lang();

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
		$this->data['top_navbar'] = $this->parser->parse('template/majestic/frontendpage_navbar_view', $this->data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/majestic/frontendpage_view', $this->data);
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
		// $start_row = 0;
		// $results_news = $this->Frontend_news->read_about($start_row);
		// $list_data_news = $this->setDataListFormat($results_news['list_data'], $start_row);
		// $this->data['data_list_get_news'] = $list_data_news;
		// $this->data['data_news_list'] = $list_data_news;

		// $results_shops = $this->Frontend_shops->read_about($start_row);
		// $list_data_shops = $results_shops['list_data'];
		// $this->data['data_list_shops'] = $list_data_shops;

		$this->render_view('about');
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
	}
}
/*---------------------------- END Controller Class --------------------------------*/
