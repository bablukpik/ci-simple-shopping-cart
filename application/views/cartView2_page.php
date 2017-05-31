	<?php echo form_open('order2/update_cart'); ?>

	<table cellpadding="2" cellspacing="1" style="width:100%;" border="1">

	<tr>
	        <th>Product Name</th>
	        <th>Unit</th>


	        <th>Rate</th>
	        <th style="text-align:center">Sub Total</th>
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
	                <td style="text-align:center;"><?php echo anchor('order/removeProduct/'.$items['rowid'], 'X', array('class' => 'removeFromCartBtn', )); ?></td>
	        </tr>

	<?php $i++; ?>

	<?php endforeach; ?>
		<tr>
			<td colspan="3" style="text-align: right; font-weight: bold;">Total Amount: </td>
			<td style="text-align: right;">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
			
			<td style="text-align: center;"><?php echo anchor('order/destroyCart', 'Clear'); ?></td>
		</tr>

	</table>

	<p><?php echo form_submit('', 'Update your Cart'); ?></p>

	<script>
		//Remove product from cart
		$(".removeFromCartBtn").on('click', function(event){
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
	</script>