<?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>

  <body>
  <div class="content-wrapper">



 <section class="content">
                <div class="row">
                    <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:100%;">
                    <tr><td>DATE: </td><td></td></tr>
                    <tr><td>Date From:</td>
                        <td><input id="Text1" type="text" value="12.05.2016"/></td>
                        <td>Date To:</td>
                        <td><input id="Text2" type="text" value="25.05.2016"/></td>
                        <td>Sales by:</td>
                        <td><select id="Select1" ><option>Item Name</option></select></td>
                        <td>Items:</td>
                        <td><select id="Select2" ><option>Name</option></select></td>
                        <td><a href="" class="btn bg-green">Generate Report</a></td></tr>
                    </table>
                    </div>

                     <div class="heading">Sales By Item</div>
                        <div class="table-responsive">
                            <table class="table table_design">
                                <thead>
                                    <tr>
                                        <th>Order No.</th>
                                        <th>Restaurant Name</th>
                                        <th>Location Name</th>
                                        <th>Service Name</th>
                                        <th>Area</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Value</th>
                                        <th>Comission %</th>
                                        <th>Item Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#D00021</td>
                                        <td>Rest Name 1</td>
                                        <td>Location 1</td>
                                        <td>Service 1</td>
                                        <td>Area 1</td>
                                        <td>12.05</td>
                                        <td>4:20 AM</td>
                                        <td>13 KD</td>
                                        <td>2%</td>
                                        <td>Item Name 1</td>
                                    </tr>
                                    <tr>
                                        <td>#D00022</td>
                                        <td>Rest Name 2</td>
                                        <td>Location 2</td>
                                        <td>Service 2</td>
                                        <td>Area 2</td>
                                        <td>12.05</td>
                                        <td>4:20 AM</td>
                                        <td>13 KD</td>
                                        <td>2%</td>
                                        <td>Item Name 2</td>
                                    </tr>
                                    <tr>
                                        <td>#D00023</td>
                                        <td>Rest Name 3</td>
                                        <td>Location 3</td>
                                        <td>Service 3</td>
                                        <td>Area 3</td>
                                        <td>12.05</td>
                                        <td>4:20 AM</td>
                                        <td>13 KD</td>
                                        <td>2%</td>
                                        <td>Item Name 3</td>
                                    </tr>
                                    <tr>
                                        <td>#D00024</td>
                                        <td>Rest Name 4</td>
                                        <td>Location 4</td>
                                        <td>Service 4</td>
                                        <td>Area 4</td>
                                        <td>12.05</td>
                                        <td>4:20 AM</td>
                                        <td>13 KD</td>
                                        <td>2%</td>
                                        <td>Item Name 4</td>
                                    </tr>
                                    <tr>
                                        <td>#D00025</td>
                                        <td>Rest Name 5</td>
                                        <td>Location 5</td>
                                        <td>Service 5</td>
                                        <td>Area 5</td>
                                        <td>12.05</td>
                                        <td>4:20 AM</td>
                                        <td>13 KD</td>
                                        <td>2%</td>
                                        <td>Item Name 5</td>
                                    </tr>
                                    <tr>
                                        <td>#D00026</td>
                                        <td>Rest Name 6</td>
                                        <td>Location 6</td>
                                        <td>Service 6</td>
                                        <td>Area 6</td>
                                        <td>12.05</td>
                                        <td>4:20 AM</td>
                                        <td>13 KD</td>
                                        <td>2%</td>
                                        <td>Item Name 6</td>
                                    </tr>
                                    <tr>
                                        <td>#D00027</td>
                                        <td>Rest Name 7</td>
                                        <td>Location 7</td>
                                        <td>Service 7</td>
                                        <td>Area 7</td>
                                        <td>12.05</td>
                                        <td>4:20 AM</td>
                                        <td>13 KD</td>
                                        <td>2%</td>
                                        <td>Item Name 7</td>
                                    </tr>
                                    <tr>
                                        <td>#D00028</td>
                                        <td>Rest Name 8</td>
                                        <td>Location 8</td>
                                        <td>Service 8</td>
                                        <td>Area 8</td>
                                        <td>12.05</td>
                                        <td>4:20 AM</td>
                                        <td>13 KD</td>
                                        <td>2%</td>
                                        <td>Item Name 8</td>
                                    </tr>
                                    <tr>
                                        <td>#D00029</td>
                                        <td>Rest Name 9</td>
                                        <td>Location 9</td>
                                        <td>Service 9</td>
                                        <td>Area 9</td>
                                        <td>12.05</td>
                                        <td>4:20 AM</td>
                                        <td>13 KD</td>
                                        <td>2%</td>
                                        <td>Item Name 9</td>
                                    </tr>
                                    <tr>
                                        <td>#D00030</td>
                                        <td>Rest Name 10</td>
                                        <td>Location 10</td>
                                        <td>Service 10</td>
                                        <td>Area 10</td>
                                        <td>12.05</td>
                                        <td>4:20 AM</td>
                                        <td>13 KD</td>
                                        <td>2%</td>
                                        <td>Item Name 10</td>
                                    </tr>



                                </tbody>
                            </table>
                    </div>

                    <center>
                    <a href="" class="btn bg-gray-light2 padding_less">< PREVIOUS</a>
                    &nbsp; <strong>PAGE 3</strong> &nbsp;
                    <a href="" class="btn bg-gray-light2 padding_less">NEXT ></a>
                    </center>
                    <div class="clear_h20"></div>
                    <a href="" class="btn bg-black">EXPORT TO EXCEL</a>
                    </div>
                </div>
            </section>
      </div><!-- /.content-wrapper -->
<?PHP
$this->load->view("includes/Administration/footer");
?>
