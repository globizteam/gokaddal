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

                    <div class="col-md-3 col-sm-12 rightBar col_sm_m_t_50">
                        <h3 class="txt_black txt_w_700 text-uppercase">Sort By</h3>
                        <ul class="m_t_40 solution_sidebar listing_page_sidebar list-unstyled p_l_0">
                            <li><a href="<?php echo $this->webroot.'home/blog/?key=recent' ?>">Recent Posts</a></li>
                            <li><a href="<?php echo $this->webroot.'home/blog/?key=week' ?>">Last Week</a></li>
                            <li><a href="<?php echo $this->webroot.'home/blog/?key=month' ?>">Last Month</a></li>
                            <li><a href="<?php echo $this->webroot.'home/blog/?key=year' ?>">Last Year</a></li>
                        </ul>
                        <h3 class="txt_black txt_w_700 text-uppercase m_t_60">Categories</h3>
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

                    </div> <!-- /.col-md-3 -->


                    <div class="col-md-9 col-sm-12">

                        <!-- <p class="txt_18 txt_black sort_by_option_one_line m_b_20 col_sm_m_t_50"><strong>Sort By -</strong>&nbsp; <a href="#" class="active">Rating</a> , <a href="#">Popularty</a> , <a href="#">Top Results</a> , <a href="#">Best Deals</a></p> -->

                        <div class="row p_lr_10">
                            <div class="col-lg-11 col-md-12">
                                <div class="listing_search_form">
                                     <form action="<?php echo $this->webroot.'home/searchblog'; ?>" method="post">
                                        <div class="row">
                                            <!-- <div class="col-sm-5 p_lr_6">
                                                <div class="input-group">
                                                    <span class="input-group-addon input_icon"><i class="fas fa-map-marker-alt"></i></span>
                                                    <input type="text" class="form-control search_inputs" placeholder="Location">
                                                </div>
                                            </div> -->
	                                            <div class="col-sm-5 p_lr_6">
	                                                <div class="input-group">
	                                                    <span class="input-group-addon input_icon">
	                                                    	<i class="fas fa-search"></i>
	                                                    </span>
	                                                    <input type="text" name="searchblog" class="form-control search_inputs" placeholder="Looking For..." required="">
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-2 p_lr_6 xs_m_t_15">
	                                            	<button type="submit" class="send_btn">
	                                            		SEARCH <i class="fas fa-angle-right m_l_3"></i>
	                                            	</button>
	                                                <!-- <a href="<?php echo $this->webroot.'home/blog_single/'.$bl['Blog']['id']; ?>" class="send_btn">SEARCH <i class="fas fa-angle-right m_l_3"></i></a> -->
	                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php 
                            if (!empty($searchResult)) 
                            {
                                foreach ($searchResult as $key => $bl) 
                                {
                        ?>
                        <div class="m_t_30">
                            <div class="blog_item_hr">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4 col_500_full_width">
                                        <a href="blog_single.php" class="blog_hr_item_img">
                                        	<img src="<?php echo $this->webroot.$bl['Blog']['images']; ?>" alt="Image" class="img-responsive center-block">
                                        </a>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-8 col_500_full_width col_500_m_t_10">
                                        <h4 class="">
                                        	<a href="<?php echo $this->webroot.'home/blog_single/'.$bl['Blog']['id']; ?>" class="txt_black hover_txt_orange">
                                        		<?php echo $bl['Blog']['title']; ?>
                                        	</a>
                                        </h4>
                                        
                                        <div class="blog_meta_info m_t_10">
                                            <span class="txt_grey">
                                            	<i class="fas fa-user"></i> 
                                            	By Admin 
                                            </span>
                                            <span class="txt_grey">
                                            	<i class="fas fa-calendar-alt"></i>
                                            	 <?php
                                            	     $date = explode(' ', $bl['Blog']['created_at']);
                                            	     echo $date[0]; 
                                            	 ?>
                                            </span>
                                        </div>
                                        <p class="para_large txt_black">
                                        	<?php
                                        		$string = substr($bl['Blog']['description'],0,100);
                                        		$string = substr($string,0,strrpos($string," "));
                                        		echo $string."...";
                                        	?>
                                            <a href="<?php echo $this->webroot.'home/blog_single/'.$bl['Blog']['id']; ?>" style="color: #FF7F27;" >READ MORE
                                            </a>
                                        </p>

                                    </div>
                                </div>
                            </div>


                        </div>





                        <div class="custom-pagination">
                            <nav aria-label="Page navigation example">
                                <?php echo $this->element('Admin/pagination')?>
                            </nav>
                        </div>


                            <?php
                                    }
                                }else{
                                	echo "<div style='text-align: center; font-weight: 600; font-size: 16px; margin-top:50px;'>No Results Found...</div>";
                                }
                             ?>

                    </div> <!-- /.col-md-9 -->

                   
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.container-fluid -->
    </div>
