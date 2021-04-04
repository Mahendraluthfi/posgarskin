<br>
<div class="row">
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<legend>Invoice</legend>		
	</div>
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		<a href="<?php echo base_url() ?>invoice/add" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-shopping-cart"></span> Transaksi Penjualan</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">		
		<table class="table table-bordered table-hover" id="table">
			<thead>
				<tr class="active">
					<th width="1%">No</th>
					<th>Invoice</th>
		      		<th>Date</th>			
					<th>Customer</th>
		      		<th>TotalHarga</th>
					<th>Keterangan</th>
		      		<th>Aksi</th>			
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal_detail" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Detail Invoice</h3>
            </div>
            <div class="modal-body form">
                <div class="container-fluid">
                    <table class="table table-condensed" id="tb">
                        <thead>
                           	<tr class="info">
								<th>Invoice</th>								
								<th>Nama Produk</th>
								<th width="15%">Qty</th>
								<th>Harga</th>								
								<th>Subtotal</th>								
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
  var table;  
  $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({ 

            "processing": true, 
            "serverSide": true, 
            "order": [], 
            
            "ajax": {
                "url": "<?php echo site_url('invoice/get_data_type')?>",
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
  
  function detail(id) {
		var a = $('#tb').DataTable();           
        a.clear().draw();
        a.destroy();
         $.ajax({
            url : "<?php echo site_url('index.php/invoice/get_detail')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+                        
                        "<td>"+data[i].idInvoice+"</td>"+                        
                        "<td>"+data[i].productName+" /"+data[i].jenisProduct+"</td>"+
                        "<td>"+data[i].qtyProduct+"</td>"+
                        "<td>"+data[i].priceIn+"</td>"+                        
                        "<td>"+data[i].totalPrice+"</td>"+                        
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