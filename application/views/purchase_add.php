<br>
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Transaksi Pembelian</h3>
  </div>
  <div class="panel-body">             
		<h3>#<?php echo $this->session->userdata('po'); ?></h3>
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				
				<form>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Pilih Supplier</label>
				    <select name="" class="form-control" onchange="javascript:handleSelect(this)">
				    	<option value="">Pilih</option>
				    	<?php foreach ($sup as $data) { ?>
				    		<option value="<?php echo $data->idSupplier ?>"><?php echo $data->supplierName ?></option>
				    	<?php } ?>
				    </select>
				  </div>
				</form>
				
					<?php echo form_open('purchase/savepo'); ?>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Supplier</label>
					    <input type="text" name="namasupplier" readonly="" class="form-control">
					    <input type="hidden" name="idSupplier">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Telepon</label>
					    <input type="text" name="telepon" readonly="" class="form-control">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Alamat</label>
					    <textarea name="alamat" readonly="" class="form-control"></textarea>
					  </div>
					  <button type="submit" class="btn btn-primary btnsimpan" onclick="return confirm('Apakah anda sudah yakin ?')" disabled="">Simpan PO</button>
					</form>
			</div>
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
				<table class="table table-bordered table-hover">
					<thead>
						<tr class="active">
							<th>Nama Produk</th>							
							<th width="15%">Qty</th>
							<th>Catatan</th>
							<th>#</th>
						</tr>
					</thead>
					<form id="frm_add">
					<tbody>
						<tr>
							<td>
								<select name="product" class="form-control select2" style="width: 100%">
									<?php foreach ($row as $data) { ?>
										<option value="<?php echo $data->idProduct ?>"><?php echo $data->productName." /".$data->jenisProduct ?></option>		
									<?php } ?>					
								</select>
							</td>							
							<td>
								<input type="number" name="qty" min="1" class="form-control" placeholder="0" >
							</td>
							<td>
								<input type="text" name="note" class="form-control" placeholder="Catatan">
							</td>
							<td>
								<button type="button" class="btn btn-success btn-sm btn-add"><span class="glyphicon glyphicon-plus"></span></button>
							</td>
						</tr>
					</tbody>
					<?php echo form_close(); ?>
				</table><hr>
				<table class="table table-condensed">
					<thead>
						<tr class="info">
							<th width="1%">No</th>
							<th>Nama Produk</th>							
							<th width="15%">Qty</th>
							<th>Catatan</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody id="show_table">
						
					</tbody>
				</table>				
			</div>			
		</div>  			  
  </div>
</div>


<script>

	function handleSelect(elm)
		  {
		    var id = elm.value;
		    $.ajax({
	            	url : "<?php echo site_url('index.php/purchase/get_supplier')?>/" + id,
	            	type: "GET",
	            	dataType: "JSON",
	            	success: function(data){
	            		$('[name="idSupplier"]').val(data.idSupplier);
	            		$('[name="namasupplier"]').val(data.supplierName);
	            		$('[name="telepon"]').val(data.contact);
	            		$('[name="alamat"]').val(data.alamat);
	            		$('.btnsimpan').removeAttr('disabled','');
	            	},
	                	error: function (jqXHR, textStatus, errorThrown){
		                // alert('Error get data from ajax');
	            		$('.btnsimpan').attr('disabled','');	                
		              	$('[name="namasupplier"]').val('');
	            		$('[name="telepon"]').val('');
	            		$('[name="alamat"]').val('');  
	            	}
	        	}); 
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

	$( document ).ready(function() {
		


		view_table();
    	function view_table() {    		
    		$.ajax({
            	url : "<?php echo site_url('index.php/purchase/get_polist')?>",
            	type: "GET",
            	dataType: "JSON",
            	success: function(data){
            	    var html = '';
        	        var i;
        	        var no = 1;
    	            for(i=0; i<data.length; i++){
                    html += "<tr>"+                        
                        "<td>"+no+++"</td>"+                        
                        "<td>"+data[i].productName+"</td>"+                                                                   
                        "<td>"+data[i].qty+"</td>"+                        
                        "<td>"+data[i].notice+"</td>"+                        
                        "<td><button type='button' class='btn btn-danger btn-xs btndelete' data='"+data[i].idProductsIn+"'><i class='glyphicon glyphicon-trash'></i></button></td>"+
                        "</tr>";
                    }
	                $('#show_table').html(html);
            	},
                	error: function (jqXHR, textStatus, errorThrown){
	                alert('Error get data from ajax');
            	}
        	});        	

    	}

    	$('.btn-add').on('click', function(){
    		$.ajax({
	            url : '<?php echo base_url('purchase/save') ?>',
	            type: "POST",
	            data: $('#frm_add').serialize(),            
	            dataType: "JSON",
	            success: function(data)
	            {
	            	$('#frm_add')[0].reset();
	            	view_table();
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error adding / update data');
	            }
	        });
    	});

    	$('#show_table').on('click','.btndelete',function(){
    		var iddelete = $(this).attr('data');
    		$.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/purchase/delete')?>",
                dataType : "JSON",
                data : {id: iddelete},
                success: function(data){                        
                    view_table();
                }
            });    
    	});



    });

	

</script>