<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Settings_admin_model Class
 * @date 2019-12-05
 */
class Settings_admin_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_admin';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$user_id = checkEncryptData($data['user_id']);
		$this->set_where("$this->my_table.user_id = $user_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.user_id = $id");
		return $this->load_record();
	}


	public function update($post)
	{
		$data = array(
			'password' => $post['password'],
			'contact_name' => $post['contact_name'],
			'contact_addr' => $post['contact_addr'],
			'contact_tel' => $post['contact_tel'],
			'contact_email' => $post['contact_email'],
			'contact_facebook' => $post['contact_facebook'],
			'contact_line' => $post['contact_line'],
			'contact_facebook_link' => $post['contact_facebook_link'],
			'contact_line_link' => $post['contact_line_link'],
		);

		$user_id = checkEncryptData($post['encrypt_user_id']);
		$this->set_where("$this->my_table.user_id = $user_id");
		return $this->update_record($data);
	}
}
/*---------------------------- END Model Class --------------------------------*/
