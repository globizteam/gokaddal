<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="logo-pro">
                <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
            </div>
        </div>
    </div>
</div>
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st">
                    <ul id="myTabedu1" class="tab-review-design">
                        
                        <li><a href="#"> Product Type Information</a></li>
                    </ul>
                    <?php echo $this->Form->create('ProductType', array('type' => 'file')); ?>
                    <?php echo $this->Form->input('id', array('type' => 'hidden'));?>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="reviews">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="devit-card-custom">
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'title',array(
                                                        'placeholder' => 'Title',
                                                        'class' => 'form-control required',
                                                        'label' => 'Title',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'description',array(
                                                        'placeholder' => 'Description',
                                                        'class' => 'form-control required',
                                                        'label' => 'Description',
                                                        'type' => 'textarea',
                                                        'rows' => '2',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    
                                                    <!-- <div class="form-group">
                                                        <label>Image</label>
                                                        <input type="file" name="image" class="form-control" <?php echo !empty($this->request->data['Category']['image']) ? "" : "required";?> multiple="" accept="image/*">
                                                    </div> -->
                                                    <div class="form-group">
                                                    <?php 
                                                        if(!empty($this->request->data['Category']['image'])){
                                                        
                                                    ?>
                                                        
                                                            <div class="col-md-2">
                                                                <img src="<?php echo $this->webroot;?>img/category/<?php echo $this->request->data['Category']['image'];?>" class="img-responsive">
                                                            </div>
                                                              
                                                    <?php
                                                        
                                                        }
                                                    ?>
                                                    </div>  
                                                    
                                                    <div class="form-group-inner">
                                                        <div class="login-btn-inner">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                        <button type="button" class="btn btn-white" onclick="history.go(-1)">Cancel</button>
                                                                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Save Change</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="product-tab-list tab-pane fade" id="INFORMATION">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                        <div class="devit-card-custom">
                                                                                                                <div class="form-group">
                                                                                                                        <input type="url" class="form-control" placeholder="Facebook URL">
                                                                                                                </div>
                                                                                                                <div class="form-group">
                                                                                                                        <input type="url" class="form-control" placeholder="Twitter URL">
                                                                                                                </div>
                                                                                                                <div class="form-group">
                                                                                                                        <input type="url" class="form-control" placeholder="Google Plus">
                                                                                                                </div>
                                                                                                                <div class="form-group">
                                                                                                                        <input type="url" class="form-control" placeholder="Linkedin URL">
                                                                                                                </div>
                                                                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>