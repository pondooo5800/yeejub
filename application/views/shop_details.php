        <!-- Inner Banner -->
        <div class="inner-banner bg-shape2 bg-color5">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="conatiner">
                        <div class="inner-title text-center">
                            <h3><?php echo lang('sd_h1'); ?></h3>
                            <ul>
                                <li>
                                <a href="{base_url}index"><?php echo lang('nav_home'); ?></a>
                                </li>
                                <li>
                                    <i class="fas fa-chevron-right"></i>
                                </li>
                                <li>
                                    <?php echo lang('sd_h1'); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Shop-Detls -->
        <section class="shop-detls ptb-100">
            <div class="container">
            <?php
                foreach ($products as $row) { ?>
            <form action="<?php echo base_url('shop/addToCart/' . $row['product_id']);?>" method="post">

                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="shop-detls-image">
                            <img src="<?php echo base_url($row['product_img1']); ?>" alt="image">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="shop-desc">
                            <h3><?php echo $row['product_name_'.$language]; ?></h3>
                            <div class="price">
                                <span class="new-price">฿<?php echo $row["price"]; ?></span>
                            </div>

                            <div class="shop-review">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p>
                                <?php echo $row['description_'.$language]; ?>
                            </p>
                            <a href="{base_url}assets/images/size_chart.pdf" class="btn btn-buy"><?php echo lang('sd_m1'); ?></a>
                            <div class="shop-add">
                                <div class="input-counter">
                                    <input type="text" class="form-control" id="size" name="size" value="" placeholder="Size" />
                                </div>
                            </div>
<br>
                            <div class="buy-checkbox-btn">
                                <div class="item">
                                    <button type="submit" class="btn btn-buy">
                                    Buy Now!
                                            </button>
                                    <!-- <a href="<?php echo base_url('shop/addToCart/' . $row['product_id']); ?>" class="btn btn-buy">Buy Now!</a> -->
                                </div>
                            </div>

                            <div class="custom-payment">
                                <span>Guaranteed safe checkout:</span>

                                <div class="payment-methods">
                                    <a href="#"><img src="{base_url}assets/themes/fontend/assets/img/product/add2.svg" alt="image"></a>
                                    <a href="#"><img src="{base_url}assets/themes/fontend/assets/img/product/add3.svg" alt="image"></a>
                                    <a href="#"><img src="{base_url}assets/themes/fontend/assets/img/product/add4.svg" alt="image"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                   <div class="col-lg-12 col-md-12">
                        <div class="tab shop-detls-tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <ul class="tabs">
                                        <li>
                                            <a href="#">Image </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="tab_content current active">
                                        <div class="tabs_item ">
                                            <div class="shop-detls-tab-content">
                                                <div class="shop_detls">
                                                    <img src="<?php echo base_url($row['product_img1']); ?>" alt="image">
                                                </div>
                                                <br>
                                                <div class="shop_detls">
                                                    <img src="<?php echo base_url($row['product_img2']); ?>" alt="image">
                                                </div>
                                                <br>
                                                <?php if ($row['product_img3'] != '') { ?>
                                                    <div class="shop_detls">
                                                        <img src="<?php echo base_url($row['product_img3']); ?>" alt="image" >
                                                    </div>
                                                    <br>
                                                <?php } ?>
                                                <?php if ($row['product_img4'] != '') { ?>
                                                    <div class="shop_detls">
                                                        <img src="<?php echo base_url($row['product_img4']); ?>" alt="image" >
                                                    </div>
                                                    <br>
                                                <?php } ?>
                                                <?php if ($row['product_img5'] != '') { ?>
                                                    <div class="shop_detls">
                                                        <img src="<?php echo base_url($row['product_img5']); ?>" alt="image" >
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>

                <?php } ?>

            </div>
        </section>
        <!-- Shop-Detls End -->