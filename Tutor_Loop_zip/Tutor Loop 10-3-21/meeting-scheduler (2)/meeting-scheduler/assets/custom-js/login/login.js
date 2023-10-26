$(document).ready(function () {
  
  var site_url = $("#site_url").val();
    /*login submit form ################################################################*/
    $('#login-form').submit(function(e){
           e.preventDefault();         
             
           $("#preloader").show();
            var btn = $("#submit-btn").text();
            btnDisabled("submit-btn");
            btnProcessing("#submit-btn");

            $.ajax({
                type: "POST",
                url: site_url + "/Login/login_action",
                data: $("#login-form").serialize(),
                dataType: "json",
                success: function (response) {
                    

                    if (response.status == 1) {
                        pnSuccess("Login Successful");
                        $("#preloader").show();
                        setTimeout(function () {
                            window.location.href = site_url + "/Dashboard";
                        }, 1500);
                    } else if (response.status == 3) {
                        $("#preloader").hide();
                        btnEnabled("submit-btn");
                        $("#submit-btn").html(btn);
                        pnNotExist("<b>Username or Password Not Matching</b>");
                    } else if (response.status == 0) {
                        $("#preloader").hide();
                        btnEnabled("submit-btn");
                        $("#submit-btn").html(btn);
                        pnnoAjaxRequest();
                    } else {
                        $("#preloader").hide();
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


 /*disable future date*/ 
   $('.dob').datepicker({
        format: 'dd-mm-yyyy',
        endDate: '+0d',
    });

     
/*student sign up form ################################################################*/
    $('#student-sign-up-form ').submit(function(e){
           e.preventDefault();         
             

           var password = $("#password").val();
           var c_password = $("#c_password").val();

           if(password != c_password)
           {
             $("#e_password").removeClass("dhide");
             return false;
           }

            $("#e_password").addClass("dhide");


           $("#preloader").show();
            var btn = $("#submit-btn").text();
            btnDisabled("submit-btn");
            btnProcessing("#submit-btn");

            $.ajax({
                type: "POST",
                url: site_url + "/Login/student_sign_up_action",
                data: $("#student-sign-up-form ").serialize(),
                dataType: "json",
                success: function (response) {
                    

                    if (response.status == 1) {
                        pnSuccess("Student Account Created Successfully");
                        $("#preloader").show();
                        setTimeout(function () {
                            window.location.href = site_url + "/Dashboard";
                        }, 1500);
                    } else if (response.status == 2) {
                        $("#preloader").hide();
                        btnEnabled("submit-btn");
                        $("#submit-btn").html(btn);
                         pnAlreadyExist("Email ID");
                    } else if (response.status == 0) {
                        $("#preloader").hide();
                        btnEnabled("submit-btn");
                        $("#submit-btn").html(btn);
                        pnnoAjaxRequest();
                    } else {
                        $("#preloader").hide();
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
    /*teacher sign up form ################################################################*/
    $('#teacher-sign-up-form ').submit(function(e){
           e.preventDefault();         
             

           var password = $("#password").val();
           var c_password = $("#c_password").val();

           if(password != c_password)
           {
             $("#e_password").removeClass("dhide");
             return false;
           }

            $("#e_password").addClass("dhide");


           $("#preloader").show();
            var btn = $("#submit-btn").text();
            btnDisabled("submit-btn");
            btnProcessing("#submit-btn");

            $.ajax({
                type: "POST",
                url: site_url + "/Login/teacher_sign_up_action",
                data: $("#teacher-sign-up-form ").serialize(),
                dataType: "json",
                success: function (response) {
                    

                    if (response.status == 1) {
                        pnSuccess("Teacher Account Created Successfully");
                        $("#preloader").show();
                        setTimeout(function () {
                            window.location.href = site_url + "/Dashboard";
                        }, 1500);
                    } else if (response.status == 2) {
                        $("#preloader").hide();
                        btnEnabled("submit-btn");
                        $("#submit-btn").html(btn);
                         pnAlreadyExist("Email ID");
                    } else if (response.status == 0) {
                        $("#preloader").hide();
                        btnEnabled("submit-btn");
                        $("#submit-btn").html(btn);
                        pnnoAjaxRequest();
                    } else {
                        $("#preloader").hide();
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
