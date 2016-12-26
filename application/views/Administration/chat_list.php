<?PHP
    $this->load->view("includes/Administration/header");
    $this->load->view("includes/Administration/sidebar");
?>
<link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/plugins/datatables/dataTables.bootstrap.css">
<body>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <br><br>
                <div class="header-tool">
                    <h4>CHAT LIST</h4>
                </div>
                <?PHP echo $this->session->flashdata("success_emsg");?>
                <div class="clear_h10"></div>
                <div class="table-responsive">
                    <table class="table table_design table-responsive table-bordered " id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FROM<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>MOBILE NO<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>EMAIL<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>MESSAGE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>TIME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>UNREAD<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($threads as $index => $thread):?>
                                <tr>
                                    <td><?php echo $index+1;?></td>
                                    <td><?php echo $thread->user_fullname;?></td>
                                    <td><?php echo $thread->user_mobile;?></td>
                                    <td><?php echo $thread->user_email;?></td>
                                    <td><?php echo $thread->last_message;?></td>
                                    <td><?php echo $thread->last_time;?></td>
                                    <td><?php echo $thread->unread_cnt;?></td>
                                    <td><a href="javascript:openChatWindow(<?php echo $thread->from_id;?>)" class="btn"><i class="fa fa-comments" aria-hidden="true"></i></a></td>    

                                </tr>
                                <?php endforeach;?>
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
    $this->load->view("includes/Administration/footer");
?>
<script src="<?PHP echo base_url();?>assets/Administration/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?PHP echo base_url();?>assets/Administration/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>

    $(function () {
        $("#example1").DataTable({
            "dom": '<fl<t>ip>'
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });

    var chatWin = undefined;
    function openChatWindow(from_id) {
        if(chatWin == undefined || chatWin.closed) {
            chatWin = window.open('/chat_window?from='+from_id, '_blank', ' toolbar=yes, menubar=yes,scrollbars=yes,resizable=no,top=100,left=200,width=1200,height=800');
        } else {
            chatWin.focus();
        }
    }
</script>