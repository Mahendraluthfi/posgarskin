<br>
<div class="row">
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<legend>Data Supplier</legend>		
	</div>
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		<button type="button" class="btn btn-success btn-sm" onclick="add()"><i class="fa fa-plus"></i> Tambah Supplier</button>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">		
		<table class="table table-bordered table-hover" id="example">
			<thead>
				<tr class="active">
					<th width="1%">No</th>
					<th>Nama Supplier</th>
					<th>Kontak</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; foreach ($row as $data) { ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $data->supplierName ?></td>
					<td><?php echo $data->contact ?></td>
					<td>
						 <button type="button" class="btn btn-primary btn-xs" onclick="edit('<?php echo $data->idSupplier ?>')"><i class="fa fa-edit"></i></button>
						<a href="<?php echo base_url('supplier/hapus/'.$data->idSupplier) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus Data')"><span class="glyphicon glyphicon-trash"></span></a>						
					</td>
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
            <h3 class="modal-title">Input Data Supplier</h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
                <div class="form-body">                  
                  <div class="form-group">
                      <label class="control-label col-md-3">Nama Supplier</label>
                    <div class="col-md-9">
                        <input name="namasupplier" placeholder="Nama Supplier" class="form-control" type="text">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Kontak</label>
                      <div class="col-md-9">
                      <input name="contact" placeholder="Kontak" class="form-control" type="text">
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

	function add()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal      
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

     function edit(id)
    {
      save_method = 'update';
      gid = id;
      $('#form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/supplier/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="namasupplier"]').val(data.supplierName);
            $('[name="contact"]').val(data.contact);            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Supplier'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

   	function save(){
      var url;      
      var x = document.forms["form"]["namasupplier"].value;
      if(save_method == 'add'){
          url = "<?php echo site_url('index.php/supplier/simpan')?>";          
      }else{          
          url = "<?php echo site_url('index.php/supplier/edit/')?>" + gid;         
      }
    if (x == "") {
        alert("Nama Supplier Harus Diisi");
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