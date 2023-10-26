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
   <form id="subject-form" method="post">
      <section class="panel custom_panel_margin">
         <div class="panel-body">
            <div class="form-group">
               <a href="<?= site_url('Subject'); ?>" class="btn btn-danger btn-xs pull-right text-bold" title="Back">Back</a>
            </div>
            <div class="row form-group">
               <label class="col-md-3 control-label">Choose Subject Name <span class="required">*</span></label>
               <div class="col-md-6">
                  <select multiple="" data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1" required=""  name="subject_fid[]">
                     
                    
                       
                     <?php foreach ($getSubjectMaster as $key => $value): ?>
                        
                         <option value="<?= $value->subject_id ?>"><?= $value->subject_name ?></option>

                     <?php endforeach ?>

                     </select>

                   <p><p>
                  <span><i>Note: You can choose multi-subject</i></span>
                  </p></p>
                  <!-- <input type="text" autocomplete="off" name="subject_fid" class="form-control" placeholder="Enter subject name" required="" value="<?= isset($view->subject_name) ? $view->subject_name : '' ?>"> -->
               </div>
            </div>
            <div class="form-group"></div>
         </div>
         <footer class="panel-footer">
            <div class="row">
               <div class="col-sm-12">
                   
                  <button type="submit" id="submit-btn" class="btn btn-primary"><?= $btn ?></button>
                  <a href="<?= site_url('Subject'); ?>" class="btn btn-default">Cancel</a>
               </div>
            </div>
         </footer>
         <!-- end: page -->
      </section>
   </form>
</section>
<!-- start: footer -->
<?php $this->load->view('common/footer') ?>
<!-- end: footer -->
<!-- start: custom role js -->
<script src="<?php echo base_url() ?>assets/custom-js/subject/subject.js"></script>
<!-- end: footer custom role js -->