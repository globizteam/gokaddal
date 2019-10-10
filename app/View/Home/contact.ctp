
        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <h1 class="text-center txt_white m_b_20 txt_52">Contact Us</h1>
                    <h3 class="text-center txt_white m_b_70">Lorem ipsum dolor sit amet</h3>
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


                    <div class="col-md-6 col-sm-12 col-xs-12">

                        <?php echo $this->Flash->render(); ?>

                        <div class="form_with_grey_bg contact_match_height">
                            <h2 class="text-center txt_black m_b_20 txt_w_700">Contact Form</h2>
                            <h4 class="text-center txt_grey txt_w_400">Please fill the below form for more info</h4>
                            <form action="<?php echo $this->webroot.'home/contact'; ?>" method="post" class="m_t_40">
                                <div class="form-group">
                                    <input type="text" class="form-control input_field" name="name" placeholder="Enter Your Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control input_field" name="email" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input_field" name="contact" placeholder="Enter Contact Number">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input_field" name="subject" placeholder="Enter Subject">
                                </div>
                               <div class="form-group">
                                   <textarea rows="4" class="form-control input_field" name="message" placeholder="Enter Message"></textarea>
                               </div> 
                                <div class="text-center orange_btns m_t_30">
                                    <ul class="list-unstyled list-inline m_b_0">
                                        <li>
                                            <input type="submit" name="" value="Submit">
                                        </li>
                                    </ul>
                                </div>
                                <!-- <p class="text-center txt_16 txt_black m_t_30">Don't have an account? <a href="signup.php" class="txt_orange hover_txt_orange">Click Here </a> to Signup.</p> -->
                            </form>
                        </div>

                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form_with_grey_bg contact_match_height">
                            <h2 class="text-center txt_black m_b_20 txt_w_700">Our Offices</h2>
                            <h4 class="text-center txt_grey txt_w_400">Lorem ipsum dolor sit amet, consectetur.</h4>
                            <div class="m_t_15">

                                <div class="office_item">
                                <?php
                                    if (!empty($alladdress)) 
                                    {
                                        $last_key = count($alladdress);
                                        foreach ($alladdress as $key => $address) 
                                        {
                                            if ($key == 0) 
                                            {
                                                echo "<ul class='list-unstyled office_info'>";
                                            } 
                                ?> 
                                                <li>
                                                    <a href="#" class="txt_black hover_txt_orange">
                                                        <i class="fas fa-map-marker-alt"></i> 
                                                        <?php echo $address['OfficeAddress']['address']; ?>
                                                    </a>
                                                </li>
                                                
                                                <li>
                                                    <a href="#" class="txt_black hover_txt_orange">
                                                        <i class="fas fa-envelope"></i> 
                                                        <?php echo $address['OfficeAddress']['email']; ?>
                                                    </a>
                                                </li>
                                                
                                                <li>
                                                    <a href="#" class="txt_black hover_txt_orange">
                                                        <i class="fas fa-phone"></i> 
                                                        <?php echo $address['OfficeAddress']['phone']; ?>
                                                    </a>
                                                </li>

                                                <?php 
                                                    if ($key == ($last_key - 1)) 
                                                    {
                                                
                                                        echo "</ul>";
                                                    } 
                                                ?>

                                            <div class="share_blog_post m_t_15">
                                                <ul class="list-inline m_b_0">
                                                    <li>
                                                        <a href="<?php if(!empty($address['OfficeAddress']['facebook'])) echo $address['OfficeAddress']['facebook']; else echo 'javascript:';?>" class="bg_fb">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="<?php if(!empty($address['OfficeAddress']['twitter'])) echo $address['OfficeAddress']['twitter']; else echo 'javascript:;' ;?>" class="bg_twitter">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="<?php if(!empty($address['OfficeAddress']['instagram'])) echo $address['OfficeAddress']['instagram'];  else echo 'javascript:;'; ?>" class="bg_insta">
                                                            <i class="fab fa-instagram"></i>
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="<?php if(!empty($address['OfficeAddress']['linkedin'])) echo $address['OfficeAddress']['linkedin']; else echo 'javascript:;' ;?>" class="bg_ld">
                                                            <i class="fab fa-linkedin-in"></i>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>

                                        <?php
                                                }
                                            }
                                         ?>

                                </div>
                            </div>
                        </div>
                    </div>


                   
                </div>
            </div>
        </div>
    </div>




    

     <!-- forgot password modal -->
    <div id="forgot_password" class="modal fade modal_form" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close modal_close_btn" data-dismiss="modal"><i class="fas fa-times"></i></button>
                <div class="modal-body">
                    <div class="form_with_grey_bg">
                        <h2 class="text-center txt_black txt_w_700">Lost your password?</h2>
                        <h4 class="text-center txt_grey txt_w_400 l_h_28 m_t_30">Please enter your email address. You will receive a link to create a new password via email.</h4>
                        <form action="#" class="m_t_30">
                            <div class="form-group">
                                <input type="email" class="form-control input_field" placeholder="Enter Email">
                            </div>
                            <div class="text-center orange_btns m_t_30">
                                <ul class="list-unstyled list-inline m_b_0">
                                    <li><a href="#">Submit</a></li>
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

