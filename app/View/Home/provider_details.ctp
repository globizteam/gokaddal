
        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <!-- <h1 class="text-center txt_white m_b_20 txt_52">Solution Provider</h1> -->
                    <!-- <h3 class="text-center txt_white m_b_70">Lorem ipsum dolor sit amet.</h3> -->
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            
                            <?php
                                echo $this->element('Frontend/search_form');
                            ?>



                            <!-- <p class="txt_16 txt_white text-center after_search m_b_20">Popular Searches: &nbsp;&nbsp;&nbsp; <a href="#">Smart Cities</a> , <a href="#">Utilities</a> , <a href="#">Healthcare</a> , <a href="#">Real Estate</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    



    <div class="p_tb_80">
        <div class="container-fluid">
            <div class="container">
                <div class="row message_m_b_40 text-center">
                    <div class="col-md-offset-3  col-md-6 col-sm-6">
                        <?php echo $this->Flash->render();  ?>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-5 col-md-5 col-sm-6">
                        <?php if (!empty($provider['User']['profile_pic'])) { ?>

                            <a href="javascript:;">
                                <img src="<?php echo $this->webroot.$provider['User']['profile_pic'] ?>" alt="Image" class="img-responsive center-block">
                            </a>

                        <?php }else{  ?>

                            <a href="javascript:;">
                                <img src="<?php echo  $this->webroot.'app/webroot/no-image.jpg' ?>" alt="Image" class="img-responsive center-block" style="max-width: 50% !important; width: 100%;" >
                            </a>

                        <?php } ?>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6 ">
                        <h2 class="listing_item_name">
                            <a href="javascript:;" class="txt_black">
                                <!-- Need Smart Water Management solution -->
                                <?php echo $provider['User']['company_name'] ;?>
                            </a>
                        </h2>
