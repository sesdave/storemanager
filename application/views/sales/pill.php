<?php $this->load->view("partial/header"); ?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
		<?php
		if(isset($error))
		{
			echo "<div class='alert alert-dismissible alert-danger'>".$error."</div>";
		}

		if(!empty($warning))
		{
			echo "<div class='alert alert-dismissible alert-warning'>".$warning."</div>";
		}

		if(isset($success))
		{
			echo "<div class='alert alert-dismissible alert-success'>".$success."</div>";
		}
		?>

		<div id="register_wrapper">

		<!-- Top register controls -->

			

			<?php $tabindex = 0; ?>

			<?php echo form_open($controller_name."/add_pill", array('id'=>'add_item_form', 'class'=>'form-horizontal panel panel-default')); ?>
				<div class="panel-body form-group">
					<ul>
						<li class="pull-left first_li">
							<label for="item" class='control-label'><?php echo $this->lang->line('sales_find_or_scan_item_or_receipt'); ?></label>
						</li>
						<li class="pull-left">
							<?php echo form_input(array('name'=>'item', 'id'=>'item', 'class'=>'form-control input-sm', 'size'=>'50', 'tabindex'=>++$tabindex)); ?>
							<span class="ui-helper-hidden-accessible" role="status"></span>
						</li>
						
					</ul>
				</div>
			<?php echo form_close(); ?>


		<!-- Sale Items List -->
			
			<table class="sales_table_100" id="register">
				<thead>
					<tr>
						<th style="width: 5%;"><?php echo $this->lang->line('common_delete'); ?></th>
						<th style="width: 15%;"><?php echo 'Time Start'; ?></th>
						<th style="width: 35%;"><?php echo $this->lang->line('sales_item_name'); ?></th>
						<th style="width: 10%;"><?php echo $this->lang->line('sales_price'); ?></th>
						<th style="width: 10%;"><?php echo 'Period'; ?></th>
						<th style="width: 10%;"><?php echo 'No of Dose'; ?></th>
						<th style="width: 10%;"><?php echo $this->lang->line('sales_total'); ?></th>
						<th style="width: 5%;"><?php echo $this->lang->line('sales_update'); ?></th>
					</tr>
				</thead>

				<tbody id="cart_contents">
					<?php
					if(count($cart) == 0)
					{
					?>
						<tr>
							<td colspan='8'>
								<div class='alert alert-dismissible alert-info'><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div>
							</td>
						</tr>
					<?php
					}
					else
					{				
						foreach(array_reverse($cart, TRUE) as $line=>$item)
						{					
					?>
							<?php echo form_open($controller_name."/edit_pill/$line", array('class'=>'form-horizontal', 'id'=>'cart_'.$line)); ?>
							
							
								<tr>
									<td><?php echo anchor($controller_name."/delete_item/$line", '<span class="glyphicon glyphicon-trash"></span>');?></td>
									<td><?php echo form_input(array('name'=>'time_started', 'class'=>'form-control input-sm','value'=>$item['time_started'] ));?></td>
									<td style="align: center;">
										<?php echo $item['name']; ?><br /> <?php if($item['stock_type'] == '0'): echo '[' . to_quantity_decimals($item['in_stock']) . ' in ' . $item['stock_name'] . ']'; endif; ?>
										
									</td>

									<?php
									if($items_module_allowed)
									{
									?>
										<td><?php if($item['stock_name'] == $this->lang->line('wholesale')){echo form_input(array('name'=>'price', 'class'=>'form-control input-sm', 'value'=>to_currency_no_money($item['wholeprice']), 'tabindex'=>++$tabindex));}else{echo form_input(array('name'=>'price', 'class'=>'form-control input-sm', 'value'=>to_currency_no_money($item['price']), 'tabindex'=>++$tabindex));}?></td>
									<?php
									}
									else
									{
									?>
										<td>
											<?php if($item['stock_name'] == $this->lang->line('wholesale')){ echo to_currency($item['wholeprice']);} else { echo to_currency($item['price']) ;} ?>
											<?php echo form_hidden('price', to_currency_no_money($item['price'])); ?>
											<?php echo form_hidden('reminder_value', $item['reminder_value']); ?>
										</td>
									<?php
									}
									?>

									<td>
										
														<?php echo form_dropdown('period', $pill_period, $item['period'], array('class'=>'form-control',)); ?>			
											
										
										
									</td>

									<td><?php echo form_input(array('name'=>'no_of_days', 'class'=>'form-control input-sm', 'value'=>to_decimals($item['no_of_days'], 0), 'tabindex'=>++$tabindex));?></td>
									<td><?php echo to_currency((24/$item['reminder_value'])*$item['no_of_days']*$item['price']); ?></td>
									<td><a href="javascript:document.getElementById('<?php echo 'cart_'.$line ?>').submit();" title=<?php echo $this->lang->line('sales_update')?> ><span class="glyphicon glyphicon-refresh"></span></a></td>
								</tr>
								<tr>
									<?php 
									if($item['allow_alt_description']==1)
									{
									?>
										<td style="color: #2F4F4F;"><?php echo $this->lang->line('sales_description_abbrv');?></td>
									<?php 
									}
									?>

									<td colspan='2' style="text-align: left;">
										<?php
										if($item['allow_alt_description']==1)
										{
											echo form_input(array('name'=>'description', 'class'=>'form-control input-sm', 'value'=>$item['description']));
										}
										else
										{
											if($item['description']!='')
											{
												echo $item['description'];
												echo form_hidden('description', $item['description']);
											}
											else
											{
												echo $this->lang->line('sales_no_description');
												echo form_hidden('description','');
											}
										}
										?>
									</td>
									<td>&nbsp;</td>
									<td style="color: #2F4F4F;">
										<?php
										if($item['is_serialized']==1)
										{
											echo $this->lang->line('sales_serial');
										}
										?>
									</td>
									<td colspan='4' style="text-align: left;">
										<?php
										if($item['is_serialized']==1)
										{
											echo form_input(array('name'=>'serialnumber', 'class'=>'form-control input-sm', 'value'=>$item['serialnumber']));
										}
										else
										{
											echo form_hidden('serialnumber', '');
										}
										?>
									</td>
								</tr>
								
							<?php echo form_close(); ?>
					<?php
						}
					}
					?>
				</tbody>
			</table>
			<?php //print_r($batches);
				//print_r($cart);
				//print_r($expire_days);
			 ?>
			
		</div>

		<!-- Overall Sale -->

		<div id="overall_sale" class="panel panel-default">
			<div class="panel-body">
				<?php
				if(isset($customer))
				{
				?>
					<table class="sales_table_100">
						<tr>
							<th style='width: 55%;'><?php echo $this->lang->line("sales_customer"); ?></th>
							<th style="width: 45%; text-align: right;"><?php echo $customer; ?></th>
						</tr>
						<?php
						if(!empty($customer_email))
						{
						?>
							<tr>
								<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_email"); ?></th>
								<th style="width: 45%; text-align: right;"><?php echo $customer_email; ?></th>
							</tr>
						<?php
						}
						?>
						<?php
						if(!empty($customer_address))
						{
						?>
							<tr>
								<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_address"); ?></th>
								<th style="width: 45%; text-align: right;"><?php echo $customer_address; ?></th>
							</tr>
						<?php
						}
						?>
						<?php
						if(!empty($customer_location))
						{
						?>
							<tr>
								<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_location"); ?></th>
								<th style="width: 45%; text-align: right;"><?php echo $customer_location; ?></th>
							</tr>
						<?php
						}
						?>
						<tr>
							<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_discount"); ?></th>
							<th style="width: 45%; text-align: right;"><?php echo $customer_discount_percent . ' %'; ?></th>
						</tr>
						<?php if($this->config->item('customer_reward_enable') == TRUE): ?>
						<?php
						if(!empty($customer_rewards))
						{
						?>
							<tr>
								<th style='width: 55%;'><?php echo $this->lang->line("rewards_package"); ?></th>
								<th style="width: 45%; text-align: right;"><?php echo $customer_rewards['package_name']; ?></th>
							</tr>
							<tr>
								<th style='width: 55%;'><?php echo $this->lang->line("customers_available_points"); ?></th>
								<th style="width: 45%; text-align: right;"><?php echo $customer_rewards['points']; ?></th>
							</tr>
						<?php
						}
						?>
						<?php endif; ?>
						<tr>
							<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_total"); ?></th>
							<th style="width: 45%; text-align: right;"><?php echo to_currency($customer_total); ?></th>
						</tr>
						<?php
						if(!empty($mailchimp_info))
						{
						?>
							<tr>
								<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_mailchimp_status"); ?></th>
								<th style="width: 45%; text-align: right;"><?php echo $mailchimp_info['status']; ?></th>
							</tr>
						<?php
						}
						?>
					</table>

					<?php echo anchor($controller_name."/remove_customer", '<span class="glyphicon glyphicon-remove">&nbsp</span>' . $this->lang->line('common_remove').' '.$this->lang->line('customers_customer'),
										array('class'=>'btn btn-danger btn-sm', 'id'=>'remove_customer_button', 'title'=>$this->lang->line('common_remove').' '.$this->lang->line('customers_customer'))); ?>
				<?php
				}
				else
				{
				?>
					<?php echo form_open($controller_name."/select_customer", array('id'=>'select_customer_form', 'class'=>'form-horizontal')); ?>
						<div class="form-group" id="select_customer">
							<label id="customer_label" for="customer" class="control-label" style="margin-bottom: 1em; margin-top: -1em;"><?php echo $this->lang->line('sales_select_customer'); ?></label>
							<?php echo form_input(array('name'=>'customer', 'id'=>'customer', 'class'=>'form-control input-sm', 'value'=>$this->lang->line('sales_start_typing_customer_name')));?>

							<button class='btn btn-info btn-sm modal-dlg' data-btn-submit='<?php echo $this->lang->line('common_submit') ?>' data-href='<?php echo site_url("customers/view"); ?>'
									title='<?php echo $this->lang->line($controller_name. '_new_customer'); ?>'>
								<span class="glyphicon glyphicon-user">&nbsp</span><?php echo $this->lang->line($controller_name. '_new_customer'); ?>
							</button>

						</div>
					<?php echo form_close(); ?>
				<?php
				}
				?>

				<table class="sales_table_100" id="sale_totals">
					<tr>
						<th style="width: 55%;"><?php echo $this->lang->line('sales_sub_total'); ?></th>
						<th style="width: 45%; text-align: right;"><?php echo to_currency($this->config->item('tax_included') ? $tax_exclusive_subtotal : $subtotal); ?></th>
					</tr>
					
					<?php
					foreach($taxes as $tax_group_index=>$sales_tax)
					{
					?>
						<tr>
							<th style='width: 55%;'><?php echo $sales_tax['tax_group']; ?></th>
							<th style="width: 45%; text-align: right;"><?php echo to_currency($sales_tax['sale_tax_amount']); ?></th>
						</tr>
					<?php
					}
					?>

					<tr>
						<th style='width: 55%;'><?php echo $this->lang->line('sales_total'); ?></th>
						<th style="width: 45%; text-align: right;"><span id="sale_total"><?php echo to_currency($total); ?></span></th>
					</tr>
				</table>
			
				<?php
				// Only show this part if there are Items already in the sale.
				if(count($cart) > 0)
				{
				?>
					<table class="sales_table_100" id="payment_totals">
						<tr>
							<th style="width: 55%;"><?php echo $this->lang->line('sales_payments_total');?></th>
							<th style="width: 45%; text-align: right;"><?php echo to_currency($payments_total); ?></th>
						</tr>
						<tr>
							<th style="width: 55%;"><?php echo $this->lang->line('sales_amount_due');?></th>
							<th style="width: 45%; text-align: right;"><span id="sale_amount_due"><?php echo to_currency($amount_due); ?></span></th>
						</tr>
					</table>

					<div id="payment_details">
						<?php
						// Show Complete sale button instead of Add Payment if there is no amount due left
						if($payments_cover_total)
						{
						?>
							<?php echo form_open($controller_name."/add_payment_pill", array('id'=>'add_payment_form', 'class'=>'form-horizontal')); ?>
								<table class="sales_table_100">
									<tr>
										<td><?php echo $this->lang->line('sales_payment');?></td>
										<td>
											<?php echo form_dropdown('payment_type', $payment_options, $selected_payment_type, array('id'=>'payment_types', 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'auto', 'disabled'=>'disabled')); ?>
										</td>
									</tr>
									<tr>
										<td><span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered'); ?></span></td>
										<td>
											<?php echo form_input(array('name'=>'amount_tendered', 'id'=>'amount_tendered', 'class'=>'form-control input-sm disabled', 'disabled'=>'disabled', 'value'=>'0', 'size'=>'5', 'tabindex'=>++$tabindex)); ?>
										</td>
									</tr>
								</table>
							<?php echo form_close(); ?>
								<?php
								// Only show this part if the payment cover the total and in sale or return mode
								if($sales_or_return_mode == '1')
								{
								?>
								<div class='btn btn-sm btn-success pull-right' id='finish_sale_button' tabindex='<?php echo ++$tabindex; ?>'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('sales_complete_sale'); ?></div>
								<?php
								}
								?>
						<?php
						}
						else
						{
						?>
							<?php echo form_open($controller_name."/add_payment_pill", array('id'=>'add_payment_form', 'class'=>'form-horizontal')); ?>
								<table class="sales_table_100">
									<tr>
										<td><?php echo $this->lang->line('sales_payment');?></td>
										<td>
											<?php echo form_dropdown('payment_type', $payment_options,  $selected_payment_type, array('id'=>'payment_types', 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
										</td>
									</tr>
									<tr>
										<td><span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered'); ?></span></td>
										<td>
											<?php echo form_input(array('name'=>'amount_tendered', 'id'=>'amount_tendered', 'class'=>'form-control input-sm non-giftcard-input', 'value'=>to_currency_no_money($amount_due), 'size'=>'5', 'tabindex'=>++$tabindex)); ?>
											<?php echo form_input(array('name'=>'amount_tendered', 'id'=>'amount_tendered', 'class'=>'form-control input-sm giftcard-input', 'disabled' => true, 'value'=>to_currency_no_money($amount_due), 'size'=>'5', 'tabindex'=>++$tabindex)); ?>
										</td>
									</tr>
								</table>
							<?php echo form_close(); ?>

							<div class='btn btn-sm btn-success pull-right' id='add_payment_button' tabindex='<?php echo ++$tabindex; ?>'><span class="glyphicon glyphicon-credit-card">&nbsp</span><?php echo $this->lang->line('sales_add_payment'); ?></div>
						<?php
						}
						?>

						<?php
						// Only show this part if there is at least one payment entered.
						if(count($payments) > 0)
						{
						?>
							<table class="sales_table_100" id="register">
								<thead>
									<tr>
										<th style="width: 10%;"><?php echo $this->lang->line('common_delete'); ?></th>
										<th style="width: 60%;"><?php echo $this->lang->line('sales_payment_type'); ?></th>
										<th style="width: 20%;"><?php echo $this->lang->line('sales_payment_amount'); ?></th>
									</tr>
								</thead>
					
								<tbody id="payment_contents">
									<?php
									foreach($payments as $payment_id=>$payment)
									{
									?>
										<tr>
											<td><?php echo anchor($controller_name."/delete_payment/$payment_id", '<span class="glyphicon glyphicon-trash"></span>'); ?></td>
											<td><?php echo $payment['payment_type']; ?></td>
											<td style="text-align: right;"><?php echo to_currency( $payment['payment_amount'] ); ?></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						<?php
						}
						?>
					</div>

					<?php echo form_open($controller_name."/cancel", array('id'=>'buttons_form')); ?>
						<div class="form-group" id="buttons_sale">
							<div class='btn btn-sm btn-default pull-left' id='suspend_sale_button'><span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspend_sale'); ?></div>
							<?php
							// Only show this part if the payment cover the total
							if($quote_or_invoice_mode && isset($customer))
							{
							?>
							<div class='btn btn-sm btn-success' id='finish_invoice_quote_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $mode_label; ?></div>
							<?php
							}
							?>

							<div class='btn btn-sm btn-danger pull-right' id='cancel_sale_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('sales_cancel_sale'); ?></div>
						</div>
					<?php echo form_close(); ?>


					<?php
					// Only show this part if the payment cover the total
					if($payments_cover_total || $quote_or_invoice_mode)
					{
					?>
						<div class="container-fluid">
							<div class="no-gutter row">
								<div class="form-group form-group-sm">
									<div class="col-xs-12">
										<?php echo form_label($this->lang->line('common_comments'), 'comments', array('class'=>'control-label', 'id'=>'comment_label', 'for'=>'comment')); ?>
										<?php echo form_textarea(array('name'=>'comment', 'id'=>'comment', 'class'=>'form-control input-sm', 'value'=>$comment, 'rows'=>'2')); ?>
									</div>
								</div>
							</div>
							<div class="row">

								<div class="form-group form-group-sm">
									<div class="col-xs-6">
										<label for="sales_print_after_sale" class="control-label checkbox">
											<?php echo form_checkbox(array('name'=>'sales_print_after_sale', 'id'=>'sales_print_after_sale', 'value'=>1, 'checked'=>$print_after_sale)); ?>
											<?php echo $this->lang->line('sales_print_after_sale')?>
										</label>
									</div>

									<?php
									if(!empty($customer_email))
									{
									?>
										<div class="col-xs-6">
											<label for="email-receipt" class="control-label checkbox">
												<?php echo form_checkbox(array('name'=>'email_receipt', 'id'=>'email_receipt', 'value'=>1, 'checked'=>$email_receipt)); ?>
												<?php echo $this->lang->line('sales_email_receipt');?>
											</label>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						<?php
						if(($mode == "sale") && $this->config->item('invoice_enable') == TRUE)
						{
						?>
							<div class="row">
								<div class="form-group form-group-sm">

									<div class="col-xs-6">
										<label class="control-label checkbox" for="sales_invoice_enable">
											<?php echo form_checkbox(array('name'=>'sales_invoice_enable', 'id'=>'sales_invoice_enable', 'value'=>1, 'checked'=>$invoice_number_enabled)); ?>
											<?php echo $this->lang->line('sales_invoice_enable');?>
										</label>
									</div>

									<div class="col-xs-6">
										<div class="input-group input-group-sm">
											<span class="input-group-addon input-sm">#</span>
											<?php echo form_input(array('name'=>'sales_invoice_number', 'id'=>'sales_invoice_number', 'class'=>'form-control input-sm', 'value'=>$invoice_number));?>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
						?>
						</div>
					<?php
					}
					?>
				<?php
				}
				?>
			</div>
		</div>
		
	<?php// print_r($special_module); ?>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function()
{
	$("#roles").change(function(){
		/*$.ajax({
                url: '<?php echo site_url("sales/set_role");?>',
                method: 'POST',
                dataType: 'text',
                data: {
                    role: $('#roles').val(),
                
                }, success: function (response) {
                   alert($('#roles').val());
                }
            });*/
			//alert($('#roles').val());
		$.post('<?php echo site_url($controller_name."/set_role");?>', {role: $('#roles').val()});
		
		    
		});
	$("#item").autocomplete(
	{
		source: '<?php echo site_url($controller_name."/item_search"); ?>',
		minChars: 0,
		autoFocus: false,
	   	delay: 500,
		select: function (a, ui) {
			$(this).val(ui.item.value);
			$("#add_item_form").submit();
			return false;
		}
	});

	$('#item').focus();

	$('#item').keypress(function (e) {
		if(e.which == 13) {
			$('#add_item_form').submit();
			return false;
		}
	});

	$('#item').blur(function()
	{
		$(this).val("<?php echo $this->lang->line('sales_start_typing_item_name'); ?>");
	});

	var clear_fields = function()
	{
		if($(this).val().match("<?php echo $this->lang->line('sales_start_typing_item_name') . '|' . $this->lang->line('sales_start_typing_customer_name'); ?>"))
		{
			$(this).val('');
		}
	};

	$("#customer").autocomplete(
	{
		source: '<?php echo site_url("customers/suggest"); ?>',
		minChars: 0,
		delay: 10,
		select: function (a, ui) {
			$(this).val(ui.item.value);
			$("#select_customer_form").submit();
		}
	});

	$(".giftcard-input").autocomplete(
	{
		source: '<?php echo site_url("giftcards/suggest"); ?>',
		minChars: 0,
		delay: 10,
		select: function (a, ui) {
			$(this).val(ui.item.value);
			$("#add_payment_form").submit();
		}
	});

	$('#item, #customer').click(clear_fields).dblclick(function(event)
	{
		$(this).autocomplete("search");
	});

	$('#customer').blur(function()
	{
		$(this).val("<?php echo $this->lang->line('sales_start_typing_customer_name'); ?>");
	});

	$('#comment').keyup(function() 
	{
		$.post('<?php echo site_url($controller_name."/set_comment");?>', {comment: $('#comment').val()});
	});

	<?php
	if($this->config->item('invoice_enable') == TRUE) 
	{
	?>
		$('#sales_invoice_number').keyup(function() 
		{
			$.post('<?php echo site_url($controller_name."/set_invoice_number");?>', {sales_invoice_number: $('#sales_invoice_number').val()});
		});

		var enable_invoice_number = function() 
		{
			var enabled = $("#sales_invoice_enable").is(":checked");
			$("#sales_invoice_number").prop("disabled", !enabled).parents('tr').show();
			return enabled;
		}

		enable_invoice_number();
		
		$("#sales_invoice_enable").change(function()
		{
			var enabled = enable_invoice_number();
			$.post('<?php echo site_url($controller_name."/set_invoice_number_enabled");?>', {sales_invoice_number_enabled: enabled});
		});
	<?php
	}
	?>

	$("#sales_print_after_sale").change(function()
	{
		$.post('<?php echo site_url($controller_name."/set_print_after_sale");?>', {sales_print_after_sale: $(this).is(":checked")});
	});
	
	$('#email_receipt').change(function() 
	{
		$.post('<?php echo site_url($controller_name."/set_email_receipt");?>', {email_receipt: $('#email_receipt').is(':checked') ? '1' : '0'});
	});
	
	$("#finish_sale_button").click(function()
	{
		$('#buttons_form').attr('action', '<?php echo site_url($controller_name."/complete_receipt_pill"); ?>');
		$('#buttons_form').submit();
	});

	$("#finish_invoice_quote_button").click(function()
	{
		$('#buttons_form').attr('action', '<?php echo site_url($controller_name."/complete"); ?>');
		$('#buttons_form').submit();
	});

	$("#suspend_sale_button").click(function()
	{ 	
		$('#buttons_form').attr('action', '<?php echo site_url($controller_name."/suspend"); ?>');
		$('#buttons_form').submit();
	});

	$("#cancel_sale_button").click(function()
	{
		if(confirm('<?php echo $this->lang->line("sales_confirm_cancel_sale"); ?>'))
		{
			$('#buttons_form').attr('action', '<?php echo site_url($controller_name."/cancel"); ?>');
			$('#buttons_form').submit();
		}
	});

	$("#add_payment_button").click(function()
	{
		$('#add_payment_form').submit();
	});

	$("#payment_types").change(check_payment_type).ready(check_payment_type);

	$("#cart_contents input").keypress(function(event)
	{
		if(event.which == 13)
		{
			$(this).parents("tr").prevAll("form:first").submit();
		}
	});

	$("#amount_tendered").keypress(function(event)
	{
		if(event.which == 13)
		{
			$('#add_payment_form').submit();
		}
	});
	
	$("#finish_sale_button").keypress(function(event)
	{
		if(event.which == 13)
		{
			$('#finish_sale_form').submit();
		}
	});

	dialog_support.init("a.modal-dlg, button.modal-dlg");

	table_support.handle_submit = function(resource, response, stay_open)
	{
		if(response.success) 
		{
			if(resource.match(/customers$/))
			{
				$("#customer").val(response.id);
				$("#select_customer_form").submit();
			}
			else
			{
				var $stock_location = $("select[name='stock_location']").val();
				$("#item_location").val($stock_location);
				$("#item").val(response.id);
				if(stay_open)
				{
					$("#add_item_form").ajaxSubmit();
				}
				else
				{
					$("#add_item_form").submit();
				}
			}
		}
	}

	$('[name="price"],[name="period"],[name="no_of_days"],[name="time_started"],[name="serialnumber"]').focusout(function() {
		$(this).parents("tr").prevAll("form:first").submit()
	});
	
});

function check_payment_type()
{
	var cash_rounding = <?php echo json_encode($cash_rounding); ?>;

	if($("#payment_types").val() == "<?php echo $this->lang->line('sales_giftcard'); ?>")
	{
		$("#sale_total").html("<?php echo to_currency($total); ?>");
		$("#sale_amount_due").html("<?php echo to_currency($amount_due); ?>");
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_giftcard_number'); ?>");
		$("#amount_tendered:enabled").val('').focus();
		$(".giftcard-input").attr('disabled', false);
		$(".non-giftcard-input").attr('disabled', true);
		$(".giftcard-input:enabled").val('').focus();
	}
	else if($("#payment_types").val() == "<?php echo $this->lang->line('sales_cash'); ?>" && cash_rounding)
	{
		$("#sale_total").html("<?php echo to_currency($cash_total); ?>");
		$("#sale_amount_due").html("<?php echo to_currency($cash_amount_due); ?>");
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_amount_tendered'); ?>");
		$("#amount_tendered:enabled").val('<?php echo to_currency_no_money($cash_amount_due); ?>');
		$(".giftcard-input").attr('disabled', true);
		$(".non-giftcard-input").attr('disabled', false);
	}
	else
	{
		$("#sale_total").html("<?php echo to_currency($non_cash_total); ?>");
		$("#sale_amount_due").html("<?php echo to_currency($non_cash_amount_due); ?>");
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_amount_tendered'); ?>");
		$("#amount_tendered:enabled").val('<?php echo to_currency_no_money($non_cash_amount_due); ?>');
		$(".giftcard-input").attr('disabled', true);
		$(".non-giftcard-input").attr('disabled', false);
	}
}

</script>

<?php $this->load->view("partial/footer"); ?>