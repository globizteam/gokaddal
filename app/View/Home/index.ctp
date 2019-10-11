
        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <h1 class="text-center txt_white text-uppercase m_b_20 txt_52">Welcome to gokaddal</h1>
                    <h3 class="text-center txt_white m_b_70">World's Only Digital SolutionsCloud Exchange</h3>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            <?php
                                echo $this->element('Frontend/search_form');
                            ?>
                            


                            <p class="txt_16 txt_white text-center after_search m_b_20">Popular Searches: &nbsp;&nbsp;&nbsp; 
                                <?php 

                                    if (!empty($keyword)) 
                                    {
                                         foreach ($keyword as $key => $keyw) 
                                         {
                                            if ($key == 5) break; 

                                            if ($key == ($counts - 1) || $key == 4) 
                                            {
                                ?>
                                            <a href="javascript:;">
                                                <?php echo ucfirst($keyw['SearchKeyword']['keyword']) ;  ?>
                                            </a>
                                    <?php   }else{  ?>
                                            

                                            <a href="javascript:;">
                                                <?php echo ucfirst($keyw['SearchKeyword']['keyword']) . ",";  ?>
                                            </a>
                                <?php
                                            }
                                         }
                                    } 
                                ?>
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
                    <div class="col-md-9 col-sm-12">
                        <h1 class="txt_black txt_w_700 m_b_20">Featured Categories</h1>
                        <p class="txt_18 txt_grey">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, dolor?</p>
                        <div class="categories_collage m_t_50 p_lr_10">
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-12 p_lr_6">
                                    <a href="#" class="catg_item">
                                        <img src="<?php echo HTTP_ROOT; ?>gokaddal/images/img_1.jpg" alt="Image" class="img-responsive center-block">
                                        <div class="upper_catg">
                                            <span class="catg_name txt_23 txt_w_700 txt_white text-uppercase">Smart cities</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 col_500_full_width p_lr_6">
                                    <a href="#" class="catg_item">
                                        <img src="<?php echo HTTP_ROOT; ?>gokaddal/images/img_2.jpg" alt="Image" class="img-responsive center-block">
                                        <div class="upper_catg">
                                            <span class="catg_name txt_23 txt_w_700 txt_white text-uppercase">Manufacturing</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 col_500_full_width p_lr_6">
                                    <a href="#" class="catg_item">
                                        <img src="<?php echo HTTP_ROOT; ?>gokaddal/images/img_3.jpg" alt="Image" class="img-responsive center-block">
                                        <div class="upper_catg">
                                            <span class="catg_name txt_23 txt_w_700 txt_white text-uppercase">Transporation</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 col_500_full_width p_lr_6">
                                    <a href="#" class="catg_item">
                                        <img src="<?php echo HTTP_ROOT; ?>gokaddal/images/img_6.jpg" alt="Image" class="img-responsive center-block">
                                        <div class="upper_catg">
                                            <span class="catg_name txt_23 txt_w_700 txt_white text-uppercase">Banking & Finance</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 col_500_full_width p_lr_6">
                                    <a href="#" class="catg_item">
                                        <img src="<?php echo HTTP_ROOT; ?>gokaddal/images/img_4.jpg" alt="Image" class="img-responsive center-block">
                                        <div class="upper_catg">
                                            <span class="catg_name txt_23 txt_w_700 txt_white text-uppercase">Entertainment</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 rightBar col_sm_m_t_50">
                        <h3 class="txt_black txt_w_700">POPULAR SOLUTION AREAS</h3>
                        <ul class="m_t_50 solution_sidebar list-unstyled p_l_0">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="popular_listings p_tb_80">
		<div class="container-fluid">
            <div class="container">
                <h1 class="text-center txt_black txt_w_700 m_b_20">Popular Listings</h1>
                <p class="text-center txt_18 txt_grey">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, dolor?</p>
                <div class="m_t_50 owl-carousel owl-theme">
                    <div class="item">
                        <div class="blog_item">
                            <img src="<?php echo HTTP_ROOT; ?>gokaddal/images/listing1.jpg" alt="" class="img-responsive">
                        </div>
						<div class="listing_text">
							<h4><a href="#;">Stark Industries</a></h4>
							<h5>Perfect, Modern & Compact</h5>
							<span>
								<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							</span>
							<div class="list_btn">
								<a href="#;"><i class="fa fa-eye"></i>View Details</a>
								<a href="#;"><i class="fa fa-heart"></i>Save</a>
							</div>
							<h6><i class="fas fa-map-marker-alt"></i><p>East 34th Street, Near abcd Avenue</p></h6>
						</div>
						
                    </div>
					<div class="item">
                        <div class="blog_item">
                            <img src="<?php echo HTTP_ROOT; ?>gokaddal/images/listing2.jpg" alt="" class="img-responsive">
                        </div>
						<div class="listing_text">
							<h4><a href="#;">Cyberdyne Systems</a></h4>
							<h5>Perfect, Modern & Compact</h5>
							<span>
								<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							</span>
							<div class="list_btn">
								<a href="#;"><i class="fa fa-eye"></i>View Details</a>
								<a href="#;"><i class="fa fa-heart"></i>Save</a>
							</div>
							<h6><i class="fas fa-map-marker-alt"></i><p>East 34th Street, Near abcd Avenue</p></h6>
						</div>
                    </div>
					<div class="item">
                        <div class="blog_item">
                            <img src="<?php echo HTTP_ROOT; ?>gokaddal/images/listing3.jpg" alt="" class="img-responsive">
                        </div>
						<div class="listing_text">
							<h4><a href="#;">Wayne Enterprises</a></h4>
							<h5>Perfect, Modern & Compact</h5>
							<span>
								<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							</span>
							<div class="list_btn">
								<a href="#;"><i class="fa fa-eye"></i>View Details</a>
								<a href="#;"><i class="fa fa-heart"></i>Save</a>
							</div>
							<h6><i class="fas fa-map-marker-alt"></i><p>East 34th Street, Near abcd Avenue</p></h6>
						</div>
                    </div>
					<div class="item">
                        <div class="blog_item">
                            <img src="<?php echo HTTP_ROOT; ?>gokaddal/images/listing4.jpg" alt="" class="img-responsive">
                        </div>
						<div class="listing_text">
							<h4><a href="#;">Genco Pura Olive</a></h4>
							<h5>Perfect, Modern & Compact</h5>
							<span>
								<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							</span>
							<div class="list_btn">
								<a href="#;"><i class="fa fa-eye"></i>View Details</a>
								<a href="#;"><i class="fa fa-heart"></i>Save</a>
							</div>
							<h6><i class="fas fa-map-marker-alt"></i><p>East 34th Street, Near abcd Avenue</p></h6>
						</div>
                    </div>
                    <div class="item">
                        <div class="blog_item">
                            <img src="<?php echo HTTP_ROOT; ?>gokaddal/images/listing2.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="listing_text">
                            <h4><a href="#;">Genco Pura Olive</a></h4>
                            <h5>Perfect, Modern & Compact</h5>
                            <span>
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </span>
                            <div class="list_btn">
                                <a href="#;"><i class="fa fa-eye"></i>View Details</a>
                                <a href="#;"><i class="fa fa-heart"></i>Save</a>
                            </div>
                            <h6><i class="fas fa-map-marker-alt"></i><p>East 34th Street, Near abcd Avenue</p></h6>
                        </div>
                    </div>

                </div>
            </div>   
        </div>
	</div>
	
    <div class="why-sec p_tb_80">
        <div class="container-fluid">
            <div class="container">
                <h1 class="text-center txt_black txt_w_700 m_b_20">Why GoKaddal</h1>
                <p class="text-center txt_18 txt_grey">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, dolor?</p>
                <div class="row m_t_50">
                    <div class="col-sm-4 iconBox xs_m_t_50">
                        <div class="icon_out">
                            <b><i class="fa fa-check"></i></b>
                        </div>
						<h6>One Platform for all <br>Digital Solutions</h6>
                    </div>
					<div class="col-sm-4 iconBox xs_m_t_50">
                        <div class="icon_out">
                            <b><i class="far fa-thumbs-up" aria-hidden="true"></i></b>
                        </div>
						<h6>Trusted, Safe and <br>Secure</h6>
                    </div>
					<div class="col-sm-4 iconBox xs_m_t_50 ">
                        <div class="icon_out">
                            <b><i class="fas fa-headset"></i></b>
                        </div>
						<h6>Quick Support and <br> Assistance</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="community p_tb_60">
        <div class="container-fluid">
            <div class="container">
                <?php echo $this->Flash->render(); ?>
                <h1 class="text-center txt_black txt_w_700 m_b_20">Join Our Community</h1>
                <p class="text-center txt_18 txt_grey">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, dolor?</p>
                <div class="row m_t_50">
                        <div class="col-md-offset-1 col-md-10">

                            <div class="banner_search_form m_b_20">
                                <form action="<?php echo $this->webroot.'home/newsletter';  ?>" method="post" id="newsletter">
                                    <div class="row">
                                        <div class="col-sm-5 p_lr_6">
                                            <div class="input-group newsltr">
                                                <span class="input-group-addon input_icon">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                                <?php 
                                                    if(!AuthComponent::user('id')) 
                                                    {
                                                ?>
                                                        <input type="text" class="form-control search_inputs news" name="name" placeholder="Enter your name"> 

                                                <?php }else{ ?>

                                                <input type="text" class="form-control search_inputs news" name="name" placeholder="Enter your name" value="<?php if(AuthComponent::user('id') ) { if(empty($news)) { $name = AuthComponent::user('name'); echo rtrim($name, ' ' ) ;} }  ?> ">

                                                <?php } ?>

                                            </div>
                                        </div>

                                        <div class="col-sm-5 p_lr_6">
                                            <div class="input-group newsltr">
                                                <span class="input-group-addon input_icon">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                                <?php 
                                                    if(!AuthComponent::user('id')) 
                                                    {
                                                ?>
                                                <input type="text" class="form-control search_inputs news" name="email" placeholder="Enter your email" >

                                                <?php }else{ ?>

                                                <input type="text" class="form-control search_inputs news" name="email"  value="<?php if(AuthComponent::user('id')) { if(empty($news)){ $email = AuthComponent::user('email');  echo rtrim($email, ' ') ; } } ?> " placeholder="Enter your email" >

                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 p_lr_6">
                                            <button type="submit" class="send_btn">SUBMIT <i class="fas fa-angle-right m_l_3"></i></button>
                                            <!-- <a href="#" class="send_btn">SUBMIT <i class="fas fa-angle-right m_l_3"></i></a> -->
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>

	<div class="blog_sec p_tb_80">
        <div class="container-fluid">
            <div class="container">
                <h1 class="text-center txt_black txt_w_700 m_b_20">Latest Blog</h1>
                <p class="text-center txt_18 txt_grey">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, dolor?</p>
                <div class="row m_t_50">
                    <div class="col-sm-4 col-xs-6 col_500_full_width">
                        <div class="blog_item mb_20">
                            <div class="image-effect"><img src="<?php echo HTTP_ROOT; ?>gokaddal/images/blog_1.jpg" alt="" class="img-responsive"></div>
							<a class="blog_cat" href="#;">Data Analytics</a>
							<p class="blog_title"><a href="#;">Lorem ipsum dollor amet conculater qwerty Set</a></p>
							<span class="blog_date">October 6, 2019 by John Doe</span>
                        </div>
                    </div>
					<div class="col-sm-4 col-xs-6 col_500_full_width">
                        <div class="blog_item mb_20">
                            <div class="image-effect"><img src="<?php echo HTTP_ROOT; ?>gokaddal/images/blog_3.jpg" alt="" class="img-responsive"></div>
							<a class="blog_cat" href="#;">SMART WATER MANAGEMENT</a>
							<p class="blog_title"><a href="#;">Lorem ipsum dollor amet conculater qwerty Set</a></p>
							<span class="blog_date">October 6, 2019 by John Doe</span>
                        </div>
                    </div>
					<div class="col-sm-4 col-xs-6 col_500_full_width">
                        <div class="blog_item mb_20">
                            <div class="image-effect"><img src="<?php echo HTTP_ROOT; ?>gokaddal/images/blog_4.jpg" alt="" class="img-responsive"></div>
							<a class="blog_cat" href="#;">DIGITAL HEALTHCARE</a>
							<p class="blog_title"><a href="#;">Lorem ipsum dollor amet conculater qwerty Set</a></p>
							<span class="blog_date">October 6, 2019 by John Doe</span>
                        </div>
                    </div>
                </div>
                <div class="text-center m_t_50">
                    <a href="#" class="read_btn text-uppercase">See All <i class="fas fa-angle-right m_l_3"></i></a>
                </div>
            </div>
        </div>
    </div>









 <!-- Page Load Modal modal or Hot Solution Modal -->
    <div id="hot_solution_modal" class="modal fade modal_form" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close modal_close_btn" data-dismiss="modal"><i class="fas fa-times"></i></button>
                <div class="modal-body">
                    <div class="form_with_grey_bg">
                        <h2 class="txt_black txt_w_700">HOT SOLUTION OF THE MONTH</h2>

                        <!-- <h4 class="text-center txt_grey txt_w_400 l_h_28">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt veritatis accusantium, doloribus.</h4> -->
                        <div class="m_t_30">
                            <h3 class="listing_item_name txt_black">Smart Water Management Solution <small><a href="single_provider.php" class="txt_grey">By Cyberdyne System</a></small></h3>
                            <h5 class="listing_item_tags txt_w_400 m_t_30"><a href="#" class="txt_grey">Parfact, Modren & Compact</a></h5>
                            <div class="listing_item_stars m_t_15">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <div class="listing_item_location m_t_15"><i class="fas fa-map-marker-alt txt_orange"></i> <span class="txt_grey">East 34th Street, Near Abcd Avenue</span></div>
                            <p class="para_large m_t_15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus enim quaerat molestias perspiciatis modi nesciunt, placeat aspernatur adipisci quia cupiditate perferendis voluptates ad blanditiis. Eos minima aliquam, ipsam, ullam aspernatur vero libero distinctio sunt vitae ab quasi reprehenderit earum hic. Ut, optio esse quia, quos facilis dolorem excepturi eius velit necessitatibus dolor impedit necessitatibus placeat accusantium est velit similique provident eum</p>
                            <div class="orange_btns m_t_30">
                                <ul class="list-unstyled list-inline m_b_0">
                                    <li><a href="#" data-toggle="modal" data-target="#ask_quote_modal">Ask a Quote</a></li>
                                    <li><a href="#">Save To Favourites</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>



