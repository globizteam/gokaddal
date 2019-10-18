        <div class="upper_banner">
            <div class="container-fluid">
                <div class="container">
                    <h1 class="text-center txt_white m_b_20 txt_52">FAQ</h1>
                    <h3 class="text-center txt_white m_b_70">Lorem ipsum dolor sit amet.</h3>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            
                            
                            <?php //include 'search_form_top.php'; ?>


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

				<div class="row">
				
					<div class="col-md-offset-1 col-md-10">

						<div class="panel-group" id="accordion">
						<?php
							if (!empty($faqrecords)) 
							{
								foreach ($faqrecords as $key => $faq) 
								{
						?>


									<div class="panel panel-default faq_item">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key ?>">
													<?php echo $faq['Faq']['ques'] ; ?>
												<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est, facilis ?</a> -->
												</a>
												<span class="faq_arrows">
													<i class="fas fa-angle-down" style="display: none;"></i>
													<i class="fas fa-angle-up" style=""></i>
												</span>
											</h4>
										</div>
										<div id="collapse<?php echo $key ?>" class="panel-collapse collapse in">
											<div class="panel-body">

											<?php echo $faq['Faq']['ans'] ; ?>
											<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste dolores, minus, vitae, repellat tempora delectus aut saepe doloribus est numquam possimus sed officia ex hic nobis optio? Ex, excepturi facilis quo quae eius ducimus velit blanditiis praesentium quisquam repudiandae. Minus, a est vero. Rerum fugiat accusamus non nostrum odio quisquam quo, molestiae fuga pariatur, natus provident, perferendis quod assumenda unde! -->

										</div>
										</div>
									</div>

						<?php
								}
							 } 
						?>


						</div>

					</div>



				</div>

			</div>
		</div>
	</div>