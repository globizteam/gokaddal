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
                               
                                <li><a href="#"> Add FAQ</a></li>
                            </ul>
                            <?php //echo $this->Form->create('Page');?>
                                <?php //echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Page']['id']));?>
                                <form action="<?php echo $this->webroot.'admin/pages/addfaq' ?>" method="post" >
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
                                                                                'ques',array(
                                                                                    'type'=>'textarea',
                                                                                    'placeholder' => 'Add question', 
                                                                                    'class' => 'form-control', 
                                                                                    'label' => 'Add Question',
                                                                                    'required' => true,
                                                                                    'value' => !empty( $record['faq']['ques']) ? $record['faq']['ques'] : ''
                                                                                    )
                                                                                );?>
                                                                </div>

                                                                <?php  if (!empty($record)) 
                                                                        { 
                                                                ?>
                                                                        <input type="hidden" name="id" value="<?php echo $record['faq']['id']; ?>">
                                                                <?php   } ?>


                                                                <div class="form-group">
                                                                    
                                                                    <?php echo $this->Form->input(
                                                                                'ans',array(
                                                                                    'type'=>'textarea',
                                                                                    'placeholder' => 'Add answer', 
                                                                                    'class' => 'form-control', 
                                                                                    'label' => 'Add Answer',
                                                                                    'required' => true,
                                                                                    'value' => !empty( $record['faq']['ans']) ? $record['faq']['ans'] : ''
                                                                                    )
                                                                                );?>
                                                                </div>
                                                                <div class="form-group-inner">
                                                                    <div class="login-btn-inner">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                                    <button type="button" class="btn btn-white" onclick="history.go(-1)">Cancel</button>
                                                                                    <button class="btn btn-sm btn-primary login-submit-cs add-address" type="submit">Save Change</button>
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
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>