<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="row">
                    <div class="col-md-12">
                        <p>Today's Date: <?php echo date("Y-M-d"); ?></p>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">

<?php
            $this->load->view("includes/Restaurant_Owner/dash_order_box");
?>
              <!-- Small boxes (Stat box) -->
              <!--<div class="row">
                <div class="col-lg-3 col-xs-6">
                  
                  <a href="PendingOrderDelivery.html">
                  <div class="small-box bg-green">
                    <div class="icon">
                        <img class="img-responsive" src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/car.png" alt="">  
                    </div>
                    <div class="inner">
                        <h4>DELIVERY</h4>
                    </div>
                  </div>
                  </a>
                  <div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr><td colspan="2">TODAY SALES: KD 1,250</td></tr>
                      <tr><td colspan="2">TODAY ORDERS: 40</td></tr>
                    </table>
                  </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                 
                  <a href="PendingOrderCatering.html">
                  <div class="small-box bg-yellow">
                    <div class="icon">
                        <img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/man.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                        <h4>CATERING</h4>
                    </div>
                  </div>
                  </a>
                  <div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr><td colspan="2">TODAY SALES: KD 1,250</td></tr>
                      <tr><td colspan="2">TODAY ORDERS: 40</td></tr>
                    </table>
                  </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                  
                  <a href="PendingOrderReservation.html">
                  <div class="small-box bg-red">
                    <div class="icon">
                        <img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/food.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                      <h4>RESERVATION</h4>
                    </div>
                  </div>
                  </a>
                  <div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr><td colspan="2">TODAY ORDERS: 40</td></tr>
                      <tr><td>&nbsp;</td></tr>
                    </table>
                  </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                  
                  <a href="PendingOrderPickup.html">
                  <div class="small-box bg-aqua">
                    <div class="icon">
                        <img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/cock.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                      <h4>PICK UP</h4>
                    </div>
                  </div>
                  </a>
                  <div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr><td colspan="2">TODAY SALES: KD 1,250</td></tr>
                      <tr><td colspan="2">TODAY ORDERS: 40</td></tr>
                    </table>
                  </div>
                </div>
              </div>-->
              <!-- Main row -->

                        <!-- row -->
              <div class="row">
            <div class="col-xs-12">
              <!-- jQuery Knob -->
              <div class="box box-solid">
                <div class="box-header">                  
                  <h3 class="box-title">COMPLETED ORDER PERCENTAGE</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="49" data-width="90" data-height="90" data-fgColor="#7CC424">
                      <div class="knob-label">Delivery</div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="73" data-width="90" data-height="90" data-fgColor="#FF7E00">
                      <div class="knob-label">Catering</div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="0" data-width="90" data-height="90" data-fgColor="#D61D08">
                      <div class="knob-label">Reservation</div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="35" data-width="90" data-height="90" data-fgColor="#2993FF">
                      <div class="knob-label">Pickup</div>
                    </div><!-- ./col -->
                  </div><!-- /.row -->

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
              

              <div class="row">
              <div class="col-md-12">
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">SALES BY LOCATION</h3>                  
                </div>
                <div class="clearfix"></div>
                <br /><br />
                <div class="col-md-4">
                <div class="small-box-bottom bg-gray-light">
                 <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr><td>LOCATION:</td>
                      <td><select id="Select1" name="Select1" >
                           <option value="">Select Location</option>
						  <?php
                            foreach($area_list as $area => $ar):
                            ?>
                                <option value="<?php echo $ar->id; ?>"><?php echo $ar->name; ?></option>
                            <?php
                            endforeach;
                            ?> 
                          </select>
                      </td></tr>
                  <tr><td>DATE:</td><td></td></tr>
                  <tr><td>From:</td><td><input id="datepickerA" type="text" placeholder="YYYY-MM-DD" /></td></tr>
                  <tr><td>To:</td><td><input id="datepicker1A" type="text" placeholder="YYYY-MM-DD" /></td></tr>
                  <tr><td></td><td><a href="" class="btn bg-green">Update</a></td></tr>
                 </table>
                 </div>
                </div>
                <div class="col-md-8">
                <div class="box-body">
                Sales
                  <div class="chart">
                    <canvas id="areaChart" style="height:150px;"></canvas>
                  </div>
                </div><!-- /.box-body -->
                </div>
                <div class="clearfix"></div>
              </div><!-- /.box -->  

            </div><!-- /.col -->
            </div>


              <div class="row">
              <div class="col-md-12">
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">SALES BY SERVICE</h3>                  
                </div>
                <div class="clearfix"></div>
                <br /><br />
                <div class="col-md-4">
                <div class="small-box-bottom bg-gray-light">
                 <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr><td>SERVICE:</td>
                      <td><select id="Select2" name="Select2" >
                           <option></option>
                           <option></option></select>
                      </td></tr>
                  <tr><td>DATE:</td><td></td></tr>
                  <tr><td>From:</td><td><input id="datepickerB" type="text" placeholder="YYYY-MM-DD"/></td></tr>
                  <tr><td>To:</td><td><input id="datepicker1B" type="text" placeholder="YYYY-MM-DD"/></td></tr>
                  <tr><td></td><td><a href="" class="btn bg-green">Update</a></td></tr>
                 </table>
                 </div>
                </div>
                <div class="col-md-8">
                <div class="box-body">
                 Sales
                  <div class="chart">
                    <canvas id="areaChartservice" style="height:150px;"></canvas>
                  </div>
                </div><!-- /.box-body -->
                </div>
                <div class="clearfix"></div>
              </div><!-- /.box -->  

            </div><!-- /.col -->
            </div>
              
              <div class="row">
              <div class="col-md-12">
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">SALES BY AREA</h3>                  
                </div>
                <div class="clearfix"></div>
                <br /><br />
                <div class="col-md-4">
                <div class="small-box-bottom bg-gray-light">
                 <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr><td>AREA:</td>
                      <td><select id="Select3" name="Select3" >
                           <option value="">Select Area</option>
                            <?php
                            foreach($area_list as $area => $ar):
                            ?>
                                <option value="<?php echo $ar->id; ?>"><?php echo $ar->name; ?></option>
                            <?php
                            endforeach;
                            ?> 
						   </select>
                      </td></tr>
                  <tr><td>DATE:</td><td></td></tr>
                  <tr><td>From:</td><td><input id="datepickerC" type="text" placeholder="YYYY-MM-DD"/></td></tr>
                  <tr><td>To:</td><td><input id="datepicker1C" type="text" placeholder="YYYY-MM-DD"/></td></tr>
                  <tr><td></td><td><a href="" class="btn bg-green">Update</a></td></tr>
                 </table>
                 </div>
                </div>
                <div class="col-md-8">
                <div class="box-body">
                 Sales
                  <div class="chart">
                    <canvas id="areaChartarea" style="height:150px;"></canvas>
                  </div>
                </div><!-- /.box-body -->
                </div>
                <div class="clearfix"></div>
              </div><!-- /.box -->  

            </div><!-- /.col -->
            </div>
              
               <div class="row">
            <div class="col-md-12">             
              <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">BEST SELLING ITEMS "5 ITEMS"</h3>                  
                </div>
                <div class="clearfix"></div>
                <br /><br />
                <div class="col-md-4">
                <div class="small-box-bottom bg-gray-light">
                 <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  
                  <tr><td>DATE:</td><td></td></tr>
                  <tr><td>From:</td><td><input id="datepickerD" type="text" placeholder="YYYY-MM-DD"/></td></tr>
                  <tr><td>To:</td><td><input id="datepicker1D" type="text" placeholder="YYYY-MM-DD"/></td></tr>
                  <tr><td></td><td><a href="" class="btn bg-green">Update</a></td></tr>
                 </table>
                 </div>
                </div>
                <div class="col-md-8">
                <div class="box-body">
                 Sales
                  <div class="chart">
                    <canvas id="barChart" style="height:150px"></canvas>
                  </div>
                </div><!-- /.box-body -->
                </div>
                <div class="clearfix"></div>
              </div><!-- /.box -->

            </div>
            </div>

              <div class="row">
              <div class="col-md-12">
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">SALES INTERVAL PER DAY AND SERVICE</h3>                  
                </div>
                <div class="clearfix"></div>
                <br /><br />
                <div class="col-md-4">
                <div class="small-box-bottom bg-gray-light">
                 <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr><td>AREA:</td>
                      <td><select id="Select4" name="Select4" >
                          <option value="">Select Area</option>
                            <?php
                            foreach($area_list as $area => $ar):
                            ?>
                                <option value="<?php echo $ar->id; ?>"><?php echo $ar->name; ?></option>
                            <?php
                            endforeach;
                            ?> 
						   </select>
                      </td></tr>
                  <tr><td>DATE:</td><td></td></tr>
                  <tr><td>From:</td><td><input id="datepickerE" type="text" placeholder="YYYY-MM-DD"/></td></tr>
                  <tr><td>To:</td><td><input id="datepicker1E" type="text" placeholder="YYYY-MM-DD"/></td></tr>
                  <tr><td></td><td><a href="" class="btn bg-green">Update</a></td></tr>
                 </table>
                 </div>
                </div>
                <div class="col-md-8">
                <div class="box-body">
                 Sales
                  <div class="chart">
                    <canvas id="areaChartsaleinterval" style="height:150px;"></canvas>
                  </div>
                </div><!-- /.box-body -->
                </div>
                <div class="clearfix"></div>
              </div><!-- /.box -->  

            </div><!-- /.col -->
            </div>
              
              <div class="row">
              <div class="col-md-12">
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">WEEKELY SALES</h3>                  
                </div>
                <div class="clearfix"></div>
                <br /><br />
                <div class="col-md-4">
                <div class="small-box-bottom bg-gray-light">
                 <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr><td>AREA:</td>
                      <td><select id="Select5" name="Select5" >
                           <option value="">Select Area</option>
                            <?php
                            foreach($area_list as $area => $ar):
                            ?>
                                <option value="<?php echo $ar->id; ?>"><?php echo $ar->name; ?></option>
                            <?php
                            endforeach;
                            ?> 
						   </select>
                      </td></tr>
                  <tr><td>DATE:</td><td></td></tr>
                  <tr><td>From:</td><td><input id="datepickerF" type="text" placeholder="YYYY-MM-DD" /></td></tr>
                  <tr><td>To:</td><td><input id="datepicker1F" type="text" placeholder="YYYY-MM-DD" /></td></tr>
                  <tr><td></td><td><a href="" class="btn bg-green">Update</a></td></tr>
                 </table>
                 </div>
                </div>
                <div class="col-md-8">
                <div class="box-body">
                 Sales
                  <div class="chart">
                    <canvas id="areaChartweeklysale" style="height:150px;"></canvas>
                  </div>
                </div><!-- /.box-body -->
                </div>
                <div class="clearfix"></div>
              </div><!-- /.box -->  

            </div><!-- /.col -->
            </div>

             
            </section><!-- /.content -->
            
          </div><!-- /.content-wrapper -->
         
          

 <?PHP
  $this->load->view("includes/Administration/footer");
