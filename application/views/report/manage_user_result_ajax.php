<div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
  <table class="table table-hover">
    <tr>
      <th>Emp ID / Name</th>
      <th>Designation/Email</th>
      <th>Leader/DIV/Team</th>
      <th>Template</th>
      <th>User Type</th>
      <th>Answered on</th>
      <th>Action</th>
    </tr>
    <?php $i=1; if(!empty($user_result)): foreach($user_result as $user_results): ?>
    <tr>
      <td>
        <span class="label label-success"><?php echo $user_results['ed_emp_id']; ?></span> <br><?php echo $user_results['ed_emp_name']; ?>
      </td>
      <td>
        <span class="label label-warning"><?php echo $user_results['ed_emp_desig']; ?></span> <br><?php echo $user_results['ed_emp_email']; ?>
      </td>
      <td>
        <span class="label label-info"><?php echo $user_results['ed_emp_leader']; ?></span> <br><?php echo $user_results['ed_emp_div']; ?> - <?php echo $user_results['ed_emp_team']; ?>
      </td>
      <td><?php echo $user_results['qt_name'] ?></td>
      <td>
        <?php echo $user_results['ed_emp_type']; ?>
      </td>
      <td><?php echo $user_results['qa_add_on'] ?></td>
      <td>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#" data-toggle="modal" data-target="#empAnswerModal" onclick="getEmpAnswers('<?php echo $this->Autoload_model->encrypt_decrypt('en',$user_results['ed_id']) ?>','<?php echo $user_results['ed_emp_type'] ?>')">View Answers</a></li>
            <li><a href="#" data-toggle="modal" data-target="#allowEditModal" onclick="allowEmpEditAns('<?php echo $this->Autoload_model->encrypt_decrypt('en',$user_results['ed_id']) ?>')">Allow Edit</a></li>
          </ul>
        </div> 
      </td>
    </tr>

    <?php $i++; endforeach; else: ?>
    <tr><td align="center" colspan="7"><p style="color: red;">No Results Available</p></td></tr>
    <?php endif; ?>
    
  </table>
</div>
<!-- /.box-body -->

<div class="box-footer clearfix">
  <!-- <ul class="pagination pagination-sm no-margin pull-right"> -->
     <?php echo $this->ajax_pagination->create_links(); ?>
  <!-- </ul> -->
</div>