<?PHP
    $this->load->view("includes/Restaurant_Owner/header");
    $this->load->view("includes/Restaurant_Owner/sidebar");
?>

<body>
<div class="content-wrapper">


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <a href='/manage_my_restro_list/' class="btn bg-gray-light2"> Back to Restaurant</a>

                <br><br>
                <h4>Restaurant Location List</h4>
                <div class="clear_h10"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table_design">
                        <thead>
                            <tr>
                                <th>Name<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Contact Person<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Telephones<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>City<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Area<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th style="text-align: center;">ACTION<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($restro_location as $ks => $vs): ?>


                                <tr>
                                    <td><?php echo ucwords($vs->location_name);?></td>
                                    <td><?php echo ucwords($vs->location_contact_person);?></td>
                                    <td><?php echo $vs->telephones;?></td>
                                    <td><?php getCityName($vs->city);?></td>
                                    <td><?php getAreaName($vs->area);?></td>
                                    <td style="text-align: center;">  
                                        <?php $services = explode(',', $vs->services); echo in_array(3,$services)?"<a href='/manage_restro_table/".$vs->restro_id."/".$vs->id."'>Table</a>":"&nbsp;" ?>
                                    </td>

                                </tr>
                                <?PHP

                                    endforeach;

                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="clear_h10"></div>
                <!--<a href="AddRestaurant.html" class="btn bg-gray-light2"><span class="add_sign">+</span> Add Restaurant</a>-->



            </div>
        </div>
    </section>
</div><!-- /.content-wrapper -->
<?PHP
    $this->load->view("includes/Restaurant_Owner/footer");
?>

<script>
    $(function () {
        $("#example1").DataTable({
            "dom": '<fl<t>ip>'
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
    </script>