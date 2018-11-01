  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $language['question_tab']['mana_ques'] ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>/employee"><i class="fa fa-dashboard"></i> <?= $language['common']['home'] ?></a></li>
        <li class="active"><?= $language['question_tab']['mana_ques'] ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
          <div class="col-xs-12">
            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <div class="box">

            <!-- <div class="box-header"> -->
              <div class="col-md-12">
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?= $language['question_tab']['sear_by_temp'] ?></label>
                      <select name="qstn_tmpl_srch" id="qstn_tmpl_srch" class="form-control" onchange="manageQuestionPage()">
                        <option value="">All</option>
                        <?php foreach($template as $templates){ ?>
                        <option value="<?php echo $templates['qt_id'] ?>"><?php echo $templates['qt_name'] ?></option>  
                        <?php } ?> 
                      </select>
                    </div>
                  </div>

                  <div class="col-xs-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?= $language['question_tab']['sear_by_ques'] ?></label>
                      <div class="input-group">
                        <input type="text" name="qstn_templ_key" id="qstn_templ_key" onkeyup="manageQuestionPage()" class="form-control pull-right" placeholder="<?= $language['question_tab']['ques'] ?>">

                        <div class="input-group-btn">
                          <button type="submit" onclick="manageQuestionPage()" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>  
                    </div>
                    </div>
                  </div>
                </div>
            <!-- </div>  -->
              <!-- /.box-header -->
              <div id="questList"> 
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLabel"><?= $language['question_tab']['dele_ques'] ?></h5>
        </div>
        <div class="modal-body"><p style="color: red;"><?= $language['question_tab']['dele_ques_aler'] ?></p></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language['common']['clos'] ?></button>
          <button type="submit" class="btn btn-primary"><?= $language['common']['dele'] ?></button>
        </div>
      </form>
    </div>
  </div>
</div>