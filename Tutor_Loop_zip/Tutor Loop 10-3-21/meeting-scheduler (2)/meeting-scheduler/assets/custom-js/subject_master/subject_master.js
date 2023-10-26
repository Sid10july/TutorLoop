$(document).ready(function () {
    
    /*site url*/
    var site_url = $("#site_url").val();
    
     /*disable future date*/ 
   $('.dob').datepicker({
        format: 'dd-mm-yyyy',
        endDate: '+0d',
    });

 
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
            url: site_url + "/Subject_master/ajax_subject_master_list",
            type: "POST",
            dataType: "json",
            dataSrc: function (jsonData) {
                return jsonData.data;
            },
        },
        //Set column definition initialisation properties.
        columnDefs: [
            {
                targets: [0,3], //first column / numbering column
                orderable: false, //set not orderable
            },
        ],
    });
 
     
    /*add form ####################################################################*/
    $(document).on("click", "#add-btn", function () {
         
            window.location.href = site_url + "/Subject_master/add";
        
    });

    /*edit form ################################################################## */
    $(document).on("click","#edit-btn",function(){

        var subject_id = $(this).attr("data-id");
        $("#preloader").show();
        
            window.location.href = site_url + "/Subject_master/edit/"+subject_id;
      
   
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

     
    /*submit form ################################################################*/
   /*student sign up form ################################################################*/
    $('#subject-master-form').submit(function(e){
           e.preventDefault();         
             
           
           $("#preloader").show();
            var btn = $("#submit-btn").text();
            var btn_text = successText(btn);
            btnDisabled("submit-btn");
            btnProcessing("#submit-btn");

            $.ajax({
                type: "POST",
                url: site_url + "/Subject_master/add_edit_action",
                data: $("#subject-master-form").serialize(),
                dataType: "json",
                success: function (response) {
                    

                    if (response.status == 1) {
                        pnSuccess(btn_text);
                        $("#preloader").show();
                        setTimeout(function () {
                            window.location.href = site_url + "/Subject_master";
                        }, 1500);
                    } else if (response.status == 2) {
                        $("#preloader").hide();
                        btnEnabled("submit-btn");
                        $("#submit-btn").html(btn);
                         pnAlreadyExist("Subject name");
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
    
    /*change student status ################################################################## */
    $(document).on("click","#status-btn",function(){

        var subject_id = $(this).attr("data-id");
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
                        url: site_url + "/Subject_master/change_status_action",
                        data: {"subject_id":subject_id},
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


    /*soft delete for student ################################################################## */
     $(document).on("click","#delete-btn",function(){

        var subject_id = $(this).attr("data-id");
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
                        url: site_url + "/Subject_master/delete_subject_master",
                        data: {"subject_id":subject_id},
                        dataType: "json",
                        success: function (response) {
                            $("#preloader").hide();

                                swal.close();
                            if (response.status == 1) {
                                pnDeleteSuccess();
                                 setTimeout(function () {
                                    location.reload()
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

