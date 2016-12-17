<?PHP
    $this->load->helper('restaurant_helper');
    $this->load->view("includes/Customer/header"); 


    foreach($restroInfo as $res => $vs):
    ?>

    <div class="container-fluid">
        <div class="margin20"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-4 col-sm-6">
                    <div class="row">

                        <?php
                            if($vs->restaurant_logo != '')
                            {
                            ?>
                            <img class="img-responsive img-menu" alt="" src="<?php $img = explode('public_html',$vs->restaurant_logo); 
                                echo $img[1];?>">
                            <?php
                            }
                            else
                            {
                            ?>
                            <img class="img-responsive img-menu" alt="" src="/assets/Customer/img/icon/bottomIcon2.png">
                            <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="col-md-8 col-sm-6">
                    <h4><?php echo ucwords($vs->restro_name); ?></h4>
                    <!--<h5 class="just">Mansarover, Jaipur</h5>-->
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-offset-6 col-md-6 text-center">
                    <h4>Ratings</h4>
                    <div class="ratings">
                        <?php 

                            $ratArray = getRestroRatingValues($vs->id);
                            if($ratArray['rating_num'] != 0)
                            {
                                $getR = $ratArray['rating_value'] / $ratArray['rating_num'];
                                $getR = round($getR);
                            ?>
                            <span>
                                <?php
                                    if($getR == 5)
                                    {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">  
                                    <?php
                                    }
                                    elseif($getR == 4)
                                    {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                    <?php
                                    }
                                    elseif($getR == 3)
                                    {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                    <?php
                                    }
                                    elseif($getR == 2)
                                    {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                    <?php
                                    }
                                    elseif($getR == 1)
                                    {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">  
                                    <?php
                                    }
                                }
                                else
                                {
                                ?>
                                <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">  
                                <?php
                                }


                            ?>

                        </span>

                    </div>
                    <div>
                        <div class="margin20"></div>
                        <button class="btn btn-success" data-toggle="modal" data-target="#reviewModel">Rate Now</button>


                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="margin20"></div>
            <div class="col-md-12"><div class="greenBorder"></div></div>
            <div class="clearfix"></div>
            <div class="margin20"></div>
            <div class="col-md-12">
                <h3 class="custReviewHead">Customer Reviews</h3>
            </div>
            <div class="clearfix"></div>
            <div class="margin20"></div>
            <div class="col-md-12">
                <ul class="list-unstyled">

                    <?php
                        foreach($ratingdata as $res => $rat):
                        ?>
                        <li>
                            <div class="col-md-3 ratings text-center">
                                <h4>Ratings</h4>
                                <?php
                                    if($rat->star_value == 5)
                                    {
                                    ?>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <?php
                                    }
                                    elseif($rat->star_value == 4)
                                    {
                                    ?>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <?php
                                    }
                                    elseif($rat->star_value == 3)
                                    {
                                    ?>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <?php
                                    }
                                    elseif($rat->star_value == 2)
                                    {
                                    ?>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <?php
                                    }
                                    elseif($rat->star_value == 1)
                                    {
                                    ?>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <?php
                                    }
                                ?>



                            </div>
                            <div class="col-md-9">
                                <h4>By <b><?php echo $rat->name; ?></b> on <?php echo date('jS M Y', strtotime($rat->created_time)) ; ?></h4>
                                <p><i><?php echo $rat->msg; ?></i></p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="margin20"></div>
                            <div class="borderDashed"></div>
                            <div class="margin20"></div>
                        </li>
                        <?php
                            endforeach;
                    ?>


                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="margin20"></div>
    </div>

    <?php
        endforeach;
    $this->load->view("includes/Customer/advertise"); 
    $this->load->view("includes/Customer/footer"); 
?>

<!--review code.............................................-->
<div class="modal fade" id="reviewModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Put Your Review With Us</h4>
            </div>
            <div class="modal-body">
                <INPUT type="HIDDEN" ID="restro_id" name="restro_id" value="<?PHP echo $this->uri->segment(2); ?>">
                <INPUT type="HIDDEN" ID="location_id" name="location_id" value="<?PHP echo $this->uri->segment(3); ?>">
                <INPUT type="HIDDEN" id="rating_value_id" >

                <fieldset class="rating">
                    <legend>Please rate:</legend>
                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" onClick="get_starRating(this.id)" id="star5" title="Rocks!">5 stars</label>
                    <input type="radio" id="star4" name="rating" value="4"  /><label for="star4" onClick="get_starRating(this.id)" id="star4" title="Pretty good">4 stars</label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" onClick="get_starRating(this.id)" id="star3" title="Good">3 stars</label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" onClick="get_starRating(this.id)" id="star2" title="Average">2 stars</label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" onClick="get_starRating(this.id)" id="star1" title="Poor">1 star</label>
                </fieldset>   
                <span id="ratingMsg"></span>

                <br>
                <br><br><br>
                <br>

                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" name="email" class="form-control" id="email">
                    <span id="emailMsg"></span>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <span id="nameMsg"></span>
                </div>


                <div class="form-group">
                    <label for="msg">Reviews:</label>
                    <textarea name="msg" id="msg" class="form-control" ></textarea>
                    <span id="msgMsg"></span>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onClick="add_review()" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
<script>
    function get_starRating(id)
    {
        $("#rating_value_id").val($("#"+id).val());
    }
    function add_review()
    {
        var name=$("#name").val();
        var email=$("#name").val();
        var msg=$("#msg").val();
        var restro_id=$("#restro_id").val();
        var location_id=$("#location_id").val();
        var star_value=$("#rating_value_id").val();


        if(name=="")
        {
            $("#nameMsg").text("Please Enter your name");
            $("#nameMsg").css("color","red");

        }

        else if(email=="")
        {
            $("#emailMsg").text("Please Enter Email address");
            $("#emailMsg").css("color","red");

        }
        /*else if(msg=="")
        {
            $("#msgMsg").text("Please Enter Msg");
            $("#msgMsg").css("color","red");
        }*/
        else if(star_value=="")
        {
            $("#ratingMsg").text("Please Vote");
            $("#ratingMsg").css("color","red");
        }
        else
        {
            $.ajax({
                method:"post",
                url:"/put_rating/",
                data:{name:name,email:email,msg:msg,restro_id:restro_id,location_id:location_id,star_value:star_value},
                success:function(response)
                {
                    alert("Your Review Submitted successfully...");
                }          
            });
        } 

    }



</script>
<style>
    .rating {
        float:left;
    }

    /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
    follow these rules. Every browser that supports :checked also supports :not(), so
    it doesn’t make the test unnecessarily selective */
    .rating:not(:checked) > input {
        position:absolute;
        top:-9999px;
        clip:rect(0,0,0,0);
    }

    .rating:not(:checked) > label {
        float:right;
        width:1em;
        padding:0 .1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:200%;
        line-height:1.2;
        color:#ddd;
        text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
    }

    .rating:not(:checked) > label:before {
        content: '★ ';
    }

    .rating > input:checked ~ label {
        color: #ea0;
        text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
    }

    .rating:not(:checked) > label:hover,
    .rating:not(:checked) > label:hover ~ label {
        color: gold;
        text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
    }

    .rating > input:checked + label:hover,
    .rating > input:checked + label:hover ~ label,
    .rating > input:checked ~ label:hover,
    .rating > input:checked ~ label:hover ~ label,
    .rating > label:hover ~ input:checked ~ label {
        color: #ea0;
        text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
    }

    .rating > label:active {
        position:relative;
        top:2px;
        left:2px;
    }
 </style>