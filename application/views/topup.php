<br>
<div class="row">
	<div class="col-md-12 col-lg-12">
		<legend>Transaksi Top Up</legend>		
	</div>
	<!-- <div class="col-md-3 col-lg-3">
	    <button type="button" class="btn btn-primary btn-sm" onclick="topup()"><i class="fa fa-credit-card"></i> Jenis TopUp</button>	    
	</div> -->
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">		
    <button type="button" class="btn btn-success btn-sm" onclick="add()"><i class="fa fa-plus"></i> Transaksi</button><p></p>
    <div class="table-responsive">
      
		<table class="table table-bordered table-hover" id="example">
			<thead>
				<tr class="active">
					<th width="1%">No</th>
          			<th>No Transaksi</th>
          			<th>Tanggal</th>
					<th>Top Up</th>
					<th>ID</th>
					<th>Nominal</th>
					<th>Customer</th>					
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach ($get as $data) {?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $data->idTopup ?></td>
						<td><?php echo $data->date ?></td>
						<td><?php echo $data->idjenistopup ?></td>
						<td><?php echo $data->idnumber ?></td>
						<td><?php echo number_format($data->nominal) ?></td>
						<td><?php echo $data->customer ?></td>
						<td>							
            			  	<button type="button" class="btn btn-xs btn-primary" onclick="edit('<?php echo $data->idTopup ?>')"><i class="fa fa-edit"></i></button>
              				<a href="<?php echo base_url('topup/Hapus/'.$data->idTopup) ?>" onclick="return confirm('Yakin Hapus data ?')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>            
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
    </div>
	</div>
</div>

<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Input Data Produk</h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
                <div class="form-body">  
                	<div class="form-group">
                      	<label class="control-label col-md-3">Tanggal</label>
                      	<div class="col-md-9">
                            <input name="date" placeholder="Tanggal" class="form-control" type="date" value="<?php echo date('Y-m-d') ?>">                        
                        </div>
                  	</div>                                        
                  <div class="form-group">
                      	<label class="control-label col-md-3">Jenis Top Up</label>
                    	<div class="col-md-9">
                    		<input type="text" class="form-control" name="idjenistopup" placeholder="Jenis Top Up">
                    	</div>
                  </div>
                  <div class="form-group">
                      	<label class="control-label col-md-3">ID</label>
                      	<div class="col-md-9">
                            <input name="idnumber" placeholder="ID/Number" class="form-control" type="text">                        
                        </div>
                  </div>                        
                  <div class="form-group">
                      	<label class="control-label col-md-3">Nominal</label>
                      	<div class="col-md-9">
                            <input name="nominal" placeholder="Nominal Top Up" class="form-control" type="number" min="0">                        
                        </div>
                  </div>
                  <div class="form-group">
                      	<label class="control-label col-md-3">Bayar</label>
                      	<div class="col-md-9">
                            <input name="bayar" placeholder="Bayar" class="form-control" type="number" min="0">                        
                        </div>
                  </div>                        
                  <div class="form-group">
                      	<label class="control-label col-md-3">Customer</label>
                      	<div class="col-md-9">
                            <input name="customer" placeholder="Customer" class="form-control" type="text">                        
                        </div>
                  </div>                        
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
		var save_method; //for save method string
	var table;
	var gid;

	function add(){
  		save_method = 'add';
  		$('#form')[0].reset(); // reset form on modals
  		$('#modal_form').modal('show'); // show bootstrap modal      
        $('.modal-title').text('Transaksi Top Up'); // Set title to Bootstrap modal title
		//$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}

    function edit(id)
    {
      save_method = 'update';
      gid = id;
      $('#form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/topup/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
                  
        	$('[name="date"]').val(data.date);
        	$('[name="customer"]').val(data.customer);
        	$('[name="nominal"]').val(data.nominal);
        	$('[name="idjenistopup"]').val(data.idjenistopup);
        	$('[name="idnumber"]').val(data.idnumber);
        	$('[name="bayar"]').val(data.bayar);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Transaksi'); // Set title to Bootstrap modal title
            // $('[name="jenis"]').trigger('change')
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

	function save(){
      var url;      
      // var x = document.forms["form"]["namaproduk"].value;
      if(save_method == 'add'){
          url = "<?php echo site_url('index.php/topup/simpan')?>";          
      }else{          
          url = "<?php echo site_url('index.php/topup/edit/')?>" + gid;         
      }    
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
      }
    
    
</script>