<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
    <div class="content-wrapper">
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if($this->uri->segment('2') == 'web')
                        {
                        ?>
                        
            <form action="" method="post">
                    <h4 class="border_bottom">PUSH NOTIFICATION - WEB</h4>                   
                    <?php 
                    if(isset($success_web_msg))
                    {
                        echo '<span class="text-green" >'.$success_web_msg.'</span>';
                    }
                    ?>
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody><tr><td>NOTIFICATION</td>
                        <td><textarea id="TextArea1" rows="2" cols="20" placeholder="Enter Msg" name="notification"></textarea>
                            <br>
                            <span style="color:red"><?PHP  echo form_error('notification'); ?></span>
                        </td></tr>
                    <tr><td width="20%">TIME:</td>
                        <td><input  type="text" style="width:60%;" id="note_time1" name="time" value="" placeholder="H:M">

                        </td></tr>
                    <tr><td width="20%">DATE:</td>
                        <td><input  type="text" style="width:60%;" name="date" placeholder="yyyy-mm-dd" id="datepicker" >
                            <br>
                            <span style="color:red"><?PHP  echo form_error('date'); ?></span>
                        <input  type="hidden" style="width:60%;" name="type" value="1" >
                        <span style="color:red"><?PHP  echo form_error('type'); ?></span>
                        </td></tr>
                    
                    </tbody></table> 
                    </div>
                    <input type="submit" class="btn bg-gray-light2" value="Apply" name="btnweb">
                    <div class="clear_h20"></div>
             </form>   
                        <?php
                        }

                        if($this->uri->segment('2') == 'app')
                        {
                        ?>
             <form action="" method="post">    
                    <h4 class="border_bottom">PUSH NOTIFICATION - APP</h4>                   
                    <?php 
                    if(isset($success_app_msg))
                    {
                        echo '<span class="text-green" >'.$success_app_msg.'</span>';
                    }
                    ?>
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody><tr><td>NOTIFICATION</td>
                        <td><textarea id="TextArea1" rows="2" placeholder="Enter Msg" cols="20" name="notification1"></textarea>
                        <br>
                        <span style="color:red"><?PHP  echo form_error('notification1'); ?></span>
                        </td></tr>
                    <tr><td width="20%">TIME:</td>
                        <td><input  type="text" style="width:60%;" id="note_time2" name="time1" value="" placeholder="H:M"></td></tr>
                    <tr><td width="20%">DATE:</td>
                        <td><input  type="text" style="width:60%;" placeholder="yyyy-mm-dd" name="date1" id="datepicker1">
                            <br>
                            <span style="color:red"><?PHP  echo form_error('date1'); ?></span>
                        <input  type="hidden" style="width:60%;" name="type1" value="2" >
                        <span style="color:red"><?PHP  echo form_error('type1'); ?></span>
                    </td></tr>
                    
                    </tbody></table> 
                    </div>
                    <input type="submit" class="btn bg-gray-light2" value="Apply" name="btnapp">
                    </div>
                 </div>
             </form>
                        <?php
                        }
                        ?>
            </section>
        </div>

<?PHP
  $this->load->view("includes/Administration/footer");
?>


<script>

                $(function() {
                    $('#note_time1').timepicker();
                });
				
			$(function() {
                    $('#note_time2').timepicker();
                });
				

  $(function() {
    $( "#datepicker" ).datepicker({
    format: 'yyyy-mm-dd'
});

  });

  $(function() {
    
    $( "#datepicker1" ).datepicker({
    format: 'yyyy-mm-dd'
});
  });

  </script>