 <?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
 <div class="content-wrapper">
     <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add New Plan 

                 </h3>
                 <?pHP
                 if(isset($success))
                 {
                  ?>
                 <div class="alert alert-success">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:black">&times;</a>
                  <strong><?PHP echo isset($success)?$success:""; ?></strong>
                </div>
                <?pHP } ?>

                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action='/edit_plan/' enctype ="multipart/form-data">
                  <div class="box-body">

                  	<div class="form-group">
                      <label for="exampleInputEmail1">Plan Name</label>
                      <input type="text" name="plan_name" class="form-control" id="exampleInputEmail1" placeholder="Enter plan name " value="<?PHP echo set_value('plan_name') ?>">
                    <span style="color:red"><?PHP  echo form_error('plan_name'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Amount</label>
                      <input type="text" name="plan_amount" class="form-control" id="exampleInputEmail1" placeholder="Enter plan amount" value="<?PHP echo set_value('plan_amount') ?>">
                     <span style="color:red"><?PHP  echo form_error('plan_amount'); ?></span>
                   
                    </div >
                    <div class="form-group">
                      <label for="exampleInputEmail1">Details</label>
                     <textarea name="plan_detail"  class="form-control" id="exampleInputEmail1" placeholder="Enter plan detail"> <?PHP echo set_value('plan_detail') ?>  </textarea>
                    <span style="color:red"><?PHP  echo form_error('plan_detail'); ?></span>
                    </div> 

                   <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update Plan</button>
                  </div>
                </form>
              </div><!-- /.box -->
          </div>

      </div>
  </section>
</div>
</div>

<?PHP
  $this->load->view("includes/Administration/footer");
?>