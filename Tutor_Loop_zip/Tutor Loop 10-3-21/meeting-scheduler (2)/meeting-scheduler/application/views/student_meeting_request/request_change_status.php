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
         <div class="form-group">
            <a href="<?= site_url('Student_meeting_request'); ?>" class="btn btn-danger btn-xs pull-right text-bold" title="Back">Back</a>
         </div>
         <form id="status-meeting-request-form" method="post">
            <div class="row form-group">
               <label class="col-md-2 control-label">Meeting Name</label>
               <div class="col-md-4">
                  <input type="text" class="form-control" value="<?= isset($view->subject_name) ? $view->subject_name : '-' ?>" readonly>
               </div>
            </div>
            <div class="row form-group">
               <label class="col-md-2 control-label">Tutor Name </label>
               <div class="col-md-4">
                  <input type="text" class="form-control" value="<?= isset($view->firstname) ? ucfirst($view->firstname)." ".ucfirst($view->lastname) : '-' ?>" readonly>
               </div>
            </div>
            <div class="row form-group">
               <label class="col-md-2 control-label">Student Name </label>
               <div class="col-md-4">
                  <input type="text" class="form-control" value="<?= isset($view->studentfirstname) ? ucfirst($view->studentfirstname)." ".ucfirst($view->studentlastname) : '-' ?>" readonly>
               </div>
            </div>
            <div class="row form-group">
               <label class="col-md-2 control-label">Meeting Date</label>
               <div class="col-md-4">
                  <div class="input-group">
                     <input type="text" autocomplete="off" name="meeting_date" class="form-control" placeholder="Choose meeting date" required="" value="<?= isset($view->meeting_date) ? date('d-m-Y',strtotime($view->meeting_date)) : '' ?>" readonly>
                     <span class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                     </span>
                  </div>
               </div>
            </div>
            <div class="row form-group">
               <label class="col-md-2 control-label">Meeting Time <span class="required">*</span></label>
               <div class="col-md-2">
                  <div class="input-group">
                     <input type="text" data-plugin-timepicker  class="form-control" name="start_time" id="start_time" placeholder="Start time" autocomplete="off" required="" value="<?= isset($view->start_time) ? $view->start_time : '' ?>">
                      
                     <span class="input-group-addon">
                     <i class="fa fa-clock-o"></i>  
                     </span>
                     
                  </div>
                  <span> <small>Start time</small> </span>
               </div>
               <div class="col-md-2">
                  <div class="input-group">
                     <input type="text" data-plugin-timepicker  class="form-control" name="end_time" id="end_time" placeholder="End time" autocomplete="off" required="" value="<?= isset($view->end_time) ? $view->end_time : '' ?>">
                     <span class="input-group-addon">
                     <i class="fa fa-clock-o"></i>   
                     </span>
                  </div>
                  <span> <small>End time</small> </span>
               </div>
               <div class="col-md-6">
               <span id="error_time" class="text-danger text-bold"></span>
               </div>      
                    
              
            </div>
            <div class="row form-group">
               <label class="col-md-2 control-label">Status</label>
               <div class="col-md-4">
                  <select data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1" required=""  name="status" id="status" placeholder="Choose status">
                     <option value=""></option>
                     <option value="0" <?php if($view->status== 0) { echo "selected"; } ?>>Requested</option>
                     <option value="3" <?php if($view->status== 3) { echo "selected"; } ?>>Approved</option>
                     <option value="4" <?php if($view->status== 4) { echo "selected"; } ?>>Rejected</option>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <hr>
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <input type="hidden" name="student_meeting_request_id" id="student_meeting_request_id" value="<?= isset($view->student_meeting_request_id) ? $view->student_meeting_request_id : 0 ?>"> 
                  <input type="hidden" name="student_fid" id="student_fid" value="<?= isset($view->student_fid) ? $view->student_fid : 0 ?>"> 
                  <input type="hidden" name="subject_fid" id="subject_fid" value="<?= isset($view->subject_fid) ? $view->subject_fid : 0 ?>"> 
                  <input type="hidden" name="teacher_fid" id="teacher_fid" value="<?= isset($view->teacher_fid) ? $view->teacher_fid : 0 ?>"> 
                  <input type="hidden" name="meeting_fid" id="meeting_fid" value="<?= isset($view->meeting_fid) ? $view->meeting_fid : 0 ?>"> 
                  <button type="submit" id="submit-btn" class="btn btn-primary"><?= $btn." Meeting Request" ?></button>
                  <a href="<?= site_url('Student_meeting_request'); ?>" class="btn btn-default">Cancel</a>
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
<script src="<?php echo base_url() ?>assets/custom-js/student_meeting_request/student_meeting_request.js"></script>
<!-- end: footer custom role js