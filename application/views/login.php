<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BYD | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo asset_url('css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo asset_url('css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo asset_url('css/ionicons.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo asset_url('css/AdminLTE.min.css'); ?>">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="<?php echo asset_url('css/google-font.css'); ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?= $language['header']['admi_logi_titl'] ?></b></a>
  </div>

  <?php if($this->session->flashdata('message_failed')) { ?>
  <div class="alert alert-danger alert-dismissible">
  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Failed!</strong> <?php echo $this->session->flashdata('message_failed') ?>.
  </div>
  <?php } ?>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?= $language['header']['sign_in_to_mana'] ?></p>

    <form action="<?php echo base_url() ?>welcome/signin" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="emp_id" id="emp_id" required="true" class="form-control" placeholder="<?= $language['header']['empl_id'] ?>" autocomplete="off">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" required="true" class="form-control" placeholder="<?= $language['header']['pass'] ?>" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?= $language['header']['sign_in'] ?></button>
        </div>
        <div class="col-xs-2"></div>
        <div class="col-xs-6">
          <a href="<?php echo base_url() ?>user"><?= $language['header']['sign_in_as_empl'] ?></a>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo asset_url('js/jquery.min.js'); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo asset_url('js/bootstrap.min.js'); ?>"></script>

</body>
</html>
