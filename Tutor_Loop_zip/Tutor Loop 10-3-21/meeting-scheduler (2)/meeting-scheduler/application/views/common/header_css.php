<?php 

/*after logout if we press browser back button then it will redirect to login form*/
if (!isset($_SESSION['logged_in'])) {
	redirect('Login','refresh');
 } 

?>

<!doctype html>
<html class="fixed">
 	<head>
 		<!-- Basic -->
		<meta charset="UTF-8">

		<title><?= $main_title; ?></title>
		<meta name="keywords" content="Calendar Meeting" />
		<meta name="description" content="Calendar Meeting">
		<meta name="author" content="Calendar Meeting">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css"> -->

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />
		<!-- sweet alert -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/sweet-alert/sweetalert.css">

		<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/font-awesome/css/font-awesome.css" />
		<!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/magnific-popup/magnific-popup.css" /> -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/owl-carousel/owl.carousel.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/owl-carousel/owl.theme.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" /> -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/pnotify/pnotify.custom.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/morris/morris.css" /> -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />



		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="<?php echo base_url() ?>assets/vendor/modernizr/modernizr.js"></script>

		
		<!-- custom css -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/custom-css/my_custom_css.css">
 
	</head>
	<body>
		<section class="body">

		<div id="preloader"></div>	