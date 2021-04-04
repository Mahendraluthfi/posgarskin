<br><legend>Transaksi Penjualan</legend>
<div class="row">
	<div class="col-sm-4 col-md-4 col-lg-4">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">Tambah Item</h3>
		  </div>
		  <div class="panel-body">
		  	<?php echo form_open('invoice/add_item', array('id' => 'frm-add')); ?>
		  		<div class="form-group row">
		  			<div class="col-md-4">
			    		<label class="form-control-static"><?php echo date('d M Y') ?></label>		
			    		<input type="hidden" name="id_inv" value="<?php echo $id_inv ?>">	    	
		  			</div>
		  			<div class="col-md-8 text-right">
			    		<label class="form-control-static">ID: <?php echo $id_inv ?></label>			    			  				
		  			</div>
			  	</div>			  	
				<div class="form-group row">
					<div class="col-md-12">
						<button type="button" class="btn btn-warning btn-block btn-cari"><i class="fa fa-search"></i> Cari Produk</button>
					</div>					
			  	</div>	
			  	<div class="form-group">
			    	<label class="form-control-static">Nama Produk</label>
			    	<div class="input-group">
			      		<input type="text" class="form-control" readonly="" name="productName" placeholder="Nama Produk">
			      		<input type="hidden" name="idProduct">
			      		<span class="input-group-btn">
			        		<button class="btn btn-danger btn-cancel-item disabled" type="button"><i class="fa fa-times"></i></button>
			      		</span>
			    	</div><!-- /input-group -->
			    	<input type="hidden" name="">
			  	</div>
			  	<div class="form-group row">
			    	<div class="col-md-2">
			    		<label class="form-control-static">Stok</label>			    		
			    	</div>
			    	<div class="col-md-2 text-primary">
			    		<label class="form-control-static productStock"></label>			    		
			    	</div>
			  	</div>	
			  	<div class="form-group row">
			  		<div class="col-md-2">			    		
			    		<label class="form-control-static">Harga</label>
			    	</div>
			    	<div class="col-md-10 text-primary">
				    	<select class="form-control show-harga" name="selectharga">
				    		
				    	</select>
			    	</div>
			  	</div>			  
			  	<div class="form-group row">
			  		<div class="col-md-2">			    		
			    		<label class="form-control-static">Jumlah</label>
			    	</div>
			    	<div class="col-md-10">
			    		<input type="number" min="1" class="form-control" name="jmlbeli" required="" placeholder="Jumlah Pembelian">			    		
			    	</div>
			  	</div>			  
			  	<div class="form-group row">
			  		<div class="col-md-2">			    		
			    		<label class="form-control-static">Diskon</label>
			    	</div>
			    	<div class="col-md-10">
				    	<input type="number" min="0" class="form-control" name="diskon" placeholder="Diskon">			    	
			    	</div>
			  	</div>
			 <!--  	<div class="form-group">
			  		<textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
			  	</div>	 -->		  			  	
			    	
			  	<button type="submit" class="btn btn-primary disabled btn-add-submit">Tambah</button>
			</form>
		  </div>
		</div>
				

	</div>
	<div class="col-sm-8 col-md-8 col-lg-8">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">Data Item</h3>
		  </div>
		  <div class="panel-body">
		  	<table class="table table-bordered" style="font-size: 13px;">
		  		<thead>
		  			<tr class="active">
		  				<th width="1%">#</th>
		  				<th width="1%">No</th>
		  				<th>Produk</th>
		  				<th>Harga</th>
		  				<th>Jml</th>
		  				<th>Diskon</th>
		  				<th>Subtotal</th>
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<?php
		  			$no=1;
		  			$gtotal = 0;
		  			foreach ($item as $data) { 
		  			?>
		  			<tr>
		  				<td>
		  					<a href="<?php echo base_url('invoice/del_item/'.$data->idInvoiceDet.'/'.$data->idProduct) ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
		  				</td>
		  				<td><?php echo $no++; ?></td>
		  				<td><?php echo $data->productName; ?></td>
		  				<td><?php echo number_format($data->priceIn); ?></td>
		  				<td><?php echo $data->qtyProduct; ?></td>
		  				<td><?php echo number_format($data->disc); ?></td>
		  				<td><?php echo number_format($data->totalPrice); ?></td>
		  			</tr>
		  			<?php
		  			$gtotal = $gtotal+$data->totalPrice;
		  			} ?>
		  		</tbody>
		  	</table>
		  	<hr>
		  	<?php if ($numrow > 0) { ?>
		  	<div class="row">
		  		<div class="col-md-6 col-lg-6">
		  			<div class="alert alert-success" style="margin: 0px;">
			    		<h4>Grand Total</h4>
			    		<span class="text-right"><h2 class="grand_total">Rp. <?php echo number_format($gtotal) ?></h2></span>			    		
			    	</div>
		  		</div>
		  		<div class="col-md-6 col-lg-6">
		  			<form class="form-horizontal" onsubmit="return confirm('Yakin Simpan Transaksi ?')" action="<?php echo base_url('invoice/submit_transaksi/'.$id_inv) ?>" method="POST">
		  			<div class="form-group row">
		  				<label class="col-md-3 control-label">Customer</label>			  				
		  				<div class="col-md-9">			  					
		  					<input type="text" class="form-control form-control-sm" name="customer" value="Umum" required="">
		  					<input type="hidden" name="totalPrice" value="<?php echo $gtotal ?>">
		  				</div>
		  			</div>
		  			<div class="form-group row">
		  				<label class="col-md-3 control-label">Catatan</label>			  				
		  				<div class="col-md-9">
		  					<textarea name="catatan" placeholder="Catatan Penjualan" class="form-control"></textarea>
		  				</div>
		  			</div>	
		  			<div class="form-group row">
		  				<label class="col-md-3 control-label"></label>			  				
		  				<div class="col-md-9">
		  					<button type="submit" class="btn btn-primary">Simpan Transaksi</button>
		  				</div>
		  			</div>	
		  			</form>
		  		</div>
		  	</div>
		  	<?php } ?>
		  </div>
		</div>				
	</div>
