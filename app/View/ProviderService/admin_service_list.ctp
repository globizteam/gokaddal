
<?php
// print_r($joindata);die();
?>
<style>
select {
  font-family: 'FontAwesome', 'sans-serif';
} 
td i{
        font-size: 24px !important;
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
                                            <li><a href="<?php echo $this->webroot?>admin/Users/dashboard">Dashboard</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Provider Solution List</span>
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
                            <h4>Solution List</h4>
                            <div class="add-product">
                                <a href="<?php echo $this->Html->url(['controller' => 'ProviderService', 'action' => 'addService' , 'admin' => true]) ?>">Add Solution</a>
                            </div>
                            <div class="asset-inner">
                                <table>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Company</th>
                                        <th>Tag</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php   if(!empty($services)){
                                                $i = 1;
                                                foreach($services as $data){
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td>
                                            <?php if(!empty($data['ProviderService']['image'])): ?>
                                            
                                            <img src="<?php echo $this->webroot; ?>app/webroot/<?php echo $data['ProviderService']['image']; ?>" width="50px">
                                            <?php else: ?>
                                            Not Uploaded
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo @$data['ProviderService']['title'];?></td>
                                        <td><?php echo @$data['ProviderService']['description'];?></td>
                                        <td><?php echo @$data['Category']['title'];?></td>

                                        <td>
                                            <?php
                                                echo (isset($data['User']['company_name']) ) ? $data['User']['company_name'] : 'Name not available';

                                             ?>
                                             
                                        </td>

                                        <td>
                                            <?php
                                                echo (isset($data['Tag']['name']) ) ? $data['Tag']['name'] : 'N/A';

                                             ?>
                                        </td>

                                        <td> 
                                            <a href="<?php echo $this->webroot?>admin/ProviderService/addService/<?php echo $data['ProviderService']['id'];?>" data-toggle="tooltip" title="Edit" class=" pd-setting-ed"><i class=" fa fa-pencil-square-o" aria-hidden="true"></i></a>
<!--                                             <a href="<?php echo $this->Html->url(['controller'=>'ProviderService','action'=>'sub_ProviderService_list', 'admin' => true, $data['ProviderService']['id']]); ?>" title=" Subcategory list" ><i class="fa fa-th-list"></i></a> -->
                                            <a href="<?php echo $this->webroot?>admin/ProviderService/deleteCategory/ProviderService/<?php echo $data['ProviderService']['id'];?>?catName=<?php echo $data['ProviderService']['image'];?>" onclick="return confirm('Are you sure, You want to delete this ProviderService?')" data-toggle="tooltip" title="Delete" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php       $i++;
                                               } 
                                            }else{
                                    ?>
                                        <tr>
                                            <td>No Provider Solution Found</td>
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
    
