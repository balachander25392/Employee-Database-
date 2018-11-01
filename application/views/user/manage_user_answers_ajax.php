<?php
  $ed_emp_type = $this->session->userdata['user_logged_in']['ed_emp_type'];

  if($ed_emp_type=='student'){
    $sel_user = $this->Autoload_model->getUserType('teacher');
  } else {
    $sel_user = $this->Autoload_model->getUserType('student');
  }
?>
<div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
  <table class="table table-hover">
    <tr>
      <th><?= $language['user']['sl_no'] ?></th>
      <th><?= $language['user']['temp'] ?></th>
      <th><?= $language['user']['desc'] ?></th>
      <th><?= $sel_user ?> <?= $language['user']['name'] ?></th>
      <th><?= $language['user']['answ_on'] ?></th>
      <th><?= $language['common']['acti'] ?></th>
    </tr>
    <?php $i=1; if(!empty($user_templ)): foreach($user_templ as $templates): ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo stripslashes($templates['qt_name']) ?></td>
        <td><?php echo $templates['qt_desc'] ?></td>
        <td><?php echo $templates['ed_emp_id'].' - '.$templates['ed_emp_name'] ?></td>
        <td><?php echo $templates['qa_add_on'] ?></td>
        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>user/viewAnswer/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qt_id']) ?>/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qa_ans_for_user']) ?>"><?= $language['user']['show_answ'] ?></a>
        </td>
      </tr>
      <?php $i++; endforeach; else: ?>
      <tr><td align="center" colspan="7"><p style="color: red;"><?= $language['user']['no_answ_avai'] ?></p></td></tr>
      <?php endif; ?>
  </table>
</div>
<!-- /.box-body -->

<div class="box-footer clearfix">
  <!-- <ul class="pagination pagination-sm no-margin pull-right"> -->
     <?php echo $this->ajax_pagination->create_links(); ?>
  <!-- </ul> -->
</div>