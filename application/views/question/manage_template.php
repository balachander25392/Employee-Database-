  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $language['question_tab']['mana_temp'] ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>/employee"><i class="fa fa-dashboard"></i> <?= $language['common']['home'] ?></a></li>
        <li class="active"><?= $language['question_tab']['mana_temp'] ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
          <div class="col-xs-12">
            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <div class="box">

      
                  <div class="col-md-12">
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?= $language['question_tab']['sear_by_user_type'] ?></label>
                      <select name="mang_tmpl_utype" id="mang_tmpl_utype" class="form-control" onchange="manageTemplatePage()">
                        <option value=""><?= $language['common']['all'] ?></option>
                        <option value="teacher"><?= $language['common']['teac'] ?></option>
                        <option value="student"><?= $language['common']['stud'] ?></option>
                      </select>
                    </div>
                  </div>

                  <div class="col-xs-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?= $language['question_tab']['sear_by_keyw'] ?></label>
                      <div class="input-group">
                        <input type="text" name="mang_templ_key" id="mang_templ_key" onkeyup="manageTemplatePage()" class="form-control pull-right" placeholder="Template name, description">

                        <div class="input-group-btn">
                          <button type="submit" onclick="manageTemplatePage()" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>  
                    </div>
                    </div>
                  </div>

                  <div class="col-xs-2">
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?= $language['question_tab']['add_temp'] ?></label>
                      <button type="submit" data-toggle="modal" data-target="#addTemplateModal" class="btn btn-primary btn-sm"><?= $language['question_tab']['add_new_temp'] ?></button>
                    </div>
                  </div>

              </div>
              <!-- /.box-header -->
              <div id="tempList">
                <div class="box-body table-responsive no-padding" style="overflow-x: inherit;">
                  <table class="table table-hover">
                    <tr>
                      <th><?= $language['question_tab']['sl_no'] ?></th>
                      <th><?= $language['question_tab']['name'] ?></th>
                      <th><?= $language['question_tab']['desc'] ?></th>
                      <th><?= $language['question_tab']['temp_for'] ?></th>
                      <th><?= $language['question_tab']['adde_on'] ?></th>
                      <th><?= $language['common']['acti'] ?></th>
                    </tr>
                    <?php $i=1; if(!empty($template)): foreach($template as $templates): ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo stripslashes($templates['qt_name']) ?></td>
                        <td><?php echo $templates['qt_desc'] ?></td>
                        <td><?php echo $templates['qt_templ_to'] ?></td>
                        <td><?php echo $templates['qt_add_on'] ?></td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><?= $language['common']['acti'] ?>
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="#" data-toggle="modal" data-target="#PreviewTemplModal" onclick="setTemplPreview('<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qt_id']) ?>')"><?= $language['common']['prev'] ?></a></li>
                              <li><a href="#" data-toggle="modal" data-target="#EditTemplModal" onclick="setTemplEdit('<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qt_id']) ?>')"><?= $language['common']['edit'] ?></a></li>
                              <li><a href="#" data-toggle="modal" data-target="#DeleteTemplModal" onclick="setTemplDelete('<?php echo $this->Autoload_model->encrypt_decrypt('en',$templates['qt_id']) ?>')"><?= $language['common']['dele'] ?></a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <?php $i++; endforeach; else: ?>
                      <tr><td align="center" colspan="7"><p style="color: red;"><?= $language['question_tab']['no_temp_avai'] ?></p></td></tr>
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
          <h4 class="modal-title" id="exampleModalLabel"><?= $language['question_tab']['add_temp'] ?></h4>
        </div>
        <div class="modal-body">

          <div class="box-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1"><?= $language['question_tab']['temp_name'] ?></label>
                <input type="text" class="form-control" id="templ_name" name="templ_name" required="true" placeholder="Enter Template Name" autocomplete="off">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1"><?= $language['question_tab']['temp_to'] ?></label>
                <select name="templ_to" id="templ_to" required="" class="form-control">
                  <option value="">--<?= $language['common']['sele'] ?>--</option>
                  <option value="student"><?= $language['common']['stud'] ?></option>
                  <option value="teacher"><?= $language['common']['teac'] ?></option>
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputEmail1"><?= $language['question_tab']['temp_desc'] ?></label>
                <textarea name="templ_desc" id="templ_desc" required="" class="form-control" placeholder="Describe about template"></textarea>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language['common']['canc'] ?></button>
          <button type="submit" class="btn btn-primary"><?= $language['common']['crea'] ?></button>
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
          <h5 class="modal-title" id="exampleModalLabel"><?= $language['question_tab']['edit_temp'] ?></h5>
        </div>
        <div class="modal-body">
          <div class="box-body" id="editTemplDiv">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language['common']['clos'] ?></button>
          <button type="submit" class="btn btn-primary"><?= $language['common']['upda'] ?></button>
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
          <h5 class="modal-title" id="exampleModalLabel"><?= $language['question_tab']['dele_temp'] ?></h5>
        </div>
        <div class="modal-body"><p style="color: red;"><?= $language['question_tab']['dele_temp_aler'] ?></p></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language['common']['clos'] ?></button>
          <button type="submit" class="btn btn-primary"><?= $language['common']['dele'] ?></button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="PreviewTemplModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLabel"><?= $language['question_tab']['prev_ques'] ?></h5>
        </div>
        <div class="modal-body" id="adminQstnPrevDiv">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language['common']['clos'] ?></button>
        </div>
    </div>
  </div>
</div>