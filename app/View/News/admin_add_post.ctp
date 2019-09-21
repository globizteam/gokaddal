<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=9orbgac0ea4yegq01fnswj07hnea7strlu0jq17umsg94hyg"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  <!-- Main Container -->
  
    <!-- Stats -->
    <div class="content">
      <?php if(empty($content)){ ?>
        <div class="h2 page-heading">Post Ad</div><br>
      <?php } else{ ?>
        <div class="h2 page-heading">Edit Ad</div><br>
      <?php } ?>
<div class="product-status mg-b-15">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-status-wrap drp-lst">
            <h4>Add Post</h4>
	            <form id="customerform" action="" method="post" enctype="multipart/form-data">
	            	<div class="row">
	            		<div class="col-md-12">
	            		    <br><label><b>Select Category</b></label><br>
			            	<select name="data[cont3]" id='partcat' class="form-control" >
			            	    <option value=''>Select Category</option>
			            	    <?php foreach($specials2 as $special){ ?>
			            	    <option <?php if(@$content['posts']['courseid']==@$special['Course']['id']){ echo 'selected'; } ?> value='<?php echo $special['Course']['title']; ?>'><?php echo $special['Course']['title']; ?></option>
			            	    <?php } ?>
			            	</select>
			            	
			            	<br><label><b>Select Sub Category</b></label><br>
			            	<div id='sspco'>
			            	<select name="data[sub_cats]" id="data[sub_cats]" class="form-control " >
			            	    <?php foreach($subcategory as $sub_cats){ ?>
			            	    <option <?php if(@$content['posts']['subcat']==@$special['sub_cats']['id']){ echo 'selected'; } ?> value='<?php echo $special['sub_cats']['id']; ?>'><?php echo $special['sub_cats']['title']; ?></option>
			            	    <?php } ?>
			            	</select>
			            	</div>
			            	<br><label><b>Select User</b></label><br>
			            	<select name="data[User]" class="form-control required">
			            	    <option value=''>Select User</option>
			            	    <?php foreach($user_list as $user){ ?>
			            	    <option  value='<?php echo $user['users']['first_name']; ?>'><?php echo $user['users']['first_name']; ?></option>
			            	    <?php   } ?>
			            	</select>
			            	
	            		    <br><label><b>Post Title</b></label><br>
			            	<input type="text" name="data[title]" class="form-control required" placeholder="Title" value="<?php echo @$content['posts']['title']?>" required>
			            	<br><label><b>Price</b></label><br>
			            	<input type="text" name="data[price]" class="form-control required" placeholder="Price" value="<?php echo @$content['posts']['price']?>" required>
			            	<br><label><b>Add images</b></label><br>
		                    <input type="file" class="form-control" name="image[]" multiple="5">
			            	<br><br><label><b>Post Description</b></label><br>
			            	<textarea name="data[desc]" rows="20" cols="500"><?php echo @$content['posts']['descr']?></textarea>
			            	
			            	<button type="submit" class="btn btn-primary" style="margin-top: 4.5%;">Save</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>              
                   <script type="text/javascript">
                       var frm = $('#partcat');
                   
                       frm.change(function (e) {
                                var partcato = document.getElementById("partcat").value; ;
                                //alert(partcato); return false;
                           e.preventDefault();
                           
                           $.ajax({
                               type: 'GET',
                               url: '<?php echo HTTP_ROOT; ?>Users/getsubcat',
                               data: 'parid='+partcato,
                               success: function (data) {
                                   //console.log('Submission was successful.');
                                   
                                   $("#sspco").html(data);
                                   //$('.gfdr').hide();
                                   console.log(data);
                               },
                               error: function (data) {
                                   //console.log('An error occurred.');
                                   $('.gfdr').hide();
                                   console.log(data);
                               },
                           });
                       });
                   </script>