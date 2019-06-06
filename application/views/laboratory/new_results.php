<?php $this->load->view("partial/header"); ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="dist/css/dataTables.bootstrap.min.css">
	  <script type="text/javascript">
	  
$(document).ready(function()
{
	
	
    $('#generate_barcodes').click(function()
    {
        window.open(
            'index.php/items/generate_barcodes/'+table_support.selected_ids().join(':'),
            '_blank' // <- This is what makes it open in a new window.
        );
    });
	
	// when any filter is clicked and the dropdown window is closed
	$('#filters').on('hidden.bs.select', function(e)
	{
        table_support.refresh();
    });

	// load the preset datarange picker
	<?php $this->load->view('partial/daterangepicker'); ?>
    // set the beginning of time as starting date
    $('#daterangepicker').data('daterangepicker').setStartDate("<?php echo date($this->config->item('dateformat'), mktime(0,0,0,01,01,2010));?>");
	// update the hidden inputs with the selected dates before submitting the search data
    var start_date = "<?php echo date('Y-m-d', mktime(0,0,0,01,01,2010));?>";
	$("#daterangepicker").on('apply.daterangepicker', function(ev, picker) {
        table_support.refresh();
    });

    $("#stock_location").change(function() {
       table_support.refresh();
    });

    <?php $this->load->view('partial/bootstrap_tables_locale'); ?>

    table_support.init({
        employee_id: <?php echo $this->Employee->get_logged_in_employee_info()->person_id; ?>,
        resource: '<?php echo site_url($controller_name);?>',
        headers: <?php echo $table_headers; ?>,
        pageSize: <?php echo $this->config->item('lines_per_page'); ?>,
        uniqueId: 'items.item_id',
        queryParams: function() {
            return $.extend(arguments[0], {
                start_date: start_date,
                end_date: end_date,
                stock_location: $("#stock_location").val(),
                filters: $("#filters").val() || [""]
            });
        },
        onLoadSuccess: function(response) {
            $('a.rollover').imgPreview({
				imgCSS: { width: 200 },
				distanceFromCursor: { top:10, left:-210 }
			})
        }
    });
});
</script>


<?php //print_r($labv);?>
<?php foreach($invoice as $row=>$value){
		//echo $sale_id;
}?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
		<div class="container">

			  <br>
			  <table class="table table-striped table-bordered" id="table">
				<thead>
					<tr>
						<th width="10%">Result No</th>
						<th width="30%">Customer Name</th>
						<th width="30%"></th>
						<th width="10%"></th>
					   
					</tr>
				</thead>
			  </table>
			  <br>
			 
			</div>
		</div>
	</div>
			<?php// print_r($cart);?>

<?php echo form_open($controller_name."/cancel", array('id'=>'butons_form')); ?>
<?php echo form_close(); ?>
<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="dist/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="dist/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

    <script>
      $(document).ready(function() {
		  	dialog_support.init("a.modal-dlg, button.modal-dlg");
		  
		$('#addButton').click(function(){
			$('#user_form')[0].reset();
			$('.modal-title').text("Add User");
			$('#action').val("Add");
			$('#operation').val("Add");
			
			
		});
		$(document).on('click','.update', function(){
			var user_id=$(this).attr("id");
			//$('#userModal').modal('show');
			$('#invoice_id').val(user_id);
			$('.modal-title').text("Process");
			$('#action').val("Add");
			$('#action').submit();
			$('#item_form').submit();
			/*$.post('<?php echo site_url("laboratory/view");?>', {user: user_id},function(){
				$('#userModal').modal('show');
				$('.modal-title').text("Edit");
				$('#test_code').val("Hello");
				$('#test_name').val("<?php echo $test_info->test_name;?>");
				$('#action').val("Edit");
				$('#operation').val("Edit");
			});*/
			
		});
		/*$('#addButton').click(function(){
			
			$('#user_form')[0].reset();
			$('.modal-title').text("Add User");
			$('#action').val("Add");
			$('#operation').val("Add");
			
		});*/


        
		
		var columlab= [
						{ "mData": "sale_id" },
						{ "mData": "customer_id" },{ 
						"mData": "edit" }
                ];

        var columnDefs = [{
          title: "Name"
        }, {
          title: "Position"
        }, {
          title: "Office"
        }, {
          title: "Extn."
        }, {
          title: "Start date"
        }, {
          title: "Salary"
        }];
		
		var columneDef = [{
          title: "Name"
        }, {
          title: "Position"
        }, {
          title: "Office"
        }, {
          title: "Extn."
        }];
		var columnDe = [{
          title: "Test Id"
        }, {
          title: "Test Code",
		  className: "text-center"
        }, {
          title: "Name"
        }, {
          title: "Amount."
        }];

        var myTable;

        myTable = $('#table').DataTable({
          "sPaginationType": "full_numbers",
		  "sAjaxSource": "<?php echo site_url('laboratory/new_result_items');?>",
           //aoColumns: colum,
		   //data:dataSetter,
		  //data:dataSet,
		  aoColumns: columlab,
		  columns:columnDe,
          //columns: columnDefs,
		  //columns: columneDef,
          //dom: 'Bfrtip',        // Needs button container
          //select: 'single',
          //responsive: true,
          

        });
		/*$().on('','', function(){
			event.preventDefault
		});*/
        
      });
    </script>
	
 <div id="userModal" class="modal fade">
		<div class="modal-dialog">
			<?php echo form_open('laboratory/lab_result', array('id'=>'item_form', 'enctype'=>'multipart/form-data')); ?>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Test</h4>
					</div>
					<div class="modal-body">
						<label>Enter Test Code</label>
						<input type="text" name="invoice_id" id="invoice_id" class="form-control" />
			
						<label>Choose Payment</label>
						<?php echo form_dropdown('payment_type', $payment_options,  $selected_payment_type, array('id'=>'payment_types', 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
					</div>
					<div class="modal-footer">
						
						<input type="hidden" name="sale_id" id="sale_id" />
						<input type="submit" name="action" id="action" class="btn btn-success" value="Submit" />
					</div>
					
				</div>
			
			<?php echo form_close(); ?>
		</div>
		
	</div>
<?php $this->load->view("partial/footer"); ?>
