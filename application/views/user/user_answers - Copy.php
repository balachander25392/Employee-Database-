  <style type="text/css">
    .del_option{
        color: red;
        font-style: italic;
        font-size: 10px;
    }
    .corr_ans{
      font-weight: bold;
      border-radius: 5px;
      position: relative;
      padding: 5px 5px;
      background: #d2d6de;
      border: 1px solid #d2d6de;
      color: #444;
      width: max-content;
    }

    .col-box-border {
      border: 1px solid #3c8dbc42 !important;
    }
    .col-box-bcolor {
      color: #fff !important;
      background: #3c8dbc73 !important;
      background-color: #3c8dbc99 !important;
    }
  </style>

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
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Questionnaire</h3>
              <a style="float: right;" href="<?php echo base_url() ?>user/editAnswer" class="btn btn-primary btn-xs">Edit Answers</a>
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body" id="">
                <?php $i=1; foreach($questions as $question){ ?>
                  <div class="row">
                   <div class="col-md-12">
                      <div class="box box-default collapsed-box box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title"><?php echo $i.') '.$question['eq_question'] ?></h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <?php if($question['eq_answer_type']=='text'){ ?>
                              <div class="col-md-12"><p><?php echo $question['qa_text_ans'] ?></p></div>

                              <?php } else {

                                $options = $this->User_model->getOptionsforAnswer($question['eq_id']);

                                foreach($options as $option){ 
                                  if($option['eqo_option_st']=='1'){
                                ?>
                                    <div class="col-md-12">
                                      <?php if(in_array($option['eqo_id'], explode(',', $question['qa_option_id']))) {  ?>
                                        <p class="corr_ans"><i class="fa fa-hand-o-right"></i> <?php echo $option['eqo_option'] ?></p>
                                      <?php } else  { ?>
                                        <p><i class="fa fa-long-arrow-right"></i> <?php echo $option['eqo_option'] ?></p>
                                      <?php } ?>
                                    </div>

                              <?php } else if($option['eqo_option_st']=='0' && in_array($option['eqo_id'], explode(',', $question['qa_option_id']))) { ?>
                                      <div class="col-md-12">
                                        <p class="corr_ans"><i class="fa fa-hand-o-right"></i> <?php echo $option['eqo_option'] ?><span class="del_option"> (This option is deleted)</span></p>
                                      </div>
                              <?php  } 
                                }

                               } ?>
                          
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                  </div>
                  <?php $i++; } ?>                    
              </div>
              <!-- /.box-body -->
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    
  </script>