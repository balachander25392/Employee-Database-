  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $language['question_tab']['add_ques'] ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <?= $language['common']['home'] ?></a></li>
        <li class="active"><?= $language['question_tab']['add_ques'] ?></li>
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
              <h3 class="box-title"><?= $language['question_tab']['add_ques'] ?></h3>
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url() ?>question/saveQuestion" method="POST">
              <div class="box-body" id="">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="exampleInputPassword1"><?= $language['question_tab']['ques'] ?></label>
                    <input type="text" class="form-control" name="question" required="" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="exampleInputPassword1"><?= $language['question_tab']['temp'] ?></label>
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
                    <label for="exampleInputPassword1"><?= $language['question_tab']['answ_type'] ?></label>
                    <select class="form-control" name="ques_type" id="ques_type" required="" onchange="addOptiontoQuestn()">
                      <option value="">--<?= $language['common']['sele'] ?>--</option>
                      <option value="text"><?= $language['question_tab']['text_box'] ?></option>
                      <option value="radio"><?= $language['question_tab']['radi_butt'] ?></option>
                      <option value="check"><?= $language['question_tab']['chec_box'] ?></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" id="quest_dyn_div">
                  
                </div>                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?= $language['common']['subm'] ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->