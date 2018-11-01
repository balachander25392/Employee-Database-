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
            <i class="fa fa-cogs"></i> <span><?= $language['menu']['admi']; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>admin"><i class="fa fa-pencil-square-o"></i> <span><?= $language['menu']['mana_admi']; ?></span></a></li>
            <li><a href="<?php echo base_url() ?>admin/addAdmin"><i class="fa fa-plus-circle"></i> <span><?= $language['menu']['add_admi']; ?></span></a></li>
          </ul>
        </li>

      <?php } ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-id-badge"></i> <span><?= $language['menu']['empl']; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>employee"><i class="fa fa-pencil-square-o"></i> <span><?= $language['menu']['mana_empl']; ?></span></a></li>
            <li><a href="<?php echo base_url() ?>employee/addEmployee"><i class="fa fa-plus-circle"></i><?= $language['menu']['add_empl_sing']; ?></a></li>
            <li><a href="<?php echo base_url() ?>employee/addEmpBulk"><i class="fa fa-file-excel-o"></i><?= $language['menu']['add_empl_bulk']; ?></a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-question-circle-o"></i> <span><?= $language['menu']['ques_aire']; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>question/manageTemplate"><i class="fa fa-pencil-square-o"></i> <?= $language['menu']['mana_temp']; ?></a></li>
            <li><a href="<?php echo base_url() ?>question"><i class="fa fa-pencil-square-o"></i> <?= $language['menu']['mana_ques']; ?></a></li>
            <li><a href="<?php echo base_url() ?>question/addQuestion"><i class="fa fa-plus-circle"></i> <?= $language['menu']['add_ques']; ?></a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-line-chart"></i> <span><?= $language['menu']['repo']; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>report/userReport"><i class="fa fa-users"></i> <?= $language['menu']['empl_repo']; ?></a></li>
            <li><a href="<?php echo base_url() ?>report/questionReport"><i class="fa fa-users"></i> <?= $language['menu']['ques_repo']; ?></a></li>
            <li><a href="<?php echo base_url() ?>report/userFeedback"><i class="fa fa-users"></i> <?= $language['menu']['feed_repo']; ?></a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>