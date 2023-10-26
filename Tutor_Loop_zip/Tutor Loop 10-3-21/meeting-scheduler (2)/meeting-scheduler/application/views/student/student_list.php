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
                   <div class="form-group">
                          <button class="btn btn-primary btn-sm pull-right text-bold" id="add-btn"><i class="fa fa-plus"></i> ADD STUDENT</button>
                   </div>
                  <table class="table table-bordered" id="datatable_id" width="100%">
                        <thead class="t-thead-color">
                              <tr>
                                    <th width="1%" class="text-center">SN</th>
                                    <th width="25%">Student Name</th>
                                    <th width="15%">Student ID</th>
                                    <th width="20%">Email ID</th>
                                    <th width="15%">Date Of Birth</th>
                                    <th width="5%" class="text-center">Status</th>
                                    <th width="10%" class="text-center">Action</th>
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
<script src="<?php echo base_url() ?>assets/custom-js/student/student.js"></script>
<!-- end: footer custom role js -->
