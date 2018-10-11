  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee
        <small>Report</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>employee"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Employee Questionnaire Results</li>
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
                      <label for="exampleInputPassword1">Search by employee Type</label>
                      <select name="emp_type_search" id="emp_type_search" class="form-control" onchange="userResultPage()">
                        <option value="">All</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>  
                      </select>
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Search by Template</label>
                      <select name="emp_reprt_tmpl_srch" id="emp_reprt_tmpl_srch" class="form-control" onchange="userResultPage()">
                        <option value="">All</option>
                        <?php foreach($template as $templates){ ?>
                        <option value="<?php echo $templates['qt_id'] ?>"><?php echo $templates['qt_name'] ?></option>  
                        <?php } ?> 
                      </select>
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Search by Keywords</label>
                      <div class="input-group">
                        <input type="text" name="user_result_search" id="user_result_search" onkeyup="userResultPage()" class="form-control pull-right" placeholder="Emp ID, Name etc.,">

                        <div class="input-group-btn">
                          <button type="submit" onclick="userResultPage()" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>  
                    </div>
                    </div>
                  </div>

                </div>
              <!-- </div>  -->
              <!-- /.box-header -->
              <div id="resultList">
                <div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
                  <table class="table table-hover">
                    <tr>
                      <th>Emp ID / Name</th>
                      <th>Designation/Email</th>
                      <th>Leader/DIV/Team</th>
                      <th>Template</th>
                      <th>User Type</th>
                      <th>Answered For</th>                      
                      <th>Answered on</th>
                      <th>Action</th>
                    </tr>
                    <?php $i=1; if(!empty($user_result)): foreach($user_result as $user_results): ?>
                    <tr>
                      <td>
                        <span class="label label-success"><?php echo $user_results['ed_emp_id']; ?></span> <br><?php echo $user_results['ed_emp_name']; ?>
                      </td>
                      <td>
                        <span class="label label-warning"><?php echo $user_results['ed_emp_desig']; ?></span> <br><?php echo $user_results['ed_emp_email']; ?>
                      </td>
                      <td>
                        <span class="label label-info"><?php echo $user_results['ed_emp_leader']; ?></span> <br><?php echo $user_results['ed_emp_div']; ?> - <?php echo $user_results['ed_emp_team']; ?>
                      </td>
                      <td><?php echo $user_results['qt_name'] ?></td>  
                      <td>
                        <?php echo $user_results['ed_emp_type']; ?>
                      </td>  
                      <td><?php echo $user_results['ans_for_user_empid'].' - '.$user_results['ans_for_user_name'] ?></td>                   
                      <td><?php echo $user_results['qa_add_on'] ?></td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="#" data-toggle="modal" data-target="#empAnswerModal" onclick="getEmpAnswers('<?php echo $this->Autoload_model->encrypt_decrypt('en',$user_results['ed_id']) ?>','<?php echo $this->Autoload_model->encrypt_decrypt('en',$user_results['qt_id']) ?>','<?php echo $this->Autoload_model->encrypt_decrypt('en',$user_results['qa_ans_for_user']) ?>')">View Answers</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#allowEditModal" onclick="allowEmpEditAns('<?php echo $this->Autoload_model->encrypt_decrypt('en',$user_results['qa_id']) ?>')">Allow Edit</a></li>
                          </ul>
                        </div> 
                      </td>
                    </tr>

                    <?php $i++; endforeach; else: ?>
                    <tr><td align="center" colspan="7"><p style="color: red;">No Results Available</p></td></tr>
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

<div class="modal fade" id="empAnswerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 77%;" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <!-- <h5 class="modal-title" id="exampleModalLabel">Employee Answers</h5> -->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="resultAnswers">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<div class="modal fade" id="allowEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url() ?>report/alloweditAnsAcc">
        <input type="hidden" name="ans_acc_emp_id" id="ans_acc_emp_id">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title">Employee Answer Edit Access</h4>
        </div>
        <div class="modal-body">
          <p style="color: red;">Are you sure want to allow access to re-edit the answers?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Allow</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>