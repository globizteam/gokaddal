<!DOCTYPE html>
<html lang="en">
<head>
	    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GoKaddal</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>/img/logo/logo_icon_cropped.jpg" >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700,800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>gokaddal/owl-carousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>gokaddal/css/bootstrap.min.css" >
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>gokaddal/css/style.css">
    </head>

</head>
<body style="overflow-x: hidden;">
		<div class="page_wrapper">	
            <?php
                 echo $this->element('Frontend/header');
            ?>
           
            <?php echo $this->fetch('content'); ?>

          
            <?php
                 echo $this->element('Frontend/footer');
            ?>
      
            <?php echo $this->element('Frontend/modal');?>

		</div> <!-- .page_wrapper -->
</body>
</html>