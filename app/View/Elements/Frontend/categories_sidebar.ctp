                        <ul class="m_t_40 solution_sidebar listing_page_sidebar list-unstyled p_l_0">
                            <!-- if logged in as seeker, will see all the categories -->
                            <?php 
                                if( AuthComponent::user('type') != 1 ) 
                                {
                                    foreach ($categories as $key => $category) 
                                    { 

                            ?>
                                    <li>
                                        <a href="<?php echo $this->webroot.'home/provider_all_solutions?id='.$key.'&showcategories=1'; ?>" class="link">
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
                                    if (count($cat_names) > 0) {

                                        foreach ($cat_names as $key => $category) 
                                        { 

                                ?>
                                        <li>
                                            <a href="<?php echo $this->webroot.'home/seeker_selected_category?id='. $category['Category']['id'].'&showcategories=1'; ?>" class="link">
                                                <?php echo $category['Category']['title']; ?>
                                            </a>
                                        </li>
                                <?php 
                                        } 
                                    }else{
                                        echo "<li style='color: #ff7f27;'>No Categories Found</li>";
                                    }
                                }
                            ?>
                        
                        </ul>