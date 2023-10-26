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
        <div class="tabs tabs-primary">
        <?php if($btn=='Update') { ?>
          <ul class="nav nav-pills nav-justified" style="border: 0.1px dotted #428bca;border-radius: 7px;">
            <li class="active">
              <a href="#popular10" data-toggle="tab" class="text-center text-bold">Personal Details</a>
            </li>
            <li>
              <a href="#recent10" data-toggle="tab" class="text-center text-bold">Subject-Tutor Details</a>
            </li>
          </ul>
        <?php } ?>
          <div class="tab-content">
            <div id="popular10" class="tab-pane active">
               <form id="student-form" method="post">

              <div class="form-group">
                <a href="<?= site_url('Student'); ?>" class="btn btn-danger btn-xs pull-right text-bold" title="Back">Back</a>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label">Name <span class="required">*</span></label>
                <div class="col-md-3">
                  <input type="text" name="firstname" class="form-control" placeholder="Enter first name" autocomplete="off" required="" onKeyPress="return ValidateAlpha(event);" value="<?= isset($view->firstname) ? $view->firstname : '' ?>">
                </div>
                <div class="col-md-3">
                  <input type="text" name="lastname" class="form-control" placeholder="Enter last name" autocomplete="off" required="" onKeyPress="return ValidateAlpha(event);" value="<?= isset($view->lastname) ? $view->lastname : '' ?>">
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label">Email ID <span class="required">*</span></label>
                <div class="col-md-6">
                  <input type="email" autocomplete="off" name="username" class="form-control" placeholder="Enter email id" required="" value="<?= isset($view->username) ? $view->username : '' ?>">
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label">Date Of Birth <span class="required">*</span></label>
                <div class="col-md-4">
                  <div class="input-group">
                    <input type="text" name="date_of_birth" autocomplete="off" class="form-control dob" placeholder="Choose DOB" required="" value="<?= isset($view->date_of_birth) ? date('d-m-Y',strtotime($view->date_of_birth)) : '' ?>">
                    <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label">Student ID </label>
                <div class="col-md-4">
                  <?php  if($btn=='Add') { ?>
                  <input type="email" autocomplete="off" name="student_id" value="<?= substr(str_shuffle("0123456789"), 0, 5); ?>" readonly="" class="form-control" placeholder="Enter student id" required="" >
                  <?php } else { ?>
                  <input type="email" autocomplete="off" name="student_id" value="<?= isset($view->student_id) ? $view->student_id : '' ?>" readonly="" class="form-control" placeholder="Enter student id" required="" >
                  <?php } ?>
                </div>
              </div>
              <?php if($btn=='Add') { ?>
              <div class="row form-group">
                <label class="col-md-2 control-label">Password <span class="required">*</span></label>
                <div class="col-md-4">
                  <input type="password" name="password" autocomplete="off" id="password" class="form-control" placeholder="Enter password" required="" maxlength="10" minlength="6">
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label">Confirm Password <span class="required">*</span></label>
                <div class="col-md-4">
                  <input type="password" name="c_password" id="c_password" autocomplete="off" class="form-control" placeholder="Enter confirm password" maxlength="10" minlength="6" required="">
                </div>
              </div>
              <div class="row dhide" id="e_password">
                <center> <span class="text-danger text-center">Password and confirm password not matched.</span> </center>
              </div>
              <?php } ?>
              <div class="form-group"><hr></div>
              <div class="row">
                <div class="col-sm-12">
                  <input type="hidden" name="user_id" id="user_id" value="<?= isset($view->user_id) ? $view->user_id : 0 ?>">
                  <button type="submit" id="submit-btn" class="btn btn-primary"><?= $btn ?></button>
                  <a href="<?= site_url('Student'); ?>" class="btn btn-default">Cancel</a>
                </div>
              </div>
              </form>
            </div>
            <div id="recent10" class="tab-pane">
                  <div class="form-group">
                      <a href="<?= site_url('Student'); ?>" class="btn btn-danger btn-xs pull-right text-bold" title="Back">Back</a>
                    </div>
               <div class=" well">
                 <form id="subject-tutor-form" method="post">
                   
                     <div class="row form-group">
                      <div class="col-md-12 ">
                        
                         <span class="text-bold c-darkblue"><h4><i class="fa fa-plus"></i> Add Subject And Tutor</h4></span>
                      
                      </div>
                     </div>
                    <div class="row form-group">
                      
                      <div class="col-md-4">
                        <label class="control-label">Choose Subject Name <span class="required">*</span></label>
                        <select data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1" required=""  name="subject_fid" id="subject_fid">
                          <option value=""></option>
                          <?php foreach ($getSubjectMaster as $key => $value): ?>
                          <option value="<?= $value->subject_id ?>"><?= $value->subject_name ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>

                      <div class="col-md-4">
                        <label class="control-label">Choose Tutor Name <span class="required">*</span></label>
                        <select data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1" required=""  name="teacher_fid" id="teacher_fid">
                          <option value=""></option>
                        </select>
                      </div>
                       <div class="col-md-4" style="margin-top: 27px;">
                           <input type="hidden" name="student_fid" id="student_fid" value="<?= isset($view->user_id) ? $view->user_id : 0 ?>">
                        <button type="submit" id="st-submit-btn" class="btn btn-primary">Save Changes</button>
                        <a href="<?= site_url('Student'); ?>" class="btn btn-default">Cancel</a>
                       </div>
                    </div>
      
                  </form>
                </div>
                  
                  <div class="row form-group">
                     
                   <div class="col-md-12">
                     
                       <span class="text-bold c-darkblue"><h4><i class="fa fa-list"></i> Subject And Tutor List</h4></span>
                     
                   </div>  

                  <div class="col-md-12">
                    <div class="table-responsive">

                      <table class="table table-bordered">
                              <thead style="background: #f1f1f1">
                                <tr>
                                  <th width="2px">Sr.No.</th>
                                  <th>Subject Name</th>
                                  <th>Tutor Name</th>
                                  <th width="6px">Status</th>
                                  <th width="2px">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $sr=0; foreach ($getStudentSubjectTutorList as $key => $value) { ?>
                                 
                                   <tr>
                                    <td><?= ++$sr; ?></td>
                                    <td><?= $value->subject_name ?></td>
                                    <td><?= ucfirst($value->teacherfirstname)." ".ucfirst($value->teacherlastname) ?></td>
                                    <td>
                                  <?php  if ($value->status==1) { ?>
                                    <button data-id="<?= $value->student_teacher_subject_id ?>" type="button" class="btn btn-success btn-xs" id="st-status-btn" title="Change Status">Active</button>
                                  <?php  } else { ?>
                                    <button data-id ="<?= $value->student_teacher_subject_id ?>" type="button" class="btn btn-danger btn-xs" id="st-status-btn" title="Change Status">Inactive</button>
                                  <?php } ?>
                                    </td>
                                    <td class="text-center">
                                       <button data-id ="<?= $value->student_teacher_subject_id ?>" type="button" class="btn btn-default btn-xs" id="st-delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                  </tr>

                               <?php  } ?>
                                
                              </tbody>
                            </table>
                      
                    </div>
                  </div>

               </div>

            </div>
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
<script src="<?php echo base_url() ?>assets/custom-js/student/student.js"></script>
<!-- end: footer custom role js -->