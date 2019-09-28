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
                                    <h2 class="txt_black m_b_20">Notifications</h2>
                                    
                                    <div class="my_info_body m_t_30">
                                        <h4 class="txt_black txt_w_600">Notification List</h4>
                                        <hr class="dark_grey_hr m_t_15">


                                        <div class="listing_item_sec">

                                            <?php 
                                                if ( !empty($quote_list) ) 
                                                {
                                                
                                                    foreach ($quote_list as $key => $quote) 
                                                    {
                                            ?>
                                                    <a href="<?php echo $this->webroot.'home/my_requirement_detail/'.$quote['SeekerRequirement']['id']; ?>">
                                                        <div class="listing_item bg_white_item <?php if($quote['SubmitQuote']['read_status'] == 0 ) { echo 'notification_border_orange'; } ?> ">
                                                            <h5>
                                                                <a href="<?php echo $this->webroot.'home/my_requirement_detail/'.$quote['SeekerRequirement']['id']; ?>" class="txt_black hover_txt_orange">
                                                                    <?php echo $quote['SubmitQuote']['message'];  ?>
                                                                </a>
                                                            </h5>
                                                            <h5 class="txt_w_400 m_t_10 txt_12">
                                                                <a href="javascript:;" class="txt_grey">

                                                                    <?php
                                                                        $created_at = $quote['SubmitQuote']['created_at'];    
                                                                        $created_at = explode(' ', $created_at);

                                                                        $datetime1 = new DateTime($created_at[0]);
                                                                        $datetime2 = new DateTime();
                                                                        $interval = $datetime1->diff($datetime2);
                                                                        echo $interval->format('%a days ago')
                                                                    ?>
                                                                    <!-- 1 day ago -->
                                                                </a>
                                                            </h5>
                                                        </div> <!-- /.listing_item -->
                                                    </a>

                                        <?php   

                                                    }
                                                }else{

                                                }  

                                        ?>

                                        </div> <!-- /.listing_item_sec -->
                                    </div> <!-- /.my_info_body -->

                                         <!-- Pagination starts here -->
                                     <?php if(!empty($count)) {?> 
                                         <div class="custom-pagination">
                                             <nav aria-label="Page navigation example">
                                                 <?php echo $this->element('Admin/pagination')?>
                                             </nav>
                                         </div>
                                    <?php }else{  ?>
                                        <div style=" text-align: center; font-size: 16px; font-weight: 600;">
                                            You have no notifications.
                                        </div>

                                    <?php }  ?>

                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- /.col-md-9 -->
                    
                </div>
            <!-- </div> -->
        </div>
    </div>

