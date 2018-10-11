  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo asset_url('img/logo.jpg'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>BYD questionnaire</p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i></a> -->
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">MAIN NAVIGATION</li> -->
        <li><a href="<?php echo base_url() ?>user"><i class="fa fa-home"></i> <span>Home</span></a></li>

        <li><a href="<?php echo base_url() ?>user/availableQuestions"><i class="fa fa-binoculars"></i> <span>Available Questionnaire</span></a></li>

        <li><a href="<?php echo base_url() ?>user/userAnswerManage"><i class="fa fa-binoculars"></i> <span>Manage Answers</span></a></li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>