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
                               
                                <li><a href="#"> Add address</a></li>
                            </ul>
                            <?php //echo $this->Form->create('Page');?>
                                <?php //echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Page']['id']));?>
                                <form action="<?php echo $this->webroot.'admin/pages/addaddresses' ?>" method="post" >
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
                                                                                'address',array(
                                                                                    'type'=>'textarea',
                                                                                    'placeholder' => 'Address', 
                                                                                    'class' => 'form-control', 
                                                                                    'label' => 'Address',
                                                                                    'required' => true,
                                                                                    'value' => !empty( $record['OfficeAddress']['address']) ? $record['OfficeAddress']['address'] : ''
                                                                                    )
                                                                                );?>
                                                                </div>

                                                                <?php  if (!empty($record)) 
                                                                        { 
                                                                ?>
                                                                        <input type="hidden" name="id" value="<?php echo $record['OfficeAddress']['id']; ?>">
                                                                <?php   } ?>
                                                                <div class="form-group">
                                                                
                                                                    <?php echo $this->Form->input(
                                                                                'email',array(
                                                                                    'type'=>'email',
                                                                                    'placeholder' => 'Email', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'Email',
                                                                                    'value' => !empty( $record['OfficeAddress']['email']) ? $record['OfficeAddress']['email'] : ''
                                                                                    )
                                                                                );?>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                
                                                                    <?php echo $this->Form->input(
                                                                                'phone',array(
                                                                                    'type'=>'text',
                                                                                    'placeholder' => 'Phone', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'Phone',
                                                                                    'value' => !empty( $record['OfficeAddress']['phone']) ? $record['OfficeAddress']['phone'] : ''
                                                                                    )
                                                                                );?>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                
                                                                    <?php echo $this->Form->input(
                                                                                'facebook',array(
                                                                                    'type'=>'text',
                                                                                    'placeholder' => 'Facebook link', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'Facebook',
                                                                                    'value' => !empty( $record['OfficeAddress']['facebook']) ? $record['OfficeAddress']['facebook'] : ''
                                                                                    )
                                                                                );?>
                                                                </div>
                                                               
                                                                <div class="form-group">
                                                                
                                                                    <?php echo $this->Form->input(
                                                                                'twitter',array(
                                                                                    'type'=>'text',
                                                                                    'placeholder' => 'Twitter link', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'Twitter',
                                                                                    'value' => !empty( $record['OfficeAddress']['twitter']) ? $record['OfficeAddress']['twitter'] : ''
                                                                                    )
                                                                                );?>
                                                                </div>
                                                               
                                                                <div class="form-group">
                                                                
                                                                    <?php echo $this->Form->input(
                                                                                'instagram',array(
                                                                                    'type'=>'text',
                                                                                    'placeholder' => 'Instagram link', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'Instagram',
                                                                                    'value' => !empty( $record['OfficeAddress']['instagram']) ? $record['OfficeAddress']['instagram'] : ''
                                                                                    )
                                                                                );?>
                                                                </div>
                                                               
                                                                <div class="form-group">
                                                                
                                                                    <?php echo $this->Form->input(
                                                                                'linkedin',array(
                                                                                    'type'=>'text',
                                                                                    'placeholder' => 'LinkedIn link', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'LinkedIn',
                                                                                    'value' => !empty( $record['OfficeAddress']['linkedin']) ? $record['OfficeAddress']['linkedin'] :''
                                                                                    )
                                                                                );?>
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
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>