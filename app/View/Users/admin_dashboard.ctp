 
  <?php
 
$dataPoints = array(
	array("y" => 25, "label" => "Sunday"),
	array("y" => 15, "label" => "Monday"),
	array("y" => 25, "label" => "Tuesday"),
	array("y" => 5, "label" => "Wednesday"),
	array("y" => 10, "label" => "Thursday"),
	array("y" => 0, "label" => "Friday"),
	array("y" => 20, "label" => "Saturday")
);
 
?>
 <!-- Style for chart -->
 <style>
     .block-content.block-content-full {
    padding-bottom: 20px;
}

.block-content {
    margin: 0 auto;
    padding: 20px 20px 1px;
    max-width: 100%;
    overflow-x: visible;
    -webkit-transition: opacity 0.2s ease-out;
    transition: opacity 0.2s ease-out;
}
.bg-gray-lighter {
    background-color: #f9f9f9;
}
 </style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
     <script src="<?php echo HTTP_ROOT ?>js/pages/base_pages_dashboard.js"></script>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Weekly Report"
	},
	axisY: {
		title: "Data"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="<?php $this->webroot; ?>/admin/Users/dashboard"><img class="main-logo" src="/img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
<div class="product-status mg-b-15">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-status-wrap drp-lst">
            <h4>Dashboard</h4>
                           <!-- Stats -->
    <div class="content bg-white border-b">
      <div class="row items-push text-uppercase">
        <div class="col-xs-6 col-sm-4">
          <div class="font-w700 text-gray-darker animated fadeIn">Total Users</div>
          <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
          <a class="h2 font-w300 text-primary animated flipInX" href="userList"><?php echo $user; ?></a> </div>
        <div class="col-xs-6 col-sm-4">
          <div class="font-w700 text-gray-darker animated fadeIn">Total Categories</div>
          <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
          <a class="h2 font-w300 text-primary animated flipInX" href="<?php echo $this->webroot; ?>admin/products/categoryList"><?php echo $catcount; ?></a> </div>
        <div class="col-xs-6 col-sm-4">
          <div class="font-w700 text-gray-darker animated fadeIn">Provider Solutions</div>
          <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
          <a class="h2 font-w300 text-primary animated flipInX" href="<?php echo $this->webroot; ?>admin/provider_service/serviceList"><?php echo $servicecount; ?></a> </div>
        
      </div>
    </div>
    <!-- END Stats --> 
    
    <!-- Page Content -->
<!--     <div class="content">
      <div class="row">
        <div class="col-lg-8">  -->
          <!-- Main Dashboard Chart -->
<!--           <div class="block">
            <div class="block-content block-content-full bg-gray-lighter text-center"> 
              <div id="chartContainer" style="height: 370px; width: 100%;"></div><script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            </div>
            </div> -->
          <!-- END Main Dashboard Chart --> 
<!--         </div>
      </div>
    </div> -->
          <!-- END News --> 

                </div>
            </div>
        </div>
        </div>
        </div>

  