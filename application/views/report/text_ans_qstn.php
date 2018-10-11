<div class="col-md-12">
<style type="text/css">
  .pop-ans{
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 3px;
    margin-top: 0;
    background: #f7f7f7;
    color: #444;
    padding: 0;
  }  
</style>

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

<?php if (array_key_exists($qstn_id_req,$quest_id)) {

 //echo implode('<br>', $quest_id[$qstn_id_req]);

 foreach($quest_id[$qstn_id_req] as $ans_text){ ?>

  <div class="col-md-12" style="padding: 10px;">
    <div class="pop-ans">
      <div class="box-body">
        <?= $ans_text ?>
      </div>
    </div>
  </div>


<?php }

 } ?>
</div>