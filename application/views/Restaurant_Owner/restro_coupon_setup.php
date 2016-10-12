<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->


<section class="content">
  <form action="" method="post" >
                <div class="row">
                    <div class="col-md-12">
                      <a href="/restro_coupon_show" class="btn bg-gray-light2">&lt; &nbsp;Back to coupon list</a>
                    <h4 class="border_bottom">Setup Coupons</h4>                   

                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody>
                        <tr>
                          <td width="20%">COUPON CODE:</td>
                          <td colspan="4"><input id="Text12" type="text" name="coupon_code" placeholder="COUPON CODE"></td>
                        </tr>
                        <tr>
                          <td>VALIDITY DATE:</td>
                          <td width="80">FROM:</td>
                          <td><input id="datepicker" type="text" name="from_date" placeholder="YYYY-MM-DD"></td>
                          <td width="80">TO:</td>
                          <td><input id="datepicker1" type="text" name="to_date" placeholder="YYYY-MM-DD"> </td>
                        </tr>
                        <tr>
                          <td>COUPON DISCOUNT:</td>
                          <td >
                            <select name="coupon_type">
                                <option value='1'>Fixed Amount</option>
                                <option value='2'>% Amount</option>
                            </select>
                          </td>
                          <td ><input id="Text16" type="text"  class="text-right" name="discount" style="width:90%" ></td>
                        </tr>
                        <tr>
                          <td colspan="5">MY LOCATION</td>
                        </tr>
                        <tr>
                          <td colspan="5">
						  
						  <?php
            foreach($location as $lo=> $loc):
            ?>
			<input id="Radio2" type="radio" name="location_id" value="<?php echo $loc->id; ?>"> &nbsp; <span><?php echo ucwords($loc->location_name); ?></span> &nbsp;  &nbsp;
            
            <?php
           
            endforeach;
            ?>                           
                          </td>
                        </tr>
                    </tbody></table> 
                    </div>
                    <button type="submit" class="btn btn-success" name="btnsave">Save</button>
                    
                    </div>
                 </div>
               </form>
            </section>
</div>
<?PHP
  $this->load->view("includes/Restaurant_Owner/footer");
?>


<script>
  $(function() {
    var dateToday = new Date();
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd',minDate: dateToday });

  });

  $(function() {
    var dateToday = new Date();
    $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd',minDate: dateToday });
  });

  </script>
<script>
  function showState(str){
    

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {

     document.getElementById("state").innerHTML = xhttp.responseText;
      }
    };
    xhttp.open("GET","/show_state/"+str, true);
    xhttp.send();
  }
</script>

<script>
    function showCity(str){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {

              document.getElementById("city").innerHTML = xhttp.responseText;
        }
      };
      xhttp.open("GET","/show_city/"+str, true);
      xhttp.send();
    }
</script>