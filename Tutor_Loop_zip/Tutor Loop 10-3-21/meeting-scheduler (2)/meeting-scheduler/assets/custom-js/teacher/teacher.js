$(document).ready(function () {
      /*disable future date*/ 
   $('.dob').datepicker({
    format: 'dd-mm-yyyy',
    endDate: '+0d',
});
    /*site url*/
    var site_url = $("#site_url").val();
    
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
            url: site_url + "/Teacher/ajax_teacher_list",
            type: "POST",
            dataType: "json",
            dataSrc: function (jsonData) {
                return jsonData.data;
            },
        },
        //Set column definition initialisation properties.
        columnDefs: [
            {
                targets: [0], //first column / numbering column
                orderable: false, //set not orderable
            },
        ],
    });
 
    /*add form ####################################################################*/
    $(document).on("click", "#add-btn", function () {

            window.location.href = site_url + "/Teacher/add";

    });

    /*edit form ################################################################## */
    $(document).on("click","#edit-btn",function(){

        var color_id = $(this).attr("data-id");
        $("#preloader").show();
        if(edit_right == 1){
            window.location.href = site_url + "/Color/edit/"+color_id;
        }else{
        $("#preloader").hide();    
             swalNoRights("Edit");
        }
   
     });

    /*delete action ################################################################## */
    /*$(document).on("click","#delete-btn",function(){

        var role_id = $(this).attr("data-id");
        $("#preloader").show();
        if(edit_right == 1){
            window.location.href = site_url + "/Vehicle_model_master/edit/"+role_id;
        }else{
        $("#preloader").hide();    
             swalNoRights("Delete");
        }
   
     });*/

    /*add form validation##########################################################*/
    $('#teacher-form').submit(function(e){
        e.preventDefault();         
          
        var btn = $("#submit-btn").text();
        var btn_text = successText(btn);
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
             url: site_url + "/Teacher/add_edit_action",
             data: $("#teacher-form").serialize(),
             dataType: "json",
             success: function (response) {
                 
                 if (response.status == 1) {
                     pnSuccess(btn_text);
                     $("#preloader").show();
                     setTimeout(function () {
                         window.location.href = site_url + "/Teacher";
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

    /*view page ################################################################## */
    $(document).on("click","#view-btn",function(){

        var color_id = $(this).attr("data-id");
        $("#preloader").show();
        if(view_right == 1){
            window.location.href = site_url + "/Color/view/"+color_id;
        }else{
        $("#preloader").hide();    
             swalNoRights("View");
        }
   
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
                        url: site_url + "/Teacher/change_status_action",
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
