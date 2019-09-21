
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
                                        <div class="breadcome-heading">
                                            <form role="search" method="get" class="sr-input-func">
                                                <input value="<?php echo @$_GET['search_value']?>" type="text" placeholder="Search..." class="search-int form-control" name="search_value" required>
                                                <a onclick="$('form').submit();" style="cursor:pointer"><i class="fa fa-search"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="<?php echo $this->webroot?>admin/Users/dashboard">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">ProductTypeList</span>
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
                            <h4>Product Type List</h4>
                            <!-- <div class="add-product">
                                <a href="add-department.html">Add User</a>
                            </div> -->
                            <div class="asset-inner">
                                <table>
                                    <tr>
                                        <th>No</th>
                                        <!-- <th>Image</th> -->
                                        <th>Title</th>
                                        <th>Description</th>
                                        
                                        <th>Setting</th>
                                    </tr>
                                    <?php   if(!empty($categories)){
                                                $i = 1;
                                                foreach($categories as $data){
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <!-- td>
                                            <img src="<?php //echo $this->webroot.'img/category/'.$data['ProductType']['image'];?>" width="50px"></td-->
                                        <td><?php echo @$data['ProductType']['title'];?></td>
                                        <td><?php echo @$data['ProductType']['description'];?></td>
                                        
                                        <td>
                                            <a href="<?php echo $this->webroot?>admin/Products/addProductType/<?php echo $data['ProductType']['id'];?>" data-toggle="tooltip" title="Edit" class=" pd-setting-ed"><i class=" fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                           
                                            <a href="<?php echo $this->webroot?>admin/Products/deleteCategory/ProductType/<?php echo $data['ProductType']['id'];?>?catName=<?php echo $data['ProductType']['image'];?>" onclick="return confirm('Are you sure, You want to delete this data.')" data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php       $i++;
                                               } 
                                            }else{
                                    ?>
                                        <tr>
                                            <td>No Product Type Found</td>
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
    
