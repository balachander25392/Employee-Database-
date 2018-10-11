  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Answers</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>/employee"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Answers</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
          <div class="col-xs-12">
            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Answer Details</h3>

                <div class="box-tools col-xs-4">
                  <div class="input-group input-group-sm">
                    <input type="text" name="emp_ansfd_srch" id="emp_ansfd_srch" onkeyup="empAnswerSearch()" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                      <button type="submit" onclick="empAnswerSearch()" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.box-header -->
              <div id="userAnsList">
                 <?php
                    $ed_emp_type = $this->session->userdata['user_logged_in']['ed_emp_type'];

                    if($ed_emp_type=='student'){
                      $sel_user = 'Teacher';
                    } else {
                      $sel_user = 'Student';
                    }
                  ?>
                <div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
                  <table class="table table-hover">
                    <tr>
                      <th>SL.No</th>
                      <th>Template</th>
                      <th>Description</th>
                      <th><?= $sel_user ?> Name</th>
                      <th>Answered On</th>
                      <th>Action</th>
                    </tr>
                    <?php $i=1; if(!empty($user_templ)): foreach($user_templ as $templates): ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo stripslashes($templates['qt_name']) ?></td>
                        <td><?php echo $templates['qt_desc'] ?></td>
                        <td><?php echo $templates['ed_emp_id'].' - '.$templates['ed_emp_name'] ?></td>
                        <td><?php echo $templates['qa_add_on'] ?></td>
                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>user/viewAnswer/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qt_id']) ?>/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qa_ans_for_user']) ?>">Show Answers</a>
                        </td>
                      </tr>
                      <?php $i++; endforeach; else: ?>
                      <tr><td align="center" colspan="7"><p style="color: red;">No Answers Available</p></td></tr>
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

<div class="modal fade" id="addTemplateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url() ?>question/addTemplate">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Add Template</h4>
        </div>
        <div class="modal-body">

          <div class="box-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Template Name</label>
                <input type="text" class="form-control" id="templ_name" name="templ_name" required="true" placeholder="Enter Template Name" autocomplete="off">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Template to</label>
                <select name="templ_to" id="templ_to" required="" class="form-control">
                  <option value="">--Select--</option>
                  <option value="student">Student</option>
                  <option value="teacher">Teacher</option>
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputEmail1">Template Description</label>
                <textarea name="templ_desc" id="templ_desc" required="" class="form-control" placeholder="Describe about template"></textarea>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="EditTemplModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url() ?>question/editTemplate">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLabel">Edit Template</h5>
        </div>
        <div class="modal-body">
          <div class="box-body" id="editTemplDiv">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="DeleteTemplModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url() ?>question/deleteTemplate">
        <input type="hidden" name="templDeleteID" id="templDeleteID">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLabel">Delete Template</h5>
        </div>
        <div class="modal-body"><p style="color: red;">Are you sure want to delete this template? The questions associated with this template will disappear from relevant employee pages.</p></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>