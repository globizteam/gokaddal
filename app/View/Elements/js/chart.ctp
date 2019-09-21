<?php $products = $elementData;
$chart_data = [];
foreach($products as $product){
	$chart_data[] = [
		'period' => $product['Product']['monthn'],
		'TotalAds' => $product['Product']['total_ads'],
	];
}

$chart_data_json = addslashes(json_encode($chart_data));
 ?>
<script>
	var products =JSON.parse("<?php echo $chart_data_json; ?>");
	
	jQuery(document).ready(function(){
		Morris.Area({
			element: 'extra-area-chart',
			data: products,
			xkey: 'period',
			ykeys: ['TotalAds'],
			labels: ['Total Ads'],
			pointSize: 3,
			fillOpacity: 0,
			pointStrokeColors:['#006DF0'],
			behaveLikeLine: true,
			gridLineColor: '#e0e0e0',
			lineWidth: 1,
			hideHover: 'auto',
			lineColors: ['#006DF0'],
			resize: true
		});
});
</script>