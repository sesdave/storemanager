<?php $this->load->view("partial/header"); ?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
		<div id="page_title"><?php echo $title ?></div>

		<div id="page_subtitle"><?php echo $subtitle ?></div>

		<div id="table_holder">
			<table id="table"></table>
		</div>

		<div id="report_summary">
			<?php
			foreach($overall_summary_data as $name=>$value)
			{
			?>
				<div class="summary_row"><?php echo $this->lang->line('reports_'.$name). ': '.to_currency($value); ?></div>
			<?php
			}
			?>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function()
	{
	 	<?php $this->load->view('partial/bootstrap_tables_locale'); ?>

		var detail_data = <?php echo json_encode($details_data); ?>;
		<?php
		if($this->config->item('customer_reward_enable') == TRUE && !empty($details_data_rewards))
		{
		?>
			var details_data_rewards = <?php echo json_encode($details_data_rewards); ?>;
		<?php
		}
		?>
		var init_dialog = function()
		{

			<?php if (isset($editable)): ?>
			table_support.submit_handler('<?php echo site_url("reports/get_detailed_" . $editable . "_row")?>');
			dialog_support.init("a.modal-dlg");
			<?php endif; ?>
		};

		$('#table').bootstrapTable({
			columns: <?php echo transform_headers($headers['summary'], TRUE); ?>,
			pageSize: <?php echo $this->config->item('lines_per_page'); ?>,
			striped: true,
			pagination: true,
			sortable: true,
			showColumns: true,
			uniqueId: 'id',
			showExport: true,
			data: <?php echo json_encode($summary_data); ?>,
			iconSize: 'sm',
			paginationVAlign: 'bottom',
			detailView: true,
			uniqueId: 'id',
			escape: false,
			onPageChange: init_dialog,
			onPostBody: function() {
				dialog_support.init("a.modal-dlg");
			},
			onExpandRow: function (index, row, $detail) {
				$detail.html('<table></table>').find("table").bootstrapTable({
					columns: <?php echo transform_headers_readonly($headers['details']); ?>,
					data: detail_data[(!isNaN(row.id) && row.id) || $(row[0] || row.id).text().replace(/(POS|RECV)\s*/g, '')]
				});
				<?php
				if($this->config->item('customer_reward_enable') == TRUE && !empty($details_data_rewards))
				{
				?>
					$detail.append('<table></table>').find("table").bootstrapTable({
						columns: <?php echo transform_headers_readonly($headers['details_rewards']); ?>,
						data: details_data_rewards[(!isNaN(row.id) && row.id) || $(row[0] || row.id).text().replace(/(POS|RECV)\s*/g, '')]
					});
				<?php
				}
				?>
			}
		});

		init_dialog();
	});
</script>

<?php $this->load->view("partial/footer"); ?>
