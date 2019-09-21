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
                               
                                <li><a href="#"> Account Information</a></li>
                            </ul>
                            <?php echo $this->Form->create();?>
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
                                                                                'first_name',array(
                                                                                    'placeholder' => 'First Name', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'First Name'
                                                                                    )
                                                                                );?>
                                                                </div>
                                                                <div class="form-group">
                                                                    
                                                                    <?php echo $this->Form->input(
                                                                                'last_name',array(
                                                                                    'placeholder' => 'Last Name', 
                                                                                    'class' => 'form-control', 
                                                                                    'label' => 'Last Name',
                                                                                    'required' => false
                                                                                    )
                                                                                );?>
                                                                </div>
                                                                <div class="form-group">
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

                                                                    <?php 
                                                                        $codes = array('' => 'select country code', '91' => '91', '+1' => '+1');
                                                                        echo $this->Form->input(
                                                                                'country_code',
                                                                                array(
                                                                                    'options' => $countries, 
                                                                                    'default' => '',
                                                                                    'class' => 'form-control',
                                                                                    'empty' => 'Select Country'
                                                                                )
                                                                        );
                                                                    ?>

                                                                    
                                                                </div>
                                                                <div class="form-group">
                                                                    <?php echo $this->Form->input(
                                                                                'phone',array(
                                                                                    'placeholder' => 'Phone', 
                                                                                    'class' => 'form-control required', 
                                                                                    'label' => 'Phone'
                                                                                    )
                                                                                );?>
                                                                </div>
                                                                <div class="form-group">

                                                                    <?php 
                                                                        echo $this->Form->input(
                                                                                'organisation_id',
                                                                                array(
                                                                                    'options' => $organ, 
                                                                                    'empty' => 'Select Organization',
                                                                                    'class' => 'form-control',
                                                                                    'id' => 'organ_id',
                                                                                    'required' => true,
                                                                                    'label'=>'Organization'
                                                                                )
                                                                        );
                                                                    ?>
                                                                </div>
                                                                <div class="form-group">

                                                                    <?php 
                                                                        echo $this->Form->input(
                                                                                'department_id',
                                                                                array(
                                                                                    'options' => $depart, 
                                                                                    'empty' => 'Select Department',
                                                                                    'class' => 'form-control',
                                                                                    'id'=> 'depart_id',
                                                                                    'required' => true

                                                                                )
                                                                        );
                                                                    ?>

                                                                    
                                                                </div>
                                                                <div class="form-group">

                                                                    <?php 
                                                                        echo $this->Form->input(
                                                                                'designation_id',
                                                                                array(
                                                                                    'options' => $desig, 
                                                                                    'empty' => 'Select Designation',
                                                                                    'class' => 'form-control',
                                                                                    'id'=> 'desig_id',
                                                                                    'required' => true

                                                                                )
                                                                        );
                                                                    ?>

                                                                    
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" >Modules</label>
                                                                    <div class="row border">
                                                                    
                                                                    <div class="i-checks pull-left col-md-3">
                                                                        <label for="">
                                                                            <input type="checkbox"  class="child-category cate" value="users" name="Module[]"  <?php if(isset($modulesNames['users'])){ echo 'checked="true"'; } ?> > User Mgmt.
                                                                        </label>
                                                                    </div>
                                                                    <div class="i-checks pull-left col-md-3">
                                                                        <label for="">
                                                                            <input type="checkbox"  class="child-category cate" value="news" name="Module[]" <?php if(isset($modulesNames['news'])){ echo 'checked="true"'; } ?> > News Mgmt.
                                                                        </label>
                                                                    </div>
                                                                    <div class="i-checks pull-left col-md-3">
                                                                        <label for="">
                                                                            <input type="checkbox"  class="child-category cate" value="category" name="Module[]" <?php if(isset($modulesNames['category'])){ echo 'checked="true"'; } ?>  > Category Mgmt.
                                                                        </label>
                                                                    </div>
                                                                    <div class="i-checks pull-left col-md-3">
                                                                        <label for="">
                                                                            <input type="checkbox"  class="child-category cate" value="organization" name="Module[]" <?php if(isset($modulesNames['organization'])){ echo 'checked="true"'; } ?>  > Organization Mgmt.
                                                                        </label>
                                                                    </div>
                                                                    <div class="i-checks pull-left col-md-3">
                                                                        <label for="">
                                                                            <input type="checkbox"  class="child-category cate" value="department" name="Module[]" <?php if(isset($modulesNames['department'])){ echo 'checked="true"'; } ?>  > Department Mgmt.
                                                                        </label>
                                                                    </div>
                                                                    <div class="i-checks pull-left col-md-3">
                                                                        <label for="">
                                                                            <input type="checkbox"  class="child-category cate" value="designation" name="Module[]" <?php if(isset($modulesNames['designation'])){ echo 'checked="true"'; } ?> > Designation Mgmt.
                                                                        </label>
                                                                    </div>
                                                                    <div class="i-checks pull-left col-md-3">
                                                                        <label for="">
                                                                            <input type="checkbox"  class="child-category cate" value="country" name="Module[]" <?php if(isset($modulesNames['country'])){ echo 'checked="true"'; } ?>  > Country Mgmt.
                                                                        </label>
                                                                    </div>
                                                                    <div class="i-checks pull-left col-md-3">
                                                                        <label for="">
                                                                            <input type="checkbox"  class="child-category cate" value="cms" name="Module[]" <?php if(isset($modulesNames['cms'])){ echo 'checked="true"'; } ?>  > Cms Mgmt.
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                        
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
        
        