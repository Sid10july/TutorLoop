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
    <h2><?=$page_title ?></h2>
  </header>
  <!-- start: page -->
 
    <section class="panel custom_panel_margin">
      <div class="panel-body">
         
             
               <form id="subject-master-form" method="post">

              <div class="form-group">
                <a href="<?= site_url('Subject_master'); ?>" class="btn btn-danger btn-xs pull-right text-bold" title="Back">Back</a>
              </div>
              
              <div class="row form-group">
                <label class="col-md-2 control-label">Subject Name <span class="required">*</span></label>
                <div class="col-md-6">
                  <input type="text" autocomplete="off" name="subject_name" class="form-control" placeholder="Enter subject name" required="" value="<?= isset($view->subject_name) ? $view->subject_name : '' ?>">
                </div>
              </div>
            
              <div class="form-group"><hr></div>
              <div class="row">
                <div class="col-sm-12">
                  <input type="hidden" name="subject_id" id="subject_id" value="<?= isset($view->subject_id) ? $view->subject_id : 0 ?>">
                  <button type="submit" id="submit-btn" class="btn btn-primary"><?= $btn ?></button>
                  <a href="<?= site_url('Subject_master'); ?>" class="btn btn-default">Cancel</a>
                </div>
              </div>
              </form>
            
          
      </div>
      <!-- end: page -->
    </section>
  
</section>
<!-- start: footer -->
<?php $this->load->view('common/footer') ?>
<!-- end: footer -->
<!-- start: custom role js -->
<script src="<?php echo base_url() ?>assets/custom-js/subject_master/subject_master.js"></script>
<!-- end: footer custom role js -->