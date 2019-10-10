        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <!-- <h1 class="text-center txt_white m_b_20 txt_52">About Us</h1> -->
                    <!-- <h3 class="text-center txt_white m_b_70">Lorem ipsum dolor sit amet</h3> -->
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            
                            
                            <?php echo $this->element('Frontend/search_form'); ?>


                            <!-- <p class="txt_16 txt_white text-center after_search m_b_20">Popular Searches: &nbsp;&nbsp;&nbsp; <a href="#">Smart Cities</a> , <a href="#">Utilities</a> , <a href="#">Healthcare</a> , <a href="#">Real Estate</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="p_tb_80">
        <div class="container-fluid">
            <div class="container">
                <h2 class="txt_black m_b_20">
                    <?php echo $terms[0]['Page']['title']; ?>
                </h2>
                <p class="para_large p_t_20">
                    <?php echo $terms[0]['Page']['description']; ?>
                </p>
            </div> <!-- /.container -->
        </div> <!-- /.container-fluid -->
    </div>


