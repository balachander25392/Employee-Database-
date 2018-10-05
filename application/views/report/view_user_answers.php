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
  <?php $answer_json = json_decode($answer['qa_emp_ans'],true); ?>
  <?php $i=1; foreach($questions as $question){ ?>
    <div class="row">
     <div class="col-md-12">
        <div class="box box-default box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo $i.') '.$question['eq_question'] ?></h3>

            <!-- <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div> -->
            <!-- /.box-tools -->
          </div>

          <!-- /.box-header -->
          <div class="box-body">

            <?php if($question['eq_answer_type']=='text'){ ?>
                <div class="col-md-12">
                  <p>
                    <?php
                      if(array_key_exists($question['eq_id'], $answer_json)){
                        echo $answer_json[$question['eq_id']];
                      }
                    ?>
                  </p>
                </div>

            <?php } else {
                  if(array_key_exists($question['eq_id'], $answer_json)) {
                  $options = $this->Report_model->getOptionsforAnswer($question['eq_id']);
                  foreach($options as $option){ 
                    if($option['eqo_option_st']=='1'){
                  ?>
                      <div class="col-md-12">
                        <?php 

                          if(in_array($option['eqo_id'], explode(',', $answer_json[$question['eq_id']]))) {  ?>
                          <p class="corr_ans"><i class="fa fa-hand-o-right"></i> <?php echo $option['eqo_option'] ?></p>
                        <?php } else  { ?>
                          <p><i class="fa fa-long-arrow-right"></i> <?php echo $option['eqo_option'] ?></p>
                        <?php } ?>
                      </div>

                <?php } else if($option['eqo_option_st']=='0' && in_array($option['eqo_id'], explode(',', $answer_json[$question['eq_id']]))) { ?>
                        <div class="col-md-12">
                          <p class="corr_ans"><i class="fa fa-hand-o-right"></i> <?php echo $option['eqo_option'] ?><span class="del_option"> (This option is deleted)</span></p>
                        </div>
                <?php  } 
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
