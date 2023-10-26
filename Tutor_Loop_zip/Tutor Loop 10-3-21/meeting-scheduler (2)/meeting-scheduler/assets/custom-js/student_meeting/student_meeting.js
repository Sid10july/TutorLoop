$(document).ready(function () {
    

    /*site url*/
    var site_url = $("#site_url").val();

    /*disable future date*/ 
   $('.meeting_date').datepicker({
    format: 'dd-mm-yyyy',
    orientation: 'top',
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
            url: site_url + "/Student_meeting/ajax_student_meeting_list",
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
                targets: [0], //first column / numbering column
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