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