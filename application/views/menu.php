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

        <li><a href="<?php echo base_url() ?>employee"><i class="fa fa-book"></i> <span>Manage Employee</span></a></li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Add Employee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>employee/addEmployee"><i class="fa fa-circle-o"></i> Single</a></li>
            <li><a href="<?php echo base_url() ?>employee/addEmpBulk"><i class="fa fa-circle-o"></i> Bulk</a></li>
          </ul>
        </li>
        <?php if($this->session->userdata['logged_in']['ea_role']=='1'){ ?>

        <li><a href="<?php echo base_url() ?>admin"><i class="fa fa-book"></i> <span>Manage Admin</span></a></li>

        <li><a href="<?php echo base_url() ?>admin/addAdmin"><i class="fa fa-book"></i> <span>Add Admin</span></a></li>
      <?php } ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>