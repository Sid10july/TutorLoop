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
      <h2><?= $page_title ?></h2>
   </header>
   <!-- start: page -->
   <div class="row">
      <section class="panel panel-featured panel-featured-primary">
         <header class="panel-heading">
            <h2 class="panel-title"> <span title="Meeting-Subject Name"> <b><?= isset($view[0]->subject_name) ? ucfirst($view[0]->subject_name) : '' ?></b></span>
               <a href="<?= site_url('Meeting'); ?>" class="btn btn-danger btn-xs text-bold pull-right" title="Back">Back</a>
            </h2>
         </header>
         <div class="panel-body">
                  <h6 class="text-bold c-brown"><span>Meeting Details :</span></h6>
                <div class="table-responsive">
                      <table class="table table-bordered table-padding-12">
                        <thead>
                          <tr>
                            <th width="50%">Tutor Name : <span class="c-darkblue"><?= isset($view[0]->teacherfirst_name) ? ucfirst($view[0]->teacherfirst_name." ".$view[0]->teacherlastname) : '-' ?></span> </th>
                            <th width="50%">Meeting Date : <span class="c-darkblue"><?= isset($view[0]->meeting_date) ? date('d M Y',strtotime($view[0]->meeting_date)) : '-' ?></span> </th>
                            
                          </tr>
                          <tr>
                            <th width="50%">Meeting Time : <span class="c-darkblue"><?= isset($view[0]->start_time) ? ucfirst($view[0]->start_time." -- ".$view[0]->end_time) : '-' ?></span> </th>
                            <th width="50%">Reminder Time : <span class="c-darkblue"><?= isset($view[0]->reminder_time) ? $view[0]->reminder_time." - Minutes" : '-' ?></span> </th>
                          </tr>
                          <tr>
                            <th width="50%">Total Participants : <span class="c-darkblue"><?= isset($view[0]->total_student) ? $view[0]->total_student." (Students)" : '-' ?></span> </th>
                            
                            <th width="50%">Status : 
                             <?php if(isset($view[0]->status) && $view[0]->status==1) { ?>
                                  <label class="label label-success">Active</label>
                            <?php } else { ?>
                                  <label class="label label-danger">Inactive</label>
                            <?php } ?> 
                             </th>
                          </tr>
                         
                          <tr>
                            <th width="50%">Meeting Created By : <span class="c-darkblue"><?= isset($view[0]->createdfirst_name) ? ucfirst($view[0]->createdfirst_name." ".$view[0]->createdlastname)." <small>(Tutor)</small>" : '-' ?></span></th>
                            <th width="50%">Meeting Created On : <span class="c-darkblue"><?= isset($view[0]->created_on) ? date('d-M-Y / g:i A',strtotime($view[0]->created_on)) : '' ?></th>
                          </tr>
                                                   

                        </thead>
                       </table>
                    </div>
                    <hr>
                     <h6 class="text-bold c-brown"><span>Meeting Participants Details :</span></h6>
                    <div class="well well-sm">
                     <div class="owl-carousel" data-plugin-carousel data-plugin-options='{ "autoPlay": 3000, "items": 6, "itemsDesktop": [1199,4], "itemsDesktopSmall": [979,3], "itemsTablet": [768,2], "itemsMobile": [479,1] }'>
                    
                      <?php foreach ($view as $key => $value) { ?>
                      <center>
                      <div class="item spaced"><img class="img-thumbnail img-round img-responsive" src="<?= base_url('assets/uploads/user/'.$value->profile_img) ?>" style="width: 300px; height: 120px;" alt="Participants Image">
                        <span title="Student Name" class="text-bold"><?= ucfirst($value->studentfirst_name)." ".ucfirst($value->studentlastname); ?> </span>
                      </div>
                      </center>  
                       <?php } ?>
                    </div>
                    </div>
         </div>
      </section>
   </div>
</section>
<!-- start: footer -->
<?php $this->load->view('common/footer') ?>
<!-- end: footer -->