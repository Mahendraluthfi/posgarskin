<br>
<div class="row">
	<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
		<legend>Pembelian</legend>		
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
		<a href="<?php echo base_url() ?>purchase/add" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-shopping-cart"></span> Pembelian</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">		
		<table class="table table-bordered table-hover" id="example">
			<thead>
				<tr class="active">
					<th width="1%">No</th>
					<th>PurchaseOrder</th>
					<th>Tanggal</th>
					<th>Supplier</th>
					<th>Total Item</th>					
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; foreach ($row as $data) { ?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $data->purchaseOrder ?></td>
					<td><?php echo $data->date ?></td>
					<td><?php echo $data->supplierName ?></td>
					<td><?php echo $data->totalItem ?></td>					
					<td>
						 <button type="button" class="btn btn-primary btn-xs" onclick="detail('<?php echo $data->purchaseOrder ?>')"><i class="glyphicon glyphicon-zoom-in"></i></button>						
					</td>
				</tr>
				 <?php } ?> 
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal_detail" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Detail PurchaseOrder</h3>
            </div>
            <div class="modal-body form">
                <div class="container-fluid">
                    <table class="table table-condensed" id="tb">
                        <thead>
                           	<tr class="info">
								<th>PurchaseOrder</th>								
								<th>Nama Produk</th>
								<th width="15%">Qty</th>
								<th>Catatan</th>								
							</tr>
                        </thead>
                        <tbody id="show_data">
                            
                        </tbody>
                    </table>               
                </div>           
            </div>
            <div class="modal-footer">            
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
	function detail(id) {
		var a = $('#tb').DataTable();           
        a.clear().draw();
        a.destroy();
         $.ajax({
            url : "<?php echo site_url('index.php/purchase/get_detail')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+                        
                        "<td>"+data[i].purchaseOrder+"</td>"+                        
                        "<td>"+data[i].productName+" /"+data[i].typeName+"</td>"+
                        "<td>"+data[i].qty+"</td>"+
                        "<td>"+data[i].notice+"</td>"+                        
                        "</tr>";
                    }
                $('#show_data').html(html);
                $('#tb').DataTable();
                $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded                        
            },
                error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        }); 
	}
</script>