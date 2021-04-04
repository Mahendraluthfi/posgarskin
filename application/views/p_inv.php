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
				<legend>Laporan Penjualan <?php echo $this->uri->segment(3)."/".$this->uri->segment(4) ?></legend>
				 <table class="table table-condensed" id="example" style="font-size: 11px;">
		              <thead>
		                <tr class="active">
		                  <th>INV</th>
		                  <th>Date</th>
		                  <th>Customer</th>
		                  <th>Produk</th>
		                  <th>Harga</th>
		                  <th>Qty</th>
		                  <th>Subtotal</th>
		                </tr>
		              </thead>
		              <tbody>
		                <?php foreach ($result as $data) { ?>
		                <tr>
		                  <td><?php echo $data->idInvoice ?></td>
		                  <td><?php echo $data->dateInvoice ?></td>
		                  <td><?php echo $data->customer ?></td>
		                  <td><?php echo $data->productName."/".$data->typeName ?></td>
		                  <td><?php echo number_format($data->priceIn) ?></td>
		                  <td><?php echo $data->qtyProduct ?></td>
		                  <td><?php echo number_format($data->totalPrice) ?></td>
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