<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	function __construct($foo = null)
	{
		parent::__construct();
		$this->load->model('Order_m');
		$this->load->library('cart');
		$this->load->library('table');
	}

	//Display all products
	public function index()
	{
		$allProducts = $this->Order_m->getAllProducts();
		
		$this->load->view('order_page', ['allProducts'=>$allProducts]);
	}

	//Add products to cart or Buy products
	public function insert_cart($id)
	{
		$insertProductToCart = $this->Order_m->getProductByID($id);
		$data = array(
	        'id'      		=> $insertProductToCart->id,
	        'qty'     		=> 1, //Default quantity
	        'price'   		=> $insertProductToCart->unit_price,
	        'name'    		=> $insertProductToCart->name,
		);

		$this->cart->insert($data);
		
		redirect('order','refresh');
	}

	//update cart
	public function update_cart()
	{	
		$i=1;

		foreach ($this->cart->contents() as $items) {
			$data = array(
		        'rowid' => $items['rowid'],
		        'qty'   => $_POST['qty'.$i]
			);

			$result = $this->cart->update($data);
			$i++;
		}

		redirect('order');
	}

	//remove Products from Cart
	public function removeProduct($rowid)
	{
		$data = array(
	        'rowid' => $rowid,
	        'qty'   => 0
		);

		$this->cart->update($data);
		redirect('order/index');
	}

}

/* End of file order.php */
/* Location: ./application/controllers/order.php */