  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $language['user']['chan_pass'] ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>welcome"><i class="fa fa-dashboard"></i> <?= $language['common']['home'] ?></a></li>
        <li class="active"><?= $language['user']['chan_pass'] ?></li>
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
              <h3 class="box-title"><?= $language['user']['chan_pass'] ?></h3>
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" data-toggle="validator" action="<?php echo base_url() ?>admin/updatePassword" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1"><?= $language['user']['curr_pass'] ?></label>
                  <input type="password" class="form-control" id="curr_pass" name="curr_pass" required="true" placeholder="Enter Current Password" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><?= $language['user']['new_pass'] ?></label>
                  <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="New Password" required="true"  autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><?= $language['user']['conf_new_pass'] ?></label>
                  <input type="password" class="form-control" id="conf_new_pass" name="conf_new_pass" data-match="#new_pass" data-match-error="<?= $language['user']['pass_not_matc'] ?>" required="true" placeholder="Confirm new password" autocomplete="off">
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?= $language['common']['subm'] ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->