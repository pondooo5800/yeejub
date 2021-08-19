<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Products_units_model Class
 * @date 2019-12-05
 */
class Products_units_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_products_units';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$product_unit_id = checkEncryptData($data['product_unit_id']);
		$this->set_where("$this->my_table.product_unit_id = $product_unit_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.product_unit_id = $id");
		return $this->load_record();
	}


	public function create($post)
	{
		$data = array(
			'product_unit_name' => $post['product_unit_name'],
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
		$order_by	= 'product_unit_id DESC ';
		if ($this->order_field != '') {
			$order_field = $this->order_field;
			$order_sort = $this->order_sort;
			$order_by	= " $this->my_table.$order_field $order_sort";
		}

		if ($search_field != '' && $value != '') {
			$search_method_field = "$this->my_table.$search_field";
			$search_method_value = '';
			if ($search_field == 'product_unit_name') {
				$search_method_value = "LIKE '%$value%'";
			}
			$where	.= ($where != '' ? ' AND ' : '') . " $search_method_field $search_method_value ";
			if ($order_by == '') {
				$order_by	= " $this->my_table.$search_field";
			}
		}
		$total_row = $this->count_record();
		$search_row = $total_row;
		if ($where != '') {
			$this->set_where($where);
			$search_row = $this->count_record();
		}
		$offset = $start_row;
		$limit = $per_page;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);
		$this->db->select("$this->my_table.*");

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
			'product_unit_name' => $post['product_unit_name'],
			'fag_allow' => $post['fag_allow']
		);

		$product_unit_id = checkEncryptData($post['encrypt_product_unit_id']);
		$this->set_where("$this->my_table.product_unit_id = $product_unit_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$product_unit_id = checkEncryptData($post['encrypt_product_unit_id']);
		$this->set_where("$this->my_table.product_unit_id = $product_unit_id");
		return $this->delete_record();
	}
}
/*---------------------------- END Model Class --------------------------------*/
