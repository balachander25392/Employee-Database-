<div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
  <table class="table table-hover">
    <tr>
      <th><?= $language['emp_tab']['empl_id_name'] ?></th>
      <th><?= $language['emp_tab']['desi_emai'] ?></th>
      <!-- <th>Leader/DIV/Team</th> -->
      <th><?= $language['question_tab']['temp'] ?></th>
      <th><?= $language['report']['user_type'] ?></th>
      <th><?= $language['report']['answ_for'] ?></th>                      
      <th><?= $language['report']['answ_on'] ?></th>
      <th><?= $language['common']['acti'] ?></th>
    </tr>
    <?php $i=1; if(!empty($user_result)): foreach($user_result as $user_results): ?>
    <tr>
      <td>
        <span class="label label-success"><?php echo $user_results['ed_emp_id']; ?></span> <br><?php echo $user_results['ed_emp_name']; ?>
      </td>
      <td>
        <span class="label label-warning"><?php echo $user_results['ed_emp_desig']; ?></span> <br><?php echo $user_results['ed_emp_email']; ?>
      </td>
      <!-- <td>
        <span class="label label-info"><?php echo $user_results['ed_emp_leader']; ?></span> <br><?php echo $user_results['ed_emp_div']; ?> - <?php echo $user_results['ed_emp_team']; ?>
      </td> -->
      <td><?php echo $user_results['qt_name'] ?></td>  
      <td>
        <?php echo $this->Autoload_model->getUserType($user_results['ed_emp_type']); ?>
      </td>  
      <td><?php echo $user_results['ans_for_user_empid'].' - '.$user_results['ans_for_user_name'] ?></td>                   
      <td><?php echo $user_results['qa_add_on'] ?></td>
      <td>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?= $language['common']['acti'] ?>
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#" data-toggle="modal" data-target="#empAnswerModal" onclick="getEmpAnswers('<?php echo $this->Autoload_model->encrypt_decrypt('en',$user_results['ed_id']) ?>','<?php echo $this->Autoload_model->encrypt_decrypt('en',$user_results['qt_id']) ?>','<?php echo $this->Autoload_model->encrypt_decrypt('en',$user_results['qa_ans_for_user']) ?>')"><?= $language['report']['view_answ'] ?></a></li>
            <li><a href="#" data-toggle="modal" data-target="#allowEditModal" onclick="allowEmpEditAns('<?php echo $this->Autoload_model->encrypt_decrypt('en',$user_results['qa_id']) ?>')"><?= $language['report']['allo_edit'] ?></a></li>
          </ul>
        </div> 
      </td>
    </tr>

    <?php $i++; endforeach; else: ?>
    <tr><td align="center" colspan="7"><p style="color: red;"><?= $language['report']['no_resu_avai'] ?></p></td></tr>
    <?php endif; ?>
    
  </table>
</div>
<!-- /.box-body -->

<div class="box-footer clearfix">
  <!-- <ul class="pagination pagination-sm no-margin pull-right"> -->
     <?php echo $this->ajax_pagination->create_links(); ?>
  <!-- </ul> -->
</div>