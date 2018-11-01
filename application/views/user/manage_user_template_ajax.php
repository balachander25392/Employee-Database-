<div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
  <table class="table table-hover">
    <tr>
      <th><?= $language['user']['sl_no'] ?></th>
      <th><?= $language['user']['name'] ?></th>
      <th><?= $language['user']['desc'] ?></th>
      <th><?= $language['user']['temp_for'] ?></th>
      <th><?= $language['user']['adde_on'] ?></th>
      <th><?= $language['common']['acti'] ?></th>
    </tr>
    <?php $i=1; if(!empty($user_templ)): foreach($user_templ as $templates): ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo stripslashes($templates['qt_name']) ?></td>
        <td><?php echo $templates['qt_desc'] ?></td>
        <td><?php echo $templates['qt_templ_to'] ?></td>
        <td><?php echo $templates['qt_add_on'] ?></td>
        <td><!-- <a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>user/startQuestionnaire/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qt_id']) ?>">Take Questionnaire</a> -->
          <a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>user/showQuestions/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qt_id']) ?>"><?= $language['user']['take_ques'] ?></a>
        </td>
      </tr>
      <?php $i++; endforeach; else: ?>
      <tr><td align="center" colspan="7"><p style="color: red;"><?= $language['user']['no_temp_avai'] ?></p></td></tr>
      <?php endif; ?>
  </table>
</div>
<!-- /.box-body -->

<div class="box-footer clearfix">
  <!-- <ul class="pagination pagination-sm no-margin pull-right"> -->
     <?php echo $this->ajax_pagination->create_links(); ?>
  <!-- </ul> -->
</div>