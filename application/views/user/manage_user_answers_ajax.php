<?php
    $ed_emp_type = $this->session->userdata['user_logged_in']['ed_emp_type'];

    if($ed_emp_type=='student'){
      $sel_user = 'Teacher';
    } else {
      $sel_user = 'Student';
    }
  ?>
<div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
  <table class="table table-hover">
    <tr>
      <th>SL.No</th>
      <th>Template</th>
      <th>Description</th>
      <th><?= $sel_user ?> Name</th>
      <th>Answered On</th>
      <th>Action</th>
    </tr>
    <?php $i=1; if(!empty($user_templ)): foreach($user_templ as $templates): ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo stripslashes($templates['qt_name']) ?></td>
        <td><?php echo $templates['qt_desc'] ?></td>
        <td><?php echo $templates['ed_emp_id'].' - '.$templates['ed_emp_name'] ?></td>
        <td><?php echo $templates['qa_add_on'] ?></td>
        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>user/viewAnswer/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qt_id']) ?>/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qa_ans_for_user']) ?>">Show Answers</a>
        </td>
      </tr>
      <?php $i++; endforeach; else: ?>
      <tr><td align="center" colspan="7"><p style="color: red;">No Answers Available</p></td></tr>
      <?php endif; ?>
  </table>
</div>
<!-- /.box-body -->

<div class="box-footer clearfix">
  <!-- <ul class="pagination pagination-sm no-margin pull-right"> -->
     <?php echo $this->ajax_pagination->create_links(); ?>
  <!-- </ul> -->
</div>