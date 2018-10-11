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

              <div class="box-tools col-xs-3">
                <div class="input-group input-group-sm">
                  <a href="<?php echo base_url() ?>assets/ebulk/employee-bulk.xlsx">Download Template</a>
                </div>
              </div>
              
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="add_emp_bulk_form" action="<?php echo base_url() ?>employee/saveEmployeeBulk" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Upload Excel</label>
                  <input type="file" class="form-control" id="userfile" name="userfile" required="true">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Action Type</label>
                  <select class="form-control" id="eadd_act_type" name="eadd_act_type" required="true">
                    <option value="">--Select--</option>
                    <option value="insert">New Entry</option>
                    <option value="update">Update Existing</option>
                    <option value="both">Both</option>
                  </select>
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

        <div class="col-md-12"> 
          <div class="box-header with-border"><h3>Instructions</h3></div>
          <div>
            <ul>
              <li>Download the given format and fill all the columns marked in <b>red color</b>.</li>
              <li>Date should be in the format of <b>mm/dd/yyyy</b>.</li>
              <li>Action type <b>New Entry</b> Will only register the employee who is not already registred and this will not update existing.</li>
              <li>Action type <b>Update Existing</b> will only update the employees already registered and this is will not make a new registration.</li>
              <li>Action Type <b>Both</b> will register the employee if he/she is not already registered and if already register it will update the details.</li>
            </ul>
          </div>
        </div>
      
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->