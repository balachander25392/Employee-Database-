  <style type="text/css">
    .desig-span{
      font-style: italic;
      font-size: 12px;
      font-weight: bold;
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $language['emp_tab']['mana_empl'] ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>welcome"><i class="fa fa-dashboard"></i> <?= $language['header']['home'] ?></a></li>
        <li class="active"><?= $language['emp_tab']['mana_empl'] ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
          <div class="col-xs-12">
            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <?php if($this->session->flashdata('eu_succ_flash_msg')) { echo $this->session->flashdata('eu_succ_flash_msg'); } ?>
            <?php if($this->session->flashdata('eu_fail_flash_msg')) { echo $this->session->flashdata('eu_fail_flash_msg'); } ?>
            <div class="box">


              <div class="col-md-12">
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?= $language['emp_tab']['sear_by_user_type'] ?></label>
                      <select name="emp_utype_search" id="emp_utype_search" class="form-control" onchange="empSearchPage()">
                        <option value=""><?= $language['common']['all'] ?></option>
                        <option value="teacher"><?= $language['common']['teac'] ?></option>
                        <option value="student"><?= $language['common']['stud'] ?></option>
                      </select>
                    </div>
                  </div>

                  <div class="col-xs-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?= $language['emp_tab']['sear_by_keyw'] ?></label>
                      <div class="input-group">
                        <input type="text" name="emp_tab_ssearch" id="emp_tab_ssearch" onkeyup="empSearchPage()" class="form-control pull-right" placeholder="<?= $language['header']['sear'] ?>">

                        <div class="input-group-btn">
                          <button type="submit" onclick="empSearchPage()" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

              <!-- /.box-header -->
              <div id="empList">
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
              </div>

            </div>
            <!-- /.box -->
          </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<div class="modal fade" id="ResetEmpPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url() ?>employee/resetPassword">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLabel"><?= $language['emp_tab']['rese_empl_pass'] ?></h5>
        </div>
        <div class="modal-body">
          <!-- <div class="box-body"> -->
            <input type="hidden" name="empUserPassResetID" id="empUserPassResetID">
            <!-- <div class="form-group">
              <label for="exampleInputEmail1"><?= $language['emp_tab']['new_pass'] ?></label>
              <input type="password" class="form-control" id="emp_new_pass" name="emp_new_pass" required="true" placeholder="Enter New Password" autocomplete="off" style="width: 37%;">
            </div> -->
            <p style="color: red;"><?= $language['emp_tab']['pass_rese_aler'] ?>.</p>  
          <!-- </div> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language['common']['clos'] ?></button>
          <button type="submit" class="btn btn-primary"><?= $language['common']['save_chan'] ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="DeleteEmpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url() ?>employee/deleteEmployee">
        <input type="hidden" name="empUserDeelteID" id="empUserDeelteID">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $language['emp_tab']['dele_empl_acco'] ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"><p style="color: red;"><?= $language['emp_tab']['dele_empl_aler'] ?>?</p></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language['common']['clos'] ?></button>
          <button type="submit" class="btn btn-primary"><?= $language['common']['dele'] ?></button>
        </div>
      </form>
    </div>
  </div>
</div>