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
                                        <a href="#"> Edit Solution</a>
                                    <?php  else :   ?>
                                        <a href="#"> Add Solution</a>
                                    <?php endif; ?>
                                
                                </li>
                            </ul>
                            <?php  echo $this->Form->create('ProviderService',array('enctype'=>'multipart/form-data'));?>
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
                                                                    <label for="ProviderServiceDescription">Description</label>
                                                                    <?php echo $this->Form->textarea(
                                                                                'description',array(
                                                                                    'placeholder' => 'Description', 
                                                                                    'class' => 'form-control', 
                                                                                    'label' => 'Description',
                                                                                    // 'required' => true
                                                                                    )
                                                                                );
                                                                    ?>
                                                                </div>

                                                               <div class="form-group">
                                                                <?php
                                                                // $class = empty($this->request->data['ProviderService']['file'])?'form-control required':'form-control';
                                                                echo $this->Form->input(
                                                                    'file',array(
                                                                        'placeholder' => 'File',
                                                                        'class' => 'form-control',
                                                                        'label' => 'Upload image',
                                                                        'type' => 'file',
                                                                        'name' => 'file'
                                                                    )
                                                                );?>
                                                               </div>

                                                <?php if (isset($editservice)) : ?>
                                                    <input type="hidden" name="editservice" value="editservice">
                                                <?php endif; ?>

                                                            <div class="form-group">
                                                                <label for="Category">Category</label>
                                                                <select class="form-control" name="catid">
                                                                <?php foreach ($allcatrecords as $title): ?>
                                                                  <option value="<?= $title['Category']['id']; ?>" <?php  if(isset($service) && $service['Category']['id'] == $title['Category']['id'] ){ echo 'selected'; } ?> > <?= $title['Category']['title']; ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <!--Add tag information  -->
                 <!--                                            <div class="form-group">
                                                            
                                                                <?php echo $this->Form->input(
                                                                            'tag',array(
                                                                                'placeholder' => 'Add tag', 
                                                                                'class' => 'form-control required', 
                                                                                'label' => 'Add Tag',
                                                                                'required' => true
                                                                                )
                                                                            );?>
                                                            </div> -->

                                                            <div class="form-group">
                                                                <label for="Tag">Select Tag</label>
                                                                <select class="form-control" name="tagid">
                                                                <?php foreach ($tags as $tag): ?>
                                                                  <option value="<?= $tag['Tag']['id']; ?>"  <?php  if(isset($tag) && $tag['Tag']['id'] == $service['ProviderService']['tag_id'] ){ echo 'selected'; } ?> ><?= $tag['Tag']['name']; ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="User">Select User</label>
                                                                <select class="form-control" name="userid">
                                                                <?php foreach ($users as $user): 
                                                                        if ($user['User']['id'] == 1) continue;
                                                                 ?>
                                                                  <option value="<?= $user['User']['id']; ?>"  <?php  if(isset($service) && $service['User']['id'] == $user['User']['id'] ){ echo 'selected'; } ?> ><?= $user['User']['name']; ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                            </div>

<!--                                                                <div class="form-group">
                                                                <?php
                                                                   echo $this->Form->input(
                                                                           'Category',
                                                                           array(
                                                                               'options' => $allcatrecords[0], 
                                                                               'default' => '--Select--',
                                                                               'class' => 'form-control',
                                                                               // 'selected' =>  $type
                                                                           )
                                                                   );
                                                                   ?>
                                                               </div>
 -->


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
        
        