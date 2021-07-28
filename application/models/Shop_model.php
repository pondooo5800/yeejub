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
}
