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
                                    <h2 class="txt_black m_b_20">
                                        <?php echo $requirement['SeekerRequirement']['title']; ?>
                                    </h2>
                                    
                                    <div class="my_info_body m_t_30">
                                        <h4 class="txt_black txt_w_600">My Requirement</h4>
                                        <hr class="dark_grey_hr m_t_15">

                                        <div class="row">

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <p class="para_large">
                                                    <?php echo $requirement['SeekerRequirement']['description']; ?>
                                                </p>
                                                <h5 class="listing_item_tags txt_w_400 m_t_15">
                                                    <span class="txt_orange">TAGS: </span>
                                                    <a href="javascript:;" class="txt_grey">
                                                        <?php echo $requirement['Tag']['name']; ?>
                                                    </a>
                                                </h5>
<!--                                                 <div class="listing_item_stars m_t_10">
                                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                                </div> -->
                                                <div class="listing_item_location txt_12 m_t_10 txt_grey">
                                                    PUBLISH DATE: 
                                                    <?php 
                                                        $onlydate = explode(' ', $requirement['SeekerRequirement']['created_at']);                                                                       
                                                    echo $onlydate[0]; ?> &nbsp;&nbsp; | &nbsp;&nbsp; EXPIRY DATE: <?php echo $requirement['SeekerRequirement']['expiry_date']; ?>
                                                </div>
                                                <div class="listing_btns_left">
                                                    <ul class="list-unstyled m_t_15 m_b_0">
                                                        <a href="<?php echo $this->webroot.'home/post_requirement/'.$requirement['SeekerRequirement']['id']; ?>">
                                                            <i class="fas fa-pencil-alt"></i> Edit
                                                        </a> 
                                                        <a href="<?php echo $this->webroot.'home/delete_requirement/'.$requirement['SeekerRequirement']['id']; ?>"  onclick="return confirm('Are you sure, You want to delete this requirement?')" data-toggle="tooltip" title="Delete" class="pd-setting-ed">
                                                            <i class="fas fa-times"></i> Delete
                                                        </a>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>

                                    </div> <!-- /.my_info_body -->


                                    <div class="my_info_body m_t_30">
                                        <h4 class="txt_black txt_w_600">Received Quotes</h4>
                                        <hr class="dark_grey_hr m_t_15 m_b_15">

                                        <?php
                                            if (!empty($requirement['SubmitQuote'])) 
                                            {
                                                foreach ($requirement['SubmitQuote'] as $key => $quote) 
                                                {
                                                    // echo "<pre>";
                                                    // print_r($quote);
                                                    // echo "</pre>";
                                                    // die();

                                          ?>
                                        <div class="reviews_sec">
                                            <div class="review_item">
                                                <h4 class="listing_item_name">
                                                    <a href="single_seeker.php" class="txt_black txt_w_700">
                                                        <?php echo $quote['name']; ?>
                                                    </a> 
                                                </h4>
                                                <h6 class="listing_item_tags txt_w_400 m_t_10">
                                                    <a href="#" class="txt_grey">
                                                        <?php
                                                                $onlydate = explode(' ', $quote['created_at']);                                                                       
                                                            echo $onlydate[0]; 
                                                         // echo $quote['created_at']; 
                                                         ?>
                                                        <!-- 22 June, 2018 -->
                                                    </a>
                                                </h6>
                                                <p class="para_small p_t_5">
                                                    <?php echo $quote['message']; ?>

                                                </p>
                                                <div class="share_icon p_t_5">
                                                    <a href="javascript:;" class="txt_orange txt_12">
                                                        <i class="fas fa-envelope m_r_3"></i>

                                                        <?php

                                                            // in_array($onlyusers, haystack)
                                                        foreach ($onlyusers as $key => $contact) 
                                                        {
                                                            if ($contact['id'] == $quote['user_id']) 
                                                                echo $contact['contact'];
                                                        }

                                                        ?>
                                                            
                                                    </a>
                                                </div>
                                            </div> <!-- /.review_item -->

                                            <?php  
                                                }
                                             } 

                                            ?>

                                        <div class="text-center orange_btns m_t_30">
                                            <ul class="list-unstyled list-inline m_b_0">
                                                <li><a href="javascript:;">See All</a></li>
                                            </ul>
                                        </div>

                                    </div> <!-- /.my_info_body -->




                                

                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- /.col-md-9 -->
                    
                </div>
            <!-- </div> -->
        </div>
    </div>