<!--                         <h5 class="listing_item_tags txt_w_400 m_t_30"><a href="#" class="txt_orange hover_txt_orange text-uppercase">Smart Cities, Tag name Here</a></h5> -->

                        <!--Company rating code starts here  -->
                        <?php 
                            $total_users = $final_rating_no = 0;
                            $one_calc = $two_calc = $three_calc = $four_calc = $five_calc = 0;

                            // print_r($rating_all_records[0]['RateNReview']);die();
                            if(isset($rating_all_records[0]['RateNReview']) )
                            {
                                foreach ($rating_all_records as $key => $rating) 
                                {
                                        if($rating['RateNReview']['rate_to'] == $provider['User']['id'])
                                        {
                                            $rate_no_check = $rating['RateNReview']['rating'];
                                            switch ($rate_no_check) {
                                                case 1:
                                                    $one_calc = $one_calc + 1;
                                                    $total_users = $total_users + 1;
                                                    break;
                                                case 2:
                                                    $two_calc = $two_calc + 1;
                                                    $total_users = $total_users + 1;
                                                    break;
                                                case 3:
                                                    $three_calc = $three_calc + 1;
                                                    $total_users = $total_users + 1;
                                                    break;
                                                case 4:
                                                    $four_calc = $four_calc + 1;
                                                    $total_users = $total_users + 1;
                                                    break;
                                                case 5:
                                                    $five_calc = $five_calc + 1;
                                                    $total_users = $total_users + 1;
                                                    break;
                                                
                                                default:
                                                    # code...
                                                    break;
                                            }



                                        }


                                }
                                        $rating_total = ($one_calc * 1 ) + ($two_calc * 2 ) + ($three_calc * 3 ) + ($four_calc * 4 ) + ($five_calc * 5 ); 
                                        if ($rating_total != 0) {
                                            $final_rating_no = $rating_total/$total_users;
                                            // round off final rating number
                                            $final_rating_no = round($final_rating_no);
                                        }else{
                                            $final_rating_no = null;
                                        }

                                            // echo "total_users". $total_users;die();

                            }
                        ?>
                        <!--Company rating code ends here  -->
                        <div class="listing_item_stars m_t_15">
                            <?php 
                                if (isset($final_rating_no)) {
                                    $i = 1; 
                                    while ($i <= 5) {

                                        if ($final_rating_no >= $i) 
                                            echo '<i class="fas fa-star"></i>';
                                        else
                                            echo '<i class="far fa-star"></i>';            

                                        $i++;
                                    }
                                }else{
                                    $z = 1;
                                    while ($z <= 5) {
                                        echo '<i class="far fa-star"></i>';            
                                        $z++;                                  
                                    }
                                } 
                            ?> 
                        </div>


                        <p class="para_large m_t_15">
                                <?php echo $provider['User']['description'] ;?>
                        </p>
                        <div class="listing_item_location m_t_15"><i class="fas fa-map-marker-alt txt_orange"></i> 
                            <span class="txt_grey">
                                <?php echo $provider['User']['address'] ;?>
                            <!-- East 34th Street, Near Abcd Avenue -->
                            </span>
                        </div>
                        <div class="orange_btns m_t_30">
                            <ul class="list-unstyled list-inline m_b_0">

                                <li>
                                    <!-- if user is logged in -->
                                    <?php //if(AuthComponent::user('id')) : ?>
                                        <a href="<?php echo $this->webroot; ?>home/provider_all_solutions/<?php echo $provider['User']['id'] ; ?>">View Solutions</a>
                                    <!-- if user is not logged in -->
                                    <?php //else : ?>
                                        <!-- <a href="<?php echo $this->webroot ;?>home/index">Submit a Quote</a> -->
                                    <?php //endif; ?>
                                </li>
                            <!-- if user is logged in -->
                            <?php 
                                $done = 0; 
                                if(AuthComponent::user('id')) 
                                { 
                            ?>
                                <!-- if rating is already given by current logged in user(seeker) -->
                                <?php
                                    
                                    if (isset($check_rating[0]['RateNReview']['rate_to'])) {

                                        foreach ($check_rating as $key => $rating) 
                                        {
                                            if ($rating['RateNReview']['rate_to'] == $provider['User']['id']) 
                                            {
                                                $done = 1;
                                ?>
                                                <li>
                                                    <a href="#" class="rating-given"  data-toggle="collapse" data-target="#provider_reviews" >Rating & Reviews</a>
                                                </li>
                                                </br>
                                                <li>
                                                    <div class="show-rate-msg">
<!--                                                         You already given 
                                                        <b>
                                                        <?php
                                                        $rate_in = $rating['RateNReview']['rating'];  
                                                        echo $rating['RateNReview']['rating']; 
                                                        ?>  -->
                                                        <!-- </b> rating to this provider.  -->
                                                    </div>
                                                </li>
                                <?php        
                                            }
                                        }
                                    }

                                    if ($done != 1) 
                                    {
                                
                                    // if (in_array($provider['User']['id'], $check_rating['RateNReview']['rate_to'])) {
                                        // if($check_rating[0]['RateNReview']['rate_to'] != $provider['User']['id']) : 
                                ?>
                                    <li>
                                        <a href="javascript:;" data-toggle="collapse" data-target="#provider_reviews">Rating & Reviews</a>
                                    </li>
                                    
                                <?php
                                     } 

                                    } else {
                                ?>
                                    <li>
                                        <a href="javascript:;" data-toggle="modal" data-target="#provider_login_first">Rating & Reviews</a>
                                    </li>

                                    <?php  } ?>
                            </ul>
                        </div>
                    </div>
                    
                </div>



                 <!-- login first modal -->
                <div id="provider_login_first" class="modal fade modal_form" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <button type="button" class="close modal_close_btn" data-dismiss="modal">
                                <i class="fas fa-times"></i>
                            </button>
                            <div class="modal-body">
                                <div class="form_with_grey_bg">
                                    <h2 class="text-center txt_black txt_w_700">Please Login First</h2>
                                    <div class="text-center orange_btns m_t_30">
                                            <ul class="list-unstyled list-inline m_b_0">
                                                <li>
                                                    <a href="<?php echo $this->webroot.'home/login'; ?>">Login</a>
                                                    <!-- <input type="submit" value="Submit"> -->
                                                </li>
                                            </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div> -->
                        </div>

                    </div>
                </div>





                <div class="row collapse" id="provider_reviews">
                    <div class="col-sm-6 col-xs-12 p_t_80">
                        <h2 class="text-center txt_black m_b_20 txt_w_700">Rating &amp; Reviews</h2>
                        <h4 class="text-center txt_grey txt_w_400">Lorem ipsum dolor sit amet, consectetur.</h4>
                        <div class="reviews_sec m_t_30">

                            <?php 
                                if (!empty($ratings_count) ) 
                                {
                                    foreach ($company_ratings as $key => $rating) 
                                    {
                            ?>

                                        <div class="review_item">
                                            <div class="row">
                                                <div class="col-sm-2 col-xs-2 hidden-xs">
                                                    <img src="<?php echo $this->webroot.'no-image.jpg'  ?>" alt="Profile" class="img-circle img-responsive">
                                                </div>

                                                <div class="col-sm-10 col-xs-12">
                                                    <h4 class="listing_item_name">
                                                        <a href="javascript:;" class="txt_black txt_w_700">
                                                            <?php echo $rating['RateNReview']['name']; ?>
                                                        </a> 
                                                        <span class="listing_item_stars m_l_3">
                                                            <?php
                                                                $i = 1;
                                                                while ($i <= $rating['RateNReview']['rating']) {
                                                                    echo "<i class='fas fa-star'></i>";
                                                                    $i++;
                                                                }
                                                            ?>
                                                        </span>
                                                    </h4>
                                                    
                                                    <h6 class="listing_item_tags txt_w_400 m_t_10">
                                                        <a href="javascript:;" class="txt_grey">
                                                            <?php echo $rating['RateNReview']['created_at']; ?>
                                                        </a>
                                                    </h6>
                                                    <p class="para_small p_t_5">
                                                            <?php echo $rating['RateNReview']['description']; ?>
                                                    </p>
                                                    
            <!--                                         <div class="share_icon p_t_5">
                                                        <a href="#" class="txt_orange txt_12">
                                                            <i class="fas fa-share-alt m_r_3"></i> 
                                                                Share Comment
                                                        </a>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div> <!-- /.review_item -->



                            <?php
                                        /*list only 5 top favourites*/
                                        if($key > 5) break;
                                    }
                                }   
                            ?>



                        </div>


                        <div class="text-center orange_btns m_t_30">
                            <ul class="list-unstyled list-inline m_b_0">
                                <li><a href="#" data-toggle="modal" data-target="#favourite_modal" class="modal-content">See All</a></li>
                            </ul>
                        </div>
                    </div>


                    


                    <div class="col-sm-6 col-xs-12 p_t_80">
                        <h2 class="text-center txt_black m_b_20 txt_w_700">Write a Review</h2>
                        <h4 class="text-center txt_grey txt_w_400">Lorem ipsum dolor sit amet, consectetur.</h4>

                        <div class="form_with_grey_bg m_t_50">
                            <?php if ($done != 1) { ?>
                          
                                <?php echo $this->Form->create('RateNReview', array('controller' => 'home', 'url' => 'rating_n_reviews'))  ?>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control input_field" placeholder="Enter Name" value="<?php echo AuthComponent::user('name'); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control input_field" placeholder="Enter Email" value="<?php echo AuthComponent::user('email'); ?>">
                                </div>
                                    <!-- hidden field -->
                                    <input type="hidden" name="rate_to" value="<?php echo $provider['User']['id']; ?>">
                                <div class="form-group">
                                    <select class="form-control input_field rating" name="rating" >
                                        <option value="Select Star Rating" selected="" disabled="">Select Star Rating</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea rows="3" name="description" class="form-control input_field description" placeholder="Enter Message"></textarea>
                                </div>
                                <div class="text-center orange_btns m_t_30"  >
                                    <ul class="list-unstyled list-inline m_b_0">
                                        <li><input type="submit" ></li>
                                    </ul>
                                </div>
                            </form>

                            <?php   }else{ ?>
                                    <div style="font-size: 18px; font-weight: 600; text-align: center;">You already given <b><?php echo $rate_in; ?> rating</b> to this provider</div>
                            <?php }  ?>

                        </div>


                        </div>

                    </div>

                </div>










            </div>
        </div>
    </div>



    <!-- submit_quote_modal -->
    <div id="submit_quote_modal" class="modal fade modal_form" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close modal_close_btn" data-dismiss="modal"><i class="fas fa-times"></i></button>
                <div class="modal-body">
                    <div class="form_with_grey_bg">
                        <?php if(AuthComponent::user('id')) : ?>
                            <h2 class="text-center txt_black m_b_20 txt_w_700">Submit a Quote</h2>
                            <h4 class="text-center txt_grey txt_w_400">Lorem ipsum dolor sit amet, consectetur.</h4>
                                <form action="#" class="m_t_30">
                                    <div class="form-group">
                                        <input type="text" class="form-control input_field" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control input_field" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <textarea rows="3" class="form-control input_field" placeholder="Enter Message"></textarea>
                                    </div>
                                    <div class="text-center orange_btns m_t_30">
                                        <ul class="list-unstyled list-inline m_b_0">
                                            <li><a href="#">Submit</a></li>
                                        </ul>
                                    </div>
                                </form>
                        <?php else : ?>

                            <h2 class="text-center txt_black m_b_20 txt_w_700">Please login first</h2>
                            <div class="text-center orange_btns m_t_30">
                                <ul class="list-unstyled list-inline m_b_0">
                                    <li><a href="<?php echo $this->webroot; ?>home/login">Login</a></li>
                                </ul>
                            </div>

                        <?php endif; ?>


                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </div>

        </div>
    </div>



    <!-- submit_quote_modal -->
    <div id="favourite_modal" class="modal fade modal_form" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close modal_close_btn" data-dismiss="modal"><i class="fas fa-times"></i></button>
                <div class="modal-body">
                    <div class="form_with_grey_bg">

                            <h2 class="text-center txt_black m_b_20 txt_w_700">Rating &amp; Reviews</h2>
                            <h4 class="text-center txt_grey txt_w_400">Lorem ipsum dolor sit amet, consectetur.</h4>
                            <div class="reviews_sec m_t_30">

                                <?php 
                                    if (!empty($ratings_count) ) 
                                    {
                                        foreach ($company_ratings as $key => $rating) 
                                        {
                                ?>

                                            <div class="review_item">
                                                <div class="row">
                                                    <div class="col-sm-2 col-xs-2 hidden-xs">
                                                        <img src="<?php echo $this->webroot.'no-image.jpg'  ?>" alt="Profile" class="img-circle img-responsive">
                                                    </div>

                                                    <div class="col-sm-10 col-xs-12">
                                                        <h4 class="listing_item_name">
                                                            <a href="javascript:;" class="txt_black txt_w_700">
                                                                <?php echo $rating['RateNReview']['name']; ?>
                                                            </a> 
                                                            <span class="listing_item_stars m_l_3">
                                                                <?php
                                                                    $i = 1;
                                                                    while ($i <= $rating['RateNReview']['rating']) {
                                                                        echo "<i class='fas fa-star'></i>";
                                                                        $i++;
                                                                    }
                                                                ?>
                                                            </span>
                                                        </h4>
                                                        
                                                        <h6 class="listing_item_tags txt_w_400 m_t_10">
                                                            <a href="javascript:;" class="txt_grey">
                                                                <?php echo $rating['RateNReview']['created_at']; ?>
                                                            </a>
                                                        </h6>
                                                        <p class="para_small p_t_5">
                                                                <?php echo $rating['RateNReview']['description']; ?>
                                                        </p>
                                                        
                <!--                                         <div class="share_icon p_t_5">
                                                            <a href="#" class="txt_orange txt_12">
                                                                <i class="fas fa-share-alt m_r_3"></i> 
                                                                    Share Comment
                                                            </a>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div> <!-- /.review_item -->


                                <?php
                                        }
                                    }   
                                ?>



                            </div>


                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </div>

        </div>
    </div>



