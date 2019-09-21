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
<div class="product-status mg-b-15">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-status-wrap drp-lst">
                            <ul id="myTabedu1" class="tab-review-design">
                               
                                <li><a href="#"> FAQ</a></li>
                            </ul>
                            
                                <div class="add-product">
                                <a href="<?php echo $this->Html->url('/admin/users/addUser'); ?>">Add FAQ</a>
                            </div>
                                    <div class="asset-inner">                           	           <table>
               <thead>
                 <th>SNo.</th>
                 <th>Faq Question</th>
                 <th>FAQ Answer</th>
                 
                 <th>Status</th>
                 <th>Actions</th>
               </thead>
               <tbody>
                 <?php $i=1; foreach($specials as $special){?>
                 <tr>
                   <td><?php echo $i;?></td>
                   <td><?php echo $special['faq']['ques'];?></td>
                   <td><?php echo $special['faq']['ans'];?></td>
               
                   <?php if($special['faq']['status'] == 0){?>
                            <td>Inactive</td>
                            <?php } else{?>
                            <td>Active</td>
                    <?php  }?>
                   <!--<td><a href="<?php echo HTTP_ROOT .'Users/addfaq/' . base64_encode($special['faq']['id']);?>"><i class="fa fa-pencil"></i></a>-->
                   <!--<a title="Update Status" href="<?php echo HTTP_ROOT.'Users/update_faq/'.$special['faq']['id']?>"><i class="fa fa-flag" aria-hidden="true"></i></a>-->
                   <!--</td>-->
                 </tr>
                 <?php $i++; } ?>
               </tbody>
             </table>  
             </div>
                                                             
                                                               
                                                               
                                                           
                                    
                                </div>
                            <!--</form>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>