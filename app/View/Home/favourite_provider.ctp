

        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <!-- <h1 class="text-center txt_white m_b_20 txt_52">Cyberdyne System</h1>
                    <h3 class="text-center txt_white m_b_70">Category/Solution Provider Name</h3> -->
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            <?php echo $this->element('Frontend/search_form'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="my_account_container">
        <div class="container-fluid">
            <!-- <div class="container"> -->
                <div class="row">

                    <div class="col-md-3 col-sm-12">
                        
                        <?php echo $this->element('Frontend/my_account_sidebar'); ?>

                    </div> <!-- /.col-md-3 -->

                    <div class="col-md-9 col-sm-12 my_acc_match_height">

                        <?php echo $this->Flash->render(); ?>
                        
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <div class="my_account_main_content p_tb_80 col_sm_p_tb_60">
                                    <h2 class="txt_black m_b_20">My Favourites</h2>
                                    
                                    <div class="my_info_body m_t_30">
                                        <h4 class="txt_black txt_w_600">Wishlist</h4>
                                        <hr class="dark_grey_hr m_t_15">


                        <!-- Listings start here -->
                        <div class="listing_item_sec m_t_40">

                        <?php foreach ($fav_providers as $key => $user) :?>
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
                                                    <a href="javascript:;" class="txt_black">
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
                                                    <li>
                                                        <!-- removing from favourite sending provider service id -->
                                                        <a href="<?php echo  $this->webroot.'home/remove_favourite/'.$user['ProviderService']['id']; ?>" >
                                                            <i class="fa fa-heart"></i>Remove
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> 


                            <?php  endforeach; ?>

                        </div> <!-- /.listing_item_sec -->


                                        <!-- <div class="my_info_form">
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="current_password" class="txt_black">Enter Current Password</label>
                                                            <input type="password" class="form-control input_field my_info_input" id="current_password" placeholder="Enter Current Password" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="new_password" class="txt_black">Enter New Password</label>
                                                            <input type="password" class="form-control input_field my_info_input" id="new_password" placeholder="Enter New Password" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="reenter_new_password" class="txt_black">Re-enter New Password</label>
                                                            <input type="password" class="form-control input_field my_info_input" id="reenter_new_password" placeholder="Re-enter New Password" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        
                                                    </div>
                                                </div>
                                            </form>
                                        </div> -->
                                    </div> <!-- /.my_info_body -->


                                         <!-- Pagination starts here -->
                                     <?php if(!empty($count)) {?> 
                                         <div class="custom-pagination">
                                             <nav aria-label="Page navigation example">
                                                 <?php echo $this->element('Admin/pagination')?>
                                             </nav>
                                         </div>
                                    <?php }else{  ?>
                                        <div style=" text-align: center; font-size: 16px; font-weight: 600;">No provider match as per your requirement.</div>

                                    <?php }  ?>
<!--                                     <div class="listing_pagination text-center m_t_15">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination">
                                                <li>
                                                    <a href="#" aria-label="Previous">
                                                       <i class="fas fa-chevron-left"></i>
                                                    </a>
                                                </li>
                                                <li class="active"><a href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#">5</a></li>
                                                <li>
                                                    <a href="#" aria-label="Next">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div> 
 -->
                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- /.col-md-9 -->
                    
                </div>
            <!-- </div> -->
        </div>
    </div>




