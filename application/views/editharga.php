<br>
<div class="row">
	<div class="col-md-11 col-lg-11">
		<legend>Edit Harga Massal</legend>		
	</div>
	<div class="col-md-1 col-lg-1">
    <a href="<?php echo base_url() ?>product" class="btn btn-success btn-sm" onclick="add()"><i class="fa fa-chevron-left"></i> Kembali</a>
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-lg-8">
		<form>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Pilih Produk</label>
		    <select name="" class="form-control select2" onchange="javascript:handleSelect(this)">
		    	<option value="">Pilih</option>
		    	<?php foreach ($showlist as $data) {
		    		echo '<option value="'.$data->idProduct.'">'.$data->productName.'</option>';
		    	} ?>
		    </select>
		  </div>		  
		</form><hr>
		<table class="table table-condensed" id="example">
		  		<thead>
		  			<tr>
		  				<th width="1%">No</th>
		  				<th>Produk</th>
		  				<th>#</th>
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<?php $no=1; foreach ($get as $data) { ?>
		  			<tr>
		  				<td><?php echo $no++; ?></td>
		  				<td><?php echo $data->productName.' / '.$data->jenisProduct ?></td>
		  				<td>
		  					<a href="<?php echo base_url('product/hapus_sementara/'.$data->id) ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
		  				</td>
		  			</tr>
		  			<?php } ?>
		  		</tbody>
		  	</table>

	</div>
	<div class="col-md-4 col-lg-4">
		<div class="panel panel-default">
		  <div class="panel-body">
		  	<h4>Edit Harga</h4>
		  	<?php echo form_open('product/simpanharga'); ?>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Harga 1</label>
			    <input type="number" min="0" class="form-control" placeholder="Harga 1" name="harga1">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Harga 2</label>
			    <input type="number" min="0" class="form-control" placeholder="Harga 2" name="harga2">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Harga 3</label>
			    <input type="number" min="0" class="form-control" placeholder="Harga 3" name="harga3">
			  </div>
			  
			  <button type="submit" class="btn btn-primary">Simpan Harga</button>
			</form>
		  </div>
		</div>
	</div>
</div>

<script>
  function handleSelect(elm)
  {
     window.location = '<?php echo base_url('product/editin/') ?>'+elm.value;
  }
</script>