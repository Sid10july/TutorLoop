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
						<h2>Student Dashboard</h2>
					
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
					
					<?php if (isset($getStudentMeeting) AND count($getStudentMeeting) == 0 ) { ?>
						 
						<div class="row">
							 <div class="alert alert-warning">
								<marquee><strong>No meeting assigned yet by the tutor.</strong></marquee> 
							</div>
						</div>	
 					
 					<?php } ?>

					<!-- student calendar start -->
					<div class="row bg-white pd-15">
						 
						
						<div class="col-md-12 col-lg-12 col-xl-6">
						<div class="row">
					<div class="col-md-12 form-group">
                 	 <div class="col-md-6 text-center ">
                   	 <span class="badge" style="background:darkblue">Total Hours Today : <?= number_format($studenTodayHourCount,2)." Hrs" ?></span> 
                  	</div>
					  <div class="col-md-6 text-center">
                   	 <span class="badge" style="background:darkblue">Average Hours  : <?= number_format($studenAvgHourCount,2)." Hrs" ?></span> 
                  	</div>
              		 </div>
					</div>
					<br>
							<div class="row">

									<div id='calendar'></div>

								 
							</div>
						</div>
					</div>
					<!-- student calendar end -->
					 
				</section>
			 

	 <!-- start: footer -->
<?php $this->load->view('common/footer') ?>
 
<script src="<?php echo base_url() ?>assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/fullcalendar/fullcalendar.js"></script>
 <!-- end: footer -->
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
				
				<?php foreach ($getStudentMeeting as $meeting) { ?>
				{
					title: "<?php echo $meeting->subject_name; ?> : (<?php echo $meeting->ms_start_time; ?> To <?php echo $meeting->ms_end_time; ?>) \n Tutor: <?php echo $meeting->tutor_name ?>",
					start: "<?php echo $meeting->ms_meeting_date; ?>"
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