<?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>
 <body>
  <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<section class="content">
          <div class="row">
            <div class="col-xs-12">
         <div class="box">
                <div class="box-header">
                  <a href="/add_notification/app" class="btn bg-gray-light2 pull-right"><span class="add_sign">+</span> Add New</a>
                  <br>
                  <br>
                  <h3 class="box-title">List of App Notification</h3>
				  <br>
				  <?PHP
//echo $this->session->flashdata("msg");
?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Message<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Date<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Time<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Status<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($app_list as $ks => $vs):

?>

                    <tr>
                        <td><?php echo $vs->message;?></td>
                        <td><?php echo $vs->date;?></td>
                        <td><?php echo $vs->time;?></td>
                         <td><?php if ($vs->status) {
	echo "<span style='color:green'>Active</span>";
} else {
	echo "<span style='color:red;'>Deactive</span>";

}
?>
                         </td>
                        <td>


                          <a href="javascript:void(0)" onClick="updateNotification(this.id)" id="<?PHP echo $vs->id;?>@@<?PHP echo $vs->message;?>@@<?PHP echo $vs->date;?>@@<?PHP echo $vs->time;?>@@<?PHP echo $vs->status;?>"  class="edit border-gray padding_less"><i class="fa fa-pencil text-blue" aria-hidden="true"></i> Edit</a>

                          <a href="javascript:void(0)" onClick="delete_web_notification(this.id)" id="<?php echo $vs->id;?>" class="delete">x</a>
                        </td>

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

$this->load->view("includes/Administration/footer");
?>

<script>
   function updateNotification(value)
   {
          var v=value.split("@@");
          $("#note_id").val(v[0]);
          $("#note_msg").val(v[1]);
          $("#note_date").val(v[2]);
          $("#note_time").val(v[3]);
		  var status=v[4];
		  $("#status option[value='"+status+"']").prop('selected', true);
          $('#myModal').modal()                      // initialized with defaults
          $('#myModal').modal({ keyboard: false })   // initialized with no keyboard
          $('#myModal').modal('show')

   }
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">UPDATE APP NOTIFICATION </h4>
      </div>
      <div class="modal-body">
             <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody><tr><td>NOTIFICATION</td>
                    	 <input type="hidden" id="note_id">
                        <td><textarea  rows="2" id="note_msg" cols="20" name="notification"></textarea>
                            <br>
                            <span style="color:red" id="msg"></span>
                        </td></tr>
                     <tr><td width="20%">TIME:</td>
                        <td><input  type="text" id="note_time" style="width:60%;" name="time" value="12:00 AM"  class="time" >

                        </td></tr>
                    <tr><td width="20%">DATE:</td>
                        <td><input  type="text" style="width:60%;"  name="date" placeholder="yyyy-mm-dd" id="note_date" >
                            <br>

                        <input  type="hidden" style="width:60%;" name="type" value="1" >

                        </td>
						<tr><td width="20%">STATUS:</td>
                        <td>
						<select id="status">
						 <option value="1">Active</option>
						 <option value="0">Deactivated</option>

						</select>
                        </td>
						</tr>

                    </tbody></table>
                    </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="editWebNotification()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
         function editWebNotification()
         {



               var note_id=$("#note_id").val();
               var note_msg=$("#note_msg").val();
               var note_date=$("#note_date").val();
               var note_time=$("#note_time").val();
			   var status=$("#status").val();


                       $.ajax({
                                 method:"post",
                                 url:"/update_web_notification/",
                                 data:{note_id:note_id,note_msg:note_msg,note_date:note_date,note_time:note_time,status:status},
                                 success:function(response)
                                 {
                                     if(response)
                                     {

                                        $('#myModal').modal()                      // initialized with defaults
                                        $('#myModal').modal({ keyboard: false })   // initialized with no keyboard
                                        $('#myModal').modal('hide')
                                        window.location.reload();
                                     }
                                 }

                             })



         }

         function delete_web_notification(value)
         {
              var cn=confirm("Do you want to delete this notification?");
			    if(cn==true)
				{
                 $.ajax({
                                 method:"post",
                                 url:"/delete_web_notification/",
                                 data:{id:value},
                                 success:function(response)
                                 {
                                     if(response)
                                     {

                                        window.location.reload();
                                     }
                                 }

                             })
				}
         }
</script>


<script>
  $(function() {
    var dateToday = new Date();
    $("#note_date" ).datepicker({dateFormat: 'yy-mm-dd'});
  });
</script>

<script>
                $(function() {
                    $('#note_time').timepicker();
                });
            </script>