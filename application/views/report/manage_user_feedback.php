  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $language['report']['feed_repo'] ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>employee"><i class="fa fa-dashboard"></i> <?= $language['common']['home'] ?></a></li>
        <li class="active"><?= $language['report']['feed_repo'] ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
          <div class="col-xs-12">
            <?php if($this->session->flashdata('flash_msg')) { echo $this->session->flashdata('flash_msg'); } ?>
            <div class="box">

              <!-- <div class="box-header"> -->
                <div class="col-md-12">
                
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1"><?= $language['report']['ente_empl_id'] ?></label>
                        <input type="text" name="ufedb_usr_srch" id="ufedb_usr_srch" class="form-control" onkeyup="loadEmpTemplate()">
                      </div>
                  </div>  


                  <div class="col-xs-4">
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?= $language['report']['choo_temp'] ?></label>
                      <select name="qstn_reprt_tmpl_srch" id="qstn_reprt_tmpl_srch" class="form-control" onchange="getEmployeesFedbck()">
                        <option value="">--<?= $language['common']['sele'] ?>--</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-2"></div>
                  <div class="col-md-2" id="fedexcl_export_div" style="display: none;">
                    <form method="POST" action="<?php echo base_url() ?>report/exportFeedbkRprt">
                      <input type="hidden" name="feed_emp_expt_id" id="feed_emp_expt_id">
                      <input type="hidden" name="feed_templ_expt_id" id="feed_templ_expt_id">
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?= $language['report']['down'] ?></label>
                        <button type="submit" class="btn btn-primary btn-sm"><?= $language['report']['expo_to_exce'] ?></button>
                      </div>
                    </form>
                  </div>

                </div>

              <!-- </div>  -->
              <!-- /.box-header -->
              <!-- <div class="col-md-2"></div> -->
              <div id="feedbackReport">
                
                <div>
                  <p style="text-align: center;color: red;"><?= $language['report']['aler_1'] ?></p>
                <div>

              </div>

            </div>
            <!-- /.box -->
          </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class="modal fade" id="loadFeedTextAnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <!-- <h5 class="modal-title" id="exampleModalLabel">Employee Answers</h5> -->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="" id="FeedTextAns">


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language['common']['clos'] ?></button>
        </div>
    </div>
  </div>
</div>