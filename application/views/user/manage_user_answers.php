  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $language['user']['mana_answ'] ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>/employee"><i class="fa fa-dashboard"></i> <?= $language['common']['home'] ?></a></li>
        <li class="active"><?= $language['user']['mana_answ'] ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
          <div class="col-xs-12">
            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"><?= $language['user']['answ_deta'] ?></h3>

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
                      $sel_user = $this->Autoload_model->getUserType('teacher');
                    } else {
                      $sel_user = $this->Autoload_model->getUserType('student');
                    }
                  ?>
                <div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
                  <table class="table table-hover">
                    <tr>
                      <th><?= $language['user']['sl_no'] ?></th>
                      <th><?= $language['user']['temp'] ?></th>
                      <th><?= $language['user']['desc'] ?></th>
                      <th><?= $sel_user ?> <?= $language['user']['name'] ?></th>
                      <th><?= $language['user']['answ_on'] ?></th>
                      <th><?= $language['common']['acti'] ?></th>
                    </tr>
                    <?php $i=1; if(!empty($user_templ)): foreach($user_templ as $templates): ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo stripslashes($templates['qt_name']) ?></td>
                        <td><?php echo $templates['qt_desc'] ?></td>
                        <td><?php echo $templates['ed_emp_id'].' - '.$templates['ed_emp_name'] ?></td>
                        <td><?php echo $templates['qa_add_on'] ?></td>
                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>user/viewAnswer/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qt_id']) ?>/<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qa_ans_for_user']) ?>"><?= $language['user']['show_answ'] ?></a>
                        </td>
                      </tr>
                      <?php $i++; endforeach; else: ?>
                      <tr><td align="center" colspan="7"><p style="color: red;"><?= $language['user']['no_answ_avai'] ?></p></td></tr>
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