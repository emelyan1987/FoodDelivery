



<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <!--<li class="active"><a href="/restro_dashboard/"><i class="fa fa-dashboard"></i>Dashboard</a></li>-->
            <!--<li class="treeview">
            <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Restaurants</span>
            </a>
            <ul class="treeview-menu">
            <li><a href='/restro_owner_restaurants_list/'><i class="fa fa-circle-o"></i> Manage Restaurants</a></li>
            <li><a href='/add_owner_restaurant/'><i class="fa fa-circle-o"></i>Add New</a></li>
            </ul>
            </li>-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Orders</span>  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if($this->uri->segment(1)=="restro_delivery_order" || $this->uri->segment(1)=="restro_delivery_notification" || $this->uri->segment(1)=="restro_catering_order" || $this->uri->segment(1)=="restro_reservation_order" || $this->uri->segment(1)=="restro_pickup_order" || $this->uri->segment(1)=="restro_catering_order_view" || $this->uri->segment(1)=="restro_reservation_order_view" || $this->uri->segment(1)=="restro_pickup_order_view" || $this->uri->segment(1)=="restro_delivery_order_view" || $this->uri->segment(1)=="restro_catering_notification" || $this->uri->segment(1)=="restro_reservation_notification" || $this->uri->segment(1)=="restro_pickup_notification")  {?>
                    <ul class="treeview-menu" style="display:block;">
                    <?php } else { ?>
                    <ul class="treeview-menu">
                        <?php } ?>

                    <?php if($this->uri->segment(1)=="restro_delivery_order" || $this->uri->segment(1)=="restro_catering_order" || $this->uri->segment(1)=="restro_reservation_order" || $this->uri->segment(1)=="restro_pickup_order" || $this->uri->segment(1)=="restro_catering_order_view" || $this->uri->segment(1)=="restro_reservation_order_view" || $this->uri->segment(1)=="restro_pickup_order_view" || $this->uri->segment(1)=="restro_delivery_order_view") { ?>

                        <li class="active">
                        <?php } else { ?>
                        <li class="">
                            <?php } ?>			
                        <a href='/restro_delivery_order/'><i class="fa fa-circle-o"></i>All Orders</a></li>

                    <?php if($this->uri->segment(1)=="restro_delivery_notification" || $this->uri->segment(1)=="restro_catering_notification" || $this->uri->segment(1)=="restro_reservation_notification" || $this->uri->segment(1)=="restro_pickup_notification") { ?>

                        <li class="active">
                        <?php } else { ?>
                        <li class="">
                            <?php } ?>			
                        <a href='/restro_delivery_notification/'><i class="fa fa-circle-o"></i>Orders Notifications</a></li>
                </ul>
            </li>

            <!--<li>
            <a href="/restro_delivery_order/">
            <i class="fa fa-th"></i> <span>Orders</span>
            </a>
            </li>-->
            <?php if($this->uri->segment(1)=="manage_my_restro_list" || $this->uri->segment(1)=="edit_owner_restro" || $this->uri->segment(1)=="manage_restro_location" || $this->uri->segment(1)=="my_serviec_setup" || $this->uri->segment(1)=="manage_restro_table") { ?>

                <li class="active">
                <?php } else { ?>
                <li class="">
                    <?php } ?>			

                <a href="/manage_my_restro_list/">
                    <i class="fa fa-coffee"></i> <span>My Restaurant</span>
                </a>
            </li>
            <!--<li class="treeview">
            <a href="#">
            <i class="fa fa-sitemap"></i>
            <span>Item Category</span>  <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
            <li><a href='/restro_item_category_list/'><i class="fa fa-circle-o"></i>All Item Category</a></li>
            <li><a href='/restro_add_item_category/'><i class="fa fa-circle-o"></i>Add New</a></li>
            </ul>
            </li>-->




            <li class="treeview">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span>Item Category</span>  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if($this->uri->segment(1)=="restro_item_category_setup" || $this->uri->segment(1)=="restro_item_category_show")  {?>
                    <ul class="treeview-menu" style="display:block;">
                    <?php } else { ?>
                    <ul class="treeview-menu">
                        <?php } ?>

                    <?php if($this->uri->segment(1)=="restro_item_category_show") { ?>

                        <li class="active">
                        <?php } else { ?>
                        <li class="">
                            <?php } ?>		
                        <a href='/restro_item_category_show/'><i class="fa fa-circle-o"></i>All Category</a></li>
                    <?php if($this->uri->segment(1)=="restro_item_category_setup") { ?>

                        <li class="active">
                        <?php } else { ?>
                        <li class="">
                            <?php } ?>	
                        <a href='/restro_item_category_setup/'><i class="fa fa-circle-o"></i>Add New</a></li>
                </ul>
            </li>




            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cutlery"></i>
                    <span>Items</span>  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if($this->uri->segment(1)=="restro_item_list" || $this->uri->segment(1)=="restro_add_item" || $this->uri->segment(1)=="edit_restro_item")  {?>
                    <ul class="treeview-menu" style="display:block;">
                    <?php } else { ?>
                    <ul class="treeview-menu">
                        <?php } ?>

                    <?php if($this->uri->segment(1)=="restro_item_list" || $this->uri->segment(1)=="edit_restro_item") { ?>

                        <li class="active">
                        <?php } else { ?>
                        <li class="">
                            <?php } ?>		
                        <a href='/restro_item_list/'><i class="fa fa-circle-o"></i>All Items</a></li>
                    <?php if($this->uri->segment(1)=="restro_add_item") { ?>

                        <li class="active">
                        <?php } else { ?>
                        <li class="">
                            <?php } ?>	
                        <a href='/restro_add_item/'><i class="fa fa-circle-o"></i>Add New</a></li>
                </ul>
            </li>



            <li class="treeview">
                <a href="#"> 
                    <i class="fa fa-gift"></i>
                    <span>Promotion</span>  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if($this->uri->segment(1)=="restro_show_promotion" || $this->uri->segment(1)=="restro_add_promotion" || $this->uri->segment(1)=="restro_edit_promotion")  {?>
                    <ul class="treeview-menu" style="display:block;">
                    <?php } else { ?>
                    <ul class="treeview-menu">
                        <?php } ?>

                    <?php if($this->uri->segment(1)=="restro_show_promotion" || $this->uri->segment(1)=="restro_edit_promotion") { ?>

                        <li class="active">
                        <?php } else { ?>
                        <li class="">
                            <?php } ?>	
                        <a href='/restro_show_promotion/'><i class="fa fa-circle-o"></i>All Promotions</a></li>

                    <?php if($this->uri->segment(1)=="restro_add_promotion") { ?>

                        <li class="active">
                        <?php } else { ?>
                        <li class="">
                            <?php } ?>	
                        <a href='/restro_add_promotion/'><i class="fa fa-plus-circle"></i>Add New</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cc"></i>
                    <span>Setup Coupons</span>  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if($this->uri->segment(1)=="restro_coupon_show" || $this->uri->segment(1)=="restro_coupon_setup" || $this->uri->segment(1)=="restro_coupon_edit")  {?>
                    <ul class="treeview-menu" style="display:block;">
                    <?php } else { ?>
                    <ul class="treeview-menu">
                        <?php } ?>

                    <?php if($this->uri->segment(1)=="restro_coupon_show" || $this->uri->segment(1)=="restro_coupon_edit") { ?>

                        <li class="active">
                        <?php } else { ?>
                        <li class="">
                            <?php } ?>	
                        <a href='/restro_coupon_show/'><i class="fa fa-circle-o"></i>Setup  Coupons</a></li>
                    <?php if($this->uri->segment(1)=="restro_coupon_setup") { ?>

                        <li class="active">
                        <?php } else { ?>
                        <li class="">
                            <?php } ?>	
                        <a href='/restro_coupon_setup/'><i class="fa fa-circle-o"></i>Add Coupons</a></li>
                </ul>
            </li>

<!--            <?php if($this->uri->segment(1)=="loyalty_point") { ?>

                <li class="active">
                <?php } else { ?>
                <li class="">
                    <?php } ?>	
                <a href="/loyalty_point/"> <i class="fa fa-database"></i> <span>Loyalty Points Setting</span></a>
            </li>
-->        </ul>
    </section>
    <!-- /.sidebar -->
          </aside>
