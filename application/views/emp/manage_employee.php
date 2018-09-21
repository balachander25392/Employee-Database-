  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Employee</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Employee</li>
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
              <div class="box-header">
                <h3 class="box-title">Admin User Details</h3>
                <div class="box-tools col-xs-4">
                  <div class="input-group input-group-sm">
                    <input type="text" name="emp_tab_ssearch" id="emp_tab_ssearch" onkeyup="refreshEmpSearch()" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                      <button type="submit" onclick="empSearchPage()" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div id="empList">
                <div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
                  <table class="table table-hover">
                    <tr>
                      <th>Emp ID / Name</th>
                      <th>Designation/Email</th>
                      <th>Leader/DIV/Team</th>
                      <th>DOB / DOJ</th>
                      <th>Added On</th>
                      <th>Action</th>
                    </tr>
                    <?php $i=1; if(!empty($emps)): foreach($emps as $emp_detail): ?>
                    <tr>
                      <td>
                        <span class="label label-success"><?php echo $emp_detail['ed_emp_id']; ?></span> <br><?php echo $emp_detail['ed_emp_name']; ?>
                      </td>
                      <td>
                        <span class="label label-warning"><?php echo $emp_detail['ed_emp_desig']; ?></span> <br><?php echo $emp_detail['ed_emp_email']; ?>
                      </td>
                      <td>
                        <span class="label label-info"><?php echo $emp_detail['ed_emp_leader']; ?></span> <br><?php echo $emp_detail['ed_emp_div']; ?> - <?php echo $emp_detail['ed_emp_team']; ?>
                      </td>
                      <td>
                        <?php echo $emp_detail['ed_emp_dob']; ?><br><?php echo $emp_detail['ed_emp_doj']; ?>
                      </td>
                      <td>
                        <?php echo $emp_detail['ed_emp_add_on']; ?><br> <font style="font-style: italic;"> by <?php echo $emp_detail['ea_name']; ?> </font> 
                      </td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url() ?>employee/editEmployee/<?php echo $this->Autoload_model->encrypt_decrypt('en',$emp_detail['ed_id']) ?>">Edit</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#ResetEmpPasswordModal" onclick="setEmpIdPassReset('<?php echo $this->Autoload_model->encrypt_decrypt('en',$emp_detail['ed_id']) ?>')">Reset Password</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#DeleteEmpModal" onclick="setEmpIdDelete('<?php echo $this->Autoload_model->encrypt_decrypt('en',$emp_detail['ed_id']) ?>')">Delete</a></li>
                          </ul>
                        </div> 
                      </td>
                    </tr>

                    <?php $i++; endforeach; else: ?>
                    <tr><td align="center" colspan="7"><p style="color: red;">No User Available</p></td></tr>
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
          <h5 class="modal-title" id="exampleModalLabel">Reset User Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- <div class="box-body"> -->
            <input type="hidden" name="empUserPassResetID" id="empUserPassResetID">
            <div class="form-group">
              <label for="exampleInputEmail1">New Password</label>
              <input type="password" class="form-control" id="emp_new_pass" name="emp_new_pass" required="true" placeholder="Enter New Password" autocomplete="off" style="width: 37%;">
            </div>
          <!-- </div> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Delete Employee Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"><p style="color: red;">Are you sure want to delete this employee?</p></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>