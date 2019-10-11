
        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <h1 class="text-center txt_white m_b_20 txt_52">Our Blog</h1>
                    <h3 class="text-center txt_white m_b_70">Lorem ipsum dolor sit amet.</h3>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            
                            
                            <?php //echo $this->element('Frontend/search_form'); ?>


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

                    <div class="col-md-3 col-sm-12 rightBar ">
                        <h3 class="txt_black txt_w_700 text-uppercase">Sort By</h3>
                        <ul class="m_t_40 solution_sidebar listing_page_sidebar list-unstyled p_l_0">
                            <li><a href="<?php echo $this->webroot.'home/blog/?key=recent' ?>">Recent Posts</a></li>
                            <li><a href="<?php echo $this->webroot.'home/blog/?key=week' ?>">Last Week</a></li>
                            <li><a href="<?php echo $this->webroot.'home/blog/?key=month' ?>">Last Month</a></li>
                            <li><a href="<?php echo $this->webroot.'home/blog/?key=year' ?>">Last Year</a></li>
                        </ul>

                        <h3 class="txt_black txt_w_700 text-uppercase m_t_60">Categories</h3>
                        <ul class="m_t_40 solution_sidebar listing_page_sidebar list-unstyled p_l_0">
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

                    </div> <!-- /.col-md-3 -->


                    <div class="col-md-9 col-sm-12">

                        <h3 class="col_sm_m_t_50">
                            <a href="javascript:;" class="txt_black hover_txt_orange">
                                <?php echo $blog['Blog']['title']; ?>
                            </a>
                        </h3>
                        
                        <div class="blog_meta_info m_t_15">
                            <span class="txt_grey">
                                <i class="fas fa-user"></i> 
                                By Admin 
                            </span>
                            
                            <span class="txt_grey">
                                <i class="fas fa-calendar-alt"></i> 
                                <?php
                                    $date = explode(' ', $blog['Blog']['created_at']);
                                    echo $date[0]; 
                                ?>
                            </span>
                        </div>

                        <a href="javascript:;" class="blog_hr_item_img m_t_30">
                            <?php 
                                if (!empty($blog['Blog']['images'])) 
                                {
                            ?>
                                    <img src="<?php echo $this->webroot.$blog['Blog']['images']; ?>" alt="Image" class="img-responsive">
                            <?php
                                }else{
                            ?>
                                    <img src="<?php echo $this->webroot.'no-image.jpg'; ?>" alt="Image" class="img-responsive no-img">
                            <?php

                                } 
                            ?>
                        </a>
                        
                        <p class="para_large txt_black m_t_30">
                                <?php echo $blog['Blog']['description']; ?>
                        </p>

                        <?php 
                            /*Getting current page url*/
                            $uri = $_SERVER['REQUEST_URI'];
                            // echo $uri; // Outputs: URI
                             
                            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                             
                            $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            // echo $url; // Outputs: Full URL
                             
                            $query = $_SERVER['QUERY_STRING'];
                            // echo $query; // Outputs: Query String

                        ?>
                        
                        <div class="share_blog_post m_t_30">
                            <ul class="list-inline">
                                <li class="share_post_title txt_w_700 txt_black">
                                    Share Post - 
                                </li>
                                <li>
                                    <a href="http://www.facebook.com/sharer.php?u=<?php echo $url ?>" target="_blank" class="bg_fb">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <?php $title = $blog['Blog']['title']; ?>
                                    <a href="http://twitter.com/share?text=<?php echo $title ?>&url=<?php echo $url ?>" target="_blank" class="bg_twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/share?url=<?php echo $url ?>" target="_blank" rel="noopener" class="bg_insta">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url ?>" target="_blank" class="bg_ld">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>





<!--                         <div class="row m_t_60">
                            <div class="col-md-8 col-sm-8">
                                <h2 class="text-center txt_black m_b_20 txt_w_700">Write a Review</h2>
                                <h4 class="text-center txt_grey txt_w_400">Lorem ipsum dolor sit amet, consectetur.</h4>

                                <div class="form_with_grey_bg m_t_50">
                                    <form action="#">
                                        <div class="form-group">
                                            <input type="text" class="form-control input_field" placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control input_field" placeholder="Enter Email">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control input_field">
                                                <option value="Select Star Rating" selected disabled>Select Star Rating</option>
                                                <option value="1 star">1 Star</option>
                                                <option value="2 star">2 Star</option>
                                                <option value="3 star">3 Star</option>
                                                <option value="4 star">4 Star</option>
                                                <option value="5 star">5 Star</option>
                                            </select>
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
                                </div>
                            </div>
                        </div> -->


                    </div> <!-- /.col-md-9 -->

                   
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.container-fluid -->
    </div>
