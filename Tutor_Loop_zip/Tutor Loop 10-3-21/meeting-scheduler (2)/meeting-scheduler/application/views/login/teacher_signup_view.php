<!DOCTYPE html>
<html class="fixed">
   <head>
      <title>Meeting Scheduler Sign Up</title>
      <!-- Basic -->
      <meta charset="UTF-8" />
      <meta name="keywords" content="Automobile Admin Login" />
      <meta name="description" content="Automobile Admin Login" />
      <meta name="author" content="Automobile Admin Login" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <!-- Web Fonts  -->
      <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css"> -->
      <!-- Vendor CSS -->
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/font-awesome/css/font-awesome.css" />
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
      <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/magnific-popup/magnific-popup.css" /> -->
      <!-- Theme CSS -->
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/theme.css" />
      <!-- Skin CSS -->
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/skins/default.css" />
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/pnotify/pnotify.custom.css" />
      <!-- Theme Custom CSS -->
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/theme-custom.css">
      <!-- Head Libs -->
      <script src="<?php echo base_url() ?>assets/vendor/modernizr/modernizr.js"></script>
      <!-- custom css -->
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/custom-css/my_custom_css.css">
      <style type="text/css">
         .body-sign .center-sign {
         display: block !important;
         padding-top: 45px !important;
         }
         .body-sign{
         max-width: 600px !important;
         }
      </style>
   </head>
   <body>
      <div id="preloader"></div>
      <!-- start: page -->
      <section class="body-sign">
         <div class="center-sign">
            <a href="<?= site_url('Login') ?>" class="logo pull-left">
               <!-- <img src="<?php echo base_url() ?>assets/images/auto-logo.jpeg" height="60" width="130" alt="Automobile Admin" /> -->
               <!-- <div class="sidebar-title" style="margin-top:49px;">
                  <h4 class="label label-primary text-bold" style="font-size:20px;">Meeting Scheduler</h4>
                  </div> -->
            </a>
            <div class="panel panel-sign">
               <div class="panel-title-sign text-right">
                  <h4 class="label label-primary text-bold" style="font-size:20px;">Meeting Scheduler</h4>
                  <!-- <h2 class="title text-uppercase text-bold m-none">  <i class="fa fa-user mr-xs"></i>   </h2> -->
               </div>
               <div class="panel-body">
                  <h4 class="text-center text-bold">Tutor Sign Up</h4>
                  <hr>
                  <form id="teacher-sign-up-form" method="post">
                     <div class="row form-group">
                        <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                        <div class="col-md-4">
                           <input type="text" name="firstname" class="form-control" placeholder="Enter first name" autocomplete="off" required="" onKeyPress="return ValidateAlpha(event);">
                        </div>
                        <div class="col-md-4">
                           <input type="text" name="lastname" class="form-control" placeholder="Enter last name" autocomplete="off" required="" onKeyPress="return ValidateAlpha(event);">
                        </div>
                     </div>
                     <div class="row form-group">
                        <label class="col-md-3 control-label">Email ID <span class="required">*</span></label>
                        <div class="col-md-8">
                           <input type="email" autocomplete="off" name="username" class="form-control" placeholder="Enter email id" required="">
                        </div>
                     </div>
                     <div class="row form-group">
                        <label class="col-md-3 control-label">Date Of Birth <span class="required">*</span></label>
                        <div class="col-md-8">
                           <div class="input-group">
                              <input type="text" name="date_of_birth" autocomplete="off" class="form-control dob" placeholder="Choose DOB" required="">
                              <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                              </span>
                           </div>
                        </div>
                     </div>
                    <!--  <div class="row form-group">
                        <label class="col-md-3 control-label">Student ID </label>
                        <div class="col-md-8">
                           <input type="email" autocomplete="off" name="student_id" value="<?= substr(str_shuffle("0123456789"), 0, 5); ?>" readonly="" class="form-control" placeholder="Enter student id" required="">
                        </div>
                     </div> -->
                     <div class="row form-group">
                        <label class="col-md-3 control-label">Password <span class="required">*</span></label>
                        <div class="col-md-8">
                           <input type="password" name="password" autocomplete="off" id="password" class="form-control" placeholder="Enter password" required="" maxlength="10" minlength="6">
                        </div>
                     </div>
                     <div class="row form-group">
                        <label class="col-md-3 control-label">Confirm Password <span class="required">*</span></label>
                        <div class="col-md-8">
                           <input type="password" name="c_password" id="c_password" autocomplete="off" class="form-control" placeholder="Enter confirm password" maxlength="10" minlength="6" required="">
                        </div>
                     </div>
                      <div class="row dhide" id="e_password">
                       <center> <span class="text-danger text-center">Password and confirm password not matched.</span> </center>
                      </div>
                     <!-- <div class="row">
                        <div class="col-sm-7">
                          <div class="checkbox-custom checkbox-default">
                            <input id="RememberMe" name="rememberme" type="checkbox"/>
                              <label for="RememberMe">Remember Me</label>
                          </div>
                        </div>
                        <div class="col-sm-5 text-right">
                          <button type="submit" class="btn btn-warning btn-block text-bold" id="submit-btn">Create Now</button>
                           <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" id="submit-btn">Sign In</button>
                        </div>
                        </div> -->
                     <span class="mt-lg mb-lg text-center">
                        <hr>
                     </span>
                     <!-- <p class="text-center">Don't have an account yet? Sign Up!</p> -->
                     <div class="mb-xs text-center">
                        <button type="submit" id="submit-btn" class="btn btn-primary mb-md ml-xs mr-xs text-bold"> Create Now</button>
                        <a class="btn btn-default mb-md ml-xs mr-xs text-bold" href="<?= site_url('Login') ?>"><i class="fa fa-sign-in"></i> Back To Login</a>
                     </div>
                  </form>
               </div>
            </div>
            <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2020-2021. All rights reserved.</p>
         </div>
      </section>
      <!-- end: page -->
   </body>
   <!-- start: footer -->
   <?php $this->load->view('common/footer') ?>
   <!-- end: footer -->
   <!-- start: custom login js -->
   <script src="<?php echo base_url() ?>assets/custom-js/login/login.js"></script>
   <!-- end: footer custom login js -->
</html>