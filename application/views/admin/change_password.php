  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change
        <small>Password</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Password</li>
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
              <h3 class="box-title">Change Password</h3>
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" data-toggle="validator" action="<?php echo base_url() ?>admin/updatePassword" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Current Password</label>
                  <input type="password" class="form-control" id="curr_pass" name="curr_pass" required="true" placeholder="Enter Current Password" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">New Password</label>
                  <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="New Password" required="true"  autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm New Password</label>
                  <input type="password" class="form-control" id="conf_new_pass" name="conf_new_pass" data-match="#new_pass" data-match-error="Password Doesnot match" required="true" placeholder="Confirm new password" autocomplete="off">
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->