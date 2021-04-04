<br>
<div class="row">
	<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
		<legend>Data Jenis</legend>		
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
		<button type="button" class="btn btn-success btn-sm" onclick="add()"><i class="fa fa-plus"></i></button>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">		
		<table class="table table-bordered table-hover" id="table">
			<thead>
				<tr class="active">
					<th width="1%">No</th>
					<th>KodeJenis</th>
					<th>NamaJenis</th>
		      <th>Aksi</th>			
				</tr>
			</thead>
			<tbody>

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
            <h3 class="modal-title">Input Data Jenis</h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
                <div class="form-body">                  
                  <div class="form-group">
                      <label class="control-label col-md-3">Kode Jenis</label>
                    <div class="col-md-9">
                        <input name="kodejenis" placeholder="Kode Jenis" class="form-control" type="text" maxlength="5" style="text-transform: uppercase;">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Nama Jenis</label>
                      <div class="col-md-9">
                      <input name="namajenis" placeholder="Nama Jenis" class="form-control" type="text">
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
  $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({ 

            "processing": true, 
            "serverSide": true, 
            "order": [], 
            
            "ajax": {
                "url": "<?php echo site_url('type/get_data_type')?>",
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
        url : "<?php echo site_url('index.php/type/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="kodejenis"]').val(data.kodeType);
            $('[name="kodejenis"]').attr('readonly','readonly');
            $('[name="namajenis"]').val(data.typeName);            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Jenis'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

   	function save(){
      var url;      
      var x = document.forms["form"]["kodejenis"].value;
      if(save_method == 'add'){
          url = "<?php echo site_url('index.php/type/simpan')?>";          
      }else{          
          url = "<?php echo site_url('index.php/type/edit/')?>" + gid;         
      }
    if (x == "") {
        alert("KodeJenis Harus Diisi");
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