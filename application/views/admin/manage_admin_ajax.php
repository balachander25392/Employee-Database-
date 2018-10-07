<div class="box-body table-responsive no-padding">
  <table class="table table-hover">
    <tr>
      <th>SL.No</th>
      <th>Emp ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Designation</th>
      <th>Added On</th>
      <th>Action</th>
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
          <a href="<?php echo base_url() ?>admin/editAdmin/<?php echo $this->Autoload_model->encrypt_decrypt('en',$aduser['ea_id']) ?>" class="btn btn-primary btn-sm">Edit</a>
          <button type="button" data-toggle="modal" data-target="#ResetPasswordModal" class="btn btn-info btn-sm" onclick="setAdminIdPassReset('<?php echo $this->Autoload_model->encrypt_decrypt('en',$aduser['ea_id']) ?>')">Reset Password</button>
          <button type="button" data-toggle="modal" data-target="#DeleteAdminModal" onclick="setAdminIdDelete('<?php echo $this->Autoload_model->encrypt_decrypt('en',$aduser['ea_id']) ?>')" class="btn btn-danger btn-sm">Delete</button>
        </td>
      </tr>
      <?php $i++; endforeach; else: ?>
      <tr><td align="center" colspan="7"><p style="color: red;">No User Available</p></td></tr>
      <?php endif; ?>
  </table>
</div>
<!-- /.box-body -->
<div class="box-footer clearfix">
  <!-- <ul class="pagination pagination-sm no-margin pull-right"> -->
     <?php echo $this->ajax_pagination->create_links(); ?>
  <!-- </ul> -->
</div>