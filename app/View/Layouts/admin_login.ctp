<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>/img/logo/logo_icon_cropped.jpg">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/owl.theme.css">
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/normalize.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/main.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/morris<?php echo $this->webroot; ?>/js/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/metisMenu/metisMenu.min.css"> -->
    <!-- <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/metisMenu/metisMenu-vertical.css"> -->
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/calendar/fullcalendar.print.min.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/form/all-type-forms.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/vendor/modernizr-2.8.3.min.js"></script>
    <style type="text/css">
        div#flashMessage{
            background: red;
        }
    </style>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login">
				<!-- <h3>PLEASE LOGIN TO APP</h3> -->
				<p> <img src="<?php echo $this->webroot; ?>img/logo/gokaddal-logo.png" alt=""> </p>
			</div>
            <?php echo $this->Flash->render(); ?>

			<div class="content-error login-form">
				<div class="hpanel">
                    <div class="panel-body">
                        <form action="<?php echo $this->Html->url([
                                'controller' => 'users',
                                'action' => 'login',
                                'admin' => true
                            ]); ?>" id="loginForm" method="POST">
                            <div class="form-group">
                                <label class="control-label" for="username">Username/Email</label>
                                <input type="text" placeholder="" title="Please enter you username" required="" value="" name="data[User][email]" id="username" class="form-control">
                             
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="" required="" value="" name="data[User][password]" id="password" class="form-control">
                             
                            </div>
                            <!-- <div class="checkbox login-checkbox">
                                <label>
										<input type="checkbox" class="i-checks"> Remember me </label>
                                <p class="help-block small">(if this is a private computer)</p>
                            </div> -->
                            <button type="submit" class="btn btn-success btn-block loginbtn">Login</button>
                            <span class="btn-block forgot-password text-center" href="#" style="cursor:pointer">Forgot Password ?</span>
                        </form>
                    </div>
                </div>
			</div>
            <div class="content-error forgot-password-form">
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="<?php echo $this->Html->url([
                                'controller' => 'users',
                                'action' => 'forgotPassword',
                                'admin' => true
                            ]); ?>" id="loginForm" method="POST">
                            <div class="form-group">
                                <label class="control-label" for="username">Username/Email</label>
                                <input type="text" placeholder="" title="Please enter you username" required="" value="" name="data[User][email]" id="username" class="form-control">
                             
                            </div>
                            <!-- <div class="checkbox login-checkbox">
                                <label>
                                        <input type="checkbox" class="i-checks"> Remember me </label>
                                <p class="help-block small">(if this is a private computer)</p>
                            </div> -->
                            <button type="submit" class="btn btn-success btn-block loginbtn">Submit</button>
                            <!-- <a class="btn btn-default btn-block login" href="#">login</a> -->
                            <span class="btn-block login text-center" href="#" style="cursor:pointer">login ?</span>
                        </form>
                    </div>
                </div>
            </div>
			<div class="text-center login-footer">
				<p>Globiz Technology INC. Copyright © <?php echo date('Y') ?> .All rights reserved. </p>
			</div>
		</div>   
    </div>
    <!-- jquery
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/metisMenu/metisMenu-active.js"></script>
    <!-- tab JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/tab.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/icheck/icheck.min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/icheck/icheck-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/main.js"></script>
    <!-- tawk chat JS
		============================================ -->
    <!-- <script src="<?php echo $this->webroot; ?>/js/tawk-chat.js"></script> -->
    <script>
        $('.forgot-password').click(function(){
            $('.forgot-password-form').show();
            $('.login-form').hide();
        });
        $('.login').click(function(){
            $('.forgot-password-form').hide();
            $('.login-form').show();
        });
    </script>
</body>

</html>