?>


<script>
    $(function () {
        /* ChartJS
        * -------
        * Here we will create a few charts using ChartJS
        */

        //--------------
        //- AREA CHART -
        //--------------
        //location//
        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
            labels: ["0", "2", "4", "6", "8", "10"],
            datasets: [
            {
                label: "Sales",
                fillColor: "#A5DED8",
                strokeColor: "rgba(102, 173, 193, 1)",
                pointColor: "#A5DED8",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(102, 173, 193,1)",
                data: [10, 22, 33, 21, 27, 51]
            },
            {
                label: "Date",
                fillColor: "#74B7D1",
                strokeColor: "rgba(162,224,211,0.8)",
                pointColor: "#74B7D1",
                pointStrokeColor: "rgba(162,224,211,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(162,224,211,1)",
                data: [2, 6, 17, 19, 16, 19]
            }
          ]
        };

        var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };
        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);
        //service//
        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChartservice").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData2 = {
            labels: ["0", "2", "4", "6", "8", "10"],
            datasets: [
            {
                label: "Sales",
                fillColor: "#ACA2DE",
                strokeColor: "#61559D",
                pointColor: "#ACA2DE",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(102, 173, 193,1)",
                data: [10, 22, 33, 21, 27, 51]
            },
            {
                label: "Date",
                fillColor: "#A66ACE",
                strokeColor: "#691E9B",
                pointColor: "#A66ACE",
                pointStrokeColor: "rgba(162,224,211,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(162,224,211,1)",
                data: [2, 3, 12, 29, 16, 19]
            }
          ]
        };

        var areaChartOptions2 = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };
        //Create the line chart
        areaChart.Line(areaChartData2, areaChartOptions2);
        //area//
        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChartarea").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData3 = {
            labels: ["0", "2", "4", "6", "8", "10"],
            datasets: [
            {
                label: "Sales",
                fillColor: "#DDA3B2",
                strokeColor: "#AB7B87",
                pointColor: "#DDA3B2",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(102, 173, 193,1)",
                data: [10, 12, 43, 21, 27, 51]
            },
            {
                label: "Date",
                fillColor: "#C9796E",
                strokeColor: "#C27565",
                pointColor: "#C9796E",
                pointStrokeColor: "rgba(162,224,211,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(162,224,211,1)",
                data: [2, 3, 12, 9, 16, 19]
            }
          ]
        };

        var areaChartOptions3 = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };
        //Create the line chart
        areaChart.Line(areaChartData3, areaChartOptions3);
        //saleinteval//
        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChartsaleinterval").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData4 = {
            labels: ["5AM-12AM", "12AM-4PM", "4PM-8AM", "8AM-5AM"],
            datasets: [
            {
                label: "Sales",
                fillColor: "#CCDEA0",
                strokeColor: "#889B56",
                pointColor: "#CCDEA0",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(102, 173, 193,1)",
                data: [20, 12, 53, 21]
            },
            {
                label: "Date",
                fillColor: "#8BCC6E",
                strokeColor: "#4A8B2D",
                pointColor: "#8BCC6E",
                pointStrokeColor: "rgba(162,224,211,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(162,224,211,1)",
                data: [2, 13, 22, 9]
            }
          ]
        };

        var areaChartOptions4 = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };
        //Create the line chart
        areaChart.Line(areaChartData4, areaChartOptions4);
        //weeklysale//
        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChartweeklysale").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData5 = {
            labels: ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"],
            datasets: [
            {
                label: "Sales",
                fillColor: "#91F1AA",
                strokeColor: "#29B74E",
                pointColor: "#91F1AA",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(102, 173, 193,1)",
                data: [10, 12, 43, 55, 27, 51, 31]
            },
            {
                label: "Date",
                fillColor: "#55E7B8",
                strokeColor: "#04B87E",
                pointColor: "#55E7B8",
                pointStrokeColor: "rgba(162,224,211,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(162,224,211,1)",
                data: [2, 3, 12, 19, 16, 19, 10]
            }
          ]
        };

        var areaChartOptions5 = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };
        //Create the line chart
        areaChart.Line(areaChartData5, areaChartOptions5);
        //-------------
       
       
        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - If there is a stroke on each bar
            barShowStroke: true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth: 1,
            //Number - Spacing between each of the X value sets
            barValueSpacing: 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing: 1,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to make the chart responsive
            responsive: true,
            maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
    });
    </script>


