<?php //$this->load->view("partial/header"); ?>

		<!-- bower:css -->
				
		
		<!-- end css template tags -->
		<!-- bower:js -->
		
      	
		
	<?php	$image = NULL;
		if ($person_info->pic_filename != '')
		{
			$ext = pathinfo($person_info->pic_filename, PATHINFO_EXTENSION);
			if($ext == '')
			{
				// legacy
				$images = glob('./uploads/item_pics/' . $person_info->pic_filename . '.*');
			}
			else
			{
				// preferred
				$images = glob('./uploads/item_pics/' . $person_info->pic_filename);
			}

			if (sizeof($images) > 0)
			{
				$image .= '<a class="rollover" href="'. base_url($images[0]) .'"><img src="'. base_url($images[0]) .'" height="150px" class="img-circle img-responsive"></a>';
			}
		}
		?>
		


		<ul id="error_message_box" class="error_message_box"></ul>

		
			

			
			
				<div class="row">
				<div class="panel panel-default">
					  <div class="panel-heading">  <h4 >Employee Profile</h4></div>
					   <div class="panel-body">
						   
						<div class="box box-info">
							
								<div class="box-body">
								 <div class="col-sm-6">
										 <div  align="center"> <?php echo $image; ?>
									
									
								<div style="color:#999;" ></div>
									<!--Upload Image Js And Css-->
							   
								  
					   
									
									
										 
										 
										 </div>
								  
								  <br>
						
								  <!-- /input-group -->
								</div>
								<div class="col-sm-6">
								          
								</div>
								<div class="clearfix"></div>
								<hr style="margin:5px 0 5px 0;">
						
								  
					<div class="col-sm-5 col-xs-6 tital " >First Name:</div><div class="col-sm-7 col-xs-6 "><p><?php echo $person_info->first_name;?></p></div>
						 <div class="clearfix"></div>
					<div class="bot-border"></div>

					<div class="col-sm-5 col-xs-6 tital " >Middle Name:</div><div class="col-sm-7"> <?php echo $person_info->last_name;?></div>
					  <div class="clearfix"></div>
					<div class="bot-border"></div>

					<div class="col-sm-5 col-xs-6 tital " >Email:</div><div class="col-sm-7"> <p><?php echo $person_info->email;?></p></div>
					  <div class="clearfix"></div>
					<div class="bot-border"></div>
					<div class="col-sm-5 col-xs-6 tital " >Gender:</div><div class="col-sm-7"><p><?php echo $person_info->gender === '1'?'Male':'Female';?></p></div>

					 <div class="clearfix"></div>
					<div class="bot-border"></div>
					<div class="col-sm-5 col-xs-6 tital " >Date of Birth:</div><div class="col-sm-7"><p><?php echo $person_info->dob;?></p></div>

					 <div class="clearfix"></div>
					<div class="bot-border"></div>

					<div class="col-sm-5 col-xs-6 tital " >Phone Number:</div><div class="col-sm-7"><p><?php echo $person_info->phone_number;?></p></div>

					  <div class="clearfix"></div>
					<div class="bot-border"></div>

					<div class="col-sm-5 col-xs-6 tital " >Address</div><div class="col-sm-7"><p><?php echo $person_info->address_1;?></p></div>

					  <div class="clearfix"></div>
					<div class="bot-border"></div>

					

					<div class="col-sm-5 col-xs-6 tital " >Nationality:</div><div class="col-sm-7"><?php echo $person_info->country;?></div>

					


								<!-- /.box-body -->
							  </div>
							  <!-- /.box -->

							</div>
						   
								
						</div> 
						</div>
					
			
						
										</div>
				
				
				
				
				
			</div>




				
			

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	$.validator.setDefaults({ ignore: [] });

	$.validator.addMethod("module", function (value, element) {
		var result = $("#permission_list input").is(":checked");
		$(".module").each(function(index, element)
		{
			var parent = $(element).parent();
			var checked =  $(element).is(":checked");
			if ($("ul", parent).length > 0 && result)
			{
				result &= !checked || (checked && $("ul > li > input:checked", parent).length > 0);
			}
		});
		return result;
	}, '<?php echo $this->lang->line('employees_subpermission_required'); ?>');

	$("ul#permission_list > li > input[name='grants[]']").each(function() 
	{
	    var $this = $(this);
	    $("ul > li > input", $this.parent()).each(function() 
	    {
		    var $that = $(this);
	        var updateCheckboxes = function (checked) 
	        {
				$that.prop("disabled", !checked);
	         	!checked && $that.prop("checked", false);
	        }
	       $this.change(function() {
	            updateCheckboxes($this.is(":checked"));
	        });
			updateCheckboxes($this.is(":checked"));
	    });
	});
	
	$("#role_permission").on("change", function() {
		//var role=$("#username").val();
		//$('#role_submission').submit();
		$("#role_submission").submit();
		//$("#receiving_quantity").val(role);
      //$.post('<?php echo site_url($controller_name."/set_role");?>', {role: role});
		
	//alert('HEllo World'); 
});
	
	$('#employee_form').validate($.extend({
		submitHandler:function(form) 
		{
			$(form).ajaxSubmit({
				success:function(response)
				{
					dialog_support.hide();
					table_support.handle_submit('<?php echo site_url('employees'); ?>', response);
				},
				dataType:'json'
			});
		},
		rules:
		{
			first_name: "required",
			last_name: "required",
			username:
			{
				required:true,
				minlength: 5
			},
			
			password:
			{
				<?php
				if($person_info->person_id == "")
				{
				?>
				required:true,
				<?php
				}
				?>
				minlength: 8
			},	
			repeat_password:
			{
 				equalTo: "#password"
			},
    		email: "email"
   		},
		messages: 
		{
     		first_name: "<?php echo $this->lang->line('common_first_name_required'); ?>",
     		last_name: "<?php echo $this->lang->line('common_last_name_required'); ?>",
     		username:
     		{
     			required: "<?php echo $this->lang->line('employees_username_required'); ?>",
     			minlength: "<?php echo $this->lang->line('employees_username_minlength'); ?>"
     		},
     		
			password:
			{
				<?php
				if($person_info->person_id == "")
				{
				?>
				required:"<?php echo $this->lang->line('employees_password_required'); ?>",
				<?php
				}
				?>
				minlength: "<?php echo $this->lang->line('employees_password_minlength'); ?>"
			},
			repeat_password:
			{
				equalTo: "<?php echo $this->lang->line('employees_password_must_match'); ?>"
     		},
     		email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>"
		}
	}, form_support.error));
});
</script>
 
<?php //$this->load->view("partial/footer"); ?>
