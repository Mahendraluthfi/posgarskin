<br>
<legend>Log Activity</legend>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<table class="table table-condensed" id="table">
			<thead>
				<tr class="active">
					<th width="1%">No</th>
					<th>Datetime</th>
					<th>User</th>
					<th>Log</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>

<script>
	var table;  
  $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({ 

            "processing": true, 
            "serverSide": true, 
            "order": [], 
            
            "ajax": {
                "url": "<?php echo site_url('dashboard/get_data_log')?>",
                "type": "POST"
            },

            
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],

        });

    });
</script>