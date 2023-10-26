<!-- start: header css -->
<?php $this->load->view('common/header_css') ?>
<!-- end: header css -->
<!-- start: header -->
<?php $this->load->view('common/header') ?>
<!-- end: header -->
<!-- start: sidebar -->
<?php $this->load->view('common/sidebar') ?>
<!-- end: sidebar -->
<section role="main" class="content-body">
  <header class="page-header">
    <h2><?= $page_title ?></h2>
  </header>
  <!-- start: page -->
  
    <section class="panel custom_panel_margin">
       <div class="panel-body">
         <div class="form-group">
          <a href="<?= site_url('Color/index/'.$_SESSION['role_right_id']); ?>" class="btn btn-danger btn-xs pull-right text-bold" title="Back">Back</a>
         </div>
        <div class="table-responsive">
                      <table class="table table-bordered table-padding-12">
                        <thead>
                          <tr>
                            <th width="50%">Color Name : <span class="c-darkblue"><?= isset($view->color_name) ? toProperCase($view->color_name) : '' ?></span> </th>
                            <th width="50%">Status : 
                            <?php if($view->status==1) { ?>
                                  <label class="label label-success"><?= Status_select::getValue($view->status) ?></label>
                            <?php } else { ?>
                                  <label class="label label-danger"><?= Status_select::getValue($view->status) ?></label>
                            <?php } ?>
                             </th>
                          </tr>
                          <tr>
                            <th width="50%">Status Updated By : <span class="c-darkblue"><?= isset($view->status_updated_by_name) ? $view->status_updated_by_name : '' ?></span></th>
                            <th width="50%">Status Updated On : <span class="c-darkblue"><?= isset($view->status_updated_on) ? date('d-M-Y / g:i A',strtotime($view->status_updated_on)) : '' ?></th>
                          </tr>
                          <tr>
                            <th width="50%">Created By : <span class="c-darkblue"><?= isset($view->created_by_name) ? $view->created_by_name : '' ?></span></th>
                            <th width="50%">Created On : <span class="c-darkblue"><?= isset($view->created_on) ? date('d-M-Y / g:i A',strtotime($view->created_on)) : '' ?></th>
                          </tr>
                                                   <tr>
                            <th width="50%">Updated By : <span class="c-darkblue"><?= isset($view->updated_by_name) ? $view->updated_by_name : '' ?></span></th>
                            <th width="50%">Updated On : <span class="c-darkblue"><?= isset($view->updated_on) ? date('d-M-Y / g:i A',strtotime($view->updated_on)) : '' ?></th>
                          </tr>

                        </thead>
                       </table>
                    </div>
       </div>
      <!-- end: page -->
    </section>
   
   
</section>

<!-- start: footer -->
<?php $this->load->view('common/footer') ?>

<!-- end: footer -->
 