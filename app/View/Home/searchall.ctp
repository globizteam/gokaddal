        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <h1 class="text-center txt_white m_b_20 txt_52">Search Result</h1>
                    <!-- <h3 class="text-center txt_white m_b_70">Lorem ipsum dolor sit amet.</h3> -->
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            
                            
                            <?php //include 'search_form_top.php'; ?>


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
                <div class="row">

                    <div class="col-md-3 col-sm-12 rightBar col_sm_m_t_50">
                        <h3 class="txt_black txt_w_700 text-uppercase">Categories</h3>
                        <ul class="m_t_40 solution_sidebar listing_page_sidebar list-unstyled p_l_0">
                            <!-- if logged in as seeker, will see all the categories -->
                            <?php 
                                if( AuthComponent::user('type') != 1 ) 
                                {
                                    foreach ($categories as $key => $category) 
                                    { 

                            ?>
                                    <li>
                                        <a href="<?php echo $this->webroot.'home/provider_all_solutions?id='.$key.'&showcategories=1'; ?>">
                                            <?php echo $category; ?>
                                        </a>
                                    </li>
                            <?php 
                                    } 
                                }
                            ?>

                            <?php 
                                if( AuthComponent::user('type') == 1 ) 
                                {
                                    if (count($cat_names) > 0) {

                                        foreach ($cat_names as $key => $category) 
                                        { 

                                ?>
                                        <li>
                                            <a href="<?php echo $this->webroot.'home/seeker_selected_category?id='. $category['Category']['id'].'&showcategories=1'; ?>">
                                                <?php echo $category['Category']['title']; ?>
                                            </a>
                                        </li>
                                <?php 
                                        } 
                                    }else{
                                        echo "<li style='color: #ff7f27;'>No Categories Found</li>";
                                    }
                                }
                            ?>
                        </ul>

                        <h3 class="txt_black txt_w_700 text-uppercase m_t_60">POPULAR SOLUTION AREAS</h3>
                        <ul class="m_t_40 solution_sidebar listing_page_sidebar list-unstyled p_l_0">
                            <li><a href="#">Digital healthcare</a></li>
                            <li><a href="#">Smart Water Management</a></li>
                            <li><a href="#">Egovernance</a></li>
                            <li><a href="#">Fleet Management</a></li>
                            <li><a href="#">Energy Management</a></li>
                            <li><a href="#">RFID Tracking</a></li>
                            <li><a href="#">Data Analytics</a></li>
                            <li><a href="#">Robotic Assistant</a></li>
                            <li><a href="#">AI Bots</a></li>
                            <li><a href="#">AR/VR</a></li>
                        </ul>

                    </div> <!-- /.col-md-3 -->

                    <div class="col-md-9 col-sm-12">

                        <p class="txt_18 txt_black sort_by_option_one_line m_b_20 col_sm_m_t_50"><strong>Sort By -</strong>&nbsp; <a href="#" class="active">Rating</a> , <a href="#">Popularty</a> , <a href="#">Top Results</a> , <a href="#">Best Deals</a></p>

                        <div class="row p_lr_10">
                            <div class="col-lg-11 col-md-12">
                                <div class="listing_search_form">
                                   <form name="searchform" method="post" action="<?php echo $this->webroot.'/home/searchall'; ?>" id="searchform">

                                        <div class="row">
                                            <div class="col-sm-5 p_lr_6">
                                                <div class="input-group">
                                                    <span class="input-group-addon input_icon"><i class="fas fa-map-marker-alt"></i></span>
                                                    <input type="text" name="location" class="form-control search_inputs" placeholder="Location">
                                                </div>
                                            </div>
                                            <div class="col-sm-5 p_lr_6 xs_m_t_15">
                                                <div class="input-group">
                                                    <span class="input-group-addon input_icon"><i class="fas fa-search"></i></span>
                                                    <input type="text" name="lookingfor" class="form-control search_inputs" placeholder="Looking For...">
                                                </div>
                                            </div>
                                            <div class="col-sm-2 p_lr_6 xs_m_t_15">
                                               <button type="submit" class="send_btn search_btn">SEARCH<i class="fas fa-angle-right m_l_3"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- Listings start here -->
                        <div class="listing_item_sec m_t_40">

                        <?php 
                        /*For Providers listings*/
                        // if(!empty($searchResult) && (AuthComponent::user('type') == 2) ) 
                        if( !empty($searchResult) && (AuthComponent::user('type') != 1)  ) 
                        {
	                        foreach ($searchResult as $key => $user) 
	                        {
                        ?>
                            <div class="listing_item bg_grey_item">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <div class="listing_item_img listing_match_item">
                                                <?php if(isset($user['User']['profile_pic'])) :?> 
                                                    
                                                    <img src="<?php echo  $this->webroot.$user['User']['profile_pic']; ?>" alt="Image" class="img-responsive center-block" width="100px" >
                                                    <?php else : ?> 
                                                        <img src="<?php echo  $this->webroot.'app/webroot/no-image.jpg' ?>" alt="Image" class="img-responsive center-block" width="100px" >
                                                    <?php endif; ?>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 col_600_full_width xs_m_t_15">
                                            <div class="listing_item_info listing_match_item">
                                                <h4 class="listing_item_name">
                                                    <a href="<?php echo  $this->webroot.'home/provider_details/'.$user['User']['id']; ?>" class="txt_black">
                                                        <?php echo  $user['User']['name']; ?>
                                                    </a>
                                                </h4>
                                                <!-- <h5 class="listing_item_tags txt_w_400 m_t_10"><a href="#" class="txt_grey">Parfact, Modren & Compact</a></h5> -->

                                                <?php 
                                                    $total_users = $final_rating_no = 0;
                                                    $one_calc = $two_calc = $three_calc = $four_calc = $five_calc = 0;

                                                    // print_r($rating_all_records[0]['RateNReview']);die();
                                                    if(isset($rating_all_records[0]['RateNReview']) )
                                                    {
                                                        foreach ($rating_all_records as $key => $rating) 
                                                        {
                                                                if($rating['RateNReview']['rate_to'] == $user['User']['id'])
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


                                                
                                                <div class="listing_item_location m_t_10"><i class="fas fa-map-marker-alt txt_orange"></i> <span class="txt_grey">
                                                        <?php echo  $user['User']['address']; ?>

                                                </span></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6 col_600_full_width xs_m_t_15">
                                            <div class="listing_item_btns listing_match_item">
                                                <ul class="list-unstyled m_b_0">
                                                    <li>
                                                        <?php
                                                            echo $this->Html->link(
                                                                    $this->Html->tag('i', '', array('class' => 'fa fa-eye')) .'View Details',
                                                                    array(
                                                                        'controller' => 'home',
                                                                        'action' => 'provider_details/'.$user['User']['id'],
                                                                        'full_base' => true
                                                                    ),
                                                                    array('escape' => false)
                                                            );


                                                            // echo $this->Html->link(
                                                            //     'View Details',
                                                            //     array(
                                                            //         'controller' => 'home',
                                                            //         'action' => 'provider_details/'.$user['User']['id'],
                                                            //         'full_base' => true
                                                            //     )
                                                            // );

                                                        ?>

                                                    </li>
<!--                                                     <li>
                                                        <a href="#" data-toggle="modal" data-target="#like_modal">
                                                            <i class="fa fa-heart"></i>Favourite
                                                        </a>
                                                    </li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> 


                            <?php  
                        		} 
                        	}
                        	?>


                            <!-- For Seekers listings start -->

                        <?php 
                        if(!empty($searchResult) && (AuthComponent::user('type') == 1) )
                        {
                            foreach ($searchResult as $key => $seeker) 
                            {    
                            ?>
                                <div class="listing_item bg_grey_item">
                                    <div class="row">
                                        <div class="col-md-9 col-sm-8 col-xs-8 col_600_full_width">
                                            <div class="listing_item_info listing_match_item">
                                                <h4 class="listing_item_name">
                                                    <a href="<?php echo $this->webroot.'home/seeker_requirement_view/'.$seeker['SeekerRequirement']['id'];  ?>" class="txt_black">
                                                        <!-- Need Smart Water Management solution -->
                                                        <?php echo  $seeker['SeekerRequirement']['title']; ?>
                                                    </a>
                                                </h4>
                                                <h5 class="listing_item_tags txt_w_400 m_t_10">
                                                    <a href="javascript:;" class="txt_orange hover_txt_orange text-uppercase">
                                                        <?php echo  $seeker['Tag']['name']; ?>
                                                    </a>
                                                </h5>
                                                <p class="m_t_10">
                                                        <?php echo  $seeker['SeekerRequirement']['description']; ?>
                                                </p>
                                                <div class="listing_item_location m_t_10">
                                                    <i class="fas fa-map-marker-alt txt_orange"></i> 
                                                    <span class="txt_grey">
                                                        <?php echo  $seeker['User']['address']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-4 col_600_full_width xs_m_t_15">
                                            <div class="listing_item_btns listing_match_item">
                                                <ul class="list-unstyled m_b_0">
                                                    <li>
                                                        <a href="<?php echo $this->webroot.'home/seeker_requirement_view/'.$seeker['SeekerRequirement']['id'];  ?>">
                                                            <i class="fa fa-eye"></i>
                                                                View Details
                                                        </a>
                                                    </li>
<!--                                                     <li>
                                                        <a href="#">
                                                            <i class="fa fa-heart"></i>
                                                                Save
                                                        </a>
                                                    </li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- /.listing_item -->

                    <?php  
                            } 
                        }
                    ?>


                            <!-- For Seekers listings end-->


                        </div> <!-- /.listing_item_sec -->

                        <!-- Pagination starts here -->
                    <?php if(!empty($searchResult)) {?> 
                        <div class="custom-pagination">
                            <nav aria-label="Page navigation example">
                                <?php echo $this->element('Admin/pagination')?>
                            </nav>
                        </div>
                   <?php }else{  ?>
                       <div style=" text-align: center; font-size: 16px; font-weight: 600;"> No result found related to your seach keyword.</div>

                   <?php }  ?>

                   </div> <!-- /.col-md-9 -->
                    
                </div>
            </div>
        </div>
    </div>


    <!-- submit_quote_modal -->
    <div id="like_modal" class="modal fade modal_form" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close modal_close_btn" data-dismiss="modal"><i class="fas fa-times"></i></button>
                <div class="modal-body">
                    <div class="form_with_grey_bg">
                        <?php if(!AuthComponent::user('id')) : ?>

                            <h2 class="text-center txt_black m_b_20 txt_w_700">Please login first</h2>
                            <div class="text-center orange_btns m_t_30">
                                <ul class="list-unstyled list-inline m_b_0">
                                    <li><a href="<?php echo $this->webroot; ?>home/login">Login</a></li>
                                </ul>
                            </div>

                        <?php endif; ?>


                    </div>
                </div>
            </div>

        </div>
    </div>




