
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
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="<?php echo $this->webroot?>admin/Users/dashboard">Dashboard</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Designation List</span>
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
                            <h4>Designation List</h4>
                            <div class="add-product">
                                <a href="<?php echo $this->Html->url('/admin/Users/addDesignation'); ?>">Add Designation</a>
                            </div>
                            <div class="asset-inner">
                                <table>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php   if(!empty($users)){
                                                $i = 1;
                                                foreach($users as $user){
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo @$user['Designation']['name'];?></td>
                                        <td><?php echo empty($user['Designation']['status'])?'Inactive':'Active'; ?><a href="<?php echo $this->webroot?>admin/Users/updateStatus/Designation/<?php echo $user['Designation']['id'];?>" data-toggle="tooltip" title="Change status" class=" pd-setting-ed">
                                                <i class="fa fa-toggle-<?php echo $user['Designation']['status'] == 0 ? "off" : "on";?>" aria-hidden="true"></i>
                                                </a></td>
                                        <td>
                                            <a href="<?php echo $this->webroot?>admin/Users/addDesignation/<?php echo $user['Designation']['id'];?>" data-toggle="tooltip" title="Edit" class=" pd-setting-ed"><i class=" fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            
                                            <a href="<?php echo $this->webroot?>admin/Users/delete/Designation/<?php echo $user['Designation']['id'];?>" onclick="return confirm('Are you sure, You want to delete this designation?')" data-toggle="tooltip" title="Delete" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php       $i++;
                                               } 
                                            }else{
                                    ?>
                                        <tr>
                                            <td>No Designation Found</td>
                                        </tr>
                                    <?php }?>
                                    
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
    
