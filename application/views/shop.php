<?php $CI = &get_instance(); ?>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- row -->
        <div class="row">
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-12" id="center_column">
                <!-- view-product-list-->
                <?php if ($this->uri->segment(2) === 'category') { ?>
                    <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading"><span class="page-heading-title"><?php echo $product_type?></span></h2>
                    <ul class="row product-list style2 grid">
                        <p id="oneflashsale" style="display:none">EXPIRED</p>
                        <?php
                        foreach ($products as $row) { ?>
                            <li class="col-sx-12 col-sm-4">
                                <div class="product-container">
                                    <div class="left-block" style="position: relative; ">
                                        <a href="<?php echo base_url($row['product_img1']); ?>" data-fancybox data-type="image">
                                            <img class="img-responsive" style="width:350px; height:350px; object-fit:contain" alt="product" src="<?php echo base_url($row['product_img1']); ?>" /></a>
                                    </div>
                                    <div class="right-block">
                                        <h5 class="product-name" style="font-weight: bold;">
                                            <? echo $row['product_name'] ?>
                                        </h5>
                                        <div class="content_price">
                                            <span class="price product-price" style="color: red; font-weight: bold;"><? echo $row['price'] ?> บาท </span>

                                        </div>
                                        <div class="add-to-cart">

                                            <a class="" title="Add to Cart" href="<?php echo base_url('shop/addToCart/' . $row['product_id']); ?>"><span></span>คลิก ซื้อเลย !</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        <? } ?>
                    </ul>
                    <!-- ./PRODUCT LIST -->
                </div>
                <!-- ./view-product-list-->
                <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        <nav>
                        <?php echo $links; ?>
                        </nav>
                    </div>

                </div>

                <?php } else  { ?>
                    <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading"><span class="page-heading-title">สินค้าทั้งหมด</span></h2>
                    <ul class="row product-list style2 grid">
                        <p id="oneflashsale" style="display:none">EXPIRED</p>
                        <?php
                        foreach ($products as $row) { ?>
                            <li class="col-sx-12 col-sm-4">
                                <div class="product-container">
                                    <div class="left-block" style="position: relative; ">
                                        <a href="<?php echo base_url($row['product_img1']); ?>" data-fancybox data-type="image">
                                            <img class="img-responsive" style="width:350px; height:350px; object-fit:contain" alt="product" src="<?php echo base_url($row['product_img1']); ?>" /></a>
                                    </div>
                                    <div class="right-block">
                                        <h5 class="product-name" style="font-weight: bold;">
                                            <? echo $row['product_name'] ?>
                                        </h5>
                                        <div class="content_price">
                                            <span class="price product-price" style="color: red; font-weight: bold;"><? echo $row['price'] ?> บาท </span>

                                        </div>
                                        <div class="add-to-cart">

                                            <a class="" title="Add to Cart" href="<?php echo base_url('shop/addToCart/' . $row['product_id']); ?>"><span></span>คลิก ซื้อเลย !</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        <? } ?>
                    </ul>
                    <!-- ./PRODUCT LIST -->
                </div>
                <!-- ./view-product-list-->
                <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        <nav>
                        <?php echo $links; ?>
                        </nav>
                    </div>

                </div>

                <?php   } ?>

            </div>
        </div>
        <!-- ./row-->
    </div>
</div>