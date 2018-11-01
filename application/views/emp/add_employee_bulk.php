  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $language['emp_tab']['add_empl'] ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <?= $language['common']['home'] ?></a></li>
        <li class="active"><?= $language['emp_tab']['add_empl'] ?></li>
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
              <h3 class="box-title"><?= $language['emp_tab']['add_empl'] ?></h3>

              <div class="box-tools col-xs-3">
                <div class="input-group input-group-sm">
                  <a href="<?php echo base_url() ?>assets/ebulk/employee-bulk.xlsx"><?= $language['emp_tab']['down_temp'] ?></a>
                </div>
              </div>
              
            </div>

            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="add_emp_bulk_form" action="<?php echo base_url() ?>employee/saveEmployeeBulk" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1"><?= $language['emp_tab']['uplo_exce'] ?></label>
                  <input type="file" class="form-control" id="userfile" name="userfile" required="true">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><?= $language['emp_tab']['acti_type'] ?></label>
                  <select class="form-control" id="eadd_act_type" name="eadd_act_type" required="true">
                    <option value="">--<?= $language['common']['sele'] ?>--</option>
                    <option value="insert"><?= $language['emp_tab']['new_entr'] ?></option>
                    <option value="update"><?= $language['emp_tab']['upda_exis'] ?></option>
                    <option value="both"><?= $language['emp_tab']['both'] ?></option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary"><?= $language['common']['subm'] ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="col-md-12"> 
          <div class="box-header with-border"><h3><?= $language['emp_tab']['inst'] ?></h3></div>
          <div>
            <ul>
              <li><?= $language['emp_tab']['inst_1'] ?></li>
              <li><?= $language['emp_tab']['inst_2'] ?></li>
              <li><?= $language['emp_tab']['inst_3'] ?></li>
              <li><?= $language['emp_tab']['inst_4'] ?></li>
              <li><?= $language['emp_tab']['inst_5'] ?></li>
            </ul>
          </div>
        </div>
      
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->