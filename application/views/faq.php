<?PHP

    $this->load->view("includes/Customer/header");
    //$this->load->view("includes/Cutomer/");
      
?>
     

     <div class="container-fluid">
            <div class="margin20"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="border">
                        <div class="col-md-12">
                            <div class="margin20"></div>
                            <h3>FAQ</h3>
                        </div>
                        <div class="col-md-3">
                            <div class="greenBorder"></div>
                            <ul class="nav nav-pills nav-stacked newTabStyle">
                                <?PHP
                                foreach($faq_cat_list as $vs):
								  if($vs->name!="")
								  {
                                ?>
                                <li class="active">
                                    <a data-toggle="tab" onClick="get_faq(this.id)" href="#tab1" id="<?PHP echo $vs->id; ?>">
                                        <img class="menuListImg" src="<?PHP echo base_url(); ?>assets/Customer/img/icon/smallLogoCss.png">
                                        <span class="menuListTitle"><?PHP echo $vs->name; ?></span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                                <?PHP
								  }
                                endforeach;
                                ?>
                            </ul>
                            <div class="greenBorder"></div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content">
                                <div id="tab1" class="tab-pane fade in active">
                                    
                                    <ul class="faqList">
                                        

                                          <?PHP
                                             foreach($faq_cat_list as $vs):
                                         ?>

                                        <li>
                                            <div class="toggleDiv tabDiv<?PHP echo $vs->fid;  ?>" onClick="faq_tog(<?PHP echo $vs->fid;  ?>)">
                                                <img class="img-responsive" src="<?PHP echo base_url(); ?>assets/Customer/img/icon/smallLogoCss.png">
                                                <h4><?PHP echo $vs->title;  ?>?</h4>
                                                <p id="p<?PHP echo $vs->fid;  ?>"><?PHP echo $vs->description; ?></p>
                                            </div>
                                        </li>
                                        <?PHP
                                           endforeach;
                                        ?>
                                        
                                    </ul>

                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="margin20"></div>
        </div>

<?PHP
   $this->load->view("includes/Customer/footer");
?>
<script>

                 function faq_tog(id)
                 {
                     
                  $("#p"+id).fadeToggle();
               
                  }
           
</script>
<script>
 function get_faq(id)
 {
          if(id)
          {
              $.ajax({
                       method:"post",
                       url:"/Faq/get_faq_by_category",
                       data:{id:id},
                       success:function(response)
                       {
                         //alert(response);
                         $("#tab1").html(response);

                       }
                     
                  });
          }

 }
</script>