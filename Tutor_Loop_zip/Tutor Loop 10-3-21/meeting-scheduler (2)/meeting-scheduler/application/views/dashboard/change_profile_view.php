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
      <h2>Change Profile</h2>
   </header>
   <!-- start: page -->
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-body">
               <div class="box box-info">
                  <div class="box-body">
                     <div class="col-sm-12">
                        <div class="col-sm-2">
                           <div title="Profile Image"  align=""> <img alt="My Profile Pic" src="<?= base_url('assets/uploads/user/'.$_SESSION['profile_img']) ?>" id="profile-image1" class="img-circle img-responsive" style="width:120px; height: 115px;"> 
                           </div>
                        </div>
                        <div class="col-sm-5">
                           <h3 class="text-bold" title="Full Name" style="color:#00b1b1;"><?= ucfirst($_SESSION['firstname'])." ".ucfirst($_SESSION['lastname']) ?></h3>
                           <span title="Date Of Birth">
                              <p><?= date('d M Y',strtotime($_SESSION['date_of_birth'])) ?></p>
                           </span>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br>
                     <div class="col-md-12">
                        <div class="tabs tabs-primary" style="background: #f1f1f1">
                           <ul class="nav nav-tabs nav-justified">
                              <li class="active">
                                 <a href="#popular10" data-toggle="tab" class="text-center text-bold">Personal Details</a>
                              </li>
                              <li>
                                 <a href="#recent10" data-toggle="tab" class="text-center text-bold">Change Password</a>
                              </li>
                           </ul>
                           <div class="tab-content">
                              <div id="popular10" class="tab-pane active">
                           	 <form id="profile-form" method="post" enctype="multipart/form-data">
                                 <div style="margin-top: 15px;"></div>
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
                                 	 <label class="col-md-2 control-label">Profile Image</label>
                                 	  <div class="col-md-8">
				                        <div class="fileupload fileupload-new" data-provides="fileupload">
				                           <div class="input-append">
				                              <div class="uneditable-input">
				                                 <i class="fa fa-file fileupload-exists"></i>
				                                 <span class="fileupload-preview"></span>
				                              </div>
				                              <span class="btn btn-default btn-file">
				                              <span class="fileupload-exists">Change</span>
				                              <span class="fileupload-new">Select file</span>
				                              <input type="file" name="profile_img" id="profile_img" accept="image/*">
				                              </span>
				                              <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
				                           </div>
				                        </div>
				                    </div>
                                 </div>
                                 <hr>
                                 <div class="row form-group">
                                    <div class="col-sm-12">
                                       <input type="hidden" name="old_profile_img" id="old_profile_img" value="<?= isset($view->profile_img) ? $view->profile_img : 0 ?>">
                                       <input type="hidden" name="user_id" id="user_id" value="<?= isset($view->user_id) ? $view->user_id : 0 ?>">
                                       <button type="submit" id="profile-submit-btn" class="btn btn-primary">Save Changes</button>
                                       <a href="<?= site_url('Dashboard/change_profile'); ?>" class="btn btn-default">Cancel</a>
                                    </div>
                                 </div>
                            </form>
                              </div>
                              <div id="recent10" class="tab-pane">
                            <form id="password-form" method="post">
                                 <div style="margin-top: 15px;"></div>
                                 <div class="row form-group">
                                    <label class="col-md-2 control-label">Old Password <span class="required">*</span></label>
                                    <div class="col-md-4">
                                       <input type="password" name="password" autocomplete="off" id="password" class="form-control" placeholder="Enter old password" required="" maxlength="10" minlength="6">
                                    </div>
                                 </div>
                                 <div class="row form-group">
                                    <label class="col-md-2 control-label">New Password <span class="required">*</span></label>
                                    <div class="col-md-4">
                                       <input type="password" name="new_password" autocomplete="off" id="new_password" class="form-control" placeholder="Enter new password" required="" maxlength="10" minlength="6">
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
                                 <div class="row form-group">
                                    <div class="col-sm-12">
                                       <input type="hidden" name="user_id" id="user_id" value="<?= isset($view->user_id) ? $view->user_id : 0 ?>">
                                       <button type="submit" id="password-submit-btn" class="btn btn-primary">Save Changes</button>
                                       <a href="<?= site_url('Dashboard/change_profile'); ?>" class="btn btn-default">Cancel</a>
                                    </div>
                                 </div>
                          </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- start: footer -->
