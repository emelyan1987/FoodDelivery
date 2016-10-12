<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
 <script src="<?PHP echo base_url(); ?>assets/Administration/editor/ckeditor/ckeditor.js"></script>
  <script src="<?PHP echo base_url();  ?>assets/Administration/editor/ckeditor/samples/js/sample.js"></script>
  <link rel="stylesheet" href="<?PHP  echo base_url();?>assets/Administration/editor/ckeditor/samples/samples.css">
  <link rel="stylesheet" href="<?PHP echo base_url(); ?>assets/Administration/editor/ckeditor/samples/neo.css">

<!-- Content Wrapper. Contains page content -->
<form action="/tearms_conditions/" method="post">

          <div class="content-wrapper">
     <section class="content">
                <div class="row">
                    <div class="col-md-12">
                    <h4 class="border_bottom">Terms and Conditions</h4>  
                    <?PHP echo $this->session->flashdata("msg"); ?>                 
                    <div style="width:80%;">

        <textarea name="tearms" id="editor">
          <?PHP echo $tearms_data['text']; ?>
        </textarea>
       <button  class="btn btn-primary" name="go" type="submit">Submit</button>
  
                    </div>
                    </div>
                 </div>
            </section>
</div>
</div>

</form>


  
<script>
  initSample();
</script>






<?PHP
  $this->load->view("includes/Administration/footer");
?>
<style>

body
{
font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-size: 14px !important;
    line-height: 1.42857143;
    color: #333;
    background-color: #fff;
}

</style>