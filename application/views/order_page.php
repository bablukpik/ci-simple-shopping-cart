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
			$this->table->add_row($product->name, $product->unit_price, $product->description, anchor('order/insert_cart/'.$product->id, 'Add to Cart'));
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
	<?php echo form_open('order/update_cart'); ?>

	<table cellpadding="2" cellspacing="1" style="width:100%;" border="1">

	<tr>
	        <th>Options</th>
	        <th>QTY</th>
	        <th>Name</th>
	        <th style="text-align:center">Price</th>
	        <th style="text-align:center;">Sub-Total</th>
	</tr>

	<?php $i = 1; ?>

	<?php foreach ($this->cart->contents() as $items): ?>

	        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

	        <tr>
	                <td style="text-align:center;"><?php echo anchor('order/removeProduct/'.$items['rowid'], 'X'); ?></td>
	                <td><?php echo form_input(array('name' => 'qty'.$i, 'value' => $items['qty'], 'size' => '5')); ?></td>
	                <td>
	                        <?php echo $items['name']; ?>

	                        <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

	                                <p>
	                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

	                                                <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

	                                        <?php endforeach; ?>
	                                </p>

	                        <?php endif; ?>

	                </td>
	                <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
	                <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
	        </tr>

	<?php $i++; ?>

	<?php endforeach; ?>

	<tr>
	        <td colspan="2"> </td>
	        <td style="text-align: right;"><strong>Total</strong></td>
	        <td style="text-align: right;">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
	</tr>

	</table>

	<p><?php echo form_submit('', 'Update your Cart'); ?></p>
	<!--End Cart view-->

</body>
</html>