<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Banners_model Class
 * @date 2019-12-05
 */
class Banners_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_banners';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$banner_id = checkEncryptData($data['banner_id']);
		$this->set_where("$this->my_table.banner_id = $banner_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.banner_id = $id");
		return $this->load_record();

	}


	public function create($post)
	{
		$data = array(
			'banner_name' => $post['banner_name'],
			'banner_img1' => $post['banner_img1'],
			'fag_allow' => $post['fag_allow'],
		);
		return $this->add_record($data);
	}


	/**
	 * List all data
	 * @param $start_row	Number offset record start
	 * @param $per_page	Number limit record perpage
	 */
	public function read($start_row, $per_page)
	{
		$search_field 	= $this->session->userdata($this->session_name . '_search_field');
		$value 	= $this->session->userdata($this->session_name . '_value');
		$value 	= trim($value);

		$where	= '';
		$order_by	= 'banner_id DESC ';
		if ($this->order_field != '') {
			$order_field = $this->order_field;
			$order_sort = $this->order_sort;
			$order_by	= " $this->my_table.$order_field $order_sort";
		}

		if ($search_field != '' && $value != '') {
			$search_method_field = "$this->my_table.$search_field";
			$search_method_value = '';
			if ($search_field == 'banner_name') {
				$search_method_value = "LIKE '%$value%'";
			}
			// if ($search_field == 'email_addr') {
			// 	$search_method_value = "LIKE '%$value%'";
			// }
			// if ($search_field == 'shop_user') {
			// 	$search_method_field = "users_2.user_fname";
			// 	$search_method_value = "LIKE '%$value%'";
			// }
			// if ($search_field == 'fag_allow') {
			// 	$search_method_value = "LIKE '%$value%'";
			// }
			$where	.= ($where != '' ? ' AND ' : '') . " $search_method_field $search_method_value ";
			if ($order_by == '') {
				$order_by	= " $this->my_table.$search_field";
			}
		}
		$total_row = $this->count_record();
		$search_row = $total_row;
		if ($where != '') {
			// $this->db->join('category AS category_1', "$this->my_table.cate_id = category_1.cate_id", 'left');
			// $this->db->join('users AS users_2', "$this->my_table.shop_user = users_2.user_id", 'left');
			// $this->db->join('users AS users_3', "$this->my_table.user_delete = users_3.user_id", 'left');
			// $this->db->join('users AS users_4', "$this->my_table.user_add = users_4.user_id", 'left');
			// $this->db->join('users AS users_5', "$this->my_table.user_update = users_5.user_id", 'left');

			$this->set_where($where);
			$search_row = $this->count_record();
		}
		$offset = $start_row;
		$limit = $per_page;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);
		$this->db->select("$this->my_table.*");
		// $this->db->join('users AS users_2', "$this->my_table.shop_user = users_2.user_id", 'left');
		// $this->db->join('users AS users_3', "$this->my_table.user_delete = users_3.user_id", 'left');
		// $this->db->join('users AS users_4', "$this->my_table.user_add = users_4.user_id", 'left');
		// $this->db->join('users AS users_5', "$this->my_table.user_update = users_5.user_id", 'left');

		$list_record = $this->list_record();
		// print_r($this->db->last_query());
		// die();

		$data = array(
			'total_row'	=> $total_row,
			'search_row'	=> $search_row,
			'list_data'	=> $list_record
		);
		return $data;
	}

	public function update($post)
	{
		$data = array(
			'banner_name' => $post['banner_name'],
			'fag_allow' => $post['fag_allow'],
		);

		if (isset($post['banner_img1'])) {
			$data['banner_img1'] = $post['banner_img1'];
		}


		$banner_id = checkEncryptData($post['encrypt_banner_id']);
		$this->set_where("$this->my_table.banner_id = $banner_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$banner_id = checkEncryptData($post['encrypt_banner_id']);
		$this->set_where("$this->my_table.banner_id = $banner_id");
		return $this->delete_record();
	}
}
/*---------------------------- END Model Class --------------------------------*/
