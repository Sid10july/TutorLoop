$(document).ready(function () {
    

    /*site url*/
    var site_url = $("#site_url").val();
    
    /*role rights*/
    var role_right_id = $("#role_right_id").val();
    var view_right = $("#view_right").val();
    var add_right = $("#add_right").val();
    var edit_right = $("#edit_right").val();
    var status_right = $("#status_right").val();
    var delete_right = $("#delete_right").val();

   /*disable future date*/ 
   $('.dob').datepicker({
    format: 'dd-mm-yyyy',
    endDate: '+0d',
    orientation: 'bottom'
    });  
    $('.date_of_joining').datepicker({
        format: 'dd-mm-yyyy',
        orientation: 'bottom'
    });  
     

    /* listing logic ##############################################################*/
    var table;
    var site_url = $("#site_url").val();

    table = $("#datatable_id").DataTable({
        // Processing indicator
        processing: true,
        // DataTables server-side processing mode
        serverSide: true,
        // Initial no order.
        order: [],
        // Load data from an Ajax source
        ajax: {
            url: site_url + "/User/ajax_user_list",
            type: "POST",
            dataType: "json",
            dataSrc: function (jsonData) {
                return jsonData.data;
            },
        },
        //Set column definition initialisation properties.
        columnDefs: [
            {
                targets: [0, 5, 6,], //first column / numbering column
                orderable: false, //set not orderable
            },
        ],
    });

     /*add form ####################################################################*/
    $(document).on("click", "#add-btn", function () {
       
        if(add_right == 1){
            window.location.href = site_url + "/User/add";
        }else{

             swalNoRights("Add");
        }
    });

    /*edit form ################################################################## */
    $(document).on("click","#edit-btn",function(){

        var user_id = $(this).attr("data-id");
        $("#preloader").show();
        if(edit_right == 1){
            window.location.href = site_url + "/User/edit/"+user_id;
        }else{
        $("#preloader").hide();    
             swalNoRights("Edit");
        }
   
     });

    /* user details add/edit form action##########################################################*/
     $('#user-form').submit(function(e){
        event.preventDefault();
            $("#preloader").show();
            var btn = $("#submit-btn").text();
            var btn_text = successText(btn);
            btnDisabled("submit-btn");
            btnProcessing("#submit-btn");

           $.ajax({
            type: "POST",
            url: site_url + "/User/add_edit_action",
            data: $("#user-form").serialize(),
            dataType: "json",
            success: function (response) {
                $("#preloader").hide();

                if (response.status == 1) {
                    pnSuccess(btn_text);
                    setTimeout(function () {
                        window.location.href = site_url + "/User/index/"+role_right_id;
                    }, 3000);
                } else if (response.status == 2) {
                    btnEnabled("submit-btn");
                    $("#submit-btn").html(btn);
                    $("#username").focus();
                    pnAlreadyExist("Username");
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
                 $("#submit-btn").html(btn);
                pnnoResponse();
            },
        });
     });

      /*view page ################################################################## */
    $(document).on("click","#view-btn",function(){

        var user_id = $(this).attr("data-id");
        $("#preloader").show();
        if(view_right == 1){
            window.location.href = site_url + "/User/view/"+user_id;
        }else{
        $("#preloader").hide();    
             swalNoRights("View");
        }
   
    });

     /*change status ################################################################## */
    $(document).on("click","#status-btn",function(){

        var user_id = $(this).attr("data-id");
        $("#preloader").show();
        if(status_right == 1){
            $("#preloader").hide();   
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
                        url: site_url + "/User/change_status_action",
                        data: {"user_id":user_id},
                        dataType: "json",
                        success: function (response) {
                            $("#preloader").hide();

                                swal.close();
                            if (response.status == 1) {
                                pnStatusSuccess();
                                setTimeout(function () {
                                    window.location.href = site_url + "/User/index/"+role_right_id;
                                }, 3000);
                            } else if (response.status == 2) {
                                btnEnabled("submit-btn");
                                $("#submit-btn").html(btn);
                                $("#role_name").focus();
                                pnAlreadyExist();
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
       }else{
            $("#preloader").hide();    
            swalNoRights("Change Status");
        }
   
    });  


    /*bank add/edit form action##########################################################*/
    $('#user-bank-form').submit(function(e){
        event.preventDefault();
            $("#preloader").show();
            var btn = $("#submit-btn-bank").text();
            var btn_text = successText(btn);
            btnDisabled("submit-btn-bank");
            btnProcessing("#submit-btn-bank");

           $.ajax({
            type: "POST",
            url: site_url + "/User/bank_add_edit_action",
            data: $("#user-bank-form").serialize(),
            dataType: "json",
            success: function (response) {
                $("#preloader").hide();

                if (response.status == 1) {
                    pnSuccess(btn_text);
                    setTimeout(function () {
                        window.location.href = site_url + "/User/index/"+role_right_id;
                    }, 3000);
                } else if (response.status == 0) {
                    btnEnabled("submit-btn-bank");
                    $("#submit-btn-bank").html(btn);
                    pnnoAjaxRequest();
                } else {
                    btnEnabled("submit-btn-bank");
                    $("#submit-btn-bank").html(btn);
                    pnserverIssue();
                }
            },
            error: function (response) {
                $("#preloader").hide();
                btnEnabled("submit-btn-bank");
                 $("#submit-btn-bank").html(btn);
                pnnoResponse();
            },
        });
     });


       /* uplods form action##########################################################*/
    $('#user-uploads-form').submit(function(e){
        event.preventDefault();
            $("#preloader").show();
            var btn = $("#submit-btn-uploads").text();
            var btn_text = successText(btn);
           // btnDisabled("submit-btn-uploads");
            btnProcessing("#submit-btn-uploads");

           $.ajax({
            type: "POST",
            url: site_url + "/User/save_user_uploads",
            data:  new FormData($("#user-uploads-form")[0]),
            dataType: "json",
            processData: false, 
            contentType: false,
            success: function (response) {
                $("#preloader").hide();
         
                if (response.status == 1) {
                    pnSuccess(btn_text);
                    setTimeout(function () {
                        window.location.href = site_url + "/User/index/"+role_right_id;
                    }, 3000);
                }
                else if (response.status == 2) {
                    btnEnabled("submit-btn-uploads");
                    $("#submit-btn-uploads").html(btn);
                    pnFileNotAllowed(response.message);
                }  
                else if (response.status == 0) {
                    btnEnabled("submit-btn-uploads");
                    $("#submit-btn-uploads").html(btn);
                    pnnoAjaxRequest();
                } else {
                    btnEnabled("submit-btn-uploads");
                    $("#submit-btn-uploads").html(btn);
                    pnserverIssue();
                }
            },
            error: function (response) {
                $("#preloader").hide();
                btnEnabled("submit-btn-uploads");
                 $("#submit-btn-uploads").html(btn);
                pnnoResponse();
            },
        });
     });

     /*soft delete upload ################################################################## */
     $(document).on("click","#user-upload-delete-btn",function(){

        var user_upload_id = $(this).attr("data-id");
      //  $("#preloader").show();
          
            swal({
                   title: "",
                   text: "Are you sure to delete?",
                   type: "",
                   showCancelButton: true,
                   confirmButtonColor: '00bf4f',
                   confirmButtonText: 'Yes',
                   closeOnConfirm: true,
                   cancelButtonText: 'No',
                 },
                 function(){
                   //$('#preloader').show();
                   /* call ajax */
                   $.ajax({
                        type: "POST",
                        url: site_url + "/User/delete_user_upload_action",
                        data: {"user_upload_id":user_upload_id},
                        dataType: "json",
                        success: function (response) {
                            $("#preloader").hide();

                                swal.close();
                            if (response.status == 1) {
                                   $("#success-delete").removeClass("dhide");
                                   $("#delete-upload"+user_upload_id).hide("slow"); 
                                             
                                setTimeout(function () {
                                    $("#success-delete").addClass("dhide"); 
                                }, 3000);
                            } else if (response.status == 0) {
                                pnnoAjaxRequest();
                            } else {
                                pnserverIssue();
                            }
                        },
                        error: function (response) {
                            pnnoResponse();
                        },
                    });
                 
                 });
    });  

    
});
