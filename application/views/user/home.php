  <style type="text/css">
    .nav-right{
      float: right;
    }
    .head-img {
      width: 30%;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
    .body-img {
      width: 100%;
    }
  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?= $language['common']['home'] ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-1"></div>
        <div class="col-md-10">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Welcome <?php echo $this->session->userdata['user_logged_in']['ed_emp_name'] ?> !</h3>
              <a class="nav-right btn btn-primary btn-xs" href="<?php echo base_url() ?>user/availableQuestions"><?= $language['user']['view_avai_ques'] ?></a>
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body" >
                <div class="col-md-12">
                  <img class="head-img" src="<?php echo base_url() ?>assets/img/logo_BYD.PNG"> 
                </div>

                <div class="col-md-12">
                  <img class="body-img" src="<?php echo base_url() ?>assets/img/vehicle-2.jpg"> 
                </div>
                            
              </div>
              <!-- /.box-body -->
          </div>

            
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->