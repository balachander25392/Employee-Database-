  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Question</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>/employee"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Questions</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
          <div class="col-xs-12">
            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Question Details</h3>
              </div>
              <!-- /.box-header -->
              <div id="questList">
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
                        <td><?php echo stripslashes($question['eq_question']) ?></td>
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
              </div>

            </div>
            <!-- /.box -->
          </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class="modal fade" id="DeleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url() ?>question/deleteQuestion">
        <input type="hidden" name="questionDeelteID" id="questionDeelteID">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"><p style="color: red;">Are you sure want to delete this question?</p></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>