  <style type="text/css"></style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee
        <small>Questionnaire</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Questionnaire</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <!-- left column -->
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Questionnaire</h3>
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" name="question_form" id="question_form" action="<?php echo base_url() ?>user/updateAnswer" method="POST">
              <div class="box-body" id="">
                <?php $answer_json = json_decode($answer['qa_emp_ans'],true); ?>
                <?php $i=1; foreach($questions as $question){ ?>

                  <input type="hidden" name="name_ref[]" value="<?php echo $question['eq_answer_type'].$question['eq_id']; ?>">
                  <input type="hidden" name="quest_id[]" value="<?php echo $question['eq_id']; ?>">
                  <input type="hidden" name="ans_type[]" value="<?php echo $question['eq_answer_type']; ?>">

                  <div class="form-group">
                    <label for="exampleInputPassword1"><?php echo $i.') '.$question['eq_question'] ?></label>
                    <?php if($question['eq_answer_type']=='text'){ ?>
                      
                    <input type="text" class="form-control" name="qstn_text<?php echo $question['eq_id'] ?>" value="<?php echo @$answer_json[$question['eq_id']] ?>" required="" autocomplete="off">
                    <?php } else { 

                      $options = $this->User_model->getOptionsforQuestion($question['eq_id']);

                      foreach($options as $option){ 

                        if($question['eq_answer_type']=='radio'){ ?>
                          <div class="radio">
                            <label>
                              <input type="radio" name="qstn_radio<?php echo $question['eq_id'] ?>" required="" value="<?php echo $option['eqo_id'] ?>" <?php if($option['eqo_id'] == @$answer_json[$question['eq_id']]) { echo 'checked'; }?>><?php echo $option['eqo_option'] ?>
                            </label>
                          </div>

                      <?php } else { ?>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="req_question" name="qstn_check<?php echo $question['eq_id'] ?>[]" value="<?php echo $option['eqo_id'] ?>" <?php if(in_array($option['eqo_id'], @explode(',', $answer_json[$question['eq_id']]))) { echo 'checked'; }?>><?php echo $option['eqo_option'] ?>
                            </label>
                          </div>

                      <?php }

                      }

                     } ?>
                  </div>
                <?php $i++; } ?>
                    
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    
  </script>