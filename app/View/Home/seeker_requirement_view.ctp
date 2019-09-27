
        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <!-- <h1 class="text-center txt_white m_b_20 txt_52">Solution Provider</h1> -->
                    <!-- <h3 class="text-center txt_white m_b_70">Lorem ipsum dolor sit amet.</h3> -->
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

                    <!-- <div class="col-lg-5 col-md-5 col-sm-6">
                        <a href="#"><img src="images/listing3.jpg" alt="Image" class="img-responsive center-block"></a>
                    </div> -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?php echo $this->Flash->render(); ?>
                        <h2 class="listing_item_name">
                            <a href="javascript:;" class="txt_black">
                                <?php echo $seeker_req['SeekerRequirement']['title']?>
                            </a>
                        </h2>
                        
                        <h5 class="listing_item_tags txt_w_400 m_t_30">
                            <a href="javascript:;" class="txt_orange hover_txt_orange text-uppercase">
                                <?php echo $seeker_req['Tag']['name']?>
                            </a>
                        </h5>
                        <!-- <div class="listing_item_stars m_t_15">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div> -->
                        <p class="para_large m_t_15">
                            <?php echo $seeker_req['SeekerRequirement']['description']?>
                        </p>
                        <div class="listing_item_location m_t_15">
                            <i class="fas fa-map-marker-alt txt_orange"></i> 
                            <span class="txt_grey">
                                <?php echo $seeker_req['User']['address']?>
                            </span>
                        </div>
                        <div class="orange_btns m_t_30">
                            <ul class="list-unstyled list-inline m_b_0">
                                <li><a href="#" data-toggle="modal" data-target="#submit_quote_modal">Submit a Quote</a></li>
                                <!-- <li><a href="#">Save To Favourites</a></li> -->
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
                    <h2 class="text-center txt_black m_b_20 txt_w_700">Submit a Quote</h2>
                    <h4 class="text-center txt_grey txt_w_400">Lorem ipsum dolor sit amet, consectetur.</h4>
                        <form action="<?php echo $this->webroot.'home/submit_quote/'.$seeker_req['SeekerRequirement']['id']; ?>" method="post" class="m_t_30">
                            <div class="form-group">
                                <input type="text" class="form-control input_field" name="data[SubmitQuote][name]" value="<?php echo AuthComponent::user('company_name'); ?>" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control input_field" name="data[SubmitQuote][email]" value="<?php echo AuthComponent::user('email'); ?>" placeholder="Enter Email">
                            </div>
                            <input type="hidden" name="data[SubmitQuote][user_id]" value="<?php echo AuthComponent::user('id');  ?>" >
                            <input type="hidden" name="data[SubmitQuote][quote_to]" value="<?php echo $seeker_req['SeekerRequirement']['user_id'];  ?>" >
                            <input type="hidden" name="data[SubmitQuote][seeker_requirement_id]" value="<?php echo $seeker_req['SeekerRequirement']['id'];  ?>" >
                            <div class="form-group">
                                <textarea rows="3" class="form-control input_field"  name="data[SubmitQuote][message]" placeholder="Enter Message"></textarea>
                            </div>
                            <div class="text-center orange_btns m_t_30">
                                <ul class="list-unstyled list-inline m_b_0">
                                    <li>
                                        <input type="submit" name="" value="Submit">
                                        <!-- <a href="<?php echo $this->webroot.'home/submit_quote/'.$seeker_req['SeekerRequirement']['id']; ?>">Submit</a> -->
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </div>

        </div>
    </div>