</div>

<div class="modal fade" id="modal-search">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cari Produk</h4>
			</div>
			<div class="modal-body">
				<input type="text" class="form-control" name="" placeholder="Cari nama produk . . ." id="sample_search"><hr>
				<div class="list-group list-search">
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cari Produk</h4>
			</div>
			<div class="modal-body">
				<div class="list-group show-result">
					
				</div>
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>
	</div>
</div>

<script>	
	
	$('.btn-cari').on('click',function(){
		$('#modal-search').modal('show');
	});

	$('.btn-cancel-item').on('click',function(){
		// $('#modal-search').modal('show');
		location.reload();
	});

	var searchRequest = null;
		var minlength = 2;

    $("#sample_search").keyup(function () {
        var that = this,
        value = $(this).val();
        // console.log(value);
        if (value.length >= minlength ) {
            if (searchRequest != null) 
                searchRequest.abort();
            	searchRequest = $.ajax({
                	type: "POST",
                	url: "<?php echo base_url('invoice/search_product') ?>",
                	data: {
	                    'search_keyword' : value
                	},
                	dataType: "JSON",
                	success: function(data){
                    //we need to check if the value is the same
                    	if (value==$(that).val()) {	
                    	// Receiving the result of search here
                    		// console.log(data);
	                    	var html = '';
		        	        var i;		        	        
		    	            for(i=0; i<data.length; i++){
		                    	html += '<button type="button" class="list-group-item" onclick="golek(\''+data[i].idProduct+'\')">'+data[i].productName+' / '+data[i].jenisProduct+'</button>';                        		                        
		                    }
			                $('.list-search').html(html);
                    	}
                	}
            });
        }else{
            $('.list-search').html('');	        	
        }
    });

    function golek(idProduct) {	
    	var option = '';		
        $.ajax({
           url : "<?php echo site_url('index.php/invoice/get_item')?>",
        	type: "POST",
        	dataType: "JSON",
        	data: {idProduct:idProduct},
        	success: function(data){
        		$('#modal-search').modal('hide');
        		$('[name="productName"]').val(data.productName+' / '+data.jenisProduct);
        		$('[name="idProduct"]').val(data.idProduct);
        		// $('[name="jmlbeli"]').attr('max', data.productStock);
        		$('.productStock').text(data.productStock);
        		$('.btn-add-submit').removeClass('disabled');
        		$('.btn-cancel-item').removeClass('disabled');
        		option += '<option value="'+data.harga1+'">'+data.harga1+' /Harga1</option>';
        		option += '<option value="'+data.harga2+'">'+data.harga2+' /Harga2</option>';
        		option += '<option value="'+data.harga3+'">'+data.harga3+' /Harga3</option>';
        		
        		$('.show-harga').html(option);
        	},
            	error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
        	}
        });       
	}

</script>