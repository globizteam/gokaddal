<div class="row my_account_sidebar_container my_acc_match_height p_tb_80 col_sm_p_tb_60">
    <div class="col-lg-offset-3 col-lg-9 col-md-12">
        <h4 class="txt_black txt_w_700">
            <?php echo AuthComponent::user('name'); ?>
        </h4>
        <hr class="dark_hr">
        <ul class="m_t_15 solution_sidebar listing_page_sidebar my_account_sidebar list-unstyled p_l_0 m_b_0">
            <li><a href="<?php echo $this->webroot.'home/myaccount'; ?>">Account Details</a></li>
            <li><a href="javascript:;">Change Password</a></li>
            <li><a href="javascript:;">Notification</a></li>
            <hr class="hidden-sm hidden-xs">
            <?php if(AuthComponent::user('type') == 1) : ?>
                <li class="col_sm_m_t_20"><a href="javascript:;">My Solutions</a></li>
                <li><a href="javascript:;">My Proposals</a></li>
                <li><a href="javascript:;">Post Solution</a></li>
            <?php endif; ?>    
            <!-- <li><a href="#">My Requests</a></li> -->
            <?php if(AuthComponent::user('type') == 2) : ?>
                <li><a href="javascript:;">My Favourites</a></li>
                 <!-- <li><a href="<?php //echo $this->webroot.'home/show_requirement'; ?>">My Requirements</a></li> -->
                <li><a href="<?php echo $this->webroot.'home/my_requirement'; ?>">My Requirements</a></li>
                <li><a href="<?php echo $this->webroot.'home/post_requirement'; ?>">Post Requirement</a></li>
            <?php endif; ?>
        </ul>
        <div class="text-left orange_btns m_t_30">
            <a href="<?php echo $this->webroot.'home/logout'; ?>">Logout</a>
        </div>
    </div>
</div>