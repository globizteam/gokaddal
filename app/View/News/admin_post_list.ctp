<div class="product-status mg-b-15">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-status-wrap drp-lst">
            <h4>Post List</h4>
            <div class="add-product">
                                <a href="<?php echo $this->Html->url('/admin/news/add_post'); ?>">Add post</a>
                            </div>
            <div class="asset-inner">
	           <table class="dataTable table-hover">
               <thead>
                 <th>SNo.</th>
                 <th>Category</th>
                 <th>Sub-Category</th>    
                 <th>Post Title</th>
                 <th>Seller Name</th>
                 <th>Price</th>
                 <!--<th>Content Format</th>-->
                 <th>Actions</th>
               </thead>
               <tbody>
                 <?php 
                 //print_r($specials);
                 $i=1; foreach($specials as $special){
                 
                 ?>
                 <tr>
                   <td><?php echo $i;?></td>
                   <td><?php echo $special['posts']['title'];?></td>
                   <td></td>
                   <td><?php echo $special['posts']['title'];?></td>
                   <td><?php //echo $special['posts']['sell_name'];?></td>
                   <td><?php echo $special['posts']['price'];?></td>
                   <td><a href="#"><i class="fas fa-pencil-alt"></i></a>
                   <a title="Delete" href="#"><i class="fa fa-trash" aria-hidden="true" style="color:red;"></i></a>
                  
                   </td>
                 </tr>
                 <?php $i++; } ?>
               </tbody>
             </table>
        	 </div>
          
          </div>  

   
        </div>
      </div>
    </div>
    </div>
    <!-- END Stats --> 
    
    
  