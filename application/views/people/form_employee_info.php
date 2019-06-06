<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_first_name'), 'first_name', array('class'=>'required control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'first_name',
				'id'=>'first_name',
				'class'=>'form-control input-sm',
				'value'=>$person_info->first_name)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_last_name'), 'last_name', array('class'=>'required control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'last_name',
				'id'=>'last_name',
				'class'=>'form-control input-sm',
				'value'=>$person_info->last_name)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_gender'), 'gender', !empty($basic_version) ? array('class'=>'required control-label col-xs-3') : array('class'=>'control-label col-xs-3')); ?>
	<div class="col-xs-4">
		<label class="radio-inline">
			<?php echo form_radio(array(
					'name'=>'gender',
					'type'=>'radio',
					'id'=>'gender',
					'value'=>1,
					'checked'=>$person_info->gender === '1')
					); ?> <?php echo $this->lang->line('common_gender_male'); ?>
		</label>
		<label class="radio-inline">
			<?php echo form_radio(array(
					'name'=>'gender',
					'type'=>'radio',
					'id'=>'gender',
					'value'=>0,
					'checked'=>$person_info->gender === '0')
					); ?> <?php echo $this->lang->line('common_gender_female'); ?>
		</label>

	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_email'), 'email', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<div class="input-group">
			<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-envelope"></span></span>
			<?php echo form_input(array(
					'name'=>'email',
					'id'=>'email',
					'class'=>'form-control input-sm',
					'value'=>$person_info->email)
					);?>
		</div>
	</div>
</div>
<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('dob'), 'date_of_birth', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<div class="input-group  date" id="datetimepicker3">
					<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-calendar"></span></span>
					
					<?php echo form_input(array(
							'name'=>'date_of_birth',
							'id'=>'date_of_birth',
							'class'=>'form-control input-sm',
							'value'=>$date_of_birth)
							);?>
				</div>
			</div>
		</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_phone_number'), 'phone_number', array('class'=>'required control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<div class="input-group">
			<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-phone-alt"></span></span>
			<?php echo form_input(array(
					'name'=>'phone_number',
					'id'=>'phone_number',
					'class'=>'form-control input-sm',
					'value'=>$person_info->phone_number)
					);?>
		</div>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_address_1'), 'address_1', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'address_1',
				'id'=>'address_1',
				'class'=>'form-control input-sm',
				'value'=>$person_info->address_1)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_address_2'), 'address_2', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'address_2',
				'id'=>'address_2',
				'class'=>'form-control input-sm',
				'value'=>$person_info->address_2)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_city'), 'city', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'city',
				'id'=>'city',
				'class'=>'form-control input-sm',
				'value'=>$person_info->city)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_state'), 'state', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'state',
				'id'=>'state',
				'class'=>'form-control input-sm',
				'value'=>$person_info->state)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_zip'), 'zip', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'zip',
				'id'=>'postcode',
				'class'=>'form-control input-sm',
				'value'=>$person_info->zip)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_country'), 'country', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'country',
				'id'=>'country',
				'class'=>'form-control input-sm',
				'value'=>$person_info->country)
				);?>
	</div>
</div>
<div class="form-group form-group-sm">
			<?php echo form_label('Image', 'items_image', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<div class="fileinput <?php echo $logo_exists ? 'fileinput-exists' : 'fileinput-new'; ?>" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;"></div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px; max-height: 100px;">
						<img data-src="holder.js/100%x100%" alt="<?php echo $this->lang->line('items_image'); ?>"
							 src="<?php echo $image_path; ?>"
							 style="max-height: 100%; max-width: 100%;">
					</div>
					<div>
						<span class="btn btn-default btn-sm btn-file">
							<span class="fileinput-new"><?php echo $this->lang->line("items_select_image"); ?></span>
							<span class="fileinput-exists"><?php echo $this->lang->line("items_change_image"); ?></span>
							<input type="file" name="item_image" accept="image/*">
						</span>
						<a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><?php echo $this->lang->line("items_remove_image"); ?></a>
					</div>
				</div>
			</div>
		</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_comments'), 'comments', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_textarea(array(
				'name'=>'comments',
				'id'=>'comments',
				'class'=>'form-control input-sm',
				'value'=>$comments)
				);?>
	</div>
</div>

<script type="text/javascript">
$('#datetimepicker2').datetimepicker( {
	locale: "ar"
} );
$('#datetimepicker3').datetimepicker();
//validation and submit handling
$(document).ready(function()
{
	nominatim.init({
		fields : {
			postcode : {
				dependencies :  ["postcode", "city", "state", "country"],
				response : {
					field : 'postalcode',
					format: ["postcode", "village|town|hamlet|city_district|city", "state", "country"]
				}
			},

			city : {
				dependencies :  ["postcode", "city", "state", "country"],
				response : {
					format: ["postcode", "village|town|hamlet|city_district|city", "state", "country"]
				}
			},

			state : {
				dependencies :  ["state", "country"]
			},

			country : {
				dependencies :  ["state", "country"]
			}
		},
		language : '<?php echo current_language_code();?>',
		country_codes: '<?php echo $this->config->item('country_codes'); ?>'
	});
});
</script>