<?php $this->load->view('common/footer') ?>
<script type="text/javascript">
	$(document).ready(function () {
    
    /*site url*/
    var site_url = $("#site_url").val();
    
     /*disable future date*/ 
   $('.dob').datepicker({
        format: 'dd-mm-yyyy',
        endDate: '+0d',
    });

  
     
   /*submit form ################################################################*/
   /*update Profile personal details ################################################################*/
    $('#profile-form').submit(function(e){
           e.preventDefault();         
             
           var btn = $("#submit-btn").text();
           var btn_text = successText(btn);
            
           $("#preloader").show();
           var btn = $("#profile-submit-btn").text();
           btnDisabled("profile-submit-btn");
           btnProcessing("#profile-submit-btn");

            $.ajax({
                type: "POST",
                url: site_url + "/Dashboard/update_user_profile",
                data:  new FormData($("#profile-form")[0]),
                dataType: "json",
                processData: false, 
                contentType: false,
                success: function (response) {
                    
			        if (response.status == 1) {
                        pnSuccess("Profile updated successfully..!");
                        $("#preloader").show();
                        setTimeout(function () {
                            window.location.href = site_url + "/Dashboard/change_profile";
                        }, 1500);
                    } else if (response.status == 2) {
                        $("#preloader").hide();
                        btnEnabled("profile-submit-btn");
                        $("#profile-submit-btn").html(btn);
                         pnAlreadyExist("Email ID");
                    } else if (response.status == 0) {
                        $("#preloader").hide();
                        btnEnabled("profile-submit-btn");
                        $("#profile-submit-btn").html(btn);
                        pnnoAjaxRequest();
                    } else {
                        $("#preloader").hide();
                        btnEnabled("profile-submit-btn");
                        $("#profile-submit-btn").html(btn);
                        pnserverIssue();
                    }
                },
                error: function (response) {
                    $("#preloader").hide();
                    btnEnabled("submit-btn");
                    pnnoResponse();
                },
            });
        }); 
 
    /*submit form ################################################################*/
   /*update Profile personal details ################################################################*/
    $('#password-form').submit(function(e){
           e.preventDefault();         
             
           var btn = $("#submit-btn").text();
           var btn_text = successText(btn);

           var new_password = $("#new_password").val();
           var c_password = $("#c_password").val();

           if(new_password != c_password)
           {
             $("#e_password").removeClass("dhide");
             return false;
           }

            $("#e_password").addClass("dhide");

            
           $("#preloader").show();
           var btn = $("#password-submit-btn").text();
           btnDisabled("password-submit-btn");
           btnProcessing("#password-submit-btn");

            $.ajax({
                type: "POST",
                url: site_url + "/Dashboard/update_user_profile_password",
                data:  $("#password-form").serialize(),
                dataType: "json",
                success: function (response) {
                    
			        if (response.status == 1) {
                        pnSuccess("Password updated successfully..!");
                        $("#preloader").show();
                        setTimeout(function () {
                            window.location.href = site_url + "/Login/logout";
                        }, 1500);
                     } else if (response.status == 2) {
                        $("#preloader").hide();
                        btnEnabled("password-submit-btn");
                        $("#password-submit-btn").html(btn);
                         pnNotExist("<b>Old password in not matched..!</b>");
                    }else if (response.status == 0) {
                        $("#preloader").hide();
                        btnEnabled("password-submit-btn");
                        $("#password-submit-btn").html(btn);
                        pnnoAjaxRequest();
                    } else {
                        $("#preloader").hide();
                        btnEnabled("password-submit-btn");
                        $("#password-submit-btn").html(btn);
                        pnserverIssue();
                    }
                },
                error: function (response) {
                    $("#preloader").hide();
                    btnEnabled("submit-btn");
                    pnnoResponse();
                },
            });
        }); 


    /*change status ################################################################## */
    $(document).on("click","#status-btn",function(){

        var user_id = $(this).attr("data-id");
        
             
            swal({
                   title: "",
                   text: "Are you sure to change status?",
                   type: "",
                   showCancelButton: true,
                   confirmButtonColor: '00bf4f',
                   confirmButtonText: 'Yes',
                   closeOnConfirm: true,
                   cancelButtonText: 'No',
                 },
                 function(){
                   $('#preloader').show();
                   /* call ajax */
                   $.ajax({
                        type: "POST",
                        url: site_url + "/Student/change_status_action",
                        data: {"user_id":user_id},
                        dataType: "json",
                        success: function (response) {
                            $("#preloader").hide();

                                swal.close();
                            if (response.status == 1) {
                                pnStatusSuccess();
                                setTimeout(function () {
//                                    window.location.href = site_url + "/Color/index/"+role_right_id;
                                location.reload();
                                }, 3000);
                            } else if (response.status == 0) {
                                btnEnabled("submit-btn");
                                $("#submit-btn").html(btn);
                                pnnoAjaxRequest();
                            } else {
                                btnEnabled("submit-btn");
                                $("#submit-btn").html(btn);
                                pnserverIssue();
                            }
                        },
                        error: function (response) {
                            $("#preloader").hide();
                            btnEnabled("submit-btn");
                            pnnoResponse();
                        },
                    });
                 
                 });
        
    });


    
});

</script>