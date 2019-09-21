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
                        
                        <li><a href="#"> Designation Information</a></li>
                    </ul>
                    <?php echo $this->Form->create('Designation');?>
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
                                                    <!--<div class="form-group">
                                                        
                                                        <?php echo $this->Form->input(
                                                        'short_name',array(
                                                        'placeholder' => 'Short Name',
                                                        'class' => 'form-control',
                                                        'label' => 'Short Name',
                                                        'required' => false
                                                        )
                                                        );?>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <?php
                                                        echo $this->Form->input(
                                                        'organisation_id',
                                                        array(
                                                        'options' => $codes,
                                                        'empty' => 'Select Organisation',
                                                        'class' => 'form-control',
                                                        'id' => 'organ_id',
                                                        'required' => true
                                                        )
                                                        );
                                                        ?>
                                                        
                                                    </div>
                                                    <div class="form-group">
                                                        <?php
                                                        echo $this->Form->input(
                                                        'department_id',
                                                        array(
                                                        'options' => @$depart,
                                                        'empty' => 'Select Department',
                                                        'class' => 'form-control',
                                                        'id'=> 'depart_id',
                                                        'required' => true
                                                        )
                                                        );
                                                        ?>
                                                        
                                                    </div> -->
                                                    <!-- <div class="form-group">
                                                        <label for="" >Select Category</label>
                                                        <?php foreach( $categories as $category ): ?>
                                                        <div class="row">
                                                            <div class="i-checks pull-left">
                                                                <label for="">
                                                                    <input type="checkbox" class="i-checks parent-category" id="parent_cate_<?php echo $category['Category']['id']; ?>" value="<?php echo $category['Category']['id']; ?>" name="DesignationCategory[category_id][]" <?php if(isset($selectedCategories) && in_array( $category['Category']['id'] ,$selectedCategories )): ?>checked <?php endif; ?> > <?php echo $category['Category']['title']; ?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <label for="">Subacategory</label>
                                                        <div class="row">
                                                            <?php foreach( $category['Subcategory'] as $subcategory ): ?>
                                                            <div class="i-checks pull-left col-md-3">
                                                                <label for="">
                                                                    <input type="checkbox" parentId="<?php echo $subcategory['parent']; ?>" class="child-category-<?php echo $subcategory['parent']; ?> child-category" value="<?php echo $subcategory['id']; ?>" name="DesignationCategory[category_id][]" <?php if(isset($selectedCategories) && in_array( $subcategory['id'] ,$selectedCategories )): ?>checked <?php endif; ?> > <?php echo $subcategory['title']; ?>
                                                                </label>
                                                            </div>
                                                            <?php endforeach;?>
                                                        </div>
                                                        <?php endforeach; ?>
                                                    </div>-->
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#organ_id').on('change', function() {
        var organId = $(this).val();
        $.ajax({
            type: "post",
            url: "<?php echo $this->webroot?>admin/Users/getDeparment/" + organId,
            success: function(resp) {
                var re = $.parseJSON(resp);
                if (re.status) {
                    $('#depart_id').html(re.data);
                } else {
                    $('#depart_id').html(re.data);
                    alert(re.msg);
                }
            }
        });
    });

    $('.parent-category').change(function(){
        var parentId = $(this).val();
        if( $(this).is(':checked') ) {
            $('.child-category-'+parentId).prop('checked',true);
        } else {
            $('.child-category-'+parentId).prop('checked',false);
        }
    });

    $('.child-category').change(function(){
        var parentId = $(this).attr('parentId');
        if($(this).is(':checked') && !$('#parent_cate_'+parentId).is(':checked') ) {
            $('#parent_cate_'+parentId).prop('checked',true);
        }
    });
});


</script>