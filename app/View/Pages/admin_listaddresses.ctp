<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="logo-pro">
                <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
            </div>
        </div>
    </div>
</div>

<div class="header-advance-area">
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list single-page-breadcome">
                        <div class="row">
<!--                             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="breadcome-heading">
                                    <form role="search" method="get" class="sr-input-func">
                                        <input value="<?php echo @$_GET['search_value']?>" type="text" placeholder="Search..." class="search-int form-control" name="search_value" required>
                                        <a onclick="$('form').submit();" style="cursor:pointer"><i class="fa fa-search"></i></a>
                                    </form>
                                </div>
                            </div> -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="breadcome-menu">
                                    <li><a href="<?php echo $this->webroot?>admin/Users/dashboard">Dashboard</a> <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Office Address</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="product-status mg-b-15">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-status-wrap drp-lst">
            <h4>Office Addresses</h4>
            <div class="add-product">
                <a href="<?php echo $this->webroot.'admin/pages/addaddresses' ; ?>">Add Address</a>
            </div>
            <div class="asset-inner">
                <table>
                    <tr>
                        <th>No</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Facebook</th>
                        <th>Twitter</th>
                        <th>Instagram</th>
                        <th>Linkedin</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    <?php   
                    if(!empty($getaddresses))
                    {
                        foreach($getaddresses as $key => $address)
                        {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $key + 1;?>
                                </td>
                                
                                <td> 
                                    <?php echo $address['OfficeAddress']['address']; ?>
                                </td>
                                
                                <td>
                                    <?php echo $address['OfficeAddress']['email']; ?>
                                </td>
                                
                                <td> 
                                    <?php echo $address['OfficeAddress']['phone']; ?>
                                </td>
                                
                                <td> 
                                    <?php echo $address['OfficeAddress']['facebook']; ?>
                                </td>
                                
                                <td> 
                                    <?php echo $address['OfficeAddress']['twitter']; ?>
                                </td>
                                
                                <td> 
                                    <?php echo $address['OfficeAddress']['instagram']; ?>
                                </td>
                                
                                <td> 
                                    <?php echo $address['OfficeAddress']['linkedin']; ?>
                                </td>
                                <td>
                                    <?php 
                                        if ($address['OfficeAddress']['status'] == 1) 
                                            echo "ON";
                                        else
                                            echo "OFF";

                                    ?>
                                </td>
                                

                                <td>

                                   <a title="Change Status" href="<?php echo $this->webroot.'admin/pages/statusaddresses/'.$address['OfficeAddress']['id'];?>"><i class="fa fa-flag" aria-hidden="true"></i></a>
                                    
                                    <a href="<?php echo $this->webroot.'admin/pages/addaddresses/'.$address['OfficeAddress']['id'];?>" data-toggle="tooltip" title="Edit" class=" pd-setting-ed"><i class=" fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    
                                    <a href="<?php echo $this->webroot.'admin/pages/deleteaddresses/'.$address['OfficeAddress']['id'];?>" onclick="return confirm('Are you sure, You want to delete this address?')" data-toggle="tooltip" title="Delete" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                    <?php       
                    }
                        }else{
                    ?>
                    <tr>
                        <td>No Addresses Found</td>
                    </tr>
                    <?php   }   ?>
                    
                </table>
            </div>
            <div class="custom-pagination">
                <nav aria-label="Page navigation example">
                    <!-- <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul> -->
                    <?php echo $this->element('Admin/pagination')?>
                </nav>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title userName"></h4>
            </div>
            <div class="modal-body">
                <p>Email: <span class="email-text"></span> </p>
                <p>Country: <span class="country-text"></span> </p>
                <p>State: <span class="state-text"></span> </p>
                <p>Contact: <span class="contact-text"></span> </p>
                <p>Address: <span class="address-text"></span> </p>
                <p>UserType: <span class="usertype-text"></span> </p>
                <!-- <p>Organization: <span class="organization-text"></span> </p> -->
                <!-- <p>Designation: <span class="designation-text"></span> </p> -->
                <!-- <p>Department: <span class="department-text"></span> </p> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>