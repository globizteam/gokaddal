<style type="text/css">
    .pagination>li:first-child>a, .pagination>li:first-child>span,.pagination>li>a, .pagination>li>span,.pagination>li:last-child>a, .pagination>li:last-child>span{
            background: grey;
    color: #fff;
    }
</style>
<?php $modules = $this->Module->getModules( $this->Session->read('Auth.User.id') );$type=$this->Session->read('Auth.User.type');  ?>
<nav class="sidebar-nav left-sidebar-menu-pro">
    <ul class="metismenu" id="menu1">
        <li >
            <a class="" href="<?php echo $this->webroot; ?>admin/users/dashboard" title="Dashboard">
                <span class="educate-icon educate-home icon-wrap"></span>
                <span class="mini-click-non">Dashboard</span>
            </a>
            
        </li>
        <li class="active">
            <a class="has-arrow" href="" aria-expanded="false" title="Manage All"><i class="fa fa-list-alt"></i> <span class="mini-click-non">Manage</span></a>
            <ul class="submenu-angle" aria-expanded="false">
                <?php if( isset($modules['users'])  || $type == 0 ): ?>
                    <li><a title="" href="<?php echo $this->Html->url('/admin/users/userList'); ?>"><span class="educate-icon educate-professor icon-wrap" ></span><span class="mini-sub-pro">Users</span></a></li>
                <?php endif; ?>

<!--                 <?php if(isset($modules['news'])  || $type == 0 ): ?>
                <li><a title="" href="<?php echo $this->Html->url('/admin/news/manage_news'); ?>"><i class="icon-wrap fa fa-newspaper-o"></i><span class="mini-sub-pro">Post</span></a></li>
                <?php endif; ?>
 -->
                <?php if(isset($modules['category'])  || $type == 0): ?>
                <li><a title="" href="<?php echo $this->Html->url('/admin/Products/categoryList'); ?>"><i class="icon-wrap fa fa-list-alt"></i><span class="mini-sub-pro">Category</span></a></li>
                <?php endif; ?>
                <!--<?php if(isset($modules['organization'])  || $type == 0 ): ?>-->

                <!--<li><a title="" href="<?php echo $this->Html->url('/admin/Users/organisationList'); ?>"><i class="icon-wrap fa fa-institution"></i><span class="mini-sub-pro">Organization</span></a></li>-->
                <!--<?php endif; ?>-->

                <?php //if(isset($modules['department'])  || $type == 0): ?>
                <li><a title="" href="<?php echo $this->Html->url('/admin/ProviderService/serviceList'); ?>"><i class="icon-wrap fa fa-industry"></i><span class="mini-sub-pro">Solutions</span></a></li>
                <?php //endif; ?>

<!--                 <?php if(isset($modules['planlist'])  || $type == 0): ?>
                <li><a title="" href="<?php echo $this->Html->url('/admin/Users/planlist'); ?>"><i class="icon-wrap fa fa-users"></i><span class="mini-sub-pro">Plans</span></a></li>
                <?php endif; ?> -->

                <!--<?php if(isset($modules['country'])  || $type == 0): ?>-->
                <!--<li><a title="" href="<?php echo $this->Html->url('/admin/Users/countryList'); ?>"><i class="icon-wrap fa fa-flag"></i><span class="mini-sub-pro">Country</span></a></li>-->
                <!--<?php endif; ?>-->
            </ul>
        </li>
        
        <?php if(isset($modules['cms']) || $type == 0): ?>

            <li id="removable">
                <a class="has-arrow" href="#" aria-expanded="false"><span class="educate-icon educate-pages icon-wrap" title="CMS"></span> <span class="mini-click-non">CMS</span></a>
                <ul class="submenu-angle" aria-expanded="false">
                    <li>
                        <a title="Login" href="<?php echo $this->Html->url(['controller'=>'pages', 'action'=>'about_us', 'admin'=>true]) ?>">
                            <span class="mini-sub-pro">About</span>
                        </a>
                    </li>
                    
                    <li>
                        <a title="Register" href="<?php echo $this->Html->url(['controller'=>'pages', 'action'=>'faq', 'admin'=>true]) ?>">
                            <span class="mini-sub-pro">Faqs</span>
                        </a>
                    </li>
                    
                    <li>
                        <a title="Lock" href="<?php echo $this->Html->url(['controller'=>'pages', 'action'=>'privacy_policy', 'admin'=>true]) ?>">
                            <span class="mini-sub-pro">Privacy Policy</span>
                        </a>
                    </li>
                    
                    <li>
                        <a title="Lock" href="<?php echo $this->Html->url(['controller'=>'pages', 'action'=>'terms_conditions', 'admin'=>true]) ?>">
                            <span class="mini-sub-pro">Terms & Conditions</span>
                        </a>
                    </li>
                    
                    <li>
                        <a title="Lock" href="<?php echo $this->Html->url(['controller'=>'pages', 'action'=>'contactus', 'admin'=>true]) ?>">
                            <span class="mini-sub-pro">Contact Us</span>
                        </a>
                    </li>

                    <li>
                        <a title="Lock" href="<?php echo $this->Html->url(['controller'=>'pages', 'action'=>'listaddresses', 'admin'=>true]) ?>">
                            <span class="mini-sub-pro">Office Addresses</span>
                        </a>
                    </li>

                    <li>
                        <a title="Lock" href="<?php echo $this->Html->url(['controller'=>'pages', 'action'=>'newsletterlist', 'admin'=>true]) ?>">
                            <span class="mini-sub-pro">Newsletter</span>
                        </a>
                    </li>

<!--                     <li>
                        <a title="Lock" href="<?php echo $this->Html->url(['controller'=>'pages', 'action'=>'listblog', 'admin'=>true]) ?>">
                            <span class="mini-sub-pro">Blog</span>
                        </a>
                    </li>
 -->
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</nav>