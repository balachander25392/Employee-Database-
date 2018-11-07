  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $language['admin_tab']['titl']; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <?= $language['header']['home']; ?></a></li>
        <li class="active"><?= $language['admin_tab']['titl']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
          <div class="col-xs-12">
            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"><?= $language['admin_tab']['user_deta']; ?></h3>

                <div class="box-tools col-xs-4">
                  <div class="input-group input-group-sm">
                    <input type="text" name="adminemp_tab_ssearch" id="adminemp_tab_ssearch" onkeyup="adminEmpSearchPage()" class="form-control pull-right" placeholder="<?= $language['header']['sear']; ?>">

                    <div class="input-group-btn">
                      <button type="submit" onclick="adminEmpSearchPage()" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.box-header -->
              <div id="adminList">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th><?= $language['admin_tab']['sl_no']; ?></th>
                      <th><?= $language['admin_tab']['empl_id']; ?></th>
                      <th><?= $language['admin_tab']['name']; ?></th>
                      <th><?= $language['admin_tab']['emai']; ?></th>
                      <th><?= $language['admin_tab']['desi']; ?></th>
                      <th><?= $language['admin_tab']['adde_on']; ?></th>
                      <th><?= $language['admin_tab']['acti']; ?></th>
                    </tr>
                    <?php $i=1; if(!empty($admins)): foreach($admins as $aduser): ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $aduser['ea_emp_id'] ?></td>
                        <td><?php echo $aduser['ea_name'] ?></td>
                        <td><?php echo $aduser['ea_email'] ?></td>
                        <td><?php echo $aduser['ea_designation'] ?></td>
                        <td><?php echo $aduser['ea_added_on'] ?></td>
                        <td>
                          <a href="<?php echo base_url() ?>admin/editAdmin/<?php echo $this->Autoload_model->encrypt_decrypt('en',$aduser['ea_id']) ?>" class="btn btn-primary btn-sm"><?= $language['admin_tab']['edit']; ?></a>
                          <button type="button" data-toggle="modal" data-target="#ResetPasswordModal" class="btn btn-info btn-sm" onclick="setAdminIdPassReset('<?php echo $this->Autoload_model->encrypt_decrypt('en',$aduser['ea_id']) ?>')"><?= $language['admin_tab']['rese_pass']; ?></button>
                          <button type="button" data-toggle="modal" data-target="#DeleteAdminModal" onclick="setAdminIdDelete('<?php echo $this->Autoload_model->encrypt_decrypt('en',$aduser['ea_id']) ?>')" class="btn btn-danger btn-sm"><?= $language['admin_tab']['dele']; ?></button>

                          <!-- <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="<?php echo base_url() ?>admin/editAdmin/<?php echo $this->Autoload_model->encrypt_decrypt('en',$aduser['ea_id']) ?>">Edit</a></li>
                              <li><a href="#" data-toggle="modal" data-target="#ResetPasswordModal" onclick="setAdminIdPassReset('<?php echo $this->Autoload_model->encrypt_decrypt('en',$aduser['ea_id']) ?>')">Reset Password</a></li>
                              <li><a href="#" data-toggle="modal" data-target="#DeleteAdminModal" onclick="setAdminIdDelete('<?php echo $this->Autoload_model->encrypt_decrypt('en',$aduser['ea_id']) ?>')">Delete</a></li>
                            </ul>
                          </div> -->

                        </td>
                      </tr>
                      <?php $i++; endforeach; else: ?>
                      <tr><td align="center" colspan="7"><p style="color: red;"><?= $language['admin_tab']['no_user']; ?></p></td></tr>
                      <?php endif; ?>
                  </table>
                </div>
                <!-- /.box-body -->
               
                <div class="box-footer clearfix">
                  <!-- <ul class="pagination pagination-sm no-margin pull-right"> -->
                     <?php echo $this->ajax_pagination->create_links(); ?>
                  <!-- </ul> -->
                </div>
              </div>

            </div>
            <!-- /.box -->
          </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<div class="modal fade" id="ResetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url() ?>admin/resetPassword">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLabel"><?= $language['admin_tab']['rese_user_pass']; ?></h5>
        </div>
        <div class="modal-body">
          <!-- <div class="box-body"> -->
            <input type="hidden" name="adminUserPassResetID" id="adminUserPassResetID">
            <!-- <div class="form-group">
              <label for="exampleInputEmail1"><?= $language['admin_tab']['new_pass']; ?></label>
              <input type="password" class="form-control" id="admin_new_pass" name="admin_new_pass" required="true" placeholder="Enter New Password" autocomplete="off" style="width: 37%;">
            </div> -->
          <p style="color: red;"><?= $language['admin_tab']['pass_rese_aler'] ?>.</p>  
          <!-- </div> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language['header']['clos']; ?></button>
          <button type="submit" class="btn btn-primary"><?= $language['header']['save_chang']; ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="DeleteAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url() ?>admin/deleteAdmin">
        <input type="hidden" name="adminUserDeelteID" id="adminUserDeelteID">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $language['admin_tab']['dele_user_acco']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"><p style="color: red;"><?= $language['admin_tab']['dele_user_aler']; ?>?</p></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language['header']['clos']; ?></button>
          <button type="submit" class="btn btn-primary"><?= $language['header']['dele']; ?></button>
        </div>
      </form>
    </div>
  </div>
</div>