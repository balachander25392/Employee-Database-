<div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
  <table class="table table-hover">
    <tr>
      <th>Emp ID / Name</th>
      <th>Designation/Email</th>
      <th>Leader/DIV/Team</th>
      <th>DOB / DOJ</th>
      <th>Added On</th>
      <th>Action</th>
    </tr>
    <?php $i=1; if(!empty($emps)): foreach($emps as $emp_detail): ?>
    <tr>
      <td>
        <span class="label label-success"><?php echo $emp_detail['ed_emp_id']; ?></span> <br><?php echo $emp_detail['ed_emp_name']; ?>
      </td>
      <td>
        <span class="label label-warning"><?php echo $emp_detail['ed_emp_desig']; ?></span> <br><?php echo $emp_detail['ed_emp_email']; ?>
      </td>
      <td>
        <span class="label label-info"><?php echo $emp_detail['ed_emp_leader']; ?></span> <br><?php echo $emp_detail['ed_emp_div']; ?> - <?php echo $emp_detail['ed_emp_team']; ?>
      </td>
      <td>
        <?php echo $emp_detail['ed_emp_dob']; ?><br><?php echo $emp_detail['ed_emp_doj']; ?>
      </td>
      <td>
        <?php echo $emp_detail['ed_emp_add_on']; ?><br> <font style="font-style: italic;"> by <?php echo $emp_detail['ea_name']; ?> </font> 
      </td>
      <td>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url() ?>employee/editEmployee/<?php echo $this->Autoload_model->encrypt_decrypt('en',$emp_detail['ed_id']) ?>">Edit</a></li>
            <li><a href="#" data-toggle="modal" data-target="#ResetEmpPasswordModal" onclick="setEmpIdPassReset('<?php echo $this->Autoload_model->encrypt_decrypt('en',$emp_detail['ed_id']) ?>')">Reset Password</a></li>
            <li><a href="#" data-toggle="modal" data-target="#DeleteEmpModal" onclick="setEmpIdDelete('<?php echo $this->Autoload_model->encrypt_decrypt('en',$emp_detail['ed_id']) ?>')">Delete</a></li>
          </ul>
        </div>
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