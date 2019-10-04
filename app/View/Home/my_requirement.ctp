
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
                                            <h2 class="txt_black">My Requirements</h2>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="text-right orange_btns col_xs_txt_left xs_m_t_15">
                                                <ul class="list-unstyled list-inline m_b_0">
                                                    <li><a href="<?php echo $this->webroot.'home/post_requirement'; ?>">Post Your Requirement</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="my_info_body m_t_30">
                                        <h4 class="txt_black txt_w_600">My Requirements</h4>
                                        <hr class="dark_grey_hr m_t_15">


                                        <div class="listing_item_sec">
                                            <?php
                                            if (!empty($count)) {
                                                foreach ($userdata as $key => $data) { 
                                            ?>

                                                    <div class="listing_item bg_white_item">
                                                        <div class="row">
                                                            <div class="col-md-9 col-sm-8 col-xs-8 col_600_full_width">
                                                                <div class="listing_item_info listing_match_item">
                                                                    <h4 class="listing_item_name">
                                                                        <a href="javascript:;" class="txt_black">
                                                                            <?php echo $data['SeekerRequirement']['title']; ?>
                                                                        </a>
                                                                    </h4>
                                                                    
                                                                    <h5 class="listing_item_tags txt_w_400 m_t_10">
                                                                        <a href="javascript:;" class="txt_orange hover_txt_orange text-uppercase">
                                                                            <?php echo $data['Tag']['name']; ?>
                                                                        </a>
                                                                    </h5>
                                                                    <p class="m_t_10">
                                                                        <?php echo $data['SeekerRequirement']['description']; ?>
                                                                    </p>

                                                                    <div class="listing_item_location txt_12 m_t_10 txt_grey">
                                                                        PUBLISH DATE: 
                                                                        <?php 
                                                                            $onlydate = explode(' ', $data['SeekerRequirement']['created_at']);                                                                       
                                                                        echo $onlydate[0]; ?> &nbsp;&nbsp; | &nbsp;&nbsp; EXPIRY DATE: <?php echo $data['SeekerRequirement']['expiry_date']; ?>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 col-sm-4 col-xs-4 col_600_full_width xs_m_t_15">
                                                                <div class="listing_item_btns listing_match_item">
                                                                        <ul class="list-unstyled m_b_0">
                                                                            <li>
                                                                                <a href="<?php echo $this->webroot.'home/my_requirement_detail/'.$data['SeekerRequirement']['id']; ?>">
                                                                                    <i class="fa fa-eye"></i>View Details
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="<?php echo $this->webroot.'home/post_requirement/'.$data['SeekerRequirement']['id']; ?>">
                                                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                                                </a> 
                                                                                <a href="<?php echo $this->webroot.'home/delete_requirement/'.$data['SeekerRequirement']['id']; ?>"  onclick="return confirm('Are you sure, You want to delete this requirement?')" data-toggle="tooltip" title="Delete" class="pd-setting-ed">
                                                                                    <i class="fas fa-times"></i> Delete
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- /.listing_item -->

                                                <?php  } }?>



                                        </div> <!-- /.listing_item_sec -->



                                    </div> <!-- /.my_info_body -->

                                    <?php if(!empty($count)) {?> 
                                        <div class="custom-pagination">
                                            <nav aria-label="Page navigation example">
                                                <?php echo $this->element('Admin/pagination')?>
                                            </nav>
                                        </div>
                                    <?php }else{  ?>
                                        <div style=" text-align: center; margin-top: 20px; font-size: 16px; font-weight: 600;">You have not posted any requirement yet.</div>

                                    <?php }  ?>

                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- /.col-md-9 -->
                    
                </div>
            <!-- </div> -->
        </div>
    </div>



