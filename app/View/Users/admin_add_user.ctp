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
                               
                                <li>
                                    <?php if(isset($this->params['pass'][0])) :?>
                                        <a href="#"> Edit User</a>
                                    <?php  else :   ?>
                                        <a href="#"> Add User</a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                            <?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data'));?>
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
                                                                                'name',array(
                                                                                    'placeholder' => 'Name', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'Name'
                                                                                    )
                                                                                );?>
                                                                </div>
<!--                                                                 <div class="form-group">
                                                                    
                                                                    <?php echo $this->Form->input(
                                                                                'last_name',array(
                                                                                    'placeholder' => 'Last Name', 
                                                                                    'class' => 'form-control', 
                                                                                    'label' => 'Last Name',
                                                                                    'required' => false
                                                                                    )
                                                                                );?>
                                                                </div>
 -->                                                                <div class="form-group">
                                                                    <?php echo $this->Form->input(
                                                                                'email',array(
                                                                                    'placeholder' => 'Email', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'Email',
                                                                                    'readonly' => !empty($this->request->data['User']['id']) ? 'true' : 'false'
                                                                                    )
                                                                                );?>
                                                                </div>

                                                                
                                                                <div class="form-group">
                                                                    <?php echo $this->Form->input(
                                                                                'country',array(
                                                                                    'placeholder' => 'country', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'Country'
                                                                                    )
                                                                                );?>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <?php echo $this->Form->input(
                                                                                'state',array(
                                                                                    'placeholder' => 'state', 
                                                                                    'class' => 'form-control', 'label' => 'State'
                                                                                    )
                                                                                );?>
                                                                </div>
                            <?php if (isset($edit)) : ?>
                                <input type="hidden" name="edit" value="edit">
                            <?php endif; ?>
                            <div class="form-group">

                                <?php
                                    $type =  'seeker';
                                    if (!empty($this->request->data['User']['type']))
                                    {
                                        if($this->request->data['User']['type'] == '2') 
                                            $type = 'seeker';
                                        elseif ($this->request->data['User']['type'] == '1')
                                            $type = 'provider';
                                    }else{
                                            $type = 'Select option';
                                        }

                                    
                                    echo $this->Form->input(
                                            'type',
                                            array(
                                                'options' => ['provider'=>'Solution provider','seeker'=>'Solution Seeker'], 
                                                'default' => '',
                                                'class' => 'form-control',
                                                'selected' =>  $type ? $type : 'seeker' 
                                            )
                                    );
                                ?>

                                                                    
                                                                </div>

                                                                <div class="form-group">
                                                                    <?php echo $this->Form->input(
                                                                                'contact',array(
                                                                                    'placeholder' => 'contact', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'Contact'
                                                                                    )
                                                                                );?>
                                                                </div>

                                                                <div class="form-group">
                                                                    <?php echo $this->Form->input(
                                                                                'company_name',array(
                                                                                    'placeholder' => 'Enter company name', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'Company Name'
                                                                                    )
                                                                                );?>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="ProviderServiceDescription">Company Description</label>
                                                                    <?php echo $this->Form->textarea(
                                                                                'description',array(
                                                                                    'placeholder' => 'Company Description', 
                                                                                    'class' => 'form-control', 
                                                                                    'label' => 'Description',
                                                                                    // 'required' => true
                                                                                    )
                                                                                );
                                                                    ?>
                                                                </div>

                                                                <!-- <input type="file" value="ss.jpg" name="dd"> -->
                                                                <div class="form-group">
                                                                     <?php

                                                                         echo $this->Form->input(
                                                                             'profile_pic',array(
                                                                                 'placeholder' => 'File',
                                                                                 'class' => 'form-control',
                                                                                 'label' => 'Upload image',
                                                                                 'type' => 'file',
                                                                                 'name' => 'file',
                                                                                 'value' => 'abcc.jpg' 
                                                                             )
                                                                         );
                                                                     ?>
                                                                </div>

                                                                <div class="form-group">
                                                                    <?php echo $this->Form->input(
                                                                                'address',array(
                                                                                    'placeholder' => 'address', 
                                                                                    'class' => 'form-control', 'label' => 'Address'
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
        
        