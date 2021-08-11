<?php
class Shop_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function record_count()
  {
    return $this->db->count_all("tb_products");
  }
  public function fetch_product($limit, $start)
  {
    $this->db->limit($limit, $start);
    $this->db->from("tb_products");
    $this->db->where("fag_allow = 'allow'");
    $this->db->order_by("product_id", "desc");
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }
  public function fetch_category($limit, $start ,$product_type_id)
  {
    $this->db->limit($limit, $start);
    $this->db->from("tb_products");
    $this->db->where("fag_allow = 'allow'");
    $this->db->where("product_type =".$product_type_id);
    $this->db->order_by("product_id", "desc");
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }
  public function search($key)
  {
    $this->db->like('product_name', $key);
    $query = $this->db->get('tb_products');
    return $query->result_array();
  }

}
