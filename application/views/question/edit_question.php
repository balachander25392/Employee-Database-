  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $language['question_tab']['edit_ques'] ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <?= $language['common']['home'] ?></a></li>
        <li class="active"><?= $language['question_tab']['edit_ques'] ?></li>
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
              <h3 class="box-title"><?= $language['question_tab']['edit_ques'] ?></h3>
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url() ?>question/updateQuestion" method="POST">
              <input type="hidden" name="quest_id" id="quest_id" value="<?php echo $questn_id ?>">
              <div class="box-body" id="">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="exampleInputPassword1"><?= $language['question_tab']['ques'] ?></label>
                    <input type="text" class="form-control" name="question" value="<?php echo stripslashes($questn_detail['eq_question']) ?>" required="" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="exampleInputPassword1"><?= $language['question_tab']['temp'] ?></label>
                    <select class="form-control" name="questn_templ" required="">
                      <option value="">--Select--</option>
                      <?php foreach($template as $templates){ ?>
                      <option value="<?php echo $templates['qt_id'] ?>"<?php if($questn_detail['eq_templ_id']==$templates['qt_id']){ echo 'Selected'; } ?>><?php echo $templates['qt_name']; ?></option>  
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="exampleInputPassword1"><?= $language['question_tab']['answ_type'] ?></label>
                    <select class="form-control" name="ques_type" id="ques_type" required="" onchange="addOptiontoQuestn()">
                      <option value="">--<?= $language['common']['sele'] ?>--</option>
                      <option value="text"<?php if($questn_detail['eq_answer_type']=='text'){ echo 'Selected'; } ?>><?= $language['question_tab']['text_box'] ?></option>
                      <option value="radio"<?php if($questn_detail['eq_answer_type']=='radio'){ echo 'Selected'; } ?>><?= $language['question_tab']['radi_butt'] ?></option>
                      <option value="check"<?php if($questn_detail['eq_answer_type']=='check'){ echo 'Selected'; } ?>><?= $language['question_tab']['chec_box'] ?></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" id="quest_dyn_div">
                  <?php if(@$option_detail && count($option_detail)>0){ $i=0; foreach($option_detail as $optidt){ ?>

                    <div class="col-md-12" id="quest_par_div<?php echo 'u'.$i; ?>">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="exampleInputPassword1"><?= $language['question_tab']['opti'] ?></label>
                          <input type="hidden" name="option_id[]" value="<?php echo $optidt['eqo_id'] ?>">
                          <input type="text" name="option[]" value="<?php echo $optidt['eqo_option'] ?>" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <button type="button" name="remove" id="<?php echo 'u'.$i; ?>" class="btn btn-danger quest_btn_remove">X</button>
                        <?php if($i==0){ ?>
                        <button type="button" id="quest_btn_add" class="btn btn-primary">+</button>
                        <?php }?>
                      </div>
                    </div>

                   <?php $i++; } } ?> 
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