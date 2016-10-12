<?PHP
    $this->load->view("includes/Administration/header");
    $this->load->view("includes/Administration/sidebar");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->                         

    <section class="content">
        <a href="/Dashboard" class="btn bg-gray-light2">&lt; &nbsp;Back to Dashboard</a>
        <h4 class="border_bottom">MATAAM POINT SETUP</h4> 

        <form name="dataForm">
            <div class="table-responsive mini-wall">
                <table class="table tbl" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Points</th>
                            <th>Inv Amount</th>
                            <th colspan="2" style="text-align: center;">Redeem Points Range</th>
                            <th>Redeem Discount</th>
                        </tr>
                    </thead>
                    <tbody id="data-body">
                        <?php foreach($data as $item):?> 
                            <tr data-id="<?php echo $item->service_id;?>">
                                <td><?php echo $item->service_name; ?></td>
                                <td><input type="number" min="0" data-field="point" value="<?php echo $item->point; ?>"></td>
                                <td><input type="number" min="0" data-field="amount" value="<?php echo $item->amount; ?>" placeholder="KD"></td>
                                <td><input type="number" min="0" data-field="from" value="<?php echo $item->from; ?>" placeholder="From"></td>
                                <td><input type="number" min="0" data-field="to" value="<?php echo $item->to; ?>" placeholder="To"></td>
                                <td><input type="number" min="0" max="100" step="0.1" data-field="discount" value="<?php echo $item->discount; ?>" placeholder="%"></td>
                            </tr>
                            <?PHP endforeach;?>
                    </tbody>
                </table>
            </div>                                                                                      

            <button type="button" class="btn btn-success" name="btnsave" onclick="onSaveBtnClick()">Save</button>
        </form>
        <?php echo validation_errors(); ?>
    </section>
</div>
<?PHP
    $this->load->view("includes/Administration/footer");
?>


<script>  

    function onSaveBtnClick() {
        var data = [];
        $("#data-body").find("tr").each(function(){
            var service_id = $(this).attr("data-id");
            data.push({
                service_id: service_id,
                point: $(this).find("input[data-field=point]").val(),
                amount: $(this).find("input[data-field=amount]").val(),
                from: $(this).find("input[data-field=from]").val(),
                to: $(this).find("input[data-field=to]").val(),
                discount: $(this).find("input[data-field=discount]").val()
            })
        });

        console.log(data);

        $.ajax({
            method:"post",
            url:'/mataam_point',
            data: {
                data: data
            },
            success:function(response)
            {
                console.log(response);
                response = JSON.parse(response);

                if(!response) {
                    alert("Request failed");
                } else {
                    if(!response.success) {
                        alert(response.message);
                    }    
                }

            }     
        });
    }
</script>  