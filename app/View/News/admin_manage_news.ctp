
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
                                            <li><span class="bread-blod">POST</span>
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
                            <h4>Post List</h4>
                            <div class="add-product">
                                <a href="<?php echo $this->Html->url('/admin/news/add_news'); ?>">Add Post</a>
                            </div>
                            <div class="asset-inner">
                                <table>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                    <?php   if(!empty($news)){
                                                $i = 1;
                                                foreach($news as $data){
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td>
                                        <?php if($data['New']['type'] != 'pdf'){?>
                                            <?php
                                                $img_src = ($data['New']['type'] == 'video')?($this->webroot.'img/video.png'):$this->webroot.'img/news/'.$data['New']['file']; ?>
                                            <img src="<?php echo $img_src; ?>" width="50px">
                                        <?php }else{?>
                                            <i class="fa fa-file-pdf-o" style="color:red;font-size: 30px;"></i>
                                        <?php }?>
                                        </td>
                                        <td><?php echo @$data['New']['title'];?></td>
                                        <td> 
                                        <p id="pp1-<?php  echo @$data['New']['id']?>"><?php echo substr(@$data['New']['description'],0,30);?><br><a href="javascript:void(0);" onclick="$('#pp-<?php  echo @$data['New']['id']?>').show();$('#pp1-<?php  echo @$data['New']['id']?>').hide();">read more..</a></p>
                                        <p style="display:none;" id="pp-<?php  echo @$data['New']['id']?>"><?php echo wordwrap(@$data['New']['description'],100,'<br/>'); ?> </p></td>
                                        
                                        <td>
                                            <a href="<?php echo $this->webroot?>admin/news/add_news/<?php echo $data['New']['id'];?>" data-toggle="tooltip" title="Edit" class=" pd-setting-ed"><i class=" fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                            <a href="<?php echo $this->webroot?>admin/news/addComment/<?php echo $data['New']['id'];?>" data-toggle="tooltip" title="Add Comment" class=" pd-setting-ed"><i class=" fa fa-comments-o" aria-hidden="true"></i></a>
                                            
                                            <a href="<?php echo $this->webroot?>admin/news/deleteNew/New/<?php echo $data['New']['id'];?>?catName=<?php echo $data['New']['file'];?>" onclick="return confirm('Are you sure, You want to delete this news?')" data-toggle="tooltip" title="Delete" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php       $i++;
                                               } 
                                            }else{
                                    ?>
                                        <tr>
                                            <td>No News Found</td>
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
    
