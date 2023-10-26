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
            <h2><?=$page_title ?></h2>
      </header>
      <!-- start: page -->
      <section class="panel custom_panel_margin">
            
            <div class="panel-body">
                  <!-- for student only -->
                  <?php if($_SESSION['role_fid'] == 4) { ?>
                     <div class="form-group">
                            <button class="btn btn-primary btn-sm pull-right text-bold" id="add-btn"><i class="fa fa-plus"></i> ADD NEW REQUEST</button>
                     </div>
                  <?php } ?>
                  <!-- for tutor only -->
                   <?php if($_SESSION['role_fid'] == 3) { ?>
                  <div class="form-group well well-sm">
                 <form id="form-filter" method="post" action="<?= site_url('student_meeting_request/export_request_meeting') ?>">
                     <div class="form-group col-md-3">
                        <label class="control-label">Meeting Name</label>
                             <select data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1" name="subject_fid" id="subject_fid" placeholder="Choose meeting name">
                               <option value=""></option>
                               <?php foreach ($getSubjectMaster as $key => $value): ?>
                               <option value="<?= $value->subject_id ?>" ><?= ucfirst($value->subject_name) ?></option>
                               <?php endforeach ?>
                            </select>
                            <span> <small>All Subject List</small> </span>
                      </div>
                      <div class="form-group col-md-3">
                        <label class="control-label">Tutor Name</label>
                             <select data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1"  name="teacher_fid" id="teacher_fid" placeholder="Choose tutor name">
                               <option value=""></option>
                               <?php foreach ($getTutors as $key => $value): ?>
                               <option value="<?= $value->user_id ?>" ><?= ucfirst($value->firstname)." ".ucfirst($value->lastname) ?></option>
                               <?php endforeach ?>
                            </select>
                            <span> <small>After selecting meeting tutor will show</small> </span>
                      </div>
                      <div class="form-group col-md-3">
                        <label class="control-label">Meeting Date</label>
                              <div class="input-group">
                             <input type="text" autocomplete="off" name="meeting_date" id="meeting_date" class="form-control meeting_date" placeholder="Choose Meeting Date" value="<?= isset($view->meeting_date) ? date('d-m-Y',strtotime($view->meeting_date)) : '' ?>">
                             <span class="input-group-addon">
                             <i class="fa fa-calendar"></i>
                             </span>
                          </div>
                      </div>
                       <div class="form-group col-md-3">
                        <label class="control-label">Status</label>
                             <select data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1" name="status" id="status" placeholder="Choose status">
                     
                              <option value=""></option>
                              <option value="0">Requested</option>
                             <option value="3">Approved</option>
                              <option value="4">Rejected</option>
                            </select>
                      </div>
                     
                    <div class="form-group col-md-12">
                        
                            <button type="button" id="btn-filter" class="btn btn-info btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                         
                            <button type="submit" class="btn btn-success btn-sm" title="Export To Excel"> <i class="fa fa-file-excel-o"></i> Export</button>

                            <button type="button" id="btn-reset" class="btn btn-danger btn-sm" title="Reset"><i class="fa fa-refresh"></i> Reset</button>
                        
                    </div>
                    
                     
                </form>

            </div>

         <?php } ?>
                  <table class="table table-bordered" id="datatable_id" width="100%">
                        <thead class="t-thead-color">
                              <tr>
                                    <th width="1%" class="text-center">SN</th>
                                    <th width="20%">Meeting Name </th>
                                    <th width="15%">Tutor Name</th>
                                    <th width="15%">Student Name</th>
                                    <th width="13%">Meeting Date</th>
                                   <!--  <th width="18%">Meeting Time</th>
                                    <th width="8%" class="text-center">Reminder</th>
                                    <th width="4%" class="text-center">Participants</th> -->
                                    <th width="10%">Status</th>
                                    <?php if($_SESSION['role_fid'] == 3){ ?>
                                    <th width="13%" class="text-center">Action</th>
                                    <?php } ?>
                              </tr>
                        </thead>
                        <tbody>
                              <!-- data coming from ajax server side -->
                        </tbody>
                  </table>
            </div>
      </section>
      <!-- end: page -->
</section>



<!-- start: footer -->
<?php $this->load->view('common/footer') ?>
<!-- end: footer -->

<!-- start: custom role js -->
<script src="<?php echo base_url() ?>assets/custom-js/student_meeting_request/student_meeting_request.js"></script>
<!-- end: footer custom role js -->
