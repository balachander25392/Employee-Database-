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
          <p>BYD <?php if($this->session->userdata['logged_in']['ea_role']=='1'){ echo ' Super '; } ?> Admin</p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">MAIN NAVIGATION</li> -->

        <?php if($this->session->userdata['logged_in']['ea_role']=='1'){ ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Admin</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>admin"><i class="fa fa-pencil-square-o"></i> <span>Manage Admin</span></a></li>
            <li><a href="<?php echo base_url() ?>admin/addAdmin"><i class="fa fa-plus-circle"></i> <span>Add Admin</span></a></li>
          </ul>
        </li>

      <?php } ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-id-badge"></i> <span>Employee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>employee"><i class="fa fa-pencil-square-o"></i> <span>Manage Employee</span></a></li>
            <li><a href="<?php echo base_url() ?>employee/addEmployee"><i class="fa fa-plus-circle"></i>Add Employee Single</a></li>
            <li><a href="<?php echo base_url() ?>employee/addEmpBulk"><i class="fa fa-file-excel-o"></i>Add Employee Bulk</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-question-circle-o"></i> <span>Questionnaire</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>question/manageTemplate"><i class="fa fa-pencil-square-o"></i> Manage Template</a></li>
            <li><a href="<?php echo base_url() ?>question"><i class="fa fa-pencil-square-o"></i> Manage Questions</a></li>
            <li><a href="<?php echo base_url() ?>question/addQuestion"><i class="fa fa-plus-circle"></i> Add Question</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-line-chart"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>report/userReport"><i class="fa fa-users"></i> User Report</a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>