  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $language['user']['avai_ques'] ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>/employee"><i class="fa fa-dashboard"></i> <?= $language['common']['home'] ?></a></li>
        <li class="active"><?= $language['user']['avai_ques'] ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
          <div class="col-xs-12">
            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"><?= $language['user']['temp_deta'] ?></h3>

                <div class="box-tools col-xs-4">
                  <div class="input-group input-group-sm">
                    <input type="text" name="emp_templ_srch" id="emp_templ_srch" onkeyup="empTemplateSearch()" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                      <button type="submit" onclick="empTemplateSearch()" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.box-header -->
              <div id="userTempList">
                <div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
                  <table class="table table-hover">
                    <tr>
                      <th><?= $language['user']['sl_no'] ?></th>
                      <th><?= $language['user']['name'] ?></th>
                      <th><?= $language['user']['desc'] ?></th>
                      <th><?= $language['user']['temp_for'] ?></th>
                      <th><?= $language['user']['adde_on'] ?></th>
                      <th><?= $language['common']['acti'] ?></th>
                    </tr>
                    <?php $i=1; if(!empty($user_templ)): foreach($user_templ as $templates): ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo stripslashes($templates['qt_name']) ?></td>
                        <td><?php echo $templates['qt_desc'] ?></td>
                        <td><?php echo $templates['qt_templ_to'] ?></td>
                        <td><?php echo $templates['qt_add_on'] ?></td>
                        <td><!-- <a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>user/startQuestionnaire/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qt_id']) ?>">Take Questionnaire</a> -->
                          <a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>user/showQuestions/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qt_id']) ?>"><?= $language['user']['take_ques'] ?></a>
                        </td>
                      </tr>
                      <?php $i++; endforeach; else: ?>
                      <tr><td align="center" colspan="7"><p style="color: red;"><?= $language['user']['no_temp_avai'] ?></p></td></tr>
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