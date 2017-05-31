<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order2_m extends CI_Model {

	//Display products
	public function getAllProducts()
	{
		return $this->db->get('products')->result();
	}

	//Get product by id
	public function getProductByID($id)
	{	
		$this->db->where('id', $id);
		return $this->db->get('products')->row();
	}

}

/* End of file order_m2.php */
/* Location: ./application/models/order_m2.php */