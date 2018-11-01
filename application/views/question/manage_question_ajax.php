<div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
  <table class="table table-hover">
    <tr>
      <th><?= $language['question_tab']['sl_no'] ?></th>
      <th><?= $language['question_tab']['ques'] ?></th>
      <th><?= $language['question_tab']['answ_type'] ?></th>
      <th><?= $language['question_tab']['temp'] ?></th>
      <th><?= $language['question_tab']['temp_to'] ?></th>
      <th><?= $language['common']['acti'] ?></th>
    </tr>
    <?php $i=1; if(!empty($questions)): foreach($questions as $question): ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo stripslashes($question['eq_question']) ?></td>
        <td><?php echo $this->Autoload_model->getAnswerType($question['eq_answer_type']); ?></td>
        <td><?php echo $question['qt_name'] ?></td>
        <td><?php echo $question['qt_templ_to'] ?></td>
        <td>
          <a href="<?php echo base_url() ?>question/editQuestion/<?php echo $this->Autoload_model->encrypt_decrypt('en',$question['eq_id']) ?>" class="btn btn-primary btn-sm"><?= $language['common']['edit'] ?></a>
          <button type="button" data-toggle="modal" data-target="#DeleteQuestionModal" onclick="setQuestionIdDelete('<?php echo $this->Autoload_model->encrypt_decrypt('en',$question['eq_id']) ?>')" class="btn btn-danger btn-sm"><?= $language['common']['dele'] ?></button>
        </td>
      </tr>
      <?php $i++; endforeach; else: ?>
      <tr><td align="center" colspan="7"><p style="color: red;"><?= $language['question_tab']['no_ques_avai'] ?></p></td></tr>
      <?php endif; ?>
  </table>
</div>
<!-- /.box-body -->

<div class="box-footer clearfix">
     <?php echo $this->ajax_pagination->create_links(); ?>
</div>