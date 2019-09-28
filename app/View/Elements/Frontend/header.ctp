
<!-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GoKaddal</title>
        <link rel="icon" href="<?php echo HTTP_ROOT; ?>gokaddal/images/logo.png" type="image/png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700,800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo HTTP_ROOT; ?>gokaddal/owl-carousel/assets/owl.carousel.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo HTTP_ROOT; ?>gokaddal/css/style.css">
    </head>

<body> -->
    <div class="top_header">
        <div class="topbar">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col_xs_top_logo_center">

                            
                            <a href="<?php echo $this->webroot ;?>home/index"><img src="<?php echo $this->webroot; ?>img/logo/gokaddal-logo.png" alt="Logo" class="img-responsive"></a>
                            <!-- <a href="index.php" style="border: 2px solid #fff; color: #fff; display: inline-block; padding: 8px 30px; ">Logo Here</a> -->
                        </div>
                        <div class="col-md-9 col-sm-12 mobileNav">
                    
                            <nav class="navbar navbar-default top_navbar">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my_navbar" aria-expanded="false" >
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="my_navbar">
                                    <ul class="nav navbar-nav navbar-right top_main_menu">
                                        <li class="dropdown">
                                            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <i class="fas fa-angle-down"></i></a> -->
                                            <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Categories <i class="fas fa-angle-down"></i></a>
                                            <ul class="dropdown-menu">

                                                <!-- if logged in as seeker, will see all the categories -->
                                                <?php 
                                                    if( AuthComponent::user('type') != 1 ) 
                                                    {
                                                        foreach ($categories as $key => $category) 
                                                        { 

                                                ?>
                                                        <li>
                                                            <!-- <a href="<?php echo HTTP_ROOT; ?>"solution_seeker.php> -->
                                                            <a href="<?php echo $this->webroot.'home/provider_all_solutions?id='.$key.'&showcategories=1'; ?>">
                                                                <?php echo $category; ?>
                                                            </a>
                                                        </li>
                                                <?php 
                                                        } 
                                                    }
                                                ?>

                                                <?php 
                                                    if( AuthComponent::user('type') == 1 ) 
                                                    {
                                                        foreach ($cat_names as $key => $category) 
                                                        { 

                                                ?>
                                                        <li>
                                                            <!-- <a href="<?php echo HTTP_ROOT; ?>"solution_seeker.php> -->
                                                            <a href="<?php echo $this->webroot.'home/seeker_selected_category?id='. $category['Category']['id'].'&showcategories=1'; ?>">
                                                                <?php echo $category['Category']['title']; ?>
                                                            </a>
                                                        </li>
                                                <?php 
                                                        } 
                                                    }
                                                ?>

<!--                                                 <li><a href="solution_seeker.php">Public Services</a></li>
                                                <li><a href="solution_seeker.php">Manufacturing</a></li>
                                                <li><a href="solution_seeker.php">E-Governance</a></li>
                                                <li><a href="solution_seeker.php">Oil& Gas</a></li>
                                                <li><a href="solution_seeker.php">Servillence & Security</a></li>
                                                <li><a href="solution_seeker.php">Real Estate</a></li>
                                                <li><a href="solution_seeker.php">Transportation</a></li>
                                                <li><a href="solution_seeker.php">Agriculture</a></li>
                                                <li><a href="solution_seeker.php">Media & Entertainment</a></li>
                                                <li><a href="solution_seeker.php">Retail</a></li>
                                                <li><a href="solution_seeker.php">Banking & Finance</a></li>
                                                <li><a href="solution_seeker.php">Utilities</a></li>
                                                <li><a href="solution_seeker.php">Dairy</a></li> -->
                                            </ul>
                                        </li>
                                        <?php if( AuthComponent::user('type') == 2 ) { ?>
                                            <li>
                                                <a href="<?php echo $this->webroot ;?>home/provider_list">Solution Provider</a>
                                            </li>
                                        <?php }elseif( AuthComponent::user('type') == 1 ) {?>
                                            <li>
                                                <a href="<?php echo $this->webroot ;?>home/seeker_list">Solution Seeker</a>
                                            </li>
                                        <?php }else {?>
                                            <li>
                                                <a href="<?php echo $this->webroot ;?>home/provider_list">Solution Provider</a>
                                            </li>
                                            <li>
                                                <!-- <a href="<?php echo $this->webroot ;?>home/seeker_list">Solution Seeker</a> -->
                                                <a href="<?php echo $this->webroot ;?>home/seeker_list">Solution Seeker</a>
                                            </li>
                                        <?php } ?>
                                        
                                        <li><a href="javascript:;">Blog</a></li>
                                        <!-- <li class="top_right_menu"><a href="login.php"><i class="fas fa-user m_r_3"></i> Login / Signup</a></li> -->

                                        <li class="top_right_menu">
                                        <?php
                                            if( !AuthComponent::user('id') ) {
                                                echo $this->Html->link(
                                                        $this->Html->tag('i', '', array('class' => 'fas fa-user m_r_3')) .'Login / Signup',
                                                        array(
                                                            'controller' => 'home',
                                                            'action' => 'login',
                                                            'full_base' => true
                                                        ),
                                                        array('escape' => false)
                                                );

                                            }else {

                                                echo $this->Html->link(
                                                        $this->Html->tag('i', '', array('class' => 'fas fa-user m_r_3')) .'Logout',
                                                        array(
                                                            'controller' => 'home',
                                                            'action' => 'logout',
                                                            'full_base' => true,
                                                        ),
                                                        array('escape' => false)
                                                );
                                            ?>
                                                <ul class="dropdown-menu myaccount_dropdown">
                                                    <li><a href="<?php echo $this->webroot.'home/myaccount';
                                                     ?>">My Account</a></li>
                                                </ul>
                                           <?php } ?>

                                        

                                    </li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>