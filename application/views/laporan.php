<br>
<a href="<?php echo base_url('laporan') ?>"><legend>Laporan</legend></a>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Penjualan</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Pembelian</a></li>        
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">
      <br>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <?php echo form_open('laporan/sub_view_inv', array('class' => 'form-inline')); ?>
            <div class="form-group">                    
              <input type="text" class="form-control" id="dp" placeholder="Tanggal Awal" name="tgla">
            </div>
            <div class="form-group">                    
              <input type="text" class="form-control" id="dp1" placeholder="Tanggal Akhir" name="tglb">
            </div>
            <button type="submit" class="btn btn-primary">Tampilkan</button>
          <?php echo form_close(); ?>
        </div>
      </div>  <p></p>  
      <?php if (!empty($v_inv)) { $this->load->view($v_inv); } ?>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
    	  <br>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <?php echo form_open('laporan/sub_view_po', array('class' => 'form-inline')); ?>
            <div class="form-group">                    
              <input type="text" class="form-control" id="dp2" placeholder="Tanggal Awal" name="tglc">
            </div>
            <div class="form-group">                    
              <input type="text" class="form-control" id="dp3" placeholder="Tanggal Akhir" name="tgld">
            </div>
            <button type="submit" class="btn btn-primary">Tampilkan</button>
          <?php echo form_close(); ?>
        </div>
      </div>  <p></p>  
      <?php if (!empty($v_po)) { $this->load->view($v_po); } ?>
    </div>    
  </div>

</div>
