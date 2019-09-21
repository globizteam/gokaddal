   <style>
  .pagination > li > span {
    float: left;
  }
  table,th,td
  {
    text-align: center;
  }
  </style>

  <!-- Main Container -->
  <main id="main-container"> 
    
    <!-- Stats -->
    <div class="product-status mg-b-15">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-status-wrap drp-lst">
            <h4>Plans</h4>
            <div class="add-product">
                                <a href="<?php echo $this->Html->url('/admin/users/plans'); ?>">Add Plan</a>
                            </div>
            <div class="asset-inner">
	           <table class="dataTable table-hover">
               <thead>
                 <th>SNo.</th>
                 <th>Name</th>
                 <th>Price</th>
                 <th>Days</th>
                 <th>Actions</th>
               </thead>
               <tbody>
                 <?php 
                 //print_r($specials);
                 $i=1; foreach($specials as $special){
                 
                 ?>
                 <tr>
                   <td><?php echo $i;?></td>
                   <td><?php echo $special['plans']['name'];?></td>
                   <td><?php echo $special['plans']['price'];?></td>
                   <td><?php echo $special['plans']['max_days'];?></td>
                   <td><a href="<?php echo $this->webroot.'admin/users/plans/' . base64_encode($special['plans']['id']);?>"><i class=" fa fa-pencil-square-o"></i></a>
                   <a title="Delete" onclick="if(!confirm('Are you sure, you want to delete this Content?')){return false;}" href="<?php echo $this->webroot?>/Users/deleteAll/plans/<?php echo base64_encode($special['plans']['id']); ?>"><i class="fa fa-trash-o" aria-hidden="true" ></i></a>
                  
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
