<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() ?>asset/favicon.ico">
    
    <title>Login Rumah Garskin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url() ?>asset/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <?php echo form_open('login/submit', array('class' => 'form-signin')); ?>
      <img class="mb-4" src="<?php echo base_url() ?>asset/favicon.ico" alt="" width="72" height="72">
      <h1 class="h4 mb-3 font-weight-normal">Rumah Garskin Inventory</h1>
      <?php echo $this->session->flashdata('msg'); ?>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      <p class="mt-5 mb-3 text-muted">&copy; #AnotherNakaProject 2018</p>
    <?php echo form_close(); ?>
  </body>
</html>
