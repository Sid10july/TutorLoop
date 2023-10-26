<!--start: header css -->
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
         <div class="row">
            <div class="form-group col-md-10 col-xs-6">
               <h5 class="c-darkblue text-bold">Note : Selected days will disabled while creating meeting, in <span class="c-black">Meeting Mgmt Section</span></h5> 
            </div>
            <!--  <div class="form-group col-md-2 col-xs-6">
                <button class="btn btn-primary btn-sm pull-right text-bold" id="add-btn"><i class="fa fa-plus"></i> ADD NEW</button>
            </div> -->
            
            </div>
            <?php if($flag==1) { ?>
            <div class="row">
               <div class="col-md-12">
                   <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Data save successfully..!</strong> 
              </div>
            </div>
            </div>
          <?php } ?>  
         <form method="post" action="<?= site_url('Leaves/save_leaves_days') ?>">
          <div class="row">
 
            <div class="col-md-12">
               
               <div class="col-md-4 form-group">
                  <div class="card subject-list">
                     <div class="card-body text-center">
                        <h4 class="card-title text-bold">
                           <div class="checkbox-custom checkbox-default">
                              <input type="checkbox" name="leave_days[]" value="0" <?php if(in_array(0, $leave_days)) {  echo "checked"; } ?> >
                              <label><i class="fa fa-calendar"></i> Sunday</label>
                           </div>
                        </h4>
                     </div>
                  </div>
               </div>

               <div class="col-md-4 form-group">
                  <div class="card subject-list">
                     <div class="card-body text-center">
                        <h4 class="card-title text-bold">
                           <div class="checkbox-custom checkbox-default">
                              <input type="checkbox" name="leave_days[]" value="1" <?php if(in_array(1, $leave_days)) {  echo "checked"; } ?>>
                              <label><i class="fa fa-calendar"></i> Monday</label>
                           </div>
                        </h4>
                     </div>
                  </div>
               </div>

               <div class="col-md-4 form-group">
                  <div class="card subject-list">
                     <div class="card-body text-center">
                        <h4 class="card-title text-bold">
                           <div class="checkbox-custom checkbox-default">
                              <input type="checkbox" name="leave_days[]" value="2" <?php if(in_array(2, $leave_days)) {  echo "checked"; } ?>>
                              <label><i class="fa fa-calendar"></i> Tuesday</label>
                           </div>
                        </h4>
                     </div>
                  </div>
               </div>

               <div class="col-md-4 form-group">
                  <div class="card subject-list">
                     <div class="card-body text-center">
                        <h4 class="card-title text-bold">
                           <div class="checkbox-custom checkbox-default">
                              <input type="checkbox" name="leave_days[]" value="3" <?php if(in_array(3, $leave_days)) {  echo "checked"; } ?>>
                              <label><i class="fa fa-calendar"></i> Wednesday</label>
                           </div>
                        </h4>
                     </div>
                  </div>
               </div>
               
               <div class="col-md-4 form-group">
                  <div class="card subject-list">
                     <div class="card-body text-center">
                        <h4 class="card-title text-bold">
                           <div class="checkbox-custom checkbox-default">
                              <input type="checkbox" name="leave_days[]" value="4" <?php if(in_array(4, $leave_days)) {  echo "checked"; } ?>>
                              <label><i class="fa fa-calendar"></i> Thursday</label>
                           </div>
                        </h4>
                     </div>
                  </div>
               </div>

               <div class="col-md-4 form-group">
                  <div class="card subject-list">
                     <div class="card-body text-center">
                        <h4 class="card-title text-bold">
                           <div class="checkbox-custom checkbox-default">
                              <input type="checkbox" name="leave_days[]" value="5" <?php if(in_array(5, $leave_days)) {  echo "checked"; } ?>>
                              <label><i class="fa fa-calendar"></i> Friday</label>
                           </div>
                        </h4>
                     </div>
                  </div>
               </div>

               <div class="col-md-4 form-group">
                  <div class="card subject-list">
                     <div class="card-body text-center">
                        <h4 class="card-title text-bold">
                           <div class="checkbox-custom checkbox-default">
                              <input type="checkbox" name="leave_days[]" value="6" <?php if(in_array(6, $leave_days)) {  echo "checked"; } ?>>
                              <label><i class="fa fa-calendar"></i> Saturday</label>
                           </div>
                        </h4>
                     </div>
                  </div>
               </div>

               <div class="col-md-12 form-group">
                <hr>
                <button class="btn btn-primary bold pull-right" type="submit">Save Leave Days</button>
               </div>


            </div>
          </div>
         </form>
      </div>
   </section>
   <!-- end: page -->
</section>
<!-- start: footer -->
<?php $this->load->view('common/footer') ?>
<!-- end: footer -->
 