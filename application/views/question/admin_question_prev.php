
<div class="box-body" id="">
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

            