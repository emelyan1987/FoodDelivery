<?PHP
    $this->load->view("includes/Customer/header"); 
    error_reporting(0);
?>	
<style>
    .modal{
        background: rgba(0, 0, 0, 0.5);
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $(".modal").css('display','block');
    });
</script>




<?php echo form_open($this->uri->uri_string()); ?>       

<div id="myModal" class="modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center"><b>INSERT CODE</b></h4>
                <span id="otperror" style="color:red;"></span>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="text" id="otp" name="otp" class="form-control" placeholder="Code goes here">
                    </div>
                    <button type="button" onclick="myFunction()" class="btn btn-success-new-sm">CONFIRM</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<?PHP
    $this->load->view("includes/Customer/footer"); 
?>  




<script>
    function myFunction(){
        var otp = document.getElementById("otp").value;
        if(otp =="")
        {
            document.getElementById("otperror").innerHTML="Enter Otp";
        }else{
            //alert(otp);
            $.ajax({

                url: "/check_otp/",
                type: "post",
                data: {otp: otp},
                success: function (response) {
                    //alert(response);     
                    $("#ot").val(response);
                    if(response != 1)
                    {

                        window.location="/customer_dashboard/";

                    } else {document.getElementById("otperror").innerHTML="Incorrect OTP"; }                   
                }
            })

        }                 
    }
</script>
