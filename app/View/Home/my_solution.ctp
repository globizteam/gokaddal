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
                            	<?php echo $this->Flash->render(); ?>
                                <div class="my_account_main_content p_tb_80 col_sm_p_tb_60">

                                    <div class="row m_b_15">
                                        <div class="col-sm-8">
                                            <h2 class="txt_black">My Solutions</h2>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="text-right orange_btns col_xs_txt_left xs_m_t_15">
                                                <ul class="list-unstyled list-inline m_b_0">
                                                    <li><a href="post_solution.php">Post Your Solution</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="my_info_body m_t_30">
                                        <h4 class="txt_black txt_w_600">My Solutions</h4>
                                        <hr class="dark_grey_hr m_t_15">


                        <!-- Listings start here -->
                        <div class="listing_item_sec m_t_40">

                <?php 
                     if (!empty($solutioncount )) 
                     {
                        foreach ($userdata as $key => $solution) :?>
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
                                                    <li>
                                                    	<a href="<?php echo $this->webroot.'home/post_solution/'.$solution['ProviderService']['id']; ?>">
                                                    	    <i class="fas fa-pencil-alt"></i> Edit
                                                    	</a> 
                                                    	<a href="<?php echo $this->webroot.'home/delete_solution/'.$solution['ProviderService']['id']; ?>"  onclick="return confirm('Are you sure, You want to delete this solution?')" data-toggle="tooltip" title="Delete" class="pd-setting-ed">
                                                    	    <i class="fas fa-times"></i> Delete
                                                    	</a>
                                                    </li>
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




                                    </div> <!-- /.my_info_body -->


                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- /.col-md-9 -->
                    
                </div>
            <!-- </div> -->
        </div>
    </div>

