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
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->