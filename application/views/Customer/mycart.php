<?PHP
    $this->load->view("includes/Customer/header"); 
    $this->load->helper('customer_helper');
?>

<form action="" method="post">
    <div class="container-fluid">
        <div class="margin20"></div>
        <div class="clearfix"></div>
        <div class="row">

            <div class="col-md-12">
                <!-- Nav tabs -->
                <ul id="service-tab" class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#delivery" role="tab" data-toggle="tab">
                            <i class="icon-tab-green"></i> Delivery
                        </a>
                    </li>
                    <li>
                        <a href="#catering" role="tab" data-toggle="tab">
                            <i class="icon-tab-orange"></i> Catering
                        </a>
                    </li>
                    <li>
                        <a href="#reservation" role="tab" data-toggle="tab">
                            <i class="icon-tab-red"></i> Reservation
                        </a>
                    </li>
                    <li>
                        <a href="#pickup" role="tab" data-toggle="tab">
                            <i class="icon-tab-blue"></i> Pickup
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="delivery">
                        <div class="col-md-12" style="padding:20px; border-bottom: 1px solid #ddd;">
                            <div class="col-md-3 col-sm-12">
                                &nbsp;
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <?php 
                                    $cartEmpty = true;
                                    foreach($deliveries as $restro) {
                                        if($restro!=null) {
                                            $cartEmpty = false;
                                        ?>
                                        <div class="col-md-12 col-sm-12" style="padding:10px; border-bottom: 1px solid #ddd;">
                                            <div class="col-md-3 col-sm-12">
                                                <div style="width: 80%; margin: 0 auto; text-align: center;">
                                                    <img class="img-responsive" style="width:100%;" alt="" src="<?php if ($restro->restro_logo != '') {getImagePath($restro->restro_logo);}?>"/>
                                                    <div class="restro-title"><?php echo $restro->restro_name;?></div>
                                                    <div class="location-title"><?php echo $restro->location_name;?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-12">
                                                <div class="col-md-12">
                                                    <div class="col-md-12" style="padding:0px 3px 0 3px;">
                                                        <?php 
                                                            foreach($restro->cart_items as $cart_item) {
                                                            ?>
                                                            <div class="border pos-rel cart-item" data-id="<?php echo $cart_item->id;?>">
                                                                <a href="/view_restro_item/<?php echo $cart_item->restro_id;?>/<?php echo $cart_item->location_id;?>/<?php echo $cart_item->product_id;?>?service_id=1&cart_item_id=<?php echo $cart_item->id;?>" class="item-action-edit">Edit  <i class="fa fa-pencil"></i></a>
                                                                <div class="col-md-3" style="padding-right:0;margin-left: 18px;">
                                                                    <a href="javascript:removeCartItem(<?php echo $cart_item->id;?>, 1)" class="item-action-remove"><i class="fa fa-times-circle" style="color: #cbcbcb;"></i></a>
                                                                    <img class="itemCheckImg" src="<?php if ($cart_item->item_image != '') {getImagePath($cart_item->item_image);} else {echo '/assets/Customer/img/default_item.png';}?>" alt=""/>
                                                                </div>
                                                                <div class="col-md-8" style="padding-left:0;">
                                                                    <h4 style="margin-bottom: 5px;"><?php echo $cart_item->item_name;?></h4>
                                                                    <span>Cost: KD<?php echo number_format($cart_item->item_price, 2);?> </span>&nbsp;|&nbsp;<span>Qty : <?php echo $cart_item->quantity;?> </span>&nbsp;|&nbsp;<span>Total : <?php echo number_format($cart_item->price, 2);?> </span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div style="float: right;">
                                                        <button data-toggle="modal" data-target="#areaSelectModal" type="button" class="btn btn-yellow" onclick="onClickCheckoutBtn(1, '<?php echo $restro->restro_id;?>', '<?php echo $restro->location_id;?>')"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> CHECKOUT</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        }
                                    }

                                    if($cartEmpty) {
                                        echo "<div class='alert alert-warning'>
                                        <strong>Warning!</strong> Your cart is empty.
                                        </div>";
                                    }
                                ?>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="catering">
                        <div class="col-md-12" style="padding:20px; border-bottom: 1px solid #ddd;">
                            <div class="col-md-3 col-sm-12">
                                &nbsp;
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <?php 
                                    $cartEmpty = true;
                                    foreach($caterings as $restro) {
                                        if($restro!=null) {
                                            $cartEmpty = false;
                                        ?>
                                        <div class="col-md-12 col-sm-12" style="padding:10px; border-bottom: 1px solid #ddd;">
                                            <div class="col-md-3 col-sm-12">
                                                <div style="width: 80%; margin: 0 auto; text-align: center;">
                                                    <img class="img-responsive" style="width:100%;" alt="" src="<?php if ($restro->restro_logo != '') {getImagePath($restro->restro_logo);}?>"/>
                                                    <div class="restro-title"><?php echo $restro->restro_name;?></div>
                                                    <div class="location-title"><?php echo $restro->location_name;?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-12">
                                                <div class="col-md-12">
                                                    <div class="col-md-12" style="padding:0px 3px 0 3px;">
                                                        <?php 
                                                            foreach($restro->cart_items as $cart_item) {
                                                            ?>
                                                            <div class="border pos-rel cart-item" data-id="<?php echo $cart_item->id;?>">
                                                                <a href="/view_restro_item/<?php echo $cart_item->restro_id;?>/<?php echo $cart_item->location_id;?>/<?php echo $cart_item->product_id;?>?service_id=2&cart_item_id=<?php echo $cart_item->id;?>" class="item-action-edit">Edit  <i class="fa fa-pencil"></i></a>
                                                                <div class="col-md-3" style="padding-right:0;margin-left: 18px;">
                                                                    <a href="javascript:removeCartItem(<?php echo $cart_item->id;?>, 2)" class="item-action-remove"><i class="fa fa-times-circle" style="color: #cbcbcb;"></i></a>
                                                                    <img class="itemCheckImg" src="<?php if ($cart_item->item_image != '') {getImagePath($cart_item->item_image);} else {echo '/assets/Customer/img/default_item.png';}?>" alt=""/>
                                                                </div>
                                                                <div class="col-md-8" style="padding-left:0;">
                                                                    <h4 style="margin-bottom: 5px;"><?php echo $cart_item->item_name;?></h4>
                                                                    <span>Cost: KD<?php echo number_format($cart_item->item_price, 2);?> </span>&nbsp;|&nbsp;<span>Qty : <?php echo $cart_item->quantity;?> </span>&nbsp;|&nbsp;<span>Total : <?php echo number_format($cart_item->price, 2);?> </span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div style="float: right;">
                                                        <button data-toggle="modal" data-target="#areaSelectModal" type="button" class="btn btn-yellow" onclick="onClickCheckoutBtn(2, '<?php echo $restro->restro_id;?>', '<?php echo $restro->location_id;?>')"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> CHECKOUT</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        }
                                    }

                                    if($cartEmpty) {
                                        echo "<div class='alert alert-warning'>
                                        <strong>Warning!</strong> Your cart is empty.
                                        </div>";
                                    }
                                ?>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                &nbsp;
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="reservation">
                        <div class="col-md-12" style="padding:20px; border-bottom: 1px solid #ddd;">
                            <div class="col-md-3 col-sm-12">
                                &nbsp;
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <?php 
                                    $cartEmpty = true;
                                    foreach($reservations as $restro) {
                                        if($restro!=null) {
                                            $cartEmpty = false;
                                        ?>
                                        <div class="col-md-12 col-sm-12" style="padding:10px; border-bottom: 1px solid #ddd;">
                                            <div class="col-md-3 col-sm-12">
                                                <div style="width: 80%; margin: 0 auto; text-align: center;">
                                                    <img class="img-responsive" style="width:100%;" alt="" src="<?php if ($restro->restro_logo != '') {getImagePath($restro->restro_logo);}?>"/>
                                                    <div class="restro-title"><?php echo $restro->restro_name;?></div>
                                                    <div class="location-title"><?php echo $restro->location_name;?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-12">
                                                <div class="col-md-12">
                                                    <div class="col-md-12" style="padding:0px 3px 0 3px;">
                                                        <?php 
                                                            foreach($restro->cart_items as $cart_item) {
                                                            ?>
                                                            <div class="border pos-rel cart-item" data-id="<?php echo $cart_item->id;?>">
                                                                <a href="/view_restro_item/<?php echo $cart_item->restro_id;?>/<?php echo $cart_item->location_id;?>/<?php echo $cart_item->product_id;?>?service_id=3&cart_item_id=<?php echo $cart_item->id;?>" class="item-action-edit">Edit  <i class="fa fa-pencil"></i></a>
                                                                <div class="col-md-3" style="padding-right:0;margin-left: 18px;">
                                                                    <a href="javascript:removeCartItem(<?php echo $cart_item->id;?>, 3)" class="item-action-remove"><i class="fa fa-times-circle" style="color: #cbcbcb;"></i></a>
                                                                    <img class="itemCheckImg" src="<?php if ($cart_item->item_image != '') {getImagePath($cart_item->item_image);} else {echo '/assets/Customer/img/default_item.png';}?>" alt=""/>
                                                                </div>
                                                                <div class="col-md-8" style="padding-left:0;">
                                                                    <h4 style="margin-bottom: 5px;"><?php echo $cart_item->item_name;?></h4>
                                                                    <span>Cost: KD<?php echo number_format($cart_item->item_price, 2);?> </span>&nbsp;|&nbsp;<span>Qty : <?php echo $cart_item->quantity;?> </span>&nbsp;|&nbsp;<span>Total : <?php echo number_format($cart_item->price, 2);?> </span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div style="float: right;">
                                                        <button data-toggle="modal" data-target="#areaSelectModal" type="button" class="btn btn-yellow" onclick="onClickCheckoutBtn(3, '<?php echo $restro->restro_id;?>', '<?php echo $restro->location_id;?>')"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> CHECKOUT</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        }
                                    }

                                    if($cartEmpty) {
                                        echo "<div class='alert alert-danger'>
                                        <strong>Warning!</strong> Hello Mohamed! I think reservation tab should be get rid of since reservation has no cart list. Please let me know your feedback, thanks
                                        </div>";
                                    }
                                ?>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                &nbsp;
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pickup">
                        <div class="col-md-12" style="padding:20px; border-bottom: 1px solid #ddd;">
                            <div class="col-md-3 col-sm-12">
                                &nbsp;
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <?php 
                                    $cartEmpty = true;
                                    foreach($pickups as $restro) {
                                        if($restro!=null) {
                                            $cartEmpty = false;
                                        ?>
                                        <div class="col-md-12 col-sm-12" style="padding:10px; border-bottom: 1px solid #ddd;">
                                            <div class="col-md-3 col-sm-12">
                                                <div style="width: 80%; margin: 0 auto; text-align: center;">
                                                    <img class="img-responsive" style="width:100%;" alt="" src="<?php if ($restro->restro_logo != '') {getImagePath($restro->restro_logo);}?>"/>
                                                    <div class="restro-title"><?php echo $restro->restro_name;?></div>
                                                    <div class="location-title"><?php echo $restro->location_name;?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-12">
                                                <div class="col-md-12">
                                                    <div class="col-md-12" style="padding:0px 3px 0 3px;">
                                                        <?php 
                                                            foreach($restro->cart_items as $cart_item) {
                                                            ?>
                                                            <div class="border pos-rel cart-item" data-id="<?php echo $cart_item->id;?>">
                                                                <a href="/view_restro_item/<?php echo $cart_item->restro_id;?>/<?php echo $cart_item->location_id;?>/<?php echo $cart_item->product_id;?>?service_id=4&cart_item_id=<?php echo $cart_item->id;?>" class="item-action-edit">Edit  <i class="fa fa-pencil"></i></a>
                                                                <div class="col-md-3" style="padding-right:0;margin-left: 18px;">
                                                                    <a href="javascript:removeCartItem(<?php echo $cart_item->id;?>, 4)" class="item-action-remove"><i class="fa fa-times-circle" style="color: #cbcbcb;"></i></a>
                                                                    <img class="itemCheckImg" src="<?php if ($cart_item->item_image != '') {getImagePath($cart_item->item_image);} else {echo '/assets/Customer/img/default_item.png';}?>" alt=""/>
                                                                </div>
                                                                <div class="col-md-8" style="padding-left:0;">
                                                                    <h4 style="margin-bottom: 5px;"><?php echo $cart_item->item_name;?></h4>
                                                                    <span>Cost: KD<?php echo number_format($cart_item->item_price, 2);?> </span>&nbsp;|&nbsp;<span>Qty : <?php echo $cart_item->quantity;?> </span>&nbsp;|&nbsp;<span>Total : <?php echo number_format($cart_item->price, 2);?> </span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div style="float: right;">
                                                        <button data-toggle="modal" data-target="#areaSelectModal" type="button" class="btn btn-yellow" onclick="onClickCheckoutBtn(4, '<?php echo $restro->restro_id;?>', '<?php echo $restro->location_id;?>')"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> CHECKOUT</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        }
                                    }

                                    if($cartEmpty) {
                                        echo "<div class='alert alert-warning'>
                                        <strong>Warning!</strong> Your cart is empty.
                                        </div>";
                                    }
                                ?>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                &nbsp;
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
    $this->load->view("includes/Customer/advertise"); 
    $this->load->view("includes/Customer/footer"); 
?>

<div id="areaSelectModal" class="modal fade" role="dialog" data-backdrop="static" >
    <div class="modal-dialog new-dialog">        
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close close1" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
                <h4 class="modal-title modal-title-alt"><b>SELECT AREA</b></h4>
                <div class="margin20"></div>
                <div class="input-group" style="margin-bottom: 10px;">                    
                    <span class="input-group-btn">
                        <button id="search-area-button" class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                    </span>
                    <input id="search-area-input" type="text" class="form-control" placeholder="Search for..." onkeyup="onChangeSearchArea()">
                </div>
                <div id="area-tree-view" style="max-height:600px;overflow-y:auto;"></div>
            </div>
            <div class="modal-footer">
                <button id="btn-area-select-submit" class="btn btn-primary">OK</button>
            </div>

        </div>
    </div>
</div>

<link rel="stylesheet" href="/assets/common/plugins/bootstrap-treeview/dist/bootstrap-treeview.min.css" type="text/css">
<script src="/assets/common/plugins/bootstrap-treeview/dist/bootstrap-treeview.min.js" type="text/javascript"></script>



<script>
    function removeCartItem(itemId, serviceType){
        bootbox.confirm({
            title: "Delete cart item?",
            message: "Are you sure to delete this cart item?",
            buttons: {
                cancel: {
                    label: 'Cancel',
                    className: 'btn-secondary'
                },
                confirm: {
                    label: 'Confirm',
                    className: 'btn-primary'
                }
            },
            callback: function (result) {
                if(result == true) {
                    $.ajax({
                        url: "/api/orders/cart/"+itemId+"?service_type="+serviceType,
                        type: "DELETE",
                        success: function(response) {
                            console.log('cart delete response', response);
                            if(response.code == 0) {
                                $("div.cart-item[data-id="+itemId+"]").slideUp("slow", function() { $(this).remove();});  
                            }
                        }
                    });
                }                  
            }
        });
    }
    function onClickCheckoutBtn(service_id, restro_id, location_id) {
        if(service_id == 1 || service_id == 2) {
            $.ajax({
                url: "/api/restaurants/"+restro_id+"/areas?location_id="+location_id+"&service_id="+service_id,
                type: "GET",
                success: function(response) {
                    console.log('getRestroAreas response', response);                

                    if(response.code == 0 && response.resource.length>0) {
                        var color = "";
                        if(service_id == 1) {
                            color = "green";
                        } else if(service_id == 2) {
                            color = "orange";
                        }
                        var trees = [];
                        response.resource.forEach(function(area){
                            console.log(area);
                            if(trees[area.city_id] === undefined) {
                                trees[area.city_id] = {
                                    text: area.city_name, 
                                    selectable: false, 
                                    state: {
                                        expanded:true
                                    },
                                    nodes: []
                                };
                            }
                            trees[area.city_id].nodes.push({
                                areaId: area.id,
                                text: area.name,
                                icon: 'custom-icon-normal icon-item',
                                selectedIcon: 'custom-icon-normal icon-item-selected-'+color
                            });
                        });

                        console.log(Object.values(trees));
                        $('#area-tree-view').treeview({
                            data: Object.values(trees),
                            highlightSelected: false,
                            expandIcon: 'custom-icon-large icon-bulletin-gray',
                            collapseIcon: 'custom-icon-large icon-bulletin-'+color,
                            color: '#6B6B6B',
                            backColor: '#F5F5F5',
                            onhoverColor: '#F5F5F5',
                            borderColor: '#FFFFFF'
                        });

                        $('#btn-area-select-submit').click(function(e){
                            var selectedNodes =  $('#area-tree-view').treeview('getSelected'); console.log(selectedNodes); //return;

                            if(selectedNodes.length == 0) {
                                alert('Please select an area'); return;
                            }      
                            location.href = "/checkout?service_id=1&restro_id="+restro_id+"&location_id="+location_id+"&area_id="+selectedNodes[0].areaId;
                        });
                    } else {
                        alert("Can't find restro areas");
                    }
                }
            });
        } else {
            location.href = "/checkout?service_id=1&restro_id="+restro_id+"&location_id="+location_id;
        }

    }

</script>



