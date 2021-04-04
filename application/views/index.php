<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rumah Garskin Inventory</title>

    <link href="<?php echo base_url() ?>asset/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() ?>asset/favicon.ico">
    <link href="<?php echo base_url() ?>asset/admin/dist/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/select2/dist/css/select2.min.css">    
    <link rel="stylesheet" href="<?php echo base_url()?>asset/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">    
    <link href="<?php echo base_url() ?>asset/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">    
    <link href="<?php echo base_url() ?>asset/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>asset/js/jquery-2.2.3.min.js"></script>       

    <!-- <link href="<?php echo base_url() ?>asset/admin/vendor/morrisjs/morris.css" rel="stylesheet"> -->
    <style type="text/css">
    #notifications {
      cursor: pointer;
      position: fixed;
      right: 0px;
      z-index: 9999;
      bottom: 0px;
      margin-bottom: 22px;
      margin-right: 15px;
      min-width: 300px; 
      max-width: 800px;   
    }

    @media screen and (max-width: 720px) {
      #wait{
        top: 50%;
        left: 25%;
      }
    }

    @media screen and (min-width: 720px){
      #wait{
        top: 40%;
        left: 40%;
      } 
    }
  </style>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url() ?>">Rumah Garskin Inventory</a>
            </div>
            <!-- /.navbar-header -->

            <!-- <ul class="nav navbar-top-links navbar-right"></ul> -->
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">                        
                        <li>
                            <a href="<?php echo base_url() ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-database fa-fw"></i> Master Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <!-- <li>
                                    <a href="<?php echo base_url('type') ?>">Data Jenis</a>
                                </li> -->
                                <li>
                                    <a href="<?php echo base_url('product') ?>">Data Produk</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('supplier') ?>">Data Supplier</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                    
                        <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i> Transaksi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('invoice') ?>">Penjualan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('preorder') ?>">Pre Order</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('topup') ?>">Top Up</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('purchase') ?>">Pembelian</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('retur') ?>">Retur</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url('laporan') ?>"><i class="fa fa-file fa-fw"></i> Laporan</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('login/logout') ?>" onclick="return confirm('Logout sistem?')"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php $this->load->view($content); ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>  
    <div id="wait" style="display:none;width:auto;height:89px;position:absolute;padding:2px;"><img src='<?php echo base_url() ?>asset/ring.gif'/></div>

    <!-- /#wrapper -->

    <!-- jQuery -->    
    <script src="<?php echo base_url()?>asset/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>    
    <script src="<?php echo base_url()?>asset/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>asset/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>asset/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>    
    <script src="<?php echo base_url() ?>asset/admin/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/vendor/metisMenu/metisMenu.min.js"></script>
    <script>
        // var table;     
        $(document).ajaxStart(function(){
            $("#wait").css("display", "block");
        });
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });   
        $('#notifications').slideDown('slow').delay(3000).slideUp('slow');          
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example2').DataTable();
            $('#mydata').DataTable();
        });
        $('.select2').select2();     
        $('#dp').datepicker({
            autoclose: true,
            format : 'yyyy-mm-dd'     
        });
        $('#dp1').datepicker({
            autoclose: true,
            format : 'yyyy-mm-dd'     
        })
        $('#dp2').datepicker({
            autoclose: true,
            format : 'yyyy-mm-dd'     
        })
        $('#dp3').datepicker({
            autoclose: true,
            format : 'yyyy-mm-dd'     
        })    

    </script>

</body>

</html>

    <!-- Metis Menu Plugin JavaScript -->
    <!-- Bootstrap Core JavaScript -->

    <!-- Morris Charts JavaScript -->
    <!-- <script src="<?php echo base_url() ?>asset/admin/vendor/raphael/raphael.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>asset/admin/vendor/morrisjs/morris.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>asset/admin/data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
