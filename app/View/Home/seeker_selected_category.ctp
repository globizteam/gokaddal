        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <h1 class="text-center txt_white m_b_20 txt_52">Solution Seeker</h1>
                    <h3 class="text-center txt_white m_b_70">Category/Solution Seeker Name</h3>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            
                      <!--       <p class="txt_16 txt_white text-center after_search m_b_20">Popular Searches: &nbsp;&nbsp;&nbsp; <a href="#">Smart Cities</a> , <a href="#">Utilities</a> , <a href="#">Healthcare</a> , <a href="#">Real Estate</a></p> -->
                            
                            <?php //echo $this->element('Frontend/search_form'); ?>


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
                            <li><a href="#">Smart Cities</a></li>
                            <li><a href="#">Public Services</a></li>
                            <li><a href="#">Manufacturing</a></li>
                            <li><a href="#">E-Governance</a></li>
                            <li><a href="#">Oil& Gas</a></li>
                            <li><a href="#">Servillence & Security</a></li>
                            <li><a href="#">Real Estate</a></li>
                            <li><a href="#">Transportation</a></li>
                            <li><a href="#">Agriculture</a></li>
                            <li><a href="#">Media & Entertainment</a></li>
                            <li><a href="#">Retail</a></li>
                            <li><a href="#">Banking & Finance</a></li>
                            <li><a href="#">Utilities</a></li>
                            <li><a href="#">Dairy</a></li>
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

                        <p class="txt_18 txt_black sort_by_option_one_line m_b_20 col_sm_m_t_50"><strong>Sort By -</strong>&nbsp; <a href="#"class="active">Rating</a> , <a href="#">Popularty</a> , <a href="#">Top Results</a> , <a href="#">Best Deals</a></p>

                        <div class="row p_lr_10">
                            <div class="col-lg-11 col-md-12">
                                <div class="listing_search_form">
                                   <form action="#">
                                        <div class="row">
                                            <!-- <p class="txt_16 txt_white text-center after_search m_b_20">Popular Searches: &nbsp;&nbsp;&nbsp; <a href="#">Smart Cities</a> , <a href="#">Utilities</a> , <a href="#">Healthcare</a> , <a href="#">Real Estate</a></p> -->

                                            <div class="col-sm-5 p_lr_6">
                                                <div class="input-group">
                                                    <span class="input-group-addon input_icon"><i class="fas fa-map-marker-alt"></i></span>
                                                    <input type="text" class="form-control search_inputs" placeholder="Location">
                                                </div>
                                            </div>
                                            <div class="col-sm-5 p_lr_6 xs_m_t_15">
                                                <div class="input-group">
                                                    <span class="input-group-addon input_icon"><i class="fas fa-search"></i></span>
                                                    <input type="text" class="form-control search_inputs" placeholder="Looking For...">
                                                </div>
                                            </div>
                                            <div class="col-sm-2 p_lr_6 xs_m_t_15">
                                                <a href="#" class="send_btn">SEARCH <i class="fas fa-angle-right m_l_3"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="listing_item_sec m_t_40">


                                <?php
                                    if (!empty($seeker_req_count)) 
                                    {
                                        foreach ($seeker_requirements as $key => $require) 
                                        {

                                ?>

                                <div class="listing_item bg_grey_item">
                                    <div class="row">
                                        <div class="col-md-9 col-sm-8 col-xs-8 col_600_full_width">
                                            <div class="listing_item_info listing_match_item">
                                                <h4 class="listing_item_name">
                                                    <a href="javascript:;" class="txt_black">
                                                        <?php
                                                            echo $require['SeekerRequirement']['title'];
                                                        ?>
                                                    </a>
                                                </h4>
                                                
                                                <h5 class="listing_item_tags txt_w_400 m_t_10">
                                                    <a href="javascript:;" class="txt_orange hover_txt_orange text-uppercase">
                                                        <?php
                                                            echo $require['Tag']['name'];
                                                        ?>
                                                    </a>
                                                </h5>
                                                
                                                <p class="m_t_10">
                                                        <?php
                                                            echo $require['SeekerRequirement']['description'];
                                                        ?>
                                                </p>
                                                
                                                <div class="listing_item_location m_t_10">
                                                    <i class="fas fa-map-marker-alt txt_orange"></i> 
                                                    <span class="txt_grey">
                                                        <?php
                                                            echo $require['User']['address'];
                                                        ?>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-4 col_600_full_width xs_m_t_15">
                                            <div class="listing_item_btns listing_match_item">
                                                <ul class="list-unstyled m_b_0">
                                                    <li>
                                                        <a href="<?php echo $this->webroot.'home/seeker_requirement_view/'.$require['SeekerRequirement']['id']; ?>">
                                                            <i class="fa fa-eye"></i>
                                                                View Details
                                                        </a>
                                                    </li>
    <!--                                                 <li>
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

                               <?php    }
                                    }
                                ?>


                       
                        </div> <!-- /.listing_item_sec -->



                             <!-- Pagination starts here -->
                         <?php if(!empty($seeker_req_count)) {?> 
                             <div class="custom-pagination">
                                 <nav aria-label="Page navigation example">
                                     <?php echo $this->element('Admin/pagination')?>
                                 </nav>
                             </div>
                        <?php }else{  ?>
                            <div style=" text-align: center; font-size: 16px; font-weight: 600;">
                                No Requirements for this category.
                            </div>

                        <?php }  ?>




                    </div> <!-- /.col-md-9 -->
                    
                </div>
            </div>
        </div>
    </div>

