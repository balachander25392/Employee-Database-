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