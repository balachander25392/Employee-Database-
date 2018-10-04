  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add
        <small>Employee Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Employee Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <!-- left column -->
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Employee</h3>
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url() ?>employee/updateEmployee" method="POST">
              <input type="hidden" name="emp_idd" value="<?php echo $emp_id; ?>">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Employee ID</label>
                    <input type="text" class="form-control" id="emp_id" name="emp_id" required="true" placeholder="Enter Employee ID" autocomplete="off" value="<?php echo $emp_detail['ed_emp_id'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" class="form-control" id="emp_name" name="emp_name" required="true" placeholder="Name" autocomplete="off" value="<?php echo $emp_detail['ed_emp_name'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="emp_email" name="emp_email" required="true" placeholder="Email" autocomplete="off" value="<?php echo $emp_detail['ed_emp_email'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Designation</label>
                    <input type="text" class="form-control" id="emp_desig" name="emp_desig" placeholder="Designation" autocomplete="off" value="<?php echo $emp_detail['ed_emp_desig'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Division</label>
                    <input type="text" class="form-control" id="emp_div" name="emp_div" placeholder="Division" autocomplete="off" value="<?php echo $emp_detail['ed_emp_div'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Team</label>
                    <input type="text" class="form-control" id="emp_team" name="emp_team" placeholder="Team" autocomplete="off" value="<?php echo $emp_detail['ed_emp_team'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Leader</label>
                    <input type="text" class="form-control" id="emp_leader" name="emp_leader" placeholder="Leader" autocomplete="off" value="<?php echo $emp_detail['ed_emp_leader'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">DOB</label>
                    <input type="text" class="form-control" id="emp_dob" name="emp_dob" placeholder="Date of Birth" autocomplete="off" value="<?php echo $emp_detail['ed_emp_dob'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">DOJ</label>
                    <input type="text" class="form-control" id="emp_doj" name="emp_doj" placeholder="Date of Joining" autocomplete="off" value="<?php echo $emp_detail['ed_emp_doj'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Type</label>
                    <select class="form-control" name="emp_type" id="emp_type" required="">
                      <option value="">--Select--</option>
                      <option value="student"<?php if($emp_detail['ed_emp_type']=='student'){ echo 'Selected'; } ?>>Student</option>
                      <option value="teacher"<?php if($emp_detail['ed_emp_type']=='teacher'){ echo 'Selected'; } ?>>Teacher</option>
                      <option value="none"<?php if($emp_detail['ed_emp_type']=='none'){ echo 'Selected'; } ?>>None</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->