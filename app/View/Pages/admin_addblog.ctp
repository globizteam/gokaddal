   <style>
  .pagination > li > span {
    float: left;
  }
  table,th,td
  {
    text-align: center;
  }
  </style>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=9orbgac0ea4yegq01fnswj07hnea7strlu0jq17umsg94hyg"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  <!-- Main Container -->
  <main id="main-container"> 
    
    <!-- Stats -->
    <div class="content">
      <?php if(empty($content)){ ?>
        <div class="h2 page-heading">Add Blog</div><br>
      <?php } else{ ?>
        <div class="h2 page-heading">Edit Blog</div><br>
      <?php } ?>
      <div class="block block-bordered">
       
        
        <div class="block-content tab-content">
         
          <div class="tab-pane fade in active" id="user-access">
           
            <div>
	            <form  method="post" enctype="multipart/form-data">
	            	<div class="row">
	            		<div class="col-md-6">
	            		    <br><label><b>Blog Title</b></label><br>
			            	<input type="text" name="data[title]" class="form-control required" placeholder="Blog Title" value="<?php echo @$content['blog']['ques']?>" required>
			            	<br><label><b>Blog Category</b></label><br>
			            	<input type="text" name="data[cat]" class="form-control required" placeholder="Blog Category" value="<?php echo @$content['blog']['cat']?>" required>
			            	<br><label><b>Blog Content</b></label><br>
			            	<textarea name="data[descr]" rows="10" cols="100"><?php echo @$content['blog']['ans']?></textarea><br>
			            	<br><label><b>Blog Image</b></label><br>
			            	<input class="form-control" type="file" name="DishImage" id="">
			            	<br>
			            	<input type="submit" class="btn btn-primary" name='submit' style="margin-top: 4.5%;" value='Save'>
			            	<br>
		                    <?php if(empty($content['blog']['images'])){?>
                            
                            <?php } else{?>
                                    <img src="<?php echo HTTP_ROOT.'img/profile/'.@$content['blog']['images']?>">
                            <?php }?><br>
                            
			            	
		            	</div>
	            	</div>
	            </form>
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

