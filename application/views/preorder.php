<br>
<div class="row">
	<div class="col-md-12 col-lg-12">
		<legend>Pre Order</legend>		
	</div>	
</div>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Pre-Order</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Order Selesai</a></li>    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    	<p></p>
    	<button type="button" class="btn btn-primary btn-xs" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Tambah Pre-Order</button><p></p>
      <table class="table table-hover table-striped table-condensed" style="font-size: 12px;" id="example">
        <thead>
          <tr>
            <th width="1%">No</th>
            <th>No. Transaksi</th>
            <th>Tanggal Order/<br>Tanggal Jadi</th>
            <!-- <th>Tanggal Jadi</th> -->
            <th>Nama Barang</th>
            <th width="1%">Jumlah</th>
            <th>Total Harga</th>
            <th>DP</th>            
            <th>Customer</th>
            <th>No.HP</th>
            <th>Ket</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($preorder as $data) { ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo '<button class="btn btn-success btn-xs" onclick="pay(\''.$data->idPreorder.'\')">'.$data->idPreorder.'</button>'; ?></td>
            <td><?php echo date('d-M-Y', strtotime($data->dateorder)).'/<br>'.date('d-M-Y', strtotime($data->daterelease)); ?></td>
            
            <td><?php echo $data->namaBarang ?></td>
            <td><?php echo $data->jml ?></td>
            <td><?php echo number_format($data->totalBayar) ?></td>
            <td><?php echo number_format($data->dp) ?></td>
            <td><?php echo $data->customer ?></td>
            <td><?php echo $data->no_hp ?></td>
            <td><?php echo $data->keterangan ?></td>
            <td>
              <button type="button" class="btn btn-xs btn-primary" onclick="edit('<?php echo $data->idPreorder ?>')"><i class="fa fa-edit"></i></button>
              <a href="<?php echo base_url('preorder/delete/'.$data->idPreorder) ?>" onclick="return confirm('Yakin Hapus data ?')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>


	</div>
    
    <div role="tabpanel" class="tab-pane" id="profile">
    	<p></p>
    	<table class="table table-hover table-striped table-condensed" style="font-size: 12px;" id="example2">
        <thead>
          <tr>
            <th width="1%">No</th>
            <th>No. Transaksi</th>
            <th>Tanggal Order/<br>Tanggal Jadi</th>
            <!-- <th>Tanggal Jadi</th> -->
            <th>Nama Barang</th>
            <th width="1%">Jumlah</th>
            <th>Total Harga</th>
            <th>DP</th>            
            <th>Lunas</th>            
            <th>Customer</th>
            <th>No.HP</th>
            <th>Ket</th>            
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($order as $data) { ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data->idPreorder; ?></td>
            <td><?php echo date('d-M-Y', strtotime($data->dateorder)).'/<br>'.date('d-M-Y', strtotime($data->daterelease)); ?></td>
            
            <td><?php echo $data->namaBarang ?></td>
            <td><?php echo $data->jml ?></td>
            <td><?php echo number_format($data->totalBayar) ?></td>
            <td><?php echo number_format($data->dp) ?></td>
            <td><?php echo number_format($data->pelunasan) ?></td>
            <td><?php echo $data->customer ?></td>
            <td><?php echo $data->no_hp ?></td>
            <td><?php echo $data->keterangan ?></td>            
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
                    <label class="control-label col-md-3">Tanggal Order</label>
                    <div class="col-md-9">
                      <input name="dateorder"  class="form-control" type="date">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Tanggal Jadi</label>
                    <div class="col-md-9">
                      <input name="daterelease"  class="form-control" type="date">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Nama Barang</label>
                    <div class="col-md-9">
                      <input name="namaBarang"  class="form-control" type="text" placeholder="Nama Barang">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Jumlah</label>
                    <div class="col-md-9">
                      <input name="jml"  class="form-control" type="number" min="0" placeholder="Jumlah">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Total Bayar</label>
                    <div class="col-md-9">
                      <input name="totalBayar"  class="form-control" type="number" min="0" placeholder="Total Bayar">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">DP</label>
                    <div class="col-md-9">
                      <input name="dp"  class="form-control" type="number" min="0" placeholder="DP">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Customer</label>
                    <div class="col-md-9">
                      <input name="customer"  class="form-control" type="text" placeholder="Customer">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">NO HP</label>
                    <div class="col-md-9">
                      <input name="no_hp"  class="form-control" type="text" placeholder="NO HP">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Keterangan</label>
                    <div class="col-md-9">
                      <input name="keterangan"  class="form-control" type="text" placeholder="Keterangan">
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

<div class="modal fade" id="modal_pay" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Transaksi Pre-Order</h3>
          </div> -->
          <div class="modal-body form">
            <div class="panel panel-default">
              <div class="panel-heading">Transaksi Pre-Order</div>
              <div class="panel-body">
                <form action="#" class="form-horizontal">
                    <div class="form-body">                  
                      <div class="form-group">
                        <label class="control-label col-md-3">Tanggal Order</label>
                        <div class="col-md-9">                            
                            <label class="control-label text-primary label-dateorder"></label>                        
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Tanggal Jadi</label>
                        <div class="col-md-9">                            
                            <label class="control-label text-primary label-daterelease"></label>                        
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Nama Barang</label>
                        <div class="col-md-9">                            
                            <label class="control-label text-primary label-namaBarang"></label>                        
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Jumlah</label>
                        <div class="col-md-9">                            
                            <label class="control-label text-primary label-jml"></label>                        
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label class="control-label col-md-3">Customer</label>
                        <div class="col-md-9">                            
                            <label class="control-label text-primary label-customer"></label>                        
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">NO HP</label>
                        <div class="col-md-9">                            
                            <label class="control-label text-primary label-no_hp"></label>                        
                        </div>
                      </div>                                                 
                    </div>
                </form>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">Pelunasan</div>
              <div class="panel-body">
                <form action="#" id="orderfrm" class="form-horizontal">
                    <div class="form-body">                                        
                      <div class="form-group">
                        <label class="control-label col-md-3">Total Bayar</label>
                        <div class="col-md-9">                            
                            <label class="control-label text-primary label-totalBayar"></label>                        
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">DP</label>
                        <div class="col-md-9">                            
                            <label class="control-label text-primary label-dp"></label>                        
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label class="control-label col-md-3">Pelunasan</label>
                        <div class="col-md-9">                            
                            <input type="number" class="form-control" min="0" placeholder="Pelunasan Pembayaran" name="pelunasan">
                        </div>
                      </div>  
                      <div class="form-group">
                        <label class="control-label col-md-3">Keterangan</label>
                        <div class="col-md-9">                            
                            <input name="keterangan_tf"  class="form-control" type="text" placeholder="Keterangan">   
                            <input type="hidden" name="idPreorder">                            
                        </div>
                      </div>                                                
                    </div>
                </form>
              </div>
            </div>
            
          
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="orderselesai()" class="btn btn-primary">Order Selesai</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
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
      $('.modal-title').text('Tambah Pre-Order'); // Set title to Bootstrap modal title
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
        url : "<?php echo site_url('index.php/preorder/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {              
            $('[name="dateorder"]').val(data.dateorder);
            $('[name="daterelease"]').val(data.daterelease);
            $('[name="namaBarang"]').val(data.namaBarang);
            $('[name="jml"]').val(data.jml);
            $('[name="totalBayar"]').val(data.totalBayar);
            $('[name="dp"]').val(data.dp);
            $('[name="customer"]').val(data.customer);
            $('[name="no_hp"]').val(data.no_hp);
            $('[name="keterangan"]').val(data.keterangan);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pre-Order'); // Set title to Bootstrap modal title
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
      
      if(save_method == 'add'){
          url = "<?php echo site_url('index.php/preorder/simpan')?>";          
      }else{          
          url = "<?php echo site_url('index.php/preorder/edit/')?>" + gid;         
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

      function pay(id) {
        $.ajax({
        url : "<?php echo site_url('index.php/preorder/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {            
            $('.label-dateorder').text(data.dateorder);
            $('.label-daterelease').text(data.daterelease);
            $('.label-namaBarang').text(data.namaBarang);
            $('.label-jml').text(data.jml);
            $('.label-totalBayar').text(data.totalBayar);
            $('.label-dp').text(data.dp);
            $('.label-customer').text(data.customer);
            $('.label-no_hp').text(data.no_hp);
            $('[name="keterangan_tf"]').val(data.keterangan);  
            $('[name="idPreorder"]').val(data.idPreorder);
            $('#modal_pay').modal('show');
        },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
      }

      function orderselesai() {
        $.ajax({
            url : '<?php echo base_url('preorder/pelunasan') ?>',
            type: "POST",
            data: $('#orderfrm').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_pay').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
      }
    
</script>