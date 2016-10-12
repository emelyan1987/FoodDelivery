<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<section class="content">
	<form role="form" method="post" action='' enctype ="multipart/form-data" >
                <div class="row">
                    <div class="col-md-12">
                    <a href="/manage_my_restro_list/" class="btn bg-gray-light2">&lt; &nbsp;Back to Add Restaurant</a>
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">Location Name 1</h4>                   

                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody>
                    	<tr>
                    		<td width="20%">NAME:</td>
                        	<td colspan="2"><input id="Text12" type="text" name="location_name"></td>
                       	</tr>
                    	<tr>
                    		<td>CONTACT PERSON:</td>
                        	<td colspan="2"><input id="Text15" type="text" ></td>
                        </tr>
                    	<tr>
                    		<td>TELEPHONES:</td>
                        	<td colspan="2"><input id="Text16" type="text"></td>
                        </tr>
                    	<tr>
                    		<td>LATITUDE &amp; LONGITUDE:</td>
                        	<td><input id="Text14" type="text"> </td>
                        	<td><input id="Text1" type="text"></td>
                        </tr>
                    	<tr>
                    		<td>FEATURED LOCATION<br><em style="font-size:11px;">(Super Admin feature only)</em></td>
                        	<td><input id="Radio1" type="radio" checked="checked"> <span>Yes</span>&nbsp; &nbsp;
                        	<input id="Radio2" type="radio"> <span>No</span></td>
                        </tr>
                    </tbody>
                	</table> 
                    </div>

                    <h4 class="border_bottom">Address:</h4>  
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody><tr><td>CITY:<br>
                        <select id="Select1"><option></option></select></td>
                        <td>AREA:<br>
                        <select id="Select2"><option></option></select></td></tr>
                   
                    <tr><td>BLOCK:<br>
                        <input id="Text2" type="text"></td>
                        <td>STREET:<br>
                        <input id="Text3" type="text"></td></tr>
                    <tr><td>BUILDING:<br>
                        <input id="Text4" type="text"></td></tr>
                    </tbody></table>
                    </div>
                   
                   <h4 class="border_bottom">Register service, Comission &amp; Edit options:</h4>                   
                   <div class="table-responsive">
                            <table class="table table_design">
                                <thead>
                                    <tr>
                                        <th>SELECT SERVICE:</th>
                                        <th>Comission:</th>
                                        <th>MENU CATEGORY:</th>
                                        <th>SETUP SERVICE:</th>
                                        <th>ACTIVE:</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="Radio3" type="radio" checked="checked"> <strong>PICKUP</strong></td>
                                        <td><input id="Text5" type="text" value="KD ">
                                            &nbsp;or&nbsp;
                                            <input id="Text6" type="text" value="%" class="text-right" "=""></td>
                                        <td>3 <a href="" class="btn bg-gray-light2"><span class="add_sign">+</span> Add</a></td>
                                        <td><a href="" class="btn border-gray text-black"><span><img src="images/icon/setup_blue.png" alt=""></span> Setup</a></td>
                                        <td><input id="Radio4" type="radio" checked="checked"> <span>YES</span> &nbsp;
                                            <input id="Radio5" type="radio"> <span>NO</span></td>                                        
                                    </tr>
                                    <tr>
                                        <td><input id="Radio6" type="radio"> <span>DELIVERY</span></td>
                                        <td><input id="Text7" type="text" value="KD ">
                                            &nbsp;or&nbsp;
                                            <input id="Text8" type="text" value="%" class="text-right" "=""></td>
                                        <td>0 <a href="" class="btn border-gray text-black"><span class="add_sign">+</span> Add</a></td>
                                        <td><a href="" class="btn border-gray text-black"><span><img src="images/icon/setup_gray.png" alt=""></span> Setup</a></td>
                                        <td><input id="Radio7" type="radio" checked="checked"> <span>YES</span> &nbsp;
                                            <input id="Radio8" type="radio"> <span>NO</span></td>                                        
                                    </tr>
                                   <tr>
                                        <td><input id="Radio9" type="radio" checked="checked"> <strong>RESERVATION</strong></td>
                                        <td><input id="Text9" type="text" value="KD ">
                                            &nbsp;or&nbsp;
                                            <input id="Text10" type="text" value="%" class="text-right" "=""></td>
                                        <td>N/A</td>
                                        <td><a href="" class="btn border-gray text-black"><span><img src="images/icon/setup_blue.png" alt=""></span> Setup</a></td>
                                        <td><input id="Radio10" type="radio" checked="checked"> <span>YES</span> &nbsp;
                                            <input id="Radio11" type="radio"> <span>NO</span></td>                                        
                                    </tr>
                                    <tr>
                                        <td><input id="Radio12" type="radio"> <span>CATERING</span></td>
                                        <td><input id="Text11" type="text" value="KD ">
                                            &nbsp;or&nbsp;
                                            <input id="Text13" type="text" value="%" class="text-right" "=""></td>
                                        <td>0 <a href="" class="btn border-gray text-black"><span class="add_sign">+</span> Add</a></td>
                                        <td><a href="" class="btn border-gray text-black"><span><img src="images/icon/setup_gray.png" alt=""></span> Setup</a></td>
                                        <td><input id="Radio13" type="radio" checked="checked"> <span>YES</span> &nbsp;
                                            <input id="Radio14" type="radio"> <span>NO</span></td>                                        
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                   
                   <a href="" class="btn bg-green">SAVE</a>
                    </div>
                 </div>
             </form>
            </section>

</div>

