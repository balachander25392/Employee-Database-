  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Question
        <small>Report</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>employee"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Questionnaire Report</li>
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
                      <label for="exampleInputPassword1">Search by Template</label>
                      <select name="qstn_reprt_tmpl_srch" id="qstn_reprt_tmpl_srch" class="form-control" onchange="questionResultPage()">
                        <option value="">All</option>
                        <?php foreach($template as $templates){ ?>
                        <option value="<?php echo $templates['qt_id'] ?>"><?php echo $templates['qt_name'] ?></option>  
                        <?php } ?> 
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6"></div>

                  <div class="col-md-2">
                    <form method="POST" action="<?php echo base_url() ?>report/exportQuestionRprt">
                      <input type="hidden" name="qstn_templ_expt_id" id="qstn_templ_expt_id">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Download</label>
                        <button type="submit" class="btn btn-primary btn-sm">Export to Excel</button>
                      </div>
                    </form>
                  </div>
                
                </div>

                </div>
              <!-- </div>  -->
              <!-- /.box-header -->
              <!-- <div class="col-md-2"></div> -->
              <div id="questionReport">
                





                <div class="box-body" id="">
                <?php 
                  //print_r($answers); 
                  $quest_ids = array();
                  $quest_id  = array();
                  foreach($answers as $answer){

                    $answer_json = json_decode($answer['qa_emp_ans']);
                    foreach($answer_json as $qstn_ID => $qstn_txt){
                      
                      if(!in_array($qstn_ID, $quest_ids)){
                        $quest_id[$qstn_ID] = array();
                        array_push($quest_ids,$qstn_ID);
                      }
                      array_push($quest_id[$qstn_ID],$qstn_txt);
                    }
                  }

                  //print_r($quest_id);

                ?>
                <?php $i=1; foreach($questions as $question){ ?>
                  <div class="row">
                   <div class="col-md-12">
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title"><?php echo $i.') '.$question['eq_question'] ?></h3>
                        </div>

                        <div class="box-body">

                          <?php if($question['eq_answer_type']=='text'){ ?>
                              <div class="col-md-12">
                                <p>
                                  <?php if (array_key_exists($question['eq_id'],$quest_id)) { ?> 

                                    <a data-toggle="modal" data-target="#loadQstnTextAnsModal" onclick="loadQstnTextAns('<?php echo $question['eq_id'] ?>','<?php echo $question['eq_templ_id'] ?>')" href="#"><?= count($quest_id[$question['eq_id']]);  ?> Answers</a>

                                  <?php } ?>
                                </p>
                              </div>

                          <?php } else {

                                $options = $this->User_model->getOptionsforAnswer($question['eq_id']);
                                
                                $option_ids = '';
                                $option_arr = array();

                                if (array_key_exists($question['eq_id'],$quest_id)) {

                                    $option_ids = implode(',', $quest_id[$question['eq_id']]);
                                }

                                $option_arr = explode(',', $option_ids);
                                $opti_count = array_count_values($option_arr);
                                        
                                foreach($options as $option){ 
                                  if($option['eqo_option_st']=='1'){
                                ?>
                                    <div class="col-md-12">
                                        <p class=""><i class="fa fa-long-arrow-right"></i> <?php echo $option['eqo_option'] ?> ( <?php echo (@$opti_count[$option['eqo_id']]) ? $opti_count[$option['eqo_id']] : '0';?> ) </p>
                                    </div>

                              <?php 

                                }
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



              </div>

            </div>
            <!-- /.box -->
          </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class="modal fade" id="loadQstnTextAnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <!-- <h5 class="modal-title" id="exampleModalLabel">Employee Answers</h5> -->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="" id="QstnTextAns">


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

