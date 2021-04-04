<legend>Laporan <?php echo $tgla." s/d ".$tglb ?>&nbsp;<a href="<?php echo base_url('laporan/p_inv/'.$tglap.'/'.$tglbp) ?>" target="_blank"><span class="glyphicon glyphicon-print"></span></a></legend>
<div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">          
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
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Informasi</h3>
            </div>
            <div class="panel-body">

              <div class="row">
                <div class="container-fluid">                
                  <div class="pull-left">
                    <h4>Total Penjualan</h4>              
                  </div>
                  <div class="pull-right"><h4>                
                  <?php foreach ($totalpenjualan as $key1) {
                    echo "Rp ".number_format($key1->ttl);
                  } ?></h4>
                  </div>                
                </div>
              </div>                
              <div class="row">
                <div class="container-fluid">                
                  <div class="pull-left">
                    <h4>Total Produk Terjual</h4>              
                  </div>
                  <div class="pull-right"><h4>                
                  <?php foreach ($totalitem as $key1) {
                    echo number_format($key1->ttlitem);
                  } ?></h4>
                  </div>                
                </div>
              </div>                
              <h4>Produk Paling Laris</h4>
              <ul class="list-group">
                <?php foreach ($most as $key) { ?>
                <li class="list-group-item list-group-item-success"> <span class="badge"><?php echo $key->ttlitem ?></span><?php echo $key->productName ?></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>	<p></p>      