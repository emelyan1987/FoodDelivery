<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
    <div class="content-wrapper">
<section class="content">
                <div class="row">
                    <div class="col-md-12">
            <form action="" method="post">
                    <h4 class="border_bottom">SMTP Setup</h4>                   
                    <?php 
                    if(isset($success_msg))
                    {
                        echo '<span class="text-green" >'.$success_msg.'</span>';
                    }
                    ?>
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody>
                        <tr><td width="20%">Hostname:</td>
                            <td><input  type="text" style="width:60%;" name="host_name" placeholder="Hostname" value="<?php echo $smtp_data['host_name']; ?>">
                                <br>
                                <span style="color:red"><?PHP  echo form_error('host_name'); ?></span>
                            
                            </td>
                        </tr>
                        <tr><td width="20%">Username:</td>
                            <td><input  type="email" style="width:60%;" name="username" placeholder="Username" value="<?php echo $smtp_data['username']; ?>">
                                <br>
                                <span style="color:red"><?PHP  echo form_error('username'); ?></span>
                            
                            </td>
                        </tr>
                        <tr><td width="20%">Password:</td>
                            <td><input  type="text" style="width:60%;" name="password" placeholder="Password"  value="<?php echo $smtp_data['password']; ?>">
                                <br>
                                <span style="color:red"><?PHP  echo form_error('password'); ?></span>
                            
                            </td>
                        </tr>
                        <tr><td width="20%">SMTP Secure:</td>
                            <td><input  type="text" style="width:60%;" name="smtp_secure" placeholder="SMTP Secure"   value="<?php echo $smtp_data['smtp_secure']; ?>">
                                <br>
                                <span style="color:red"><?PHP  echo form_error('smtp_secure'); ?></span>
                            
                            </td>
                        </tr>
                        <tr><td width="20%">PORT:</td>
                            <td><input  type="text" style="width:60%;" name="smtp_port"  placeholder="SMTP PORT" value="<?php echo $smtp_data['smtp_port']; ?>">
                                <br>
                                <span style="color:red"><?PHP  echo form_error('smtp_port'); ?></span>
                            
                            </td>
                        </tr>
                        <tr><td width="20%">Email From:</td>
                            <td><input  type="email" style="width:60%;" name="email_from" placeholder="Email From" value="<?php echo $smtp_data['smtp_port']; ?>">
                                <br>
                                <span style="color:red"><?PHP  echo form_error('email_from'); ?></span>
                            
                            </td>
                        </tr>
                        <tr><td width="20%">From Name:</td>
                            <td><input  type="text" style="width:60%;" name="from_name" placeholder="From Name" value="<?php echo $smtp_data['from_name']; ?>">
                                <br>
                                <span style="color:red"><?PHP  echo form_error('from_name'); ?></span>
                            
                            </td>
                        </tr>
                    </tbody></table> 
                    </div>
                    <input type="submit" class="btn bg-gray-light2" value="Save" name="btnsave">
                    <div class="clear_h20"></div>
             </form>   
            
            </section>
        </div>

<?PHP
  $this->load->view("includes/Administration/footer");
?>


<script>
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