<div class="banner_search_form m_b_20">
    <!-- <form action="<?php echo $this->webroot.'home/search'  ?>" method="get" > -->
    <form name="searchform" method="post" action="<?php echo $this->webroot.'home/searchall'; ?>" id="searchform">
        <div class="row">
            <div class="col-sm-5 p_lr_6">
                <div class="input-group">
                    <span class="input-group-addon input_icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <input type="text" class="form-control search_inputs" name="location" id="location" placeholder="Location">
                </div>
            </div>
            <div class="col-sm-5 p_lr_6">
                <div class="input-group">
                    <span class="input-group-addon input_icon">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control search_inputs" name="lookingfor" id="looking_for" placeholder="Looking For...">
                </div>
            </div>
            <div class="col-sm-2 p_lr_6">
                <button type="submit" class="send_btn search_btn">SEARCH<i class="fas fa-angle-right m_l_3"></i></button>
<!--                 <a href="#" class="send_btn search_btn">
                    SEARCH 
                    <i class="fas fa-angle-right m_l_3"></i>
                </a> -->
            </div>
        </div>
    </form>
</div>