            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-dropbox fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $rprod ?></div>
                                    <div>Produk</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url('product') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>

                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-hourglass-3 fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $alert ?></div>
                                    <div>Stok Menipis</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url('product') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bars fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $rtype ?></div>
                                    <div>Jenis Produk</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url('type') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>

                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $rsupplier ?></div>
                                    <div>Supplier</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url('supplier') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                
                </div>
                <div class="col-lg-6 col-md-6"><!-- 
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Log Activity</h3>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group" style="font-size: 11px;">
                            <?php foreach ($log as $dlog) { ?>
                              <li class="list-group-item"><span class="badge"><?php echo $dlog->datetime ?></span><?php echo $dlog->log; ?></li>
                             <?php } ?>
                            </ul>                            
                        </div><a href="<?php echo base_url('dashboard/log') ?>">
                        <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div></a>
                    </div>
                 --></div>                
            </div>
            <!-- /.row -->            
            <!-- /.row -->
        