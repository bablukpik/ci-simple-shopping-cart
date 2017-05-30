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
	        <th>Product Name</th>
	        <th>Unit</th>
	        <th>Rate</th>
	        <th style="text-align:center">Total Amount</th>
	        <th style="text-align:center;">Options</th>
	</tr>

	<?php $i = 1; ?>

	<?php foreach ($this->cart->contents() as $items): ?>

	        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

	        <tr>
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
	                <td><?php echo form_input(array('name' => 'qty'.$i, 'value' => $items['qty'], 'size' => '10')); ?></td>
	                <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
	                <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
	                <td style="text-align:center;"><?php echo anchor('order/removeProduct/'.$items['rowid'], 'X'); ?></td>
	        </tr>

	<?php $i++; ?>

	<?php endforeach; ?>
		<tr>
			<td colspan="3" style="text-align: right;">Sub Total : </td>
			<td style="text-align: right;">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
			
			<td style="text-align: center;">Clear</td>
		</tr>

	</table>

	<p><?php echo form_submit('', 'Update your Cart'); ?></p>
	<!--End Cart view-->

</body>
</html>