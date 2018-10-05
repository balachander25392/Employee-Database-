  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add
        <small>Question</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Question</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <!-- left column -->
        <div class="col-md-1"></div>
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Question</h3>
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url() ?>question/saveQuestion" method="POST">
              <div class="box-body" id="">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Question</label>
                    <input type="text" class="form-control" name="question" required="" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Template</label>
                    <select class="form-control" name="questn_templ" required="">
                      <option value="">--Select--</option>
                      <?php foreach($template as $templates){ ?>
                      <option value="<?php echo $templates['qt_id'] ?>"><?php echo $templates['qt_name']; ?></option>  
                      <?php } ?>  
                    </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Answer Type</label>
                    <select class="form-control" name="ques_type" id="ques_type" required="" onchange="addOptiontoQuestn()">
                      <option value="">--Select--</option>
                      <option value="text">Text box</option>
                      <option value="radio">Radio button</option>
                      <option value="check">Check Box</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" id="quest_dyn_div">
                  
                </div>                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->