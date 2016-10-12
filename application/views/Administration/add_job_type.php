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
                  <a href="#" class="btn bg-gray-light2 pull-right"  data-toggle="modal" data-target="#myModal"><span class="add_sign">+</span> Add New</a>
                  <br>
                  <br>
                  <h3 class="box-title">List of Job Type</h3>
				  <br>
				  <?PHP echo $this->session->flashdata("msg", "FAQ Updated Successfully");?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Title<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                        <th>Description<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                        <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($type as $ks => $vs):
?>

                    <tr>

                        <td><?php echo $vs->title;?></td>
                        <td><?php echo $vs->description;?></td>

                        <td>


  <!--<a href="javascript:void(0)" onClick="updateFaq(this.id)" id="<?PHP echo $vs->fid;?>@@<?PHP echo $vs->title;?>@@<?PHP echo $vs->description;?>@@<?PHP echo $vs->date;?>@@<?PHP echo $vs->cat_id;?>@@<?PHP echo $vs->status?>"  class="edit border-gray padding_less"><i class="fa fa-pencil text-blue" aria-hidden="true"></i></a>-->

                          <a href="javascript:void(0)" onClick="delete_job(this.id)" id="<?php echo $vs->id;?>" class="delete">x</a>
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
   function updateFaq(value)
   {




          var v=value.split("@@");
		   var faq_id=v[4];


		   $.ajax({
			      method:"post",
				  url:"Administration/Dashboard/faq_update_get_category_list",
				  data:{id:faq_id},
				  success:function(response)
				  {
					  //alert(response);
					  $("#faq_cat_list").html(response);
				  }



		        });

          $("#faq_id").val(v[0]);
          $("#faq_title").val(v[1]);
          $("#faq_description").val(v[2]);
          $("#faq_date").val(v[3]);

          var sts=v[5];

          $('#myModal').modal()                      // initialized with defaults
          $('#myModal').modal({ keyboard: false })   // initialized with no keyboard
          $('#myModal').modal('show');
		  $("#faq_status option[value='"+sts+"']").prop('selected', true);


   }
</script>

<form action="" method="post">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Job Type</h4>
      </div>
      <div class="modal-body">
             <div class="table-responsive">
                    <table class="table " style="width:80%;">
                    <tbody>


                      <tr>
                          <td>Title</td>
                          <td>
                               <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" required>
                          </td>

                      </tr>


                      <tr><td>Descritption</td>

                    	 <input type="hidden" id="faq_id">

                        <td><textarea  rows="2" id="description"  class="form-control"cols="20" name="description"></textarea>
                            <br>
                            <span style="color:red" id="msg"></span>
                        </td></tr>




                    </tbody></table>
                    </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btnsave">Save</button>
      </div>
    </div>
  </div>
</div>
</form>

<script>
         function editFaq()
         {

             var id=$("#faq_id").val();
             var title=$("#faq_title").val();
             var description=$("#faq_description").val();
             var status=$("#faq_status").val();
             var status=$("#faq_status").val();
             var faq_cat=$("#faq_cat_update_id").val();


                       $.ajax({
                                 method:"post",
                                 url:"/Administration/Dashboard/update_faq",
                                 data:{id:id,title:title,description:description,status:status,faq_cat:faq_cat},
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

         function delete_job(value)
         {

			     var cn=confirm("Do You want to delete this Job Type?");
				    if(cn==true)
					{
                 $.ajax({
                                 method:"post",
                                 url:"/Administration/Contact_us/delete_job_type",
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