<script>
  $(function() {
    $( "#datepickerA" ).datepicker({
    format: 'yyyy-mm-dd'
});

  });

  $(function() {
    
    $( "#datepicker1A" ).datepicker({
    format: 'yyyy-mm-dd'
});
  });

  </script>

<script>
  $(function() {
    $( "#datepickerB" ).datepicker({
    format: 'yyyy-mm-dd'
});

  });

  $(function() {
    
    $( "#datepicker1B" ).datepicker({
    format: 'yyyy-mm-dd'
});
  });

  </script>	
	
<script>
  $(function() {
    $( "#datepickerC" ).datepicker({
    format: 'yyyy-mm-dd'
});

  });

  $(function() {
    
    $( "#datepicker1C" ).datepicker({
    format: 'yyyy-mm-dd'
});
  });

  </script>
 
 <script>
  $(function() {
    $( "#datepickerD" ).datepicker({
    format: 'yyyy-mm-dd'
});

  });

  $(function() {
    
    $( "#datepicker1D" ).datepicker({
    format: 'yyyy-mm-dd'
});
  });

  </script>
 
 <script>
  $(function() {
    $( "#datepickerE" ).datepicker({
    format: 'yyyy-mm-dd'
});

  });

  $(function() {
    
    $( "#datepicker1E" ).datepicker({
    format: 'yyyy-mm-dd'
});
  });

  </script>
 
 <script>
  $(function() {
    $( "#datepickerF" ).datepicker({
    format: 'yyyy-mm-dd'
});

  });

  $(function() {
    
    $( "#datepicker1F" ).datepicker({
    format: 'yyyy-mm-dd'
});
  });

  </script>   	