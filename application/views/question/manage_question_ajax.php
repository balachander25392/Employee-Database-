<div class="box-body table-responsive no-padding">
  <table class="table table-hover">
    <tr>
      <th>SL.No</th>
      <th>Question</th>
      <th>Question To</th>
      <th>Answer Type</th>
      <th>Action</th>
    </tr>
    <?php $i=1; if(!empty($questions)): foreach($questions as $question): ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $question['eq_question'] ?></td>
        <td><?php echo $question['eq_question_to'] ?></td>
        <td><?php echo $question['eq_answer_type'] ?></td>
        <td>
          <a href="<?php echo base_url() ?>question/editQuestion/<?php echo $this->Autoload_model->encrypt_decrypt('en',$question['eq_id']) ?>" class="btn btn-primary btn-sm">Edit</a>
          <button type="button" data-toggle="modal" data-target="#DeleteQuestionModal" onclick="setQuestionIdDelete('<?php echo $this->Autoload_model->encrypt_decrypt('en',$question['eq_id']) ?>')" class="btn btn-danger btn-sm">Delete</button>
        </td>
      </tr>
      <?php $i++; endforeach; else: ?>
      <tr><td align="center" colspan="7"><p style="color: red;">No Questions Available</p></td></tr>
      <?php endif; ?>
  </table>
</div>
<!-- /.box-body -->

<div class="box-footer clearfix">
  <!-- <ul class="pagination pagination-sm no-margin pull-right"> -->
     <?php echo $this->ajax_pagination->create_links(); ?>
  <!-- </ul> -->
</div>