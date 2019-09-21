<style>
    .border{border: 1px solid #e1e1e1;
    padding: 10px;
    background: #eee;} 
    .border-red{padding: 10px;
    border: 1px solid #e1e1e1;
    text-transform: uppercase;}
</style>
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
                        
                        <li><a href="#"> Oranization Information</a></li>
                    </ul>
                    <?php echo $this->Form->create('Organisation',array('enctype'=>'multipart/form-data'));?>
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
                                                        'label' => 'Name',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'organization_id',array(
                                                        'type'=>'text',
                                                        'placeholder' => 'Organization Id',
                                                        'class' => 'form-control required',
                                                        'label' => 'Organization Id',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'organization_address',array(
                                                        'placeholder' => 'Orgnanization Address',
                                                        'class' => 'form-control required',
                                                        'label' => 'Orgnanization Address',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'organization_email',array(
                                                        'placeholder' => 'Organization email',
                                                        'class' => 'form-control required',
                                                        'label' => 'Organization email',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'organization_mob',array(
                                                        'placeholder' => 'Contact Number',
                                                        'class' => 'form-control required',
                                                        'label' => 'Contact Number',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'organization_contact_person',array(
                                                        'placeholder' => 'Contact Person',
                                                        'class' => 'form-control required',
                                                        'label' => 'Contact Person',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'organization_country',array(
                                                        'placeholder' => 'Enter Country Name',
                                                        'class' => 'form-control required',
                                                        'label' => 'Enter Country Name',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'no_of_employee',array(
                                                        'type'=>'select',
                                                        'options'=>[100=>100,200=>200,400=>400],
                                                        'placeholder' => 'Enter Country Name',
                                                        'class' => 'form-control required',
                                                        'label' => 'No Of Empoyee',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <?php 
                                                        $class = empty($this->request->data['Organisation']['logo'])?'form-control required':'form-control';
                                                        echo $this->Form->input(
                                                        'logo',array(
                                                        'placeholder' => 'Logo',
                                                        'class' => $class,
                                                        'label' => 'Logo',
                                                        'type' => 'file',
                                                        'name' => 'logo'
                                                        )
                                                        );?>
                                                    </div>
                                                    <?php if(!empty($this->request->data['Organisation']['logo'])){?>
                                                    <div class="form-group">
                                                        <img src="<?php echo $this->webroot.'img/organisationlogo/'.$this->request->data['Organisation']['logo']?>" width="200px">
                                                    </div>
                                                    <?php }?>
                                                    
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'designations',array(
                                                        'type'=>'select',
                                                        'options'=>$designations,
                                                        'multiple'=>true,
                                                        'selected'=> isset($selectedDesignations)?$selectedDesignations:'',
                                                        'placeholder' => 'Select Designation',
                                                        'class' => 'form-control required',
                                                        'label' => 'Select Designation',
                                                        'required' => true
                                                        )
                                                        );?>
                                                        <em>Please hold Ctrl key to select mulitple options</em>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'departments',array(
                                                        'type'=>'select',
                                                        'options'=>$departments,
                                                        'selected'=> isset($selectedDepartments)?$selectedDepartments:'',
                                                        'multiple'=>true,
                                                        'placeholder' => 'Select Departments',
                                                        'class' => 'form-control required',
                                                        'label' => 'Select Departments',
                                                        'required' => true
                                                        )
                                                        );?>
                                                        <em>Please hold Ctrl key to select mulitple options</em>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="" >Select Category</label>
                                                        <?php foreach( $categories as $category ): ?>
                                                        <div><label for="">Category Name</label></div>
                                                        <div class="row border-red">
                                                            <div class="i-checks pull-left">
                                                                <label for="">
                                                                    <input type="checkbox" class="i-checks parent-category cate" id="parent_cate_<?php echo $category['Category']['id']; ?>" value="<?php echo $category['Category']['id']; ?>" name="DesignationCategory[category_id][]" <?php if(isset($selectedCategories) && in_array( $category['Category']['id'] ,$selectedCategories )): ?>checked <?php endif; ?> > <?php echo $category['Category']['title']; ?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row border">
                                                        <div><label for="">SUB CATEGORY</label></div>
                                                            <?php foreach( $category['Subcategory'] as $subcategory ): ?>
                                                            <div class="i-checks pull-left col-md-3">
                                                                <label for="">
                                                                    <input type="checkbox" parentId="<?php echo $subcategory['parent']; ?>" class="child-category-<?php echo $subcategory['parent']; ?> child-category cate" value="<?php echo $subcategory['id']; ?>" name="DesignationCategory[category_id][]" <?php if(isset($selectedCategories) && in_array( $subcategory['id'] ,$selectedCategories )): ?>checked <?php endif; ?> > <?php echo $subcategory['title']; ?>
                                                                </label>
                                                            </div>
                                                            <?php endforeach;?>
                                                        </div>
                                                        <?php endforeach; ?>
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
