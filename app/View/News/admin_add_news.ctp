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
                        
                        <li><a href="#">Post Information</a></li>
                    </ul>
                    <?php echo $this->Form->create('New',array('enctype'=>'multipart/form-data'));?>
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
                                                        'type'=>'text',
                                                        'placeholder' => 'Enter Description',
                                                        'class' => 'form-control required',
                                                        'label' => 'Enter Description',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'number',array(
                                                        'placeholder' => 'Price',
                                                        'class' => 'form-control required',
                                                        'label' => 'Price',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                        <div class="form-group">
                                                        <?php echo $this->Form->input(
                                                        'location',array(
                                                        'type'=>'text',
                                                        'placeholder' => 'Enter Location',
                                                        'class' => 'form-control required',
                                                        'label' => 'Enter Location',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                     <div class="form-group">
                                                        <div><label for="users">Select User</label></div>           
                                                     <select id="users" name="users" class="form-control required" required>
			            	    <option value=''>Select User</option>
			            	    <?php  foreach($users as $user){ ?>
			            	    <option value='<?php echo @$user['User']['id'];?>'><?php echo @$user['User']['first_name'];?></option>
			            	    <?php   } ?>
			            	</select>
			            	
                                                            
                                                        </div>
                                                    
                                                    <div class="form-group">
                                                        <?php echo $this->Form->input(
                                                        'type',array(
                                                        'options' => ['audio' => 'Audio', 'video' => 'Video', 'image' => 'Image', 'pdf' => 'PDF'],
                                                        'empty'=>'Select Type', 
                                                        'placeholder' => 'News Number',
                                                        'selected' => isset($this->data['New']['type'])?$this->data['New']['type']:'',
                                                        'class' => 'form-control required',
                                                        'label' => 'Post type',
                                                        'required' => true
                                                        )
                                                        );?>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        
                                                        <?php 
                                                        $class = empty($this->request->data['New']['file'])?'form-control required':'form-control';
                                                        echo $this->Form->input(
                                                            'file',array(
                                                                'placeholder' => 'File',
                                                                'class' => $class,
                                                                'label' => 'Choose File',
                                                                'type' => 'file',
                                                                'name' => 'file'
                                                            )
                                                        );?>
                                                    </div>
                                                    <div class="form-group thumbnail" style="display: <?php echo (!empty($this->request->data['New']['type']) && $this->request->data['New']['type'] == 'video')?'block':'none'; ?>">
                                                        
                                                        <?php 
                                                        $class = empty($this->request->data['New']['thumbnail'])?'form-control required':'form-control';
                                                        echo $this->Form->input(
                                                            'file',array(
                                                                'placeholder' => 'File',
                                                                //'class' => $class,
                                                                'label' => 'Choose Thumbnail',
                                                                'type' => 'file',
                                                                'name' => 'thumbnail'
                                                            )
                                                        );?>
                                                    </div>
                                                    <?php if(!empty($this->request->data['New']['file'])){?>
                                                    <div class="form-group">
                                                        <img src="<?php echo $this->webroot.'img/news/'.$this->request->data['New']['file']?>" width="200px">
                                                    </div>
                                                    <?php }?>
                                                    
                                                    
                                                    <div class="form-group">
                                                    <label for="" >Select Category</label>
                                                        <?php foreach( $categories as $category ): ?>
                                                        <div style="margin-top: 20px;"><label for="">Category Name</label></div>
                                                        <div class="row border-red">
                                                            <div class="i-checks pull-left">
                                                                <label for="">
                                                                    <input type="checkbox" class="i-checks parent-category cate" id="parent_cate_<?php echo $category['Category']['id']; ?>" value="<?php echo $category['Category']['id']; ?>" name="DesignationCategory[category_id][]" <?php if(isset($selectedCategories) && in_array( $category['Category']['id'] ,$selectedCategories )): ?>checked <?php endif; ?>> <?php echo $category['Category']['title']; ?>
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
