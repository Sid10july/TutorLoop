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

 
    /* listing logic ##############################################################*/
    var table;
    table = $("#datatable_id").DataTable({
        // Processing indicator
        processing: true,
        // DataTables server-side processing mode
        serverSide: true,
        // Initial no order.
        order: [],
        // Load data from an Ajax source
        ajax: {
            url: site_url + "/Role/ajax_role_list",
            type: "POST",
            dataType: "json",
            dataSrc: function (jsonData) {
                return jsonData.data;
            },
        },
        //Set column definition initialisation properties.
        columnDefs: [
            {
                targets: [0, 2, 3], //first column / numbering column
                orderable: false, //set not orderable
            },
        ],
    });
 
     
    /*add form ####################################################################*/
    $(document).on("click", "#add-btn", function () {
       
        if(add_right == 1){
            window.location.href = site_url + "/Role/add";
        }else{

             swalNoRights("Add");
        }
    });

    /*edit form ################################################################## */
    $(document).on("click","#edit-btn",function(){

        var role_id = $(this).attr("data-id");
        $("#preloader").show();
        if(edit_right == 1){
            window.location.href = site_url + "/Role/edit/"+role_id;
        }else{
        $("#preloader").hide();    
             swalNoRights("Edit");
        }
   
     });


    /*delete action ################################################################## */
    $(document).on("click","#delete-btn",function(){

        var role_id = $(this).attr("data-id");
        $("#preloader").show();
        if(edit_right == 1){
            window.location.href = site_url + "/Role/edit/"+role_id;
        }else{
        $("#preloader").hide();    
             swalNoRights("Delete");
        }
   
     });

    /*add form validation##########################################################*/
    $("#submit-btn").click(function (event) {
        event.preventDefault();
        var isValid = 1;

        $("#error_alpha").addClass("dhide");
        $("#role_name").parents(".form-group").removeClass("has-error");

        if ($("#role_name").val().trim() == "") {
            isValid = 0;
            $("#role_name").parents(".form-group").addClass("has-error");
            $("#error_alpha").removeClass("dhide");
            $("#error_alpha").html("Enter role name").show();
        } else if (!validateName($("#role_name").val().trim())) {
            isValid = 0;
            $("#role_name").parents(".form-group").addClass("has-error");
            $("#error_alpha").removeClass("dhide");
            $("#error_alpha").html("Only alphabets are allowed").show();
        }

        if (isValid) {
            submit_form();
        }
    });
    /*submit form ################################################################*/
    function submit_form() {
        $("#preloader").show();
        var btn = $("#submit-btn").text();
        var btn_text = successText(btn);
        btnDisabled("submit-btn");
        btnProcessing("#submit-btn");

        $.ajax({
            type: "POST",
            url: site_url + "/Role/add_edit_action",
            data: $("#role-form").serialize(),
            dataType: "json",
            success: function (response) {
                $("#preloader").hide();

                if (response.status == 1) {
                    pnSuccess(btn_text);
                    setTimeout(function () {
                        window.location.href = site_url + "/Role/index/"+role_right_id;
                    }, 3000);
                } else if (response.status == 2) {
                    btnEnabled("submit-btn");
                    $("#submit-btn").html(btn);
                    $("#role_name").focus();
                    pnAlreadyExist("Role");
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
    }

    /*view page ################################################################## */
    $(document).on("click","#view-btn",function(){

        var role_id = $(this).attr("data-id");
        $("#preloader").show();
        if(view_right == 1){
            window.location.href = site_url + "/Role/view/"+role_id;
        }else{
        $("#preloader").hide();    
             swalNoRights("View");
        }
   
    });
    
    /*change status ################################################################## */
    $(document).on("click","#status-btn",function(){

        var role_id = $(this).attr("data-id");
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
                        url: site_url + "/Role/change_status_action",
                        data: {"role_id":role_id},
                        dataType: "json",
                        success: function (response) {
                            $("#preloader").hide();

                                swal.close();
                            if (response.status == 1) {
                                pnStatusSuccess();
                                setTimeout(function () {
                                    window.location.href = site_url + "/Role/index/"+role_right_id;
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
});
