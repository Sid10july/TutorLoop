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
               <a href="<?= site_url('Meeting'); ?>" class="btn btn-danger btn-xs pull-right text-bold" title="Back">Back</a>
            </div>

         <div class="row">
             
             <div class="col-md-8 form-group">
                  <form id="meeting-form" method="post">
            <div class="row form-group">
               <label class="col-md-3 control-label">Meeting Name<span class="required">*</span></label>
               <div class="col-md-6">
                  <select data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1" required=""  name="subject_fid" id="subject_fid" placeholder="Choose subject name">
                     <option value=""></option>
                     <?php foreach ($getSubjectMaster as $key => $value): ?>
                     <option value="<?= $value->subject_id ?>" <?php if(isset($view->subject_fid) && $view->subject_fid == $value->subject_id) { echo "selected"; } ?> ><?= $value->subject_name ?></option>
                     <?php endforeach ?>
                  </select>
                  <span> <small>All Subject List</small> </span>
               </div>
                
            </div>
            <div class="row form-group">
               <label class="col-md-3 control-label">Tutor Name <span class="required">*</span></label>
               <div class="col-md-6">
                  <select data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1" required=""  name="teacher_fid" id="teacher_fid" placeholder="Choose tutor name">
                     <option value=""></option>

                     <?php if ($btn == 'Update') { ?>

                        <?php foreach ($getTutorMaster as $key => $value) { ?>
                             
                           <option value="<?= $value->user_id ?>" <?php if($view->teacher_fid == $value->user_id) { echo "selected"; } ?> ><?= ucfirst($value->firstname)." ".ucfirst($value->lastname) ?></option>

                     <?php } }  ?>
              
                  </select>
                    <span> <small>After selecting meeting/subject name tutor list will show</small> </span>
               </div>
               
            </div>
            <div class="row form-group">
               <label class="col-md-3 control-label">Student Name <span class="required">*</span></label>
               <div class="col-md-6">
                  <select data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1" required=""  name="student_fid[]" id="student_fid" placeholder="Choose student name" multiple="">
                      
                      <?php if ($btn == 'Update') { ?>

                        <?php foreach ($getStudentMaster as $key => $value) { ?>
                             
                           <option value="<?= $value->user_id ?>" <?php if(in_array($value->user_id, $getStudentIds)) { echo "selected"; } ?> ><?= ucfirst($value->firstname)." ".ucfirst($value->lastname) ?></option>

                     <?php } }  ?>

                  </select>
                  <span> <small>After selecting tutor name student list will show</small></span>
               </div>
               
            </div>
            <div class="row form-group">
               <label class="col-md-3 control-label">Meeting Date <span class="required">*</span></label>
               <div class="col-md-6">
                  <div class="input-group">
                     <input type="text" autocomplete="off" name="meeting_date" class="form-control meeting_date" placeholder="Choose meeting date" required="" value="<?= isset($view->meeting_date) ? date('d-m-Y',strtotime($view->meeting_date)) : '' ?>">
                     <span class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                     </span>
                  </div>

               </div>
            </div>
            <div class="row form-group">
               <label class="col-md-3 control-label">Meeting Time <span class="required">*</span></label>
               <div class="col-md-3">
                  <div class="input-group">
                     <input type="text" data-plugin-timepicker  class="form-control" name="start_time" id="start_time" placeholder="Start time" autocomplete="off" required="" value="<?= isset($view->start_time) ? $view->start_time : '' ?>">
                      
                     <span class="input-group-addon">
                     <i class="fa fa-clock-o"></i>  
                     </span>
                     
                  </div>
                  <span> <small>Start time</small> </span>
               </div>
               <div class="col-md-3">
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
               <label class="col-md-3 control-label">Reminder Time</label>
               <div class="col-md-3">
                  <input type="number" name="reminder_time" class="form-control" placeholder="Reminder time" autocomplete="off" min="10" required="" value="<?= isset($view->reminder_time) ? $view->reminder_time : '10' ?>">
                  <span> <small>By default 10 minute</small> </span>
               </div>
            </div>
            <div class="form-group">
               <hr>
            </div>
            <div class="row">
               <div class="col-sm-12">
                 <input type="hidden" name="meeting_id" id="meeting_id" value="<?= isset($view->meeting_id) ? $view->meeting_id : 0 ?>"> 
                  <button type="submit" id="submit-btn" class="btn btn-primary"><?= $btn." Meeting" ?></button>
                  <a href="<?= site_url('Meeting'); ?>" class="btn btn-default">Cancel</a>
               </div>
            </div>

            <input type="hidden" id="leave_days" value="<?= $leave_days; ?>">



         </form>
             </div>  


             <div class="col-md-4 form-group dhide" id="participants-error">
               <br>
                <section class="panel panel-danger">
                     <header class="panel-heading" style="padding: 2px !important">
                       
                     <h5 class="c-white text-center text-bold "> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Meeting already exist for following participants / student</h5>
                      
                     </header>
                     <div class="panel-body" style="border: 1px solid #f1f1f1 !important;">
                     <ol id="append-duplicate-participants">
                        
                     </ol>
                     </div>
                     </section>
             </div> 

         </div>


       
      </div>
      <!-- end: page -->
   </section>
</section>
<!-- start: footer -->
<?php $this->load->view('common/footer') ?>
<!-- end: footer -->
<!-- start: custom role js -->
<script src="<?php echo base_url() ?>assets/custom-js/meeting/meeting.js"></script>
<!-- end: footer custom role js -->
 