
        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <!-- <h1 class="text-center txt_white m_b_20 txt_52">Solution Provider</h1> -->
                    <!-- <h3 class="text-center txt_white m_b_70">Lorem ipsum dolor sit amet.</h3> -->
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            
                            <?php
                                echo $this->element('Frontend/search_form');
                            ?>

                                                       

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
                    <div class="row message_m_b_40 text-center">
                        <div class="col-md-offset-3  col-md-6 col-sm-6">
                            <?php echo $this->Flash->render();  ?>
                        </div>
                    </div>


                    <div class="col-lg-5 col-md-5 col-sm-6">
                        <a href="javascript:;">
                            <?php if(!empty($providerservice['ProviderService']['image']) ) { ?>

                                <img src="<?php echo $this->webroot.'app/webroot/'.$providerservice['ProviderService']['image']; ?>" alt="Image" class="img-responsive center-block" style="max-width: 50% !important; width: 100%;" >
                            <?php }else { ?>
                                <img src="<?php echo $this->webroot.'app/webroot/no-image.jpg'; ?>" alt="Image" class="img-responsive center-block" style="max-width: 50% !important; width: 100%;" >

                            <?php } ?>
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6 ">
                        <h3 class="listing_item_name txt_black">
                            <!-- <a href="single_seeker.php" class=""> -->
                                <!-- Need Smart Water Management solution -->
                                <?php echo $providerservice['ProviderService']['title'] ;?><small>
                                    <a href="javascript:;" class="txt_grey"> By <?php echo $providerservice['User']['company_name'] ;?></a>
                                </small>
                            <!-- </a> -->
                        </h3>
                        <h5 class="listing_item_tags txt_w_400 m_t_30"><a href="javascript:;" class="txt_orange hover_txt_orange text-uppercase"><?php echo $providerservice['Tag']['name'] ;?></a></h5>
<!--                         <div class="listing_item_stars m_t_15">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div> -->
                        <p class="para_large m_t_15">
                                <?php echo $providerservice['ProviderService']['description'] ;?>
                        </p>
                        <div class="listing_item_location m_t_15"><i class="fas fa-map-marker-alt txt_orange"></i> 
                            <span class="txt_grey">
                                <?php echo $providerservice['User']['address'] ;?>
                            <!-- East 34th Street, Near Abcd Avenue -->
                            </span>
                        </div>
                        <div class="orange_btns m_t_30">
                            <ul class="list-unstyled list-inline m_b_0">
                                <li>
                                    <!-- if user is logged in -->
                                    <?php //if(AuthComponent::user('id')) : ?>
                                        <!-- <a href="#" data-toggle="modal" data-target="#submit_quote_modal">Submit a Quote</a> -->
                                    <!-- if user is not logged in -->
                                    <?php //else : ?>
                                        <!-- <a href="<?php echo $this->webroot ;?>home/index">Submit a Quote</a> -->
                                    <?php //endif; ?>
                                </li>
                                <li>





                                    
                                    <!-- if user is logged in -->
                                    <?php 
                                        if(AuthComponent::user('id')) 
                                        { 
                                            if (isset($providerservice['Favourite'][0]) ) {
                                    ?>
                                        <a href="#" class="save_favourites">Save To Favourites</a>
                                        <br>
                                        <div class="added_favourite">You already added this solution to favourite </div>
                                                                                          

                                    <?php }else{  ?>

                                        <a href="<?php echo $this->webroot ?>home/save_to_favourites?provider_service_id=<?php echo $providerservice['ProviderService']['id'] ;?>&company_id=<?php echo $providerservice['User']['id'] ;?>">Save To Favourites</a>

                                    <?php } }?>

                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>


            </div>
        </div>
    </div>



    <!-- submit_quote_modal -->
    <div id="submit_quote_modal" class="modal fade modal_form" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close modal_close_btn" data-dismiss="modal"><i class="fas fa-times"></i></button>
                <div class="modal-body">
                    <div class="form_with_grey_bg">
                        <?php if(AuthComponent::user('id')) : ?>
                            <h2 class="text-center txt_black m_b_20 txt_w_700">Submit a Quote</h2>
                            <h4 class="text-center txt_grey txt_w_400">Lorem ipsum dolor sit amet, consectetur.</h4>
                                <form action="#" class="m_t_30">
                                    <div class="form-group">
                                        <input type="text" class="form-control input_field" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control input_field" placeholder="Enter Email">
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
                        <?php else : ?>

                            <h2 class="text-center txt_black m_b_20 txt_w_700">Please login first</h2>
                            <div class="text-center orange_btns m_t_30">
                                <ul class="list-unstyled list-inline m_b_0">
                                    <li><a href="<?php echo $this->webroot; ?>home/login">Login</a></li>
                                </ul>
                            </div>

                        <?php endif; ?>


                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </div>

        </div>
    </div>



