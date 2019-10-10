<!-- Main Container -->
<div class="product-status mg-b-15">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-status-wrap drp-lst">
      <div class="block block-bordered">
        <!--<ul class="nav nav-tabs" data-toggle="tabs">-->
        <!--	<li class="active"><a data-toggle="tab" href="#user-access">Messages</a></li>-->
        <!--    <li><a data-toggle="tab" href="#content">Page Content</a></li>-->
        <!--</ul>-->
                    
        
        <div class="block-content tab-content">
         
          <!--<div class="tab-pane fade in active" id="user-access">-->
            <div class="push">
              <div class="pull-left">
                <div class="h2 page-heading">Messages</div> 
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="table-responsive"> <!-- My div Harpreet-->
            <table class="dataTable table-hover">
              <thead>
                      <tr role="row">
                          <th>SNo.</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          
                          <th>Message</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                      <?php $i=1; foreach($people as $tuff){?>
                        <tr class="odd">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $tuff['Contact']['name']; ?></td>
                            <td><?php echo $tuff['Contact']['email']; ?></td>
                            <td><?php echo $tuff['Contact']['contact']; ?></td>
                            <!--<td><?php echo $tuff['Contact']['gst']; ?></td>-->
                            <td><?php echo $tuff['Contact']['message']; ?></td>
                            <td><?php if($tuff['Contact']['status'] == 0) echo 'Pending'; else echo 'Responded'; ?>
                            <td>
                              <a title="Change Status" href="<?php echo $this->webroot.'admin/pages/changestatus/'.$tuff['Contact']['id']?>"><i class="fa fa-flag" aria-hidden="true"></i></a>
                              <a title="Delete" onclick="if(!confirm('Are you sure, you want to delete this Record?')){return false;}" href="<?php echo $this->webroot.'admin/pages/deletecontact/'.$tuff['Contact']['id']?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                      <?php $i++; } ?>
                    </tbody>
				    </table>
				    </div> <!-- /My div Harpreet-->

              <div class="custom-pagination">
                  <nav aria-label="Page navigation example">
                      <?php echo $this->element('Admin/pagination')?>
                  </nav>
              </div>
            </div> 
          <!--<div class="tab-pane fade" id="content">-->
          <!--    <?php echo $this->Html->url; ?>-->
          <!--  <form action="<?php echo HTTP_ROOT.'Users/contactaddress'?>" method="post">-->
          <!--      <textarea rows="20" style="margin-bottom: 2%;" class="form-control" name="content" placeholder="Content"><?php echo $data['address']['Content']['content'];?></textarea>-->
          <!--      <label>Phone Number</label>-->
          <!--      <input type="text" class="form-control" name="fax" value="<?php echo $data['fax']['Content']['content'];?>" placeholder="Phone number"><br>-->
          <!--      <label>Email</label>-->
          <!--      <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $data['email']['Content']['content'];?>"><br>-->
          <!--      <label>Find Us (Address)</label>-->
          <!--      <input type="textarea" class="form-control" name="enquiry" placeholder="Address" value="<?php echo $data['enquiry']['Content']['content'];?>">-->
          <!--      <button class="btn btn-primary" style="margin-top: 2%;    margin-bottom: 1%;">Save</button>-->
          <!--  </form>-->
          <!--</div>  -->
        </div>
      </div>
    </div>
    <!-- END Stats --> 
     </div>
        </div>
           </div>
              </div>
              
    

  