<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>GOKADDAL | ADMIN</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>/img/logo/logo_icon_cropped.jpg" >
        <script src="<?php echo HTTP_ROOT ?>js/pages/base_pages_dashboard.js"></script>
   
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
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
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/meanmenu.min.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/main.css">
    <!-- educate icon CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/educate-custon-icon.css">
    <!-- morrisjs CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/style.css">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>/css/responsive.css">
    <!-- fontawesome
           ================================================-->
    <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- modernizr JS
        ============================================ -->
     <script src="<?php echo $this->webroot; ?>/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- Start Header menu area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="<?php echo $this->webroot; ?>admin"><img class="main-logo" src="<?php echo $this->webroot; ?>img/logo/gokaddal-logo.png" alt="" /></a>

            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
               <?php echo $this->element('Admin/admin_left_menu') ?>
            </div>
        </nav>
    </div>
    <!-- End Header menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="<?php echo $this->webroot; ?>admin">
                            <!-- <img class="main-logo" src="<?php echo $this->webroot; ?>/img/logo/logo.png" alt="" /> -->
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                    <i class="educate-icon educate-nav"></i>
                                                </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            <ul class="nav navbar-nav mai-top-nav">
                                                <li class="nav-item"><a href="<?php echo $this->webroot?>/admin/Users/dashboard" class="nav-link"><span class="educate-icon educate-home icon-wrap" style="margin-right: 5px;"></span>Dashboard</a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                               
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                            <img src="<?php echo $this->webroot.'app/webroot/'.$this->Session->read('Auth.User.profile_pic'); ?>" alt="img" />
                                                            <span class="admin-name">
                                                                <?php
                                                             echo $this->Session->read('Auth.User.name'); ?></span>
                                                            <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                        </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        
                                                        <li><a href="<?php echo $this->Html->url('/admin/users/profile'); ?>"><span class="edu-icon edu-user-rounded author-log-ic"></span>Update my Profile</a>
                                                        </li>
                                                        <li><a href="<?php echo $this->Html->url([
                                                            'controller'=>'users',
                                                            'action' => 'logout',
                                                            'admin' => true
                                                            ]); ?>"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                        </li>
                                                    </ul>
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
            
        </div>
        
        <div class="row">
            <div class="col-md-12 text-center">
                <?php echo $this->Session->flash(); ?>  
            </div>
        </div>
        <?php echo $this->fetch('content'); ?>
        
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <p>Globiz Technology Copyright INC. © <?php echo date('Y') ?>. All rights reserved. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

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
    <!-- counterup JS
        ============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/counterup/jquery.counterup.min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/counterup/waypoints.min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
        ============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
        ============================================ -->
    <!-- <script src="<?php echo $this->webroot; ?>/js/morrisjs/raphael-min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/morrisjs/morris.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/morrisjs/morris-active.js"></script> -->
    <!-- morrisjs JS
        ============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/sparkline/jquery.charts-sparkline.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/sparkline/sparkline-active.js"></script>
    <!-- calendar JS
        ============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/calendar/moment.min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/calendar/fullcalendar.min.js"></script>
    <script src="<?php echo $this->webroot; ?>/js/calendar/fullcalendar-active.js"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/plugins.js"></script>
    <!-- main JS
        ============================================ -->
    <script src="<?php echo $this->webroot; ?>/js/main.js"></script>
    <!-- tawk chat JS
        ============================================ -->
    <!-- <script src="<?php echo $this->webroot; ?>/js/tawk-chat.js"></script> -->
    <?php if(!empty($thirdparty_js)):
        foreach($thirdparty_js as $js_file):
     ?>
    <script src="<?php echo $js_file; ?>"></script>

 <?php endforeach;
 endif; ?>
 <script>
    $(document).ready(function($){
        $('.form-validate').validate();

        // fading out flash messages after 5 seconds
        // $('#flashMessage').delay(5000).fadeOut(400);
        // $('.message.error').css('backgroundColor', 'red');
        $('#sidebarCollapse').on('click', function() {
            // $('.main-logo').css('width','50px');
            // alert('window.location.href');
            $('img.main-logo').css('width','70px');
            $('img.main-logo').attr('src', '<?php echo $this->webroot; ?>/img/logo/logo_icon_cropped.jpg');
        })
    });
    </script>
    <?php if(isset($element)): ?>
    <?php echo $this->element( $element, [ 'elementData' => $elementData] ); ?>
    <?php endif;  ?>
</body>

</html>