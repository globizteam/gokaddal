<?php 
    $directoryURI = $_SERVER['REQUEST_URI'];
    $activePage = basename($directoryURI);  

    // echo $activePage; 
?>

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

                    <div class="col-md-3 col-sm-12 rightBar">
                        <h3 class="txt_black txt_w_700 text-uppercase">Sort By</h3>
                        <ul class="m_t_40 solution_sidebar listing_page_sidebar list-unstyled p_l_0">
                            <li class= "<?= ($activePage == '?key=recent') ? 'active-sidebar':''; ?>" >
                            	<a href="<?php echo $this->webroot.'home/blog/?key=recent' ?>">Recent Posts</a>
                            </li>
                            <li class= "<?= ($activePage == '?key=week') ? 'active-sidebar':''; ?>" >
                            	<a href="<?php echo $this->webroot.'home/blog/?key=week' ?>">Last Week</a>
                            </li>
                            <li class= "<?= ($activePage == '?key=month') ? 'active-sidebar':''; ?>" >
                            	<a href="<?php echo $this->webroot.'home/blog/?key=month' ?>">Last Month</a>
                            </li>
                            <li class= "<?= ($activePage == '?key=year') ? 'active-sidebar':''; ?>" >
                            	<a href="<?php echo $this->webroot.'home/blog/?key=year' ?>">Last Year</a>
                            </li>
                        </ul>

                        <h3 class="txt_black txt_w_700 text-uppercase m_t_60">Categories</h3>

                        <?php echo $this->element('Frontend/categories_sidebar'); ?>

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

                        <div class="row m_t_15">


                                <?php 
                                    if (!empty($blog)) 
                                    {
                                        foreach ($blog as $key => $bl) 
                                        {
                                ?>
                            <div class="col-sm-6 col-xs-6 col_500_full_width">

                                <div class="blog_item m_t_30 mb_20">
                                    <div class="image-effect">
                                       <?php 
                                           if (!empty($bl['Blog']['images'])) 
                                           {
                                       ?>
                                               <img src="<?php echo $this->webroot.$bl['Blog']['images']; ?>" alt="Image" class="img-responsive">
                                       <?php
                                           }else{
                                       ?>
                                               <img src="<?php echo $this->webroot.'no-image.jpg'; ?>" alt="Image" class="img-responsive no-img">
                                       <?php

                                           } 
                                       ?>
                                    </div>
                                    
                                    <a class="blog_cat" href="<?php echo $this->webroot.'home/blog_single/'.$bl['Blog']['id']; ?>">
                                        <?php echo $bl['Blog']['title']; ?>
                                    </a>

                                    <p class="blog_title">
                                    	<?php
                                    		$string = substr($bl['Blog']['description'],0,100);
                                    		$string = substr($string,0,strrpos($string," "));
                                    	?>
                                        <a href="<?php echo $this->webroot.'home/blog_single/'.$bl['Blog']['id']; ?>">
                                            <?php echo $string."..."; ?><br>
                                            <a href="<?php echo $this->webroot.'home/blog_single/'.$bl['Blog']['id']; ?>" style="color: #FF7F27;" >READ MORE
                                            </a>

                                        </a>
                                    </p>
                                    <span class="blog_date">
                                    	<?php
                                    	    $date = explode(' ', $bl['Blog']['created_at']);
                                    	    echo $date[0]; 
                                    	?>
                                    </span>

                                </div>



                            </div>
                                <?php
                                        }
                                    }
                                 ?>

                        </div>
                        <?php 
                    	if (!empty($blog)) 
                        {
                        ?>
                        <div class="custom-pagination">
                            <nav aria-label="Page navigation example">
                                <?php echo $this->element('Admin/pagination')?>
                            </nav>
                        </div>

                    <?php } ?>




                    </div> <!-- /.col-md-9 -->

                   
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.container-fluid -->
    </div>


