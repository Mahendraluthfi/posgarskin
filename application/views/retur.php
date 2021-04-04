<br>
<div class="row">
	<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
		<legend>Data Retur Produk</legend>		
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
		<button type="button" class="btn btn-success btn-sm" onclick="add()"><i class="fa fa-plus"></i></button>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">		
		<table class="table table-bordered table-hover" id="example">
			<thead>
				<tr class="active">
					<th width="1%">No</th>
          <th>Date</th>
          <th>Supplier</th>
          <th>Nama Produk</th>
					<th>Qty</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
			<?php $no = 1; foreach ($row as $data) { ?>
				<tr>
					<td><?php echo $no++; ?></td>
          <td><?php echo $data->date ?></td>
          <td><?php echo $data->supplierName ?></td>
					<td><?php echo $data->productName.'/'.$data->jenisProduct ?></td>
          <td><?php echo $data->qty ?></td>
          <td><?php echo $data->notice ?></td>					
				</tr>
				<?php } ?> 
			</tbody>
		</table>
	</div>
</div>

<!-- Modal -->

<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Input Data Retur Produk</h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
                <div class="form-body">                  
                  <div class="form-group">
                      <label class="control-label col-md-3">Nama Produk</label>
                      <div class="col-md-9">
                        <select name="prod" class="form-control select2" style="width: 100%" required="" id="prod">
                            <option value="">-- Pilih --</option>           
                            <?php foreach ($prod as $key) { ?>
                            <option value="<?php echo $key->idProduct ?>"><?php echo $key->productName." /".$key->jenisProduct ?></option>
                            <?php } ?>  
                          </select>  
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Nama Supplier</label>
                      <div class="col-md-9">
                        <select name="supplier" class="form-control" style="width: 100%" required="">
                            <option value="">-- Pilih --</option>           
                            <?php foreach ($sup as $key1) { ?>
                            <option value="<?php echo $key1->idSupplier ?>"><?php echo $key1->supplierName ?></option>
                            <?php } ?>  
                          </select>  
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Date</label>
                      <div class="col-md-9">
                        <input name="date" placeholder="Tanggal" class="form-control" type="text" id="dp">
                      </div>
                  </div>
                   <div class="form-group">
                      <label class="control-label col-md-3">Qty</label>
                      <div class="col-md-9">
                        <input name="qty" placeholder="Jumlah" class="form-control" type="number" min="1">
                      </div>
                  </div>  
                   <div class="form-group">
                      <label class="control-label col-md-3">Keterangan</label>
                      <div class="col-md-9">
                        <textarea name="ket" class="form-control" placeholder="Keterangan"></textarea>
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
	// var save_method; //for save method string
    var table;
    var gid;

	function add()
    {
      // save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal      
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
   
   	function save(){
      var url;      
      var x = document.forms["form"]["prod"].value;
      url = "<?php echo site_url('index.php/retur/simpan')?>";               
    if (x == "") {
        alert("Nama Produk Harus Diisi");
        return false;
    }else{
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
    }
</script>