        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <h1 class="text-center txt_white m_b_20 txt_52">Solution Provider</h1>
                    <h3 class="text-center txt_white m_b_70">Lorem ipsum dolor sit amet.</h3>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            
                            
                            <?php //include 'search_form_top.php'; ?>


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

                        <p class="txt_18 txt_black sort_by_option_one_line m_b_20 col_sm_m_t_50"><strong>Sort By -</strong>&nbsp; <a href="#" class="active">Rating</a> , <a href="#">Popularty</a> , <a href="#">Top Results</a> , <a href="#">Best Deals</a></p>

                        <div class="row p_lr_10">
                            <div class="col-lg-11 col-md-12">
                                <div class="listing_search_form">
                                   <form action="#">
                                        <div class="row">
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


                        <!-- Listings start here -->
                        <div class="listing_item_sec m_t_40">

                <?php 
                     if (!empty($solution_count) && ($solution_count > 0) ) {
                        foreach ($provider_all_solution as $key => $solution) :?>
                            <div class="listing_item bg_grey_item">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <div class="listing_item_img listing_match_item">
                                                <?php if(!empty($solution['ProviderService']['image'])) :?> 
                                                    
                                                    <img src="<?php echo  $this->webroot.$solution['ProviderService']['image']; ?>" alt="Image" class="img-responsive center-block" width="100px" >
                                                    <?php else : ?> 
                                                        <img src="<?php echo  $this->webroot.'app/webroot/no-image.jpg' ?>" alt="Image" class="img-responsive center-block" width="100px" >
                                                    <?php endif; ?>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 col_600_full_width xs_m_t_15">
                                            <div class="listing_item_info listing_match_item">
                                                <h4 class="listing_item_name">
                                                    <a href="<?php echo $this->webroot.'home/provider_solution_view/'.$solution['ProviderService']['id']; ?>" class="txt_black">
                                                        <?php echo  $solution['ProviderService']['title']; ?>
                                                    </a>
                                                </h4>
                                                <h5 class="listing_item_tags txt_w_400 m_t_10"><a href="javascript:;" class="txt_grey">By <?php echo $solution['User']['company_name']; ?></a></h5>
<!--                                                 <div class="listing_item_stars m_t_15">
                                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                                </div> -->
                                                <div class="listing_item_location m_t_10"><i class="fas fa-map-marker-alt txt_orange"></i> <span class="txt_grey">
                                                        <?php echo  $solution['User']['address']; ?>

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
                                                                    'action' => 'provider_solution_view/'.$solution['ProviderService']['id'],
                                                                    'full_base' => true
                                                                ),
                                                                array('escape' => false)
                                                        );


                                                        ?>

                                                    </li>
<!--                                                     <li>
                                                        <a href="#" data-toggle="modal" data-target="#like_modal">
                                                            <i class="fa fa-heart"></i>Save
                                                        </a>
                                                    </li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> 


                        <?php  endforeach; ?>

                        </div> <!-- /.listing_item_sec -->

                        <!-- Pagination starts here -->
                            <div class="custom-pagination">
                                <nav aria-label="Page navigation example">
                                    <?php echo $this->element('Admin/pagination')?>
                                </nav>
                            </div>
                    <?php 
                        }else{ 
                    ?>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div  class="no-solutions" >No Solutions for this provider yet.</div>
                            </div>
                        </div>
                       <?php }   ?>

<!--                         <div class="listing_pagination text-center">
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
                        </div> -->

                    </div> <!-- /.col-md-9 -->
                    
                </div>
            </div>
        </div>
    </div>


    <!-- submit_quote_modal -->
    <div id="like_modal" class="modal fade modal_form" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close modal_close_btn" data-dismiss="modal"><i class="fas fa-times"></i></button>
                <div class="modal-body">
                    <div class="form_with_grey_bg">
                        <?php if(!AuthComponent::user('id')) : ?>

                            <h2 class="text-center txt_black m_b_20 txt_w_700">Please login first</h2>
                            <div class="text-center orange_btns m_t_30">
                                <ul class="list-unstyled list-inline m_b_0">
                                    <li><a href="<?php echo $this->webroot; ?>home/login">Login</a></li>
                                </ul>
                            </div>

                        <?php endif; ?>


                    </div>
                </div>
            </div>

        </div>
    </div>




