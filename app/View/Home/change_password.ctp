
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
                        <?php echo $this->Flash->render(); ?>
                        
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <div class="my_account_main_content p_tb_80 col_sm_p_tb_60 m_b_70">
                                    <h2 class="txt_black m_b_20">Change Password</h2>
                                    
                                    <div class="my_info_body m_t_30">
                                        <h4 class="txt_black txt_w_600">Please fill the form</h4>
                                        <hr class="dark_grey_hr m_t_15">
                                        <div class="my_info_form">
                                            <!-- <form action="#"> -->
                                                <?php //echo $this->Form->create('User', array('url' => array('controller' => 'home', 'action' => 'change_password') ) ); ?>
                                                <form method="post" action="<?php echo $this->webroot.'home/change_password'; ?>" id="changePasswordForm" >
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="current_password" class="txt_black">Enter Current Password</label>
                                                            <input type="password" name="current_password" class="form-control input_field my_info_input" id="current_password" placeholder="Enter Current Password" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="new_password" class="txt_black">Enter New Password</label>
                                                            <input type="password" class="form-control input_field my_info_input" name="new_password" id="new_password" placeholder="Enter New Password" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="confirm_password" class="txt_black">Re-enter New Password</label>
                                                            <input type="password" class="form-control input_field my_info_input" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        
                                                    </div>
                                                </div>
                                                <div class="orange_btns m_t_30">
                                                    <ul class="list-unstyled list-inline m_b_0">
                                                        <li><input type="submit" value="Update" ></li>
                                                        <li>
                                                            <a href="<?php echo $this->webroot.'home/change_password' ?>">Cancel</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </form>
                                        </div>
                                    </div> <!-- /.my_info_body -->


                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- /.col-md-9 -->
                    
                </div>
            <!-- </div> -->
        </div>
    </div>

