  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?= $language['admin_tab']['edit_admi_user']; ?>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <?= $language['header']['home']; ?></a></li>
        <li><a href="<?php echo base_url() ?>admin"> <?= $language['admin_tab']['titl']; ?></a></li>
        <li class="active"><?= $language['admin_tab']['edit_admi_user']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <!-- left column -->
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= $language['admin_tab']['edit_admi_user']; ?></h3>
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url() ?>admin/updateAdmin" method="POST">
              <input type="hidden" name="admin_idd" value="<?php echo $admin_id; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1"><?= $language['admin_tab']['empl_id']; ?></label>
                  <input type="text" class="form-control" id="emp_id" name="emp_id" required="true" value="<?php echo $admin_detail['ea_emp_id'] ?>" placeholder="Enter Employee ID" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><?= $language['admin_tab']['name']; ?></label>
                  <input type="text" class="form-control" id="emp_name" name="emp_name" value="<?php echo $admin_detail['ea_name'] ?>" required="true" placeholder="Name" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><?= $language['admin_tab']['emai']; ?></label>
                  <input type="email" class="form-control" id="emp_email" name="emp_email" value="<?php echo $admin_detail['ea_email'] ?>" required="true" placeholder="Email" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><?= $language['admin_tab']['desi']; ?></label>
                  <input type="text" class="form-control" id="emp_desig" name="emp_desig" value="<?php echo $admin_detail['ea_designation'] ?>" placeholder="Designation" autocomplete="off">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?= $language['header']['subm']; ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->