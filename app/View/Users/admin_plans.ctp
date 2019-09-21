     <!--<?php// print_r($specials3); die();?>-->
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
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                             <ul id="myTabedu1" class="tab-review-design">
                                <?php if(empty($content)){ ?>
                                <li><a href="#"> Add Plans</a></li>
                                 <?php } else{ ?>
         <li><a href="#"> Edit Plans</a></li>
      <?php } ?>
                            </ul>
	            <form id="customerform" action="" method="post" enctype="multipart/form-data">
	            	<div class="row">
	            		<div class="col-md-12">
	            		    
	            		    <br><label><b>Plan Name</b></label><br>
			            	<input type="text" name="data[name]" class="form-control required" placeholder="Plan Name" value="<?php echo @$content['plans']['name']?>" required>
			            	<!--</select>-->
			            	<br><label><b>Price</b></label><br>
			            	<input type="text" name="data[price]" class="form-control required" placeholder="Price" value="<?php echo @$content['plans']['price']?>" required>
			            	<br><label><b>How many days the post will remain published?</b></label><br>
			            	<input type="text" name="data[max_days]" class="form-control required" placeholder="Days" value="<?php echo @$content['plans']['max_days']?>" required>
			            	<br><label><b>Features</b></label>
			            	<textarea name="data[desc]" rows="20" cols="500"><?php echo @$content['plans']['description']?></textarea>
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
