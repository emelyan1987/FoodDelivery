<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<section class="content">
          <div class="row">
            <div class="col-xs-12">
         <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List Of Restaurants</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Owner</th>
                        <th>Hotel</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        
                        <th>Services</th>
                        <th>Room Type</th>
                        <th>Food Type</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($owner_restro_list as $ks => $vs): ?>                    
                               
                    <tr>
                        <td><?php echo $vs->username;?></td>
                        <td><?php echo $vs->restro_name;?></td>
                        <td><?php echo $vs->restro_country;?></td>
                        <td><?php echo $vs->restro_state;?></td>
                        <td><?php echo $vs->restro_city;?></td>
                        
                        <td><?php echo $vs->restro_services;?></td>
                        <td><?php echo $vs->restro_type;?></td>
                        <td><?php echo $vs->restro_food_type;?></td>
                        <td><?php if($vs->status==1) { echo "Active"; } else { echo "Deactive"; } ?>
                        </td>
                        <td><a href="">Edit</a>|<a href="">Delete</a></td>
                        
                    </tr>
                    <?PHP

                    endforeach;

                    ?>
                                           
                         
                                          </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
</div>
<?PHP
  $this->load->view("includes/Restaurant_Owner/footer");
?>
