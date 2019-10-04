    <?php 
        $directoryURI = $_SERVER['REQUEST_URI'];
        $activePage = basename($directoryURI);   
        // echo $activePage;

    ?>

<div class="row my_account_sidebar_container my_acc_match_height p_tb_80 col_sm_p_tb_60">
    <div class="col-lg-offset-3 col-lg-9 col-md-12">
        <h4 class="txt_black txt_w_700">
            <?php echo AuthComponent::user('name'); ?>
        </h4>
        <hr class="dark_hr">
        <ul class="m_t_15 solution_sidebar listing_page_sidebar my_account_sidebar list-unstyled p_l_0 m_b_0">
            <li class= "<?= ($activePage == 'myaccount') ? 'active-sidebar':''; ?>" >
                <a href="<?php echo $this->webroot.'home/myaccount'; ?>">Account Details</a>
            </li>
            <li class= "<?= ($activePage == 'change_password') ? 'active-sidebar':''; ?>" >
                <a href="<?php echo $this->webroot.'home/change_password'; ?>">Change Password</a>
            </li>

            <!-- if seeker logged in -->
            <?php if(AuthComponent::user('type') == 2) : ?>
            <li class= "<?= ($activePage == 'seeker_notification') ? 'active-sidebar':''; ?>" >
                <a href="<?php echo $this->webroot.'home/seeker_notification'; ?>">
                    <?php 
                        if (!empty($quote_count)) 
                                echo $quote_count; 

                    ?>  Notification
                </a>
            </li>
            <?php endif; ?>    
            
            <!-- if provider logged in -->
            <?php if(AuthComponent::user('type') == 1) : ?>
            <li class= "<?= ($activePage == 'provider_notification') ? 'active-sidebar':''; ?>" >
                <a href="<?php echo $this->webroot.'home/provider_notification'; ?>">
                    <?php 
                        if (!empty($requirement_count)) 
                                echo $requirement_count; 

                    ?>  Notification
                </a>
            </li>
            <?php endif; ?>    
            

            <hr class="hidden-sm hidden-xs">
            <?php if(AuthComponent::user('type') == 1) : ?>
                <li class="col_sm_m_t_20  <?= ($activePage == 'my_solution') ? 'active-sidebar':''; ?>" >
                    <a href="<?php echo $this->webroot.'home/my_solution'; ?>">My Solutions</a>
                </li>
                <li class="col_sm_m_t_20  <?= ($activePage == 'my_proposal') ? 'active-sidebar':''; ?>">
                    <a href="<?php echo $this->webroot.'home/my_proposal'; ?>">My Proposals</a>
                </li>
                <li class="col_sm_m_t_20  <?= ($activePage == 'post_solution') ? 'active-sidebar':''; ?>">
                    <a href="<?php echo $this->webroot.'home/post_solution'; ?>">Post Solution</a>
                </li>
            <?php endif; ?>    
            <!-- <li><a href="#">My Requests</a></li> -->
            <?php if(AuthComponent::user('type') == 2) : ?>
                <li class="<?= ($activePage == 'list_favourite_solution') ? 'active-sidebar':''; ?>">
                    <a href="<?php echo $this->webroot.'home/list_favourite_solution'; ?>">
                        My Favourites
                    </a>
                </li>
                 <!-- <li><a href="<?php //echo $this->webroot.'home/show_requirement'; ?>">My Requirements</a></li> -->
                <li class="<?= ($activePage == 'my_requirement') ? 'active-sidebar':''; ?>">
                    <a href="<?php echo $this->webroot.'home/my_requirement'; ?>">
                        My Requirements
                    </a>
                </li>
                <li class="<?= ($activePage == 'post_requirement') ? 'active-sidebar':''; ?>">
                    <a href="<?php echo $this->webroot.'home/post_requirement'; ?>">
                        Post Requirement
                    </a>
                </li>
            <?php endif; ?>
        </ul>
        <div class="text-left orange_btns m_t_30">
            <a href="<?php echo $this->webroot.'home/logout'; ?>">Logout</a>
        </div>
    </div>
</div>