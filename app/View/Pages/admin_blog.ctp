<style>
  .pagination > li > span {
    float: left;
  }

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
  <!-- Main Container -->
  <main id="main-container"> 
     <a href='http://globizdevserver.com/gokaddal-staging/admin/pages/addblog'><button type="button" class="btn btn-primary pull-right" style="margin-top: 4.5%;margin-right: 4.5%;">Add Blog Post</button></a><br>
    <!-- Stats -->
    <div class="content">
      <div class="h2 page-heading">Blog List</div>
      <br>
     
      <div class="block block-bordered">
       
        
        <div class="block-content tab-content">
         
          <div class="tab-pane fade in active" id="specials">
            <div class="push">
              <div class="pull-left">
                <div class="h2 page-heading"></div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div>
	           <table class="dataTable table-hover">
               <thead>
                 <th>SNo.</th>
                 <th>Blog Title</th>
                 <th>Blog Content</th>
                 <th>Blog Image</th>
                 <th>Blog Create Date</th>
                 <th>Status</th>
                 <th>Actions</th>
               </thead>
               <tbody>
                 <?php $i=1; foreach($specials as $special){?>
                 <tr>
                   <td><?php echo $i;?></td>
                   <td><?php echo $special['blog']['ques'];?></td>
                   <td><?php echo substr(strip_tags($special['blog']['ans']),0,250); ?></td>
                        <td><?php if(empty($special['blog']['images'])){?>
                            
                            <?php } else{?>
                                    <img src="<?php echo HTTP_ROOT.'img/profile/'.@$special['blog']['images']?>" width='100px;'>
                            <?php }?></td>
                    <td><?php echo $special['blog']['cdate'];?></td>        
                   <?php if($special['blog']['status'] == 0){?>
                            <td>Inactive</td>
                            <?php } else{?>
                            <td>Active</td>
                    <?php  }?>
                   <td><a href="http://globizdevserver.com/gokaddal-staging/admin/pages/addblog/<?php echo base64_encode($special['blog']['id']);?>"><i class="fa fa-pencil"></i></a>
                   <a title="Update Status" href="http://globizdevserver.com/gokaddal-staging/admin/pages/update_blog/<?php echo $special['blog']['id'];?>"><i class="fa fa-flag" aria-hidden="true"></i></a>
                   <a title="Delete" onclick="if(!confirm('Are you sure, you want to delete this Blog?')){return false;}" href="<?php echo $this->webroot.'admin/pages/deleteblog/'.$special['blog']['id']?>"><i class="fa fa-trash" aria-hidden="true" style="color:red;"></i></a>
                   </td>
                 </tr>
                 <?php $i++; } ?>
               </tbody>
             </table>
        	 </div>
            <div class="push">
              <div class="pull-left">
              </div>
              <div class="clearfix"></div>
            </div>    
          </div>  

     
        </div>
      </div>
    </div>
    <!-- END Stats --> 
    
    
  </main>
  <!-- END Main Container --> 
  <script>
      $(function () {
       
        $('#userTable1').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": false
        });
      });
    </script> 
