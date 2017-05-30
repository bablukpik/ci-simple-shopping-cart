<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shopping Cart</title>
</head>
<body>
	<!--Products view-->
	<?php 

		$this->table->set_heading('Name', 'Unit Price', 'Description', 'Order Now');

		foreach ($allProducts as $product) {
			$this->table->add_row($product->name, $product->unit_price, $product->description, anchor('order/insert_cart/'.$product->id, 'Add to Cart', array('class' => 'addToCartBtn')));
		}

		$template = array(
        	'table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">'
		);
		$this->table->set_template($template);

		echo $this->table->generate();
	?>
	<!--End Products view-->
	<br><br>

	<!--Cart view-->
		<div id="cartView">
			
		</div>
	<!--End Cart view-->
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

<script>
	jQuery(function(){

		//Add product to cart
		$(".addToCartBtn").on('click', function(event){
			event.preventDefault();
	        var url = $(this).attr('href');

	        //url sent
	        $.ajax({
	            url: url,
	            type: "POST",
	            data: {},
	            success: function(data){
		            //Cart page load
		        	$("#cartView").load("<?php echo base_url('order/view_cart'); ?>");
	            }
	        });

	        
	    });

	});
</script>
</body>
</html>