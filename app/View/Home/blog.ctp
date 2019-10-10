
        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <h1 class="text-center txt_white m_b_20 txt_52">Our Blog 2</h1>
                    <h3 class="text-center txt_white m_b_70">Lorem ipsum dolor sit amet.</h3>
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


    <div class="p_tb_80">
        <div class="container-fluid">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 col-sm-12 rightBar">
                        <h3 class="txt_black txt_w_700 text-uppercase">Sort By</h3>
                        <ul class="m_t_40 solution_sidebar listing_page_sidebar list-unstyled p_l_0">
                            <li><a href="#">Recent Posts</a></li>
                            <li><a href="#">Last Week</a></li>
                            <li><a href="#">Last Month</a></li>
                            <li><a href="#">Last Year</a></li>
                        </ul>

                        <h3 class="txt_black txt_w_700 text-uppercase m_t_60">Categories</h3>
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
                            <li><a href="#">Transportation</a></li>
                            <li><a href="#">Retail</a></li>
                            <li><a href="#">Banking & Finance</a></li>
                            <li><a href="#">Utilities</a></li>
                            <li><a href="#">Dairy</a></li>
                        </ul>

                    </div> <!-- /.col-md-3 -->


                    <div class="col-md-9 col-sm-12">

                        <!-- <p class="txt_18 txt_black sort_by_option_one_line m_b_20 col_sm_m_t_50"><strong>Sort By -</strong>&nbsp; <a href="#" class="active">Rating</a> , <a href="#">Popularty</a> , <a href="#">Top Results</a> , <a href="#">Best Deals</a></p> -->

                        <div class="row p_lr_10">
                            <div class="col-lg-11 col-md-12">
                                <div class="listing_search_form">
                                   <form action="#">
                                        <div class="row">
                                            <!-- <div class="col-sm-5 p_lr_6">
                                                <div class="input-group">
                                                    <span class="input-group-addon input_icon"><i class="fas fa-map-marker-alt"></i></span>
                                                    <input type="text" class="form-control search_inputs" placeholder="Location">
                                                </div>
                                            </div> -->
                                            <div class="col-sm-5 p_lr_6">
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

                        <div class="row m_t_15">


                            <div class="col-sm-4 col-xs-6 col_500_full_width">
                                <?php 
                                    if (!empty($blog)) 
                                    {
                                        foreach ($blog as $key => $bl) 
                                        {
                                ?>

                                <div class="blog_item m_t_30 mb_20">
                                    <div class="image-effect">
                                        <img src="images/blog_1.jpg" alt="" class="img-responsive">
                                    </div>
                                    
                                    <a class="blog_cat" href="#;">
                                        Data Analytics
                                    </a>

                                    <p class="blog_title">
                                        <a href="blog_single.php">
                                            Lorem ipsum dollor amet conculater qwerty Set
                                        </a>
                                    </p>
                                    <span class="blog_date">October 6, 2019 by John Doe</span>

                                </div>

                                <?php
                                        }
                                    }
                                 ?>


                            </div>

                        </div>

                        <div class="listing_pagination text-center m_t_30">
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
                        </div> <!-- /.listing_pagination -->




                    </div> <!-- /.col-md-9 -->

                   
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.container-fluid -->
    </div>


