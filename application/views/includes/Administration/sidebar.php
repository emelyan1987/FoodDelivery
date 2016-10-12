<!-- Left side column. contains the logo and sidebar -->
<!--<aside class="main-sidebar">

<section class="sidebar">
<ul class="sidebar-menu">
<li class="active"><a href="Dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
<li class="treeview">
<a href="#">
<i class="fa fa-files-o"></i>
<span>Restaurants</span>
</a>
<ul class="treeview-menu">
<li><a href='/restaurant_list'><i class="fa fa-circle-o"></i>Restaurants</a></li>
<li><a href='/add_new_restaurant'><i class="fa fa-plus-circle"></i>Add New</a></li>
</ul>
</li>

<li class="treeview">
<a href="#">
<i class="fa fa-user"></i>
<span>Customers</span>
</a>
<ul class="treeview-menu">
<li><a href='/customer_list'><i class="fa fa-circle-o"></i>Customers</a></li>
<li><a href='/new_customer'><i class="fa fa-plus-circle"></i>Add New</a></li>
</ul>
</li>

<li class="treeview">
<a href="#">
<i class="fa fa-shield"></i>
<span>Plans</span>
</a>
<ul class="treeview-menu">
<li><a href='/plan_list'><i class="fa fa-circle-o"></i>Plans</a></li>
<li><a href='/new_plan'><i class="fa fa-plus-circle"></i>Add New</a></li>
</ul>
</li>


</ul>
</section>

