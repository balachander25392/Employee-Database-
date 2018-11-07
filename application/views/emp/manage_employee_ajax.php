<div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
  <table class="table table-hover">
    <tr>
      <th><?= $language['emp_tab']['empl_id_name'] ?></th>
      <th><?= $language['emp_tab']['desi_emai'] ?></th>
      <th><?= $language['emp_tab']['grad_lead'] ?></th>
      <th><?= $language['emp_tab']['team_divi'] ?></th>
      <th><?= $language['emp_tab']['doj'] ?></th>
      <th><?= $language['emp_tab']['adde_on'] ?></th>
      <th><?= $language['emp_tab']['acti'] ?></th>
    </tr>
    <?php $i=1; if(!empty($emps)): foreach($emps as $emp_detail): ?>
    <tr>
      <td>
        <span class="label label-success"><?php echo $emp_detail['ed_emp_id']; ?></span> <br><?php echo $emp_detail['ed_emp_name']; ?>
      </td>
      <td>
        <?php 
          if($emp_detail['ed_emp_desig']) {
            echo ' <span class="desig-span">'.$emp_detail['ed_emp_desig'].'</span>';
          }

          if($emp_detail['ed_emp_email']) {
            echo '<br>'.$emp_detail['ed_emp_email'];
          }

        ?> 
      </td>
      <td>
        <?php 

          if($emp_detail['ed_emp_grade']){
             echo '<span class="label label-danger">'.$emp_detail['ed_emp_grade'].'</span><br>';
          } 

          if($emp_detail['ed_emp_leader']) {
            echo $emp_detail['ed_emp_leader'];
          }
        ?>
      </td>
      <td>
        <?php 
          if($emp_detail['ed_emp_team']) {
            echo '<span class="label label-warning">'.$emp_detail['ed_emp_team'].'</span><br>';
          }

          if($emp_detail['ed_emp_div']) {
            echo $emp_detail['ed_emp_div'];
          }
        ?>
      <td>
        <?php 
          if($emp_detail['ed_emp_doj']!='' && $emp_detail['ed_emp_doj']!='0000-00-00') {
            echo '<span class="desig-span" >'.$emp_detail['ed_emp_doj'].'</span>';
          }
          
        ?>
      </td>
      <td>
        <?php echo $emp_detail['ed_emp_add_on']; ?><br> <font style="font-style: italic;"> by <?php echo $emp_detail['ea_name']; ?> </font> 
      </td>
      <td>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?= $language['common']['acti'] ?>
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url() ?>employee/editEmployee/<?php echo $this->Autoload_model->encrypt_decrypt('en',$emp_detail['ed_id']) ?>"><?= $language['common']['edit'] ?></a></li>
            <li><a href="#" data-toggle="modal" data-target="#ResetEmpPasswordModal" onclick="setEmpIdPassReset('<?php echo $this->Autoload_model->encrypt_decrypt('en',$emp_detail['ed_id']) ?>')"><?= $language['common']['rese_pass'] ?></a></li>
            <li><a href="#" data-toggle="modal" data-target="#DeleteEmpModal" onclick="setEmpIdDelete('<?php echo $this->Autoload_model->encrypt_decrypt('en',$emp_detail['ed_id']) ?>')"><?= $language['common']['dele'] ?></a></li>
          </ul>
        </div> 
      </td>
    </tr>

    <?php $i++; endforeach; else: ?>
    <tr><td align="center" colspan="7"><p style="color: red;"><?= $language['emp_tab']['no_user_avai'] ?></p></td></tr>
    <?php endif; ?>
    
  </table>
</div>
<!-- /.box-body -->

<div class="box-footer clearfix">
  <!-- <ul class="pagination pagination-sm no-margin pull-right"> -->
     <?php echo $this->ajax_pagination->create_links(); ?>
  <!-- </ul> -->
</div>