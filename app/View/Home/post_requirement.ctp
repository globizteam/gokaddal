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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <div class="my_account_main_content p_tb_80 col_sm_p_tb_60">

                                    <div class="row m_b_15">
                                        <div class="col-sm-8">
                                            <h2 class="txt_black">Post Your Requirement</h2>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="text-right orange_btns col_xs_txt_left xs_m_t_15">
                                                <ul class="list-unstyled list-inline m_b_0">
                                                    <li><a href="<?php echo $this->webroot.'/home/my_requirement'; ?> ">Cancel</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="my_info_body m_t_30">
                                        <h4 class="txt_black txt_w_600">Please Fill the form</h4>
                                        <hr class="dark_grey_hr m_t_15">



                                        <div class="row">
                                            <div class="col-md-7 col-sm-9 col-xs-12">
                                                
                                                <!-- <form action="#" class=""> -->
                                                    <?php echo $this->Form->create(); ?>
                                                    <div class="form-group">
                                                        <select class="form-control input_field" name="category_id">
                                                            <option value="Select category" selected disabled>Select Category</option>
                                                        <?php foreach ($categories as $key => $category) {?>
                                                            <option value="<?php echo $key ?>" <?php if(isset($editrequirement['Category']['title']) && ($editrequirement['Category']['title'] == $categories[$key] )){ echo 'selected'; }?> >    <?php echo $categories[$key] ;?>
                                                            </option>
                                                        <?php }  ?>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="title" value="<?php if(isset($editrequirement['SeekerRequirement']['title']  )) { echo $editrequirement['SeekerRequirement']['title']; }?>" class="form-control input_field" placeholder="Title">
                                                    </div>
                                                    <div class="form-group">
                                                        <select class="form-control input_field" name="tag_id">
                                                            <option value="Select category" selected disabled>Select Tag</option>
                                                        <?php foreach ($tags as $key => $tag) {?>
                                                            <option value="<?php echo $tag['Tag']['id'] ;?>" <?php if(isset($editrequirement['Tag']['id']) && ($editrequirement['Tag']['id'] == $tag['Tag']['id'] )){ echo 'selected'; }?> >    <?php echo $tag['Tag']['name'] ;?>
                                                            </option>
                                                        <?php }  ?>

                                                        </select>
<!--                                                         <input type="email" name="title" class="form-control input_field" placeholder="Requirement Tags"> -->
                                                    </div>
                                                   <div class="form-group">
                                                       <textarea rows="4" name="description"  class="form-control input_field" placeholder="Requirement Description"><?php if(isset($editrequirement['SeekerRequirement']['description']  )) { echo trim($editrequirement['SeekerRequirement']['description']); }?></textarea>
                                                   </div>

                                                   <!-- if request is type of edit -->
                                                    <?php if(isset($editrequirement['SeekerRequirement']['id']  ) ) { ?>     <input type="hidden" name="id" value="<?php echo $editrequirement['SeekerRequirement']['id']; ?> ">
                                                   <?php } ?>

                                                    <div class="text-center orange_btns m_t_30">
                                                        <ul class="list-unstyled list-inline m_b_0">
                                                            <li><input type="Submit" value="Submit"></li>
                                                        </ul>
                                                    </div>
                                                </form>

                                            </div>
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