</aside>-->

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">


            <!--<li class="active"><a href="/Dashboard/"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class=""><a href="/delivery_orders/"><i class="fa fa-cart-arrow-down"></i>Pending Orders</a></li>-->


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Orders</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if ($this->uri->segment(1) == "delivery_orders" || $this->uri->segment(1) == "catering_orders" || $this->uri->segment(1) == "reservation_orders" || $this->uri->segment(1) == "pickup_orders" || $this->uri->segment(1) == "delivery_orders_notification" || $this->uri->segment(1) == "delivery_order_view" || $this->uri->segment(1) == "pickup_orders_notification" || $this->uri->segment(1) == "reservation_orders_notification" || $this->uri->segment(1) == "catering_orders_notification" || $this->uri->segment(1) == "pickup_order_view") {?>

                    <?php $blk = 'style="display:block"';} else { $blk = '';}
                ?>

                <ul class="treeview-menu" <?php echo $blk;?> >        
                    <?php if ($this->uri->segment(1) == "delivery_orders" || $this->uri->segment(1) == "catering_orders" || $this->uri->segment(1) == "reservation_orders" || $this->uri->segment(1) == "pickup_orders" || $this->uri->segment(1) == "pickup_order_view") {
                            $act = 'class="active"';
                        } else {
                            $act = '';
                        }
                    ?>
                    <li <?php echo $act;?> ><a href='/delivery_orders'><i class="fa fa-circle-o"></i> All Orders</a></li>
                    <?php if ($this->uri->segment(1) == "delivery_orders_notification" || $this->uri->segment(1) == "delivery_order_view" || $this->uri->segment(1) == "pickup_orders_notification" || $this->uri->segment(1) == "reservation_orders_notification" || $this->uri->segment(1) == "catering_orders_notification") {
                            $act = 'class="active"';
                        } else {
                            $act = '';
                        }
                    ?>
                    <li <?php echo $act;?> ><a href='/delivery_orders_notification'><i class="fa fa-circle-o"></i>Order Notifications</a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>Promotion</span>  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if ($this->uri->segment(1) == "show_promotion" || $this->uri->segment(1) == "add_promotion" || $this->uri->segment(1) == "edit_promotion") {?>
                    <ul class="treeview-menu" style="display:block;">
                    <?php } else {?>
                    <ul class="treeview-menu">
                        <?php }
                    ?>
                    <?php if ($this->uri->segment(1) == "show_promotion" || $this->uri->segment(1) == "edit_promotion") {?>

                        <li class="active">
                        <?php } else {?>
                        <li class="">
                            <?php }
                        ?>
                        <a href='/show_promotion/'><i class="fa fa-circle-o"></i>All Promotions</a></li>
                    <?php if ($this->uri->segment(1) == "add_promotion") {?>

                        <li class="active">
                        <?php } else {?>
                        <li class="">
                            <?php }
                        ?>
                        <a href='/add_promotion/'><i class="fa fa-plus-circle"></i>Add New</a></li>
                </ul>
            </li>



            <?php if (($this->uri->segment(1) == "web_customers") || ($this->uri->segment(1) == "view_web_constomer") || ($this->uri->segment(1) == "edit_web_constomer")) {?>

                <li class="active">
                <?php } else {?>
                <li class="">
                    <?php }
                ?>
                <a href="/web_customers/"><i class="fa fa-user"></i><span>CUSTOMERS</span> </a></li>





            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Restaurants Owner</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if ($this->uri->segment(1) == "customer_list" || $this->uri->segment(1) == "new_customer" || $this->uri->segment(1) == "edit_restaurant_owner" || $this->uri->segment(1) == "new_customer") {?>
                    <ul class="treeview-menu" style="display:block;">
                    <?php } else {?>
                    <ul class="treeview-menu">
                        <?php }
                    ?>
                    <?php if ($this->uri->segment(1) == "customer_list" || $this->uri->segment(1) == "edit_restaurant_owner") {?>

                        <li class="active">
                        <?php } else {?>
                        <li class="">
                            <?php }
                        ?>

                        <a href='/customer_list'><i class="fa fa-circle-o"></i>All Owners</a></li>
                    <?php if ($this->uri->segment(1) == "new_customer") {?>

                        <li class="active">
                        <?php } else {?>
                        <li class="">
                            <?php }
                        ?>

                        <a href='/new_customer'><i class="fa fa-plus-circle"></i>Add New</a></li>
                </ul>
            </li>







            <li class="treeview">
                <a href="#"> <i class="fa fa-coffee"></i><span>Restaurant</span> <i class="fa fa-angle-left pull-right" ></i></a>

                <?php if ($this->uri->segment(1) == "restaurant_list" || $this->uri->segment(1) == "add_new_restaurant" || $this->uri->segment(1) == "restaurant_edit" || $this->uri->segment(1) == "restaurant_locations" || $this->uri->segment(1) == "restaurant_new_location" || $this->uri->segment(1) == "restaurant_edit_location" || $this->uri->segment(1) == "restro_trash") {?>
                    <ul class="treeview-menu" style="display:block;">
                    <?php } else {?>
                    <ul class="treeview-menu">
                    <?php }
                ?>

                <?php if ($this->uri->segment(1) == "restaurant_list" || $this->uri->segment(1) == "restaurant_edit" || $this->uri->segment(1) == "restaurant_locations" || $this->uri->segment(1) == "restaurant_edit_location") {?>

                    <li class="active">
                    <?php } else {
                    ?>
                    <li class="">
                        <?php }
                    ?>

                    <a href="/restaurant_list"><i class="fa fa-circle-o"></i>All Restaurants</a></li>

                <?php if ($this->uri->segment(1) == "add_new_restaurant" || $this->uri->segment(1) == "restaurant_new_location") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href="/add_new_restaurant"><i class="fa fa-plus-circle"></i>Add Restaurant</a></li>


                <?php if ($this->uri->segment(1) == "restro_trash") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href="/restro_trash"><i class="fa fa-trash-o"></i>Trash</a></li>

                <!--<li><a href="/restaurant_new_location/">Add Location</a>-->
                <!-- <ul>
                <li><a href="AddMenuCategory.html">Add Menu Category</a></li>
                </ul>
                -->
            </li>
            <!--<li><a href="ServiceSetupDelivery.html">Service Setup</a></li>-->
            <!--<li><a href="#">Menu Setup</a></li>
            <li><a href="#">Menu Item</a></li>-->
        </ul>
        </li>   

        <!--
        <li class="active treeview">
        <a href="index.html"><span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
        <li class="active"><a href="PendingOrderDelivery.html">Pending Orders</a></li>
        <li><a href="OrderNotification.html">Order Notifiactions</a></li>
        </ul>
        </li>
        <li class="treeview"><a href="Promotion.html"><span>Promotion</span> </a></li>
        -->   

        <!--<li class="treeview">
        <a href="#">
        <i class="fa fa-sticky-note"></i>
        <span>Restro Registration</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <?php if (($this->uri->segment(1) == "restro_register") || ($this->uri->segment(1) == "add_restro_registration") || ($this->uri->segment(1) == "edit_restro_register")) {?>
            <ul class="treeview-menu" style="display:block;">
            <?php } else {?>
            <ul class="treeview-menu">
            <?php }
        ?>
        <?php if ($this->uri->segment(1) == "restro_register" || ($this->uri->segment(1) == "edit_restro_register")) {?>

            <li class="active">
            <?php } else {?>
            <li class="">
            <?php }
        ?>

        <a href='/restro_register/'><i class="fa fa-circle-o"></i>All Registration</a></li>
        <?php if ($this->uri->segment(1) == "add_restro_registration") {?>

            <li class="active">
            <?php } else {?>
            <li class="">
            <?php }
        ?>

        <a href='/add_restro_registration/'><i class="fa fa-plus-circle"></i>Add New</a></li>
        </ul>
        </li> -->  
        
        <li class="treeview">
            <a href="#">
                <i class="fa fa-sitemap"></i>
                <span>Item Category</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <?php if (($this->uri->segment(1) == "item_category_setup") || ($this->uri->segment(1) == "item_category_show") || ($this->uri->segment(1) == "edit_item_category")) {?>
                <ul class="treeview-menu" style="display:block;">
                <?php } else {?>
                <ul class="treeview-menu">
                    <?php }
                ?>
                <?php if ($this->uri->segment(1) == "item_category_show" || ($this->uri->segment(1) == "edit_item_category")) {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>

                    <a href='/item_category_show'><i class="fa fa-circle-o"></i>All Item Category</a></li>
                <?php if ($this->uri->segment(1) == "item_category_setup") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>

                    <a href='/item_category_setup'><i class="fa fa-plus-circle"></i>Add New</a></li>
            </ul>
        </li>







        <li class="treeview">
            <a href="#">
                <i class="fa fa-cutlery"></i>
                <span>Items</span>  <i class="fa fa-angle-left pull-right"></i>
            </a>
            <?php if ($this->uri->segment(1) == "show_item_list" || $this->uri->segment(1) == "add_item" || $this->uri->segment(1) == "edit_menu_item") {?>
                <ul class="treeview-menu" style="display:block;">
                <?php } else {?>
                <ul class="treeview-menu">
                    <?php }
                ?>
                <?php if ($this->uri->segment(1) == "show_item_list" || $this->uri->segment(1) == "edit_menu_item") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/show_item_list/'><i class="fa fa-circle-o"></i>All Items</a></li>
                <?php if ($this->uri->segment(1) == "add_item") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/add_item/'><i class="fa fa-plus-circle"></i>Add New</a></li>
            </ul>
        </li>





        <?php if ($this->uri->segment(1) == "cuisine_setup") {?>

            <li class="active">
            <?php } else {?>
            <li class="">
                <?php }
            ?>
            <a href="/cuisine_setup/"><i class="fa fa-glass"></i><span>Setup Cuisines</span> </a>

        </li>


        <li class="<?php echo ($this->uri->segment(1)=='restaurant_tables')?'active':''?>"><a href="/restaurant_tables/"><i class="fa fa-bookmark"></i><span>Restaurant tables</span> </a></li>

        <li class="treeview">
            <a href="#"><i class="fa fa-map-marker"></i><span>Coupon & Loyalty</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="display:<?php echo ($this->uri->segment(1)=='coupon_list'||$this->uri->segment(1)=='loyalty_point_list'||$this->uri->segment(1)=='mataam_point_edit')?"block":"none"; ?>">
                <li class="<?php echo $this->uri->segment(1)=='coupon_list'?'active':'';?>">
                    <a href="/coupon_list/"><i class="fa fa-circle-o"></i>Setup Coupons</a>
                </li>
                <li class="<?php echo $this->uri->segment(1)=='loyalty_point_list'?'active':'';?>">
                    <a href="/loyalty_point_list/"><i class="fa fa-circle-o"></i>Loyalty Points</a>
                </li>
                <li class="<?php echo $this->uri->segment(1)=='mataam_point_edit'?'active':'';?>">
                    <a href="/mataam_point_edit/"><i class="fa fa-circle-o"></i>Mataam Points</a>
                </li>
            </ul>                                                                      
        </li> 

        <li class="treeview">
            <a href="#"><i class="fa fa-map-marker"></i><span>Setup Address</span> <i class="fa fa-angle-left pull-right"></i></a>
            <?php if ($this->uri->segment(1) == "add_new_city" || $this->uri->segment(1) == "add_new_area") {?>
                <ul class="treeview-menu" style="display:block;">
                <?php } else {?>
                <ul class="treeview-menu">
                    <?php }
                ?>

                <?php if ($this->uri->segment(1) == "add_new_city") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href="/add_new_city/"><i class="fa fa-circle-o"></i>Add City</a></li>

                <?php if ($this->uri->segment(1) == "add_new_area") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href="/add_new_area/"><i class="fa fa-plus-circle"></i>Add Area</a></li>
            </ul>
        </li>  

        <!--<li class="treeview"><a href="#"><span>Setup Coupons</span> </a></li>-->
        <!--<li class="treeview"><a href="#"><span>Customer Order <br />And loyalty Points</span> </a></li>-->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-desktop"></i>
                <span>Advertisement</span>  <i class="fa fa-angle-left pull-right"></i>
            </a>
            <?php if ($this->uri->segment(1) == "add_advertise" || $this->uri->segment(1) == "app_add_advertise" || $this->uri->segment(1) == "edit_promotion") {?>
                <ul class="treeview-menu" style="display:block;">
                <?php } else {?>
                <ul class="treeview-menu">
                    <?php }
                ?>
                <?php if ($this->uri->segment(1) == "add_advertise" || $this->uri->segment(1) == "edit_promotion") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/add_advertise/'><i class="fa fa-plus-circle"></i>Web Advertisement</a></li>
                <?php if ($this->uri->segment(1) == "app_add_advertise") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/app_add_advertise/'><i class="fa fa-plus-circle"></i>APP Advertisement</a></li>
            </ul>
        </li>

        <!--    <?php if ($this->uri->segment(1) == "add_notification") {?>

            <li class="active">
            <?php } else {?>
            <li class="">
            <?php }
        ?>
        <a href="/add_notification"><i class="fa fa-bell-slash"></i><span>Push Notification</span> </a></li> -->


        <?php if ($this->uri->segment(1) == "admin_reset_password") {?>

            <li class="active">
            <?php } else {?>
            <li class="">
                <?php }
            ?>
            <a href="/admin_reset_password/"><i class="fa fa-lock"></i><span>Reset Passwords</span> </a></li>






        <li class="treeview">
            <a href="#">
                <i class="fa fa-sticky-note"></i>
                <span>Policy</span>  <i class="fa fa-angle-left pull-right"></i>
            </a>
            <?php if ($this->uri->segment(1) == "policys" || $this->uri->segment(1) == "tearms_conditions" || $this->uri->segment(1) == "add_about") {?>
                <ul class="treeview-menu" style="display:block;">
                <?php } else {?>
                <ul class="treeview-menu">
                    <?php }
                ?>

                <?php if ($this->uri->segment(1) == "add_about") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/add_about/'><i class="fa fa-plus-circle"></i>About Us </a></li>


                <?php if ($this->uri->segment(1) == "policys") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/policys/'><i class="fa fa-plus-circle"></i>Privacy </a></li>
                <?php if ($this->uri->segment(1) == "tearms_conditions") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/tearms_conditions/'><i class="fa fa-plus-circle"></i>Terms and Condition </a></li>
            </ul>
        </li>







        <?php if ($this->uri->segment(1) == "reports") {?>

            <li class="active">
            <?php } else {?>
            <li class="">
                <?php }
            ?>
            <a href="/reports/"><i class="fa fa-files-o"></i><span>Reports</span> </a></li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-envelope"></i>
                <span>Email Setup</span>  <i class="fa fa-angle-left pull-right"></i>
            </a>
            <?php if ($this->uri->segment(1) == "smtp_setup" || $this->uri->segment(1) == "email_templates" || $this->uri->segment(1) == "edit_email_templates") {?>
                <ul class="treeview-menu" style="display:block;">
                <?php } else {?>
                <ul class="treeview-menu">
                    <?php }
                ?>
                <?php if ($this->uri->segment(1) == "smtp_setup") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/smtp_setup/'><i class="fa fa-plus-circle"></i>SMTP Setup</a></li>
                <?php if ($this->uri->segment(1) == "email_templates" || $this->uri->segment(1) == "edit_email_templates") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/email_templates/'><i class="fa fa-plus-circle"></i>Emails Templates</a></li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-sticky-note"></i>
                <span>Push Notification</span>  <i class="fa fa-angle-left pull-right"></i>
            </a>

            <?php if ($this->uri->segment(1) == "app_notification" || $this->uri->segment(1) == "web_notification_list" || $this->uri->segment(1) == "app_notification_list" || $this->uri->segment(1) == "web_notification" || $this->uri->segment(1) == "add_notification") {?>
                <ul class="treeview-menu" style="display:block;">
                <?php } else {?>
                <ul class="treeview-menu">
                    <?php }
                ?>
                <?php if ($this->uri->segment(1) == "app_notification_list") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/app_notification_list/'><i class="fa fa-circle-o"></i>App Notification</a></li>
                <?php if ($this->uri->segment(1) == "web_notification_list") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/web_notification_list/'><i class="fa fa-circle-o"></i>Web Notification</a></li>

                <?php if (($this->uri->segment(1) == "add_notification") && ($this->uri->segment(2) == "app")) {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/add_notification/app'><i class="fa fa-plus-circle"></i>Add New APP</a></li>


                <?php if (($this->uri->segment(1) == "add_notification") && ($this->uri->segment(2) == "web")) {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/add_notification/web'><i class="fa fa-plus-circle"></i>Add New WEB</a></li>
            </ul>
        </li>




        <?php if ($this->uri->segment(1) == "sms_setup") {?>

            <li class="active">
            <?php } else {?>
            <li class="">
                <?php }
            ?>
            <a href="/sms_setup/"><i class="fa fa-envelope"></i><span>SMS Setup</span> </a></li>




        <li class="treeview">
            <a href="#">
                <i class="fa fa-envelope"></i>
                <span>Careers</span>  <i class="fa fa-angle-left pull-right"></i>
            </a>

            <?php if ($this->uri->segment(1) == "careers_list" || $this->uri->segment(1) == "add_careers") {?>
                <ul class="treeview-menu" style="display:block;">
                <?php } else {?>
                <ul class="treeview-menu">
                    <?php }
                ?>
                <?php if ($this->uri->segment(1) == "careers_list") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/careers_list/'><i class="fa fa-circle-o"></i>Careers List</a></li>
                <?php if ($this->uri->segment(1) == "add_job_type") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/add_job_type/'><i class="fa fa-circle-o"></i>Job Type</a></li>

            </ul>
        </li>


        <?php if ($this->uri->segment(1) == "contact_us_list") {?>

            <li class="active">
            <?php } else {?>
            <li class="">
                <?php }
            ?>
            <a href='/contact_us_list/'><i class="fa fa-user"></i>Contacts</a></li>

        <!--<li class="treeview">

        <a href="#">
        <i class="fa fa-shield"></i>
        <span>Plans</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href='/plan_list'><i class="fa fa-circle-o"></i>Plans</a></li>
        <li><a href='/new_plan'><i class="fa fa-plus-circle"></i>Add New</a></li>
        </ul>
        </li> -->

        <li class="treeview">
            <a href="#">
                <i class="fa fa-envelope"></i>
                <span>FAQ</span>  <i class="fa fa-angle-left pull-right"></i>
            </a>

            <?php if ($this->uri->segment(1) == "faq_list" || $this->uri->segment(1) == "add_faq" || $this->uri->segment(1) == "add_faq_category") {?>
                <ul class="treeview-menu" style="display:block;">
                <?php } else {?>
                <ul class="treeview-menu">
                    <?php }
                ?>
                <?php if ($this->uri->segment(1) == "faq_list") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/faq_list'><i class="fa fa-circle-o"></i>ALL FAQ </a></li>
                <?php if ($this->uri->segment(1) == "add_faq") {?>

                    <li class="active">
                    <?php }
                ?>

                <?php if ($this->uri->segment(1) == "add_faq") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/add_faq/'><i class="fa fa-circle-o"></i>ADD NEW FAQ</a></li>
                <?php if ($this->uri->segment(1) == "add_faq") {?>

                    <li class="active">
                    <?php }
                ?>



                <?php if ($this->uri->segment(1) == "add_faq_category") {?>

                    <li class="active">
                    <?php } else {?>
                    <li class="">
                        <?php }
                    ?>
                    <a href='/add_faq_category/'><i class="fa fa-circle-o"></i>MANAGE CATEGORY</a></li>
                <?php if ($this->uri->segment(1) == "add_faq_category") {?>

                    <li class="active">
                    <?php }
                ?>





            </ul>
        </li>

        <?php if (($this->uri->segment(1) == "commission_reports") || ($this->uri->segment(1) == "catering_commission_reports") || ($this->uri->segment(1) == "pickup_commission_reports")) {?>

            <li class="active">
            <?php } else {?>
            <li class="">
                <?php }
            ?>
            <a href='/commission_reports/'><i class="fa fa-money"></i>Commission Report</a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
          </aside>
