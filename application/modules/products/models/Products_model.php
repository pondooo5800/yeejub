<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Products_model Class
 * @date 2019-12-05
 */
class Products_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_products';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$product_id = checkEncryptData($data['product_id']);
		$this->set_where("$this->my_table.product_id = $product_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.product_id = $id");
		return $this->load_record();
	}


	public function create($post)
	{
		$data = array(
			'product_code' => getAutoNumber('tb_products','product_code','',5),
			'product_name' => $post['product_name'],
			'product_type' => $post['product_type'],
			'banner_type' => $post['banner_type'],
			'product_unit_id' => $post['product_unit_id'],
			'product_pro_id' => $post['product_pro_id'],
			'price' => $post['price'],
			'product_img1' => ($post['product_img1'] != '' ? $post['product_img1'] : ''),
			'fag_allow' => ($post['fag_allow'] != '' ? $post['fag_allow'] : 'allow'),
		);
		return $this->add_record($data);
	}
	public function create_file_img($file_path)
	{
		$data = array(
			'product_code' => getAutoNumber('tb_products','product_code','',5),
			'product_img1' => ($file_path),
			'fag_allow' => 'allow',
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
		$order_by	= 'product_id DESC ';
		if ($this->order_field != '') {
			$order_field = $this->order_field;
			$order_sort = $this->order_sort;
			$order_by	= " $this->my_table.$order_field $order_sort";
		}

		if ($search_field != '' && $value != '') {
			$search_method_field = "$this->my_table.$search_field";
			$search_method_value = '';
			if ($search_field == 'product_code') {
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'product_name') {
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'product_type_name') {
				$search_method_field = "tb_products_types.product_type_name";
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
			$this->db->join('tb_products_types', "$this->my_table.product_type = tb_products_types.product_type_id", 'left');
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
		$this->db->select("$this->my_table.*,tb_products_types.product_type_name,tb_promotions.promotion_name,tb_banners.banner_name,tb_products_units.product_unit_name");
		$this->db->join('tb_products_types', "$this->my_table.product_type = tb_products_types.product_type_id", 'left');
		$this->db->join('tb_promotions', "$this->my_table.product_pro_id = tb_promotions.promotion_id", 'left');
		$this->db->join('tb_banners', "$this->my_table.banner_type = tb_banners.banner_id", 'left');
		$this->db->join('tb_products_units', "$this->my_table.product_unit_id = tb_products_units.product_unit_id", 'left');
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
			'product_code' => $post['product_code'],
			'product_name' => $post['product_name'],
			'product_type' => $post['product_type'],
			'banner_type' => $post['banner_type'],
			'product_unit_id' => $post['product_unit_id'],
			'product_pro_id' => $post['product_pro_id'],
			'price' => $post['price'],
			'fag_allow' => $post['fag_allow'],
		);

		if (isset($post['product_img1'])) {
			$data['product_img1'] = $post['product_img1'];
		}


		$product_id = checkEncryptData($post['encrypt_product_id']);
		$this->set_where("$this->my_table.product_id = $product_id");
		return $this->update_record($data);
	}
	public function updateAjax($post)
	{
		if ($post['type'] == "promotion") {
			$data = array(
				'product_pro_id' => $post['product_pro_id']
			);
		} else if ($post['type'] == "unit") {
			$data = array(
				'product_unit_id' => $post['product_unit_id']
			);
		} else if ($post['type'] == "banner") {
			$data = array(
				'banner_type' => $post['banner_type']
			);
		} else if ($post['type'] == "product") {
			$data = array(
				'product_type' => $post['product_type']
			);
		}
		$product_id = $post['id'];
		$this->set_where("$this->my_table.product_id = $product_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$product_id = checkEncryptData($post['encrypt_product_id']);
		$this->set_where("$this->my_table.product_id = $product_id");
		return $this->delete_record();
	}
}
/*---------------------------- END Model Class --------------------------------*/
