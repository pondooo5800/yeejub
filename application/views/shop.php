<?php $CI =& get_instance(); ?>

<!-- Inner Banner -->
<div class="inner-banner bg-shape3 bg-color5">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="conatiner">
                <div class="inner-title text-center">
                    <h3><?php echo lang('nav_shop'); ?></h3>
                    <ul>
                        <li>
                            <a href="{base_url}index"><?php echo lang('nav_home'); ?></a>
                        </li>
                        <li>
                            <i class="fas fa-chevron-right"></i>
                        </li>
                        <li>
                            <?php echo lang('nav_shop'); ?>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Product Area -->
<section class="product-area pt-94 pb-70">
<!-- <div class="cart-view">
        <a href="<?php echo base_url('cart'); ?>" title="View Cart"><i class="icart"></i> (<?php echo ($this->cart->total_items() > 0) ? $this->cart->total_items() . ' Items' : 'Empty'; ?>)</a>
    </div>
 -->
    <div class="container">
        <div class="scetion-title text-center mb-50">
            <h2><?php echo lang('s_h1'); ?></h2>
        </div>
        <div class="row">
        <!-- <?php
        foreach ($products as $row) {
            echo "{" . $row->id . "}" . $row->name . " - " . $row->price . "<br>";
        }
        ?>
      <p><?php echo $links; ?></p> -->

            <?php if (!empty($products)) {
                foreach ($products as $row) { ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="product-item">
                            <a href="<?php echo base_url('shop/shop_details/' . $row['product_id']); ?>">
                                <img src="<?php echo base_url($row['product_img1']); ?>" alt="Product Images">
                            </a>
                            <div class="product-cotent">
                                <div class="product-text">
                                    <h5><?php echo $row['product_name_'.$language]; ?></h5>
                                    <span>฿<?php echo '$' . number_format($row["price"]); ?></span>
                                </div>
                                <a href="<?php echo base_url('shop/addToCart/' . $row['product_id']); ?>" class="add-product border-radius">
                                    <i class="flaticon-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <p><?php echo lang('sh_m2'); ?></p>
            <?php } ?>
            <div class="col-lg-12 col-md-12">
            <?php echo $links; ?>
                <!-- <div class="pagination-area">
                    <a href="#" class="page-numbers current" aria-current="page">1</a>
                    <a href="#" class="page-numbers ">2</a>
                    <a href="#" class="page-numbers">3</a>
                    <a href="#" class="next page-numbers">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- Product Area End -->