  <style type="text/css">
    .chosen-container{
      width: 70% !important;
    }
  </style>

  <?php
    $ed_emp_type = $this->session->userdata['user_logged_in']['ed_emp_type'];

    if($ed_emp_type=='student'){
      $sel_user = 'Teacher';
    } else {
      $sel_user = 'Student';
    }
  ?>
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
            <form role="form" name="question_form" id="question_form" enctype="multipart/form-data" action="<?php echo base_url() ?>user/saveAnswer" method="POST">
              <input type="hidden" name="templ_id" id="templ_id" value="<?php echo $templ_id; ?>">
              <div class="box-body" id="">

                <div class="form-group">  
                  <label for="exampleInputPassword1">Select your <?= $sel_user ?> </label>
                  <select name="ans_for_usr" id="ans_for_usr" class="form-control" required="">
                    <option value="">--Select--</option>
                    <?php foreach($user_details as $user_detail){ ?>
                      <option value="<?= $user_detail['ed_id'] ?>"><?= $user_detail['ed_emp_id'].'-'.$user_detail['ed_emp_name'] ?></option>
                    <?php } ?>  
                  </select>
                  <p id="ans_for_usr_error" style="color: red;display: none;">Please choose your <?= $sel_user ?></p>
                </div>

                <?php $i=1; if($questions){ foreach($questions as $question){ ?>

                  <input type="hidden" name="name_ref[]" value="<?php echo $question['eq_answer_type'].$question['eq_id']; ?>">
                  <input type="hidden" name="quest_id[]" value="<?php echo $question['eq_id']; ?>">
                  <input type="hidden" name="ans_type[]" value="<?php echo $question['eq_answer_type']; ?>">

                  <div class="form-group">
                    <label for="exampleInputPassword1"><?php echo $i.') '.$question['eq_question'] ?></label>
                    <?php if($question['eq_answer_type']=='text'){ ?>
                      
                    <input type="text" class="form-control" name="qstn_text<?php echo $question['eq_id'] ?>" value="" required="" autocomplete="off">
                    <?php } else { 

                      $options = $this->User_model->getOptionsforQuestion($question['eq_id']);

                      foreach($options as $option){ 

                        if($question['eq_answer_type']=='radio'){ ?>
                          <div class="radio">
                            <label>
                              <input type="radio" name="qstn_radio<?php echo $question['eq_id'] ?>" required="" value="<?php echo $option['eqo_id'] ?>"><?php echo $option['eqo_option'] ?>
                            </label>
                          </div>

                      <?php } else { ?>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="req_question" name="qstn_check<?php echo $question['eq_id'] ?>[]" value="<?php echo $option['eqo_id'] ?>"><?php echo $option['eqo_option'] ?>
                            </label>
                          </div>

                      <?php }

                      }

                     } ?>
                  </div>
                <?php $i++; } } ?>
                    
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