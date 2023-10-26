$(document).ready(function () {
    

    /*site url*/
   var site_url = $("#site_url").val();
    

   var leave_days = '"'+$("#leave_days").val()+'"';
    
   /*disable future date*/ 
   $('.meeting_date').datepicker({
    format: 'dd-mm-yyyy',
    startDate: '-0m',
    orientation: 'top',
    daysOfWeekDisabled: leave_days
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
            url: site_url + "/Meeting/ajax_meeting_list",
            type: "POST",
            dataType: "json",
            dataSrc: function (jsonData) {
                return jsonData.data;
            },
            "data": function ( data ) {
                data.subject_fid = $('#subject_fid').val();
                data.teacher_fid = $('#teacher_fid').val();
                data.meeting_date = $('#meeting_date').val();
                 
            }
        },
        //Set column definition initialisation properties.
        columnDefs: [
            {
                targets: [0, 7], //first column / numbering column
                orderable: false, //set not orderable
            },
        ],
    });

    $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });
    $('#btn-reset').click(function(){ //button reset event click
       location.reload()
        table.ajax.reload();  //just reload table
    });
     /*add form ####################################################################*/
    $(document).on("click", "#add-btn", function () {
        
        window.location.href = site_url + "/Meeting/add";
        
    });
 
    /*edit form ################################################################## */
    $(document).on("click","#edit-btn",function(){

        var meeting_id = $(this).attr("data-id");

        window.location.href = site_url + "/Meeting/edit/"+meeting_id;
        
     });

    /* user details add/edit form action##########################################################*/
     $('#meeting-form').submit(function(e){
        event.preventDefault();
        $("#error_time").html("");
        
        $("#participants-error").addClass("dhide"); 
         

        var strStartTime =  document.getElementById("start_time").value;
     
        var strEndTime = document.getElementById("end_time").value;
    
        var startTime = new Date().setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
        var endTime = new Date(startTime)
        endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);
        if (startTime > endTime) {
            
            $("#error_time").html("Start Time is greater than end time");
            return false;
        }
        if (startTime == endTime) {
           
            $("#error_time").html("Start Time equals end time");
            return false;
        }
        /* if (startTime < endTime) {
            alert("Start Time is less than end time");
        } */


            $("#preloader").show();
            var btn = $("#submit-btn").text();
            var btn_text = successText(btn);
            btnDisabled("submit-btn");
            btnProcessing("#submit-btn");

           $.ajax({
            type: "POST",
            url: site_url + "/Meeting/add_edit_action",
            data: $("#meeting-form").serialize(),
            dataType: "json",
            success: function (response) {
                $("#preloader").hide();

                if (response.status == 1) {
                    pnSuccess(btn_text);
                    setTimeout(function () {
                        window.location.href = site_url + "/Meeting";
                    }, 3000);
                } else if (response.status == 2) {
                    btnEnabled("submit-btn");
                    $("#submit-btn").html(btn);
                    $("#participants-error").removeClass("dhide");
                    $("#participants-error").addClass("appear-animation flash appear-animation-visible");
                    $("#append-duplicate-participants").html(response.duplicateHtml);
                    
                   // pnAlreadyExist("Meeting");
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

        var meeting_id = $(this).attr("data-id");
         
            window.location.href = site_url + "/Meeting/view/"+meeting_id;
        
   
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

    /*get teacher name by subject*/
    $("#subject_fid").on('change',function(){
        var subject_fid = $("#subject_fid").val();
            
            $('#teacher_fid').val("").trigger('change');
            $("#preloader").show();
             $.ajax({
                type: "POST",
                url: site_url + "/Student/get_subject_tutor_list",
                data: {"subject_fid":subject_fid},
                dataType: "json",
                success: function (response) {
                   $("#preloader").hide();
    
                    if (response.status == 1) {
                        
                       $("#teacher_fid").html(response.html);
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

       /*get student name by teacher id*/
    $("#teacher_fid").on('change',function(){
        var teacher_fid = $("#teacher_fid").val();
        var subject_fid = $("#subject_fid").val();
           
            $('#student_fid').val(" ").trigger('change');

            if(teacher_fid > 0 && subject_fid > 0)

            {
            $("#preloader").show();
             $.ajax({
                type: "POST",
                url: site_url + "/Student/get_student_by_teacher_list",
                data: {"teacher_fid":teacher_fid,"subject_fid":subject_fid},
                dataType: "json",
                success: function (response) {
                   $("#preloader").hide();
    
                    if (response.status == 1) {
                        
                       $("#student_fid").html(response.html);
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
         }
    
        }); 

    
      
});

function GetHours(d) {
    var h = parseInt(d.split(':')[0]);
    if (d.split(':')[1].split(' ')[1] == "PM") {
        h = h + 12;
    }
    return h;
}
function GetMinutes(d) {
    return parseInt(d.split(':')[1].split(' ')[0]);
}
