<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cetak Laporan</title>	
	<link href="<?php echo base_url() ?>asset/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>asset/admin/vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<legend>Laporan Pembelian <?php echo $this->uri->segment(3)."/".$this->uri->segment(4) ?></legend>
				 <table class="table table-condensed" id="example" style="font-size: 11px;">
		              <thead>
		                <tr class="active">
		                  <th>PO</th>
		                  <th>Date</th>
		                  <th>Supplier</th>
		                  <th>Produk</th>                  
		                  <th>Qty</th>
		                  <th>Ket</th>
		                </tr>
		              </thead>
		              <tbody>
		                <?php foreach ($result as $data) { ?>
		                <tr>
		                  <td><?php echo $data->purchaseOrder ?></td>
		                  <td><?php echo $data->date ?></td>
		                  <td><?php echo $data->supplierName ?></td>
		                  <td><?php echo $data->productName."/".$data->typeName ?></td>
		                  <td><?php echo $data->qty ?></td>
		                  <td><?php echo $data->notice ?></td>
		                </tr>
		                <?php } ?>
		              </tbody>
          		  </table>           
			</div>
		</div>
	</div>
	<script>
		window.print();
	</script>
</body>
</html>