<!-- start: header css -->
<?php $this->load->view('common/header_css') ?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/fullcalendar/fullcalendar.css" />
<!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/fullcalendar/fullcalendar.print.css" /> -->

<!-- end: header css -->
<!-- start: header -->
<?php $this->load->view('common/header') ?>
<!-- end: header -->
<!-- start: sidebar -->
<?php $this->load->view('common/sidebar') ?>
<!-- end: sidebar -->

<section role="main" class="content-body">
   <header class="page-header">
      <h2>Tutor Dashboard</h2>
      <!-- <div class="right-wrapper pull-right">
         <ol class="breadcrumbs">
         	<li>
         		<a href="index.html">
         			<i class="fa fa-home"></i>
         		</a>
         	</li>
         	<li><span>Dashboard</span></li>
         </ol>
         
         <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
         </div> -->
   </header>

   
 
   <!-- tutor calendar start -->
      
      <div class="row bg-white pd-15">
                   
         <div class="col-md-12 col-lg-12 col-xl-6">
            <div class="row">
               <div class="row">
               <div class="col-md-12 form-group">
                  <div class="col-md-6 text-center">
                    <span class="badge" style="background:darkblue">Total Hours Today : <?= number_format($tutorTodayHourCount,2)." Hrs" ?></span>
                  </div>
                  <div class="col-md-6 text-center">
                    <span class="badge" style="background:darkblue">Average Hours : <?= number_format($teacherAvgHourCount,2)." Hrs" ?></span>
                  </div>
               </div>

               <div class="col-md-12 form-group">
                   <canvas id="myChart" class="subject-list" style="max-height:350px;width:100%;max-width:900px"></canvas>
                </div>

      <div class="col-md-4">
         <a href="<?= site_url('Meeting') ?>">
         <section class="panel">
            <div class="panel-body bg-primary">
               <div class="widget-summary widget-summary-xs">
                  <div class="widget-summary-col widget-summary-col-icon">
                     <div class="summary-icon bg-primary">
                        <i class="fa fa-calendar"></i>
                     </div>
                  </div>
                  <div class="widget-summary-col">
                     <div class="summary">
                     
                           <h4 class="title">Total Meetings <span class="badge c-darkblue bg-default text-bold fz-16"> <?= isset($toalTutorMeetings) ? count($toalTutorMeetings) : '0' ?></span></h4>
                       
                     </div>
                  </div>
               </div>
            </div>
         </section>
       </a>
      </div>
      <div class="col-md-4">
        <a href="<?= site_url('Student_meeting_request') ?>">
         <section class="panel">
            <div class="panel-body bg-warning">
               <div class="widget-summary widget-summary-xs">
                  <div class="widget-summary-col widget-summary-col-icon">
                     <div class="summary-icon bg-primary">
                        <i class="fa fa-calendar-o"></i>
                     </div>
                  </div>
                  <div class="widget-summary-col">
                     <div class="summary">
                        
                           <h4 class="title">Requested Meetings <span class="badge c-darkblue bg-default text-bold fz-16"> <?= isset($toalTutorRequestMeetings) ? count($toalTutorRequestMeetings) : '0' ?></span></h4>
                      
                     </div>
                  </div>
               </div>
            </div>
         </section>
       </a>
      </div>
      <div class="col-md-4">
          <a href="<?= site_url('Subject') ?>">
         <section class="panel">
            <div class="panel-body bg-success">
               <div class="widget-summary widget-summary-xs">
                  <div class="widget-summary-col widget-summary-col-icon">
                     <div class="summary-icon bg-primary">
                        <i class="fa fa-book"></i>
                     </div>
                  </div>
                  <div class="widget-summary-col">
                     <div class="summary">
                        
                           <h4 class="title">My Subjects <span class="badge c-darkblue bg-default text-bold fz-16"><?= isset($getTutorSubjectData) ? count($getTutorSubjectData) : '0' ?></span></h4>
                      
                     </div>
                  </div>
               </div>
            </div>
         </section>
          </a>
      </div>
   </div>

                  <div id='calendar'></div>
                 
            </div>
         </div>
      </div>

   <!-- tutor calendar end -->
<input type="hidden" id="mychartDate" value="<?= date("M-Y") ?>">



<input type="hidden" id="cZeroDay" value="<?= $currentDateDay ?>">
<input type="hidden" id="cZeroCount" value="<?= $currentDateData ?>">

<input type="hidden" id="cOneDay" value="<?= $currentDateDayOne ?>">
<input type="hidden" id="cOneCount" value="<?= $currentDateDataOne ?>">

<input type="hidden" id="cTwoDay" value="<?= $currentDateDayTwo ?>">
<input type="hidden" id="cTwoCount" value="<?= $currentDateDataTwo ?>">

<input type="hidden" id="cThreeDay" value="<?= $currentDateDayThree ?>">
<input type="hidden" id="cThreeCount" value="<?= $currentDateDataThree ?>">

<input type="hidden" id="cFourDay" value="<?= $currentDateDayFour ?>">
<input type="hidden" id="cFourCount" value="<?= $currentDateDataFour ?>">

<input type="hidden" id="cFiveDay" value="<?= $currentDateDayFive ?>">
<input type="hidden" id="cFiveCount" value="<?= $currentDateDataFive ?>">
  
<input type="hidden" id="cSixDay" value="<?= $currentDateDaySix ?>">
<input type="hidden" id="cSixCount" value="<?= $currentDateDataSix ?>"> 

 

</section>
<!-- start: footer -->
<?php $this->load->view('common/footer') ?>

<script src="<?php echo base_url() ?>assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/fullcalendar/fullcalendar.js"></script>
 <!-- end: footer -->

 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript">
      

