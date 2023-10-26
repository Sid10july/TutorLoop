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

        <div class="row" style="border-bottom:1px solid #f1f1f1">
        <div class="form-group col-md-10 col-xs-6">
           <h5 class="c-darkblue text-bold">Total Subject : <span class="badge"><?= count($getSubjectData) ?></span> </h5> 
        </div>
         <div class="form-group col-md-2 col-xs-6">
            <button class="btn btn-primary btn-sm pull-right text-bold" id="add-btn"><i class="fa fa-plus"></i> ADD NEW</button>
        </div>
  
        </div>
        <div class="row">
      <div class="col-md-12">
         <?php if(isset($getSubjectData) && count($getSubjectData) > 0) { 

          foreach ($getSubjectData as $key => $value) { ?>
           
         <div class="col-md-4 form-group" id="remove<?= $value->teacher_subject_id ?>">
            <div class="card subject-list">
               <div class="card-body text-center">
                  <h4 class="card-title text-bold"> <i class="fa fa-book"></i> <?= ucfirst($value->subject_name) ?> </h4>
                  <hr>
                  <?php if($value->status==1) { ?>
                     <button type="button" data-id="<?= $value->teacher_subject_id ?>" class="btn btn-success btn-sm text-bold" id="status-btn" title="Change Status">Active</button>
                   <?php } else { ?>
                      <button type="button" data-id="<?= $value->teacher_subject_id ?>" class="btn btn-danger btn-sm text-bold" title="Change Status" id="status-btn">Inactive</button>
                   <?php } ?> 
                  <!-- <button type="button" data-id="<?= $value->subject_id ?>" class="btn btn-default btn-xs" id="edit-btn">Edit</button>
                  <button type="button" data-id="<?= $value->subject_id ?>" class="btn btn-default btn-xs" id="delete-btn">Delete</button> -->
               </div>
            </div>
         </div>
        <?php } } else { ?>

          <div class="alert alert-warning">
            <h4><strong>No subject added..!</strong></h4> 
          </div>


        <?php } ?> 
      </div>
    </div>
      </div>
   </section>
   <!-- end: page -->
</section>
<!-- start: footer -->
<?php $this->load->view('common/footer') ?>
<!-- end: footer -->
<!-- start: custom role js -->
<script src="<?php echo base_url() ?>assets/custom-js/subject/subject.js"></script>
<!-- end: footer custom role js