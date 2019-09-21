


        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <h1 class="text-center txt_white m_b_20 txt_52">Sign Up</h1>
                    <h3 class="text-center txt_white m_b_70">Please fill the below form</h3>
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


                    <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12">
                       <!--  <h2 class="text-center txt_black m_b_20 txt_w_700">Write a Review</h2>
                       <h4 class="text-center txt_grey txt_w_400">Lorem ipsum dolor sit amet, consectetur.</h4> -->
                           <?php echo $this->Flash->render(); ?>

                        <div class="form_with_grey_bg">
                            <!-- <form action="#"> -->
                            <?php echo $this->Form->create('User', array('url' => array('controller' => 'home', 'action' => 'signup') ) ); ?>

                                <div class="form-group">
                                    <input type="text" name="name" class="form-control input_field" placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control input_field" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="contact" class="form-control input_field" placeholder="Enter Contact Number">
                                </div>
                                <div class="form-group">
                                   <select class="form-control input_field" name="type">
                                       <option value="Select Star Rating" selected disabled>Select User Type</option>
                                       <option value="1">Provider</option>
                                       <option value="2">Seeker</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                    <textarea rows="2" name="address" class="form-control input_field" placeholder="Enter Address"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="country" class="form-control input_field" placeholder="Enter Country Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="state" class="form-control input_field" placeholder="Enter State Name">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control input_field" placeholder="Enter Password">
                                </div>
<!--                                 <div class="form-group">
                                    <input type="hidden" name="status" value="1">
                                </div> -->
                                <!-- <p class="text-right txt_12"><a href="#" class="txt_grey hover_txt_orange" data-toggle="modal" data-target="#forgot_password">Forgot Password ?</a></p> -->
                                <div class="text-center orange_btns m_t_30">
                                    <ul class="list-unstyled list-inline m_b_0">
                                        <li>
                                        	<?php echo $this->Form->end(__('Submit', array('class' => 'txt_orange hover_txt_orange', ))); ?>
                                        	<!-- <a href="#">Submit</a> -->
                                        </li>
                                    </ul>
                                </div>
                                <p class="text-center txt_16 txt_black m_t_30">Already have an account? <a href="login" class="txt_orange hover_txt_orange">Click Here </a> to Login.</p>
                            </form>
                        </div>

                    </div>


                   
                </div>
            </div>
        </div>
    </div>