(function( $ ) {

   'use strict';
 
   var initCalendar = function() {


      var $calendar = $('#calendar');
      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
  
      $calendar.fullCalendar({
         header: {
            left: 'title',
            right: 'prev,today,next,basicDay,basicWeek,month'
         },

         timeFormat: 'h:mm',

         titleFormat: {
            month: 'MMMM YYYY',      // September 2009
             week: "MMM d YYYY",      // Sep 13 2009
             day: 'dddd, MMM d, YYYY' // Tuesday, Sep 8, 2009
         },

         themeButtonIcons: {
            prev: 'fa fa-caret-left',
            next: 'fa fa-caret-right',
         },
          

         editable: false,
         droppable: false, // this allows things to be dropped onto the calendar !!!
         eventLimit: true, // allow "more" link when too many event
         eventLimitText: 'more',
  eventLimitClick: 'popover',
  dayPopoverFormat: 'LL',

 


          
         events: [
            
            <?php foreach ($getTutorMeetingData as $meeting) { ?>
            {
               title: "<?php echo $meeting->subject_name; ?> : (<?php echo $meeting->start_time; ?> To <?php echo $meeting->end_time; ?>) \n Participants : <?php echo $meeting->total_student ?>",
               start: "<?php echo $meeting->meeting_date; ?>"
            },

            <?php } ?>
             
         ],
            
      });
      


      // FIX INPUTS TO BOOTSTRAP VERSIONS
      var $calendarButtons = $calendar.find('.fc-header-right > span');
      $calendarButtons
         .filter('.fc-button-prev, .fc-button-today, .fc-button-next')
            .wrapAll('<div class="btn-group mt-sm mr-md mb-sm ml-sm"></div>')
            .parent()
            .after('<br class="hidden"/>');

      $calendarButtons
         .not('.fc-button-prev, .fc-button-today, .fc-button-next')
            .wrapAll('<div class="btn-group mb-sm mt-sm"></div>');

      $calendarButtons
         .attr({ 'class': 'btn btn-sm btn-default' });
   };

   $(function() {

      initCalendar();
      //initCalendarDragNDrop();


   });

}).apply(this, [ jQuery ]);
</script>

<!-- <script type="text/javascript">
   
      
      $('#calendar').fullCalendar({
         header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
         },
         defaultDate: '2014-09-12',
         editable: false,
         eventLimit: true, // allow "more" link when too many events
         events: [
            {
               title: 'Long Event',
               start: '2014-09-07',
               end: '2014-09-10',
            url: 'https://google.com/'
            },
            {
               id: 999,
               title: 'Repeating Event',
               start: '2014-09-09'
            },
        {
               id: 999,
               title: 'nitin Event',
               start: '2014-09-09'
            },
         {
               id: 999,
               title: 'nitin Event',
               start: '2014-09-09'
            },
         {
               id: 999,
               title: 'nitin Event',
               start: '2014-09-09'
            },
         {
               id: 999,
               title: 'nitin Event',
               start: '2014-09-09'
            },
            {
               id: 999,
               title: 'Repeating Event',
               start: '2014-09-16T16:00:00'
            },
            {
               title: 'Conference',
               start: '2014-09-11',
               end: '2014-09-13'
            },
            {
               title: 'Meeting',
               start: '2014-09-12T10:30:00',
               end: '2014-09-12T12:30:00'
            },
            {
               title: 'Lunch',
               start: '2014-09-12T12:00:00'
            },
            {
               title: 'Meeting',
               start: '2014-09-12T14:30:00'
            },
            {
               title: 'Happy Hour',
               start: '2014-09-12T17:30:00'
            },
            {
               title: 'Dinner',
               start: '2014-09-12T20:00:00'
            },
            {
               title: 'Birthday Party',
               start: '2014-09-13T07:00:00'
            }
         ],

        eventClick: function(event) {
          if (event.url) {
            $.magnificPopup.open({
                items: {                    
                  iframe: event.url,
                  type: 'iframe'
                }
         
            });
          }
        }
      
      });
      

</script> -->

<script>

var cZeroDay = $("#cZeroDay").val();
var cZeroCount = $("#cZeroCount").val();


var cOneDay = $("#cOneDay").val();
var cOneCount = $("#cOneCount").val();

var cTwoDay = $("#cTwoDay").val();
var cTwoCount = $("#cTwoCount").val();

var cThreeDay = $("#cThreeDay").val();
var cThreeCount = $("#cThreeCount").val();

var cFourDay = $("#cFourDay").val();
var cFourCount = $("#cFourCount").val();

var cFiveDay = $("#cFiveDay").val();
var cFiveCount = $("#cFiveCount").val();

var cSixDay = $("#cSixDay").val();
var cSixCount = $("#cSixCount").val();


var xValues = [cZeroDay, cOneDay, cTwoDay, cThreeDay, cFourDay, cFiveDay, cSixDay];
var yValues = [cZeroCount,cOneCount, cTwoCount, cThreeCount, cFourCount, cFiveCount, cSixCount];
var barColors = ["red", "green","blue","orange","brown","pink","black"];
var d = $("#mychartDate").val();
 
new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues

    }]
  },

  options: {

    legend: {display: false},
    title: {
      display: true,
      text: "Current Week Meeting Chart - "+d
    },

      scales: {
        yAxes: [{
            display: true,
            ticks: {
                beginAtZero: true,   // minimum value will be 0.
               // <=> //
               min: 0,
               max: 10,
               stepSize: 1 // 1 - 2 - 3 ...
            }
        }]
    }
  }
});
</script>