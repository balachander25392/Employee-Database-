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

                      <?php if (array_key_exists($question['eq_id'],$quest_id)) { ?> 

                        <a data-toggle="modal" data-target="#loadQstnTextAnsModal" onclick="loadQstnTextAns('<?php echo $question['eq_id'] ?>','<?php echo $question['eq_templ_id'] ?>')" href="#"><?= count($quest_id[$question['eq_id']]); ?> Answers</a>

                      <?php } ?>

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
