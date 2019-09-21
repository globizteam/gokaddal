


        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <h1 class="text-center txt_white m_b_20 txt_52">Login</h1>
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
                            <?php echo $this->Form->create('User', array('url' => array('controller' => 'home', 'action' => 'login') ) ); ?>
                            <!-- <form action="my_account.php"> -->
                                <div class="form-group">
                                    
                                    <input type="email" name="data[User][email]" class="form-control input_field" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="data[User][password]" class="form-control input_field" placeholder="Enter Password">
                                </div>
                                <p class="text-right txt_12"><a href="#" class="txt_grey hover_txt_orange" data-toggle="modal" data-target="#forgot_password">Forgot Password ?</a></p>
                               <!--  <div class="form-group">
                                   <select class="form-control input_field">
                                       <option value="Select Star Rating" selected disabled>Select Star Rating</option>
                                       <option value="1 star">1 Star</option>
                                       <option value="2 star">2 Star</option>
                                       <option value="3 star">3 Star</option>
                                       <option value="4 star">4 Star</option>
                                       <option value="5 star">5 Star</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <textarea rows="3" class="form-control input_field" placeholder="Enter Message"></textarea>
                               </div> -->
                                <div class="text-center orange_btns m_t_30">
                                    <ul class="list-unstyled list-inline m_b_0">
                                        <li>
                                            <?php echo $this->Form->end(__('Submit', array('class' => 'txt_orange hover_txt_orange', ))); ?>
                                            <!-- <a href="my_account.php">Submit</a></li> -->
                                    </ul>
                                </div>

                                <p class="text-center txt_16 txt_black m_t_30">Don't have an account? <a href="signup" class="txt_orange hover_txt_orange">Click Here </a> to Signup.</p>
                            </form>
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



