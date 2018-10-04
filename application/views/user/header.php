<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BYD Employee Database</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo asset_url('css/_all-skins.min.css'); ?>">

  <!-- Date Picker -->
   <link rel="stylesheet" href="<?php echo asset_url('css/jquery.datetimepicker.css'); ?>">  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="<?php echo asset_url('css/google-font.css'); ?>">

  <style type="text/css">
    .error{
      color: red;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>EMPQ</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Questionnaire</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">      
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo asset_url('img/logo.jpg'); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata['user_logged_in']['ed_emp_name'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo asset_url('img/logo.jpg'); ?>" class="img-circle" alt="User Image">

                <p>
                  BYD Employee questionnaire
                  <small>since 2018</small>
                </p>
              </li>
            
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url() ?>user/changePassword" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url() ?>user/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  