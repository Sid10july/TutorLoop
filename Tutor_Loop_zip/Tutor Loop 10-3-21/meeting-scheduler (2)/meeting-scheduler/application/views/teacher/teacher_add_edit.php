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
        
          <div class="tab-content">
            <div id="popular10" class="tab-pane active">
               <form id="teacher-form" method="post">

              <div class="form-group">
                <a href="<?= site_url('Teacher'); ?>" class="btn btn-danger btn-xs pull-right text-bold" title="Back">Back</a>
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
<script src="<?php echo base_url() ?>assets/custom-js/teacher/teacher.js"></script>
<!-- end: footer custom role js -->