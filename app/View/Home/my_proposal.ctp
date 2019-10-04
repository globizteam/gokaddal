        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <!-- <h1 class="text-center txt_white m_b_20 txt_52">Cyberdyne System</h1>
                    <h3 class="text-center txt_white m_b_70">Category/Solution Provider Name</h3> -->
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            
                            
                            <?php echo $this->element('Frontend/search_form'); ?>

                            <!-- <p class="txt_16 txt_white text-center after_search m_b_20">Popular Searches: &nbsp;&nbsp;&nbsp; <a href="#">Smart Cities</a> , <a href="#">Utilities</a> , <a href="#">Healthcare</a> , <a href="#">Real Estate</a></p> -->
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
                        
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <div class="my_account_main_content p_tb_80 col_sm_p_tb_60">
                                    <h2 class="txt_black m_b_20">My Proposals</h2>
                                    
                                    <div class="my_info_body m_t_30">
                                        <h4 class="txt_black txt_w_600">Proposals</h4>
                                        <hr class="dark_grey_hr m_t_15">


                                        <div class="listing_item_sec">

                                            <?php
                                                if (!empty($userdata)) 
                                                {
                                                   foreach ($userdata as $key => $user) 
                                                   {
                                            ?>
                                            <div class="listing_item bg_white_item">
                                                <div class="row">
                                                    <div class="col-md-9 col-sm-8 col-xs-8 col_600_full_width">
                                                        <div class="listing_item_info listing_match_item">
                                                            <h4 class="listing_item_name">
                                                                <a href="single_provider.php" class="txt_black">
                                                                    <?php
                                                                        echo $user['SeekerRequirement']['title'];                    
                                                                    ?>
                                                                </a>
                                                            </h4>
                                                            <h5 class="listing_item_tags txt_w_400 m_t_10">
                                                                <a href="#" class="txt_orange hover_txt_orange text-uppercase">
                                                                    Smart Cities, Tag name Here
                                                                </a>
                                                            </h5>
                                                            
                                                            <p class="m_t_10">
                                                                    <?php
                                                                        echo $user['SeekerRequirement']['description'];    
                                                                    ?>
                                                            </p>
                                                            
                                                            <div class="listing_item_location m_t_10">
                                                                <i class="fas fa-map-marker-alt txt_orange"></i> 
                                                                <span class="txt_grey">
                                                                    
                                                                    <?php

                                                                    foreach ($allSeekerUsers as $key => $seeker) {
                                                                        if (!empty($seeker) && ($seeker['User']['id'] == $user['SeekerRequirement']['user_id'])) 
                                                                        {

                                                                            echo $seeker['User']['address'];                    
                                                                            # code...
                                                                        }
                                                                        
                                                                    }
                                                                    ?>

                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-4 col-xs-4 col_600_full_width xs_m_t_15">
                                                        <div class="listing_item_btns listing_match_item">
                                                            <ul class="list-unstyled m_b_0">
                                                                <li>
                                                                    <a href="<?php echo $this->webroot.'home/seeker_requirement_view/'.$user['SeekerRequirement']['id']; ?>">
                                                                        <i class="fa fa-eye"></i>
                                                                            View Details
                                                                    </a>
                                                                </li>
                                                                <!-- <li><a href="#"><i class="fa fa-heart"></i>Save</a></li> -->
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                                <hr class="m_t_10 m_b_0">
                                                <h5 class="txt_black m_t_10 l_h_24px">
                                                    <em>
                                                        <?php
                                                            echo $user['SubmitQuote']['message'];    
                                                        ?>
                                                    </em>
                                                </h5>
                                                <h5 class="txt_w_400 m_t_10 txt_12">
                                                    <a href="#" class="txt_grey">
                                                        <?php

                                                        $created_at = $user['SeekerRequirement']['created_at'];    
                                                        $created_at = explode(' ', $created_at);

                                                        $datetime1 = new DateTime($created_at[0]);
                                                        $datetime2 = new DateTime();
                                                        $interval = $datetime1->diff($datetime2);
                                                        echo $interval->format('%a days ago')

                                                         // $onlydate = explode(' ', $user['SeekerRequirement']['created_at']);   
                                                         //    echo $onlydate[0];    
                                                        ?>
                                                    </a>
                                                </h5>
                                            </div> <!-- /.listing_item -->

                                            <?php
                                                   }
                                                }

                                            ?>

                                        </div> <!-- /.listing_item_sec -->

                                    </div> <!-- /.my_info_body -->

                                    <?php if(!empty($requirementcount)) {?> 
                                        <div class="custom-pagination">
                                            <nav aria-label="Page navigation example">
                                                <?php echo $this->element('Admin/pagination')?>
                                            </nav>
                                        </div>
                                    <?php }else{  ?>
                                        <div style=" text-align: center; margin-top: 20px; font-size: 16px; font-weight: 600;">You have no proposals yet.</div>

                                    <?php }  ?>

                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- /.col-md-9 -->
                    
                </div>
            <!-- </div> -->
        </div>
    </div>


