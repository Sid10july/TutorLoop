<!DOCTYPE html>
<html class="fixed">
    <head>
        <title>Meeting Scheduler Login</title>
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

    </head>
    <body style="background: url('<?= base_url('assets/images/p1.jpg') ?>');  background-repeat: no-repeat fixed; ">
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
                    <div class="panel-title-sign mt-xl text-right">
                    <h4 class="label label-primary text-bold" style="font-size:20px;">Meeting Scheduler</h4> <!-- <h2 class="title text-uppercase text-bold m-none">  <i class="fa fa-user mr-xs"></i>   </h2> -->
                    </div>
                    <div class="panel-body">
                        <form id="login-form" method="post">
                            <div class="form-group mb-lg">
                                <label>Username</label>
                                <div class="input-group input-group-icon">
                                    <input name="username" type="email" class="form-control input-lg" required="" placeholder="Enter Username" />
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mb-lg">
                                <div class="clearfix">
                                    <label class="pull-left">Password</label>
                                    <!-- <a href="pages-recover-password.html" class="pull-right">Lost Password?</a> -->
                                </div>
                                <div class="input-group input-group-icon">
                                    <input name="password" type="password" class="form-control input-lg" required="" placeholder="Enter Password" />
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="checkbox-custom checkbox-default">
                                        <!-- <input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label> -->
                                    </div>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <button type="submit" class="btn btn-primary btn-block text-bold" id="submit-btn">Login</button>
                                   <!--  <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" id="submit-btn">Sign In</button> -->
                                </div>
                            </div>
                            
							<span class="mt-lg mb-lg text-center">
								<hr>
							</span>

							<p class="text-center">Don't have an account yet? Sign Up!</p>
							<div class="mb-xs text-center">
								<a class="btn btn-warning mb-md ml-xs mr-xs" href="<?= site_url('Login/student_signup') ?>"><i class="fa fa-user"></i> Student</a>
								<a class="btn btn-warning mb-md ml-xs mr-xs" href="<?= site_url('Login/teacher_signup') ?>"><i class="fa fa-user"></i> Tutor</a>
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
