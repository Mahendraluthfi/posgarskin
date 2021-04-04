<br>
<div class="row">
	<div class="col-md-8 col-lg-8">
		<legend>Data Produk</legend>		
	</div>
	<div class="col-md-4 col-lg-4">
    <button type="button" class="btn btn-success btn-sm" onclick="add()"><i class="fa fa-plus"></i> Tambah Produk</button>
    <a href="<?php echo base_url() ?>product/editharga" class="btn btn-primary btn-sm"><i class="fa fa-briefcase"></i> Edit Harga Massal</a>
		<button type="button" class="btn btn-warning btn-sm" onclick="upload()"><i class="fa fa-file-excel-o"></i> Upload Produk</button>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">		
    <div class="table-responsive">
      
		<table class="table table-bordered table-hover" id="example">
			<thead>
				<tr class="active">
					<th width="1%">No</th>
          <th>Nama Produk</th>
					<th>Jenis Produk</th>
					<th>Harga1</th>
					<th>Harga2</th>
					<th>Harga3</th>
					<th>Stok</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; foreach ($row as $data) { ?>
				<tr <?php if($data->productStock < 4){echo "class='danger'";}?>>
					<td><?php echo $no++; ?></td>
          <td><?php echo $data->productName ?></td>
					<td><?php echo $data->jenisProduct ?></td>
					<td><?php echo number_format($data->harga1) ?></td>
					<td><?php echo number_format($data->harga2) ?></td>
					<td><?php echo number_format($data->harga3) ?></td>
					<td><?php echo $data->productStock ?></td>
					<td>
						 <button type="button" class="btn btn-primary btn-xs" onclick="edit('<?php echo $data->idProduct ?>')"><i class="fa fa-edit"></i></button>
						<a href="<?php echo base_url('product/hapus/'.$data->idProduct) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus Data')"><span class="glyphicon glyphicon-trash"></span></a>						
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
                      	<label class="control-label col-md-3">Nama Produk</label>
                    	<div class="col-md-9">
                        <input name="namaproduk" placeholder="Nama Produk" class="form-control" type="text">
                      	</div>
                  </div>
                  <div class="form-group">
                      	<label class="control-label col-md-3">Nama Jenis</label>
                      	<div class="col-md-9">
                            <input name="jenisproduk" placeholder="Jenis Produk" class="form-control" type="text">                        
                        </div>
                  </div>
                  <div class="form-group">
                      	<label class="control-label col-md-3">Harga 1</label>
                    	<div class="col-md-9">
                        <input name="harga1" placeholder="Harga 1" class="form-control" type="text" onkeyup="reformatText(this)">
                      	</div>
                  </div>
                  <div class="form-group">
                      	<label class="control-label col-md-3">Harga 2</label>
                    	<div class="col-md-9">
                        <input name="harga2" placeholder="Harga 2" class="form-control" type="text" onkeyup="reformatText(this)">
                      	</div>
                  </div>
                  <div class="form-group">
                      	<label class="control-label col-md-3">Harga 3</label>
                    	<div class="col-md-9">
                        <input name="harga3" placeholder="Harga 3" class="form-control" type="text" onkeyup="reformatText(this)">
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


<div class="modal fade" id="modal_upload" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Upload Produk via Excel</h3>
          </div>
          <div class="modal-body form">
            <p></p>
      <?php if(form_error('fileURL')) {?>    
        <div class="row clearfix">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="alert bg-danger alert-danger text-white" role="alert">
                <?php print form_error('fileURL'); ?>                
                </div>            
            </div>
            <div class="col-2"></div>                
        </div>
        <?php } ?>
                <h5>Download format Excel dibawah ini</h5>
                <a href="<?php echo base_url() ?>asset/TEMPLATE UPLOAD PRODUK.xlsx" target="_blank" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Download Format Excel</a><hr>
                <?php echo form_open_multipart('product/upload'); ?>
                 <div class="form-group">
                    <label for="exampleInputFile">File upload produk</label>
                    <input type="file" name="fileURL" required="">
                    <p class="help-block">File type .xlsx, .xls, .csv</p>
                  </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Upload</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <?php echo form_close(); ?>
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
		//$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}

    function upload(){     
        $('#modal_upload').modal('show'); // show bootstrap modal      
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit(id)
    {
      save_method = 'update';
      gid = id;
      $('#form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/product/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="namaproduk"]').val(data.productName);
         	$('[name="jenisproduk"]').val(data.jenisProduct);
         	$('[name="harga1"]').val(data.harga1);
         	$('[name="harga2"]').val(data.harga2);
         	$('[name="harga3"]').val(data.harga3);
            $('[name="jenis"]').val(data.idType);            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Produk'); // Set title to Bootstrap modal title
            $('[name="jenis"]').trigger('change')
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

	function save(){
      var url;      
      var x = document.forms["form"]["namaproduk"].value;
      if(save_method == 'add'){
          url = "<?php echo site_url('index.php/product/simpan')?>";          
      }else{          
          url = "<?php echo site_url('index.php/product/edit/')?>" + gid;         
      }
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

    String.prototype.reverse = function () {
        return this.split("").reverse().join("");
    }
    function reformatText(input) {        
        var x = input.value;
        x = x.replace(/,/g, ""); // Strip out all commas
        x = x.reverse();
        x = x.replace(/.../g, function (e) {
            return e + ",";
        }); // Insert new commas
        x = x.reverse();
        x = x.replace(/^,/, ""); // Remove leading comma
        input.value = x;
    }
</script>