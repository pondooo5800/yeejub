<style>
    .fix_menu {
        margin: 2px;
    }

    .ads_brand img {
        margin: 10px;
        width: 100%;
        height: auto;
        object-fit: contain;
    }

    .product-list .owl-lazy {
        width: 100%;
        height: auto;
        object-fit: contain;
    }

    .modal-body img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }

    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product-name {
        font-weight: bold;
        text-align: center;
    }

    .content_price .price {
        color: #f30;
        font-weight: bold;
    }

    @media (max-width: 576px) {

        .navbar-brand,
        .category-featured .navbar,
        .button-container {
            justify-content: center;
        }

        .product-featured-content {
            padding: 10px;
        }

        .modal-dialog {
            max-width: 90%;
            margin: 1.75rem auto;
        }
    }
</style>
<div class="container" id="container">
    <div class="row fix_menu" style="margin: 2px;">
        <div class="col-sm-3 my_menu my_menu1">Promotion</div>
        <div class="col-sm-3 my_menu my_menu2">หมวดหมู่สินค้า</div>
        <div class="col-sm-3 my_menu my_menu3">แบรนด์สินค้า</div>
    </div>

    <div class="row fix_menu" id="my_menu1_des" style="margin: 2px; display: none;">
        <?php foreach ($promotion as $row) { ?>
            <?php if ($row['promotion_type'] == 1) { ?>
                <a href="<?php echo base_url('shop/promotion/') . $row['promotion_id']; ?>">
                    <div class="col-sm-4 ads_brand">
                        <img style="margin: 10px" src="<?php echo base_url($row['promotion_img1']); ?>">
                    </div>
                </a>
            <?php } else if ($row['promotion_type'] == 0) { ?>
                <a href="#" data-toggle="modal" data-target="#myPromotion" data-row-id='{
            "promotion_id":"<?php echo ($row['promotion_id']); ?>"
            ,"promotion_name":"<?php echo ($row['promotion_name']); ?>"
            ,"promotion_detail":"<?php echo ($row['promotion_detail']); ?>"
            ,"promotion_img1":"<?php echo base_url($row['promotion_img1']); ?>"
        }'>
                    <div class="col-sm-4 ads_brand">
                        <img style="margin: 10px" src="<?php echo base_url($row['promotion_img1']); ?>">
                    </div>
                </a>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="row fix_menu" id="my_menu2_des" style="margin: 2px;">
        <?php foreach ($product_type as $row) { ?>
            <a href="<?php echo base_url('shop/category/') . $row['product_type_id']; ?>">
                <div class="col-sm-2 ads_brand">
                    <p style="text-align: center;max-width: 100%;font-weight: bold;font-size: 16px;">
                        <?php echo $row['product_type_name']; ?>
                    </p>
                </div>
            </a>
        <?php } ?>
    </div>
    <div class="row fix_menu" id="my_menu3_des" style="margin: 2px;">
        <?php foreach ($brand as $row) { ?>
            <a href="<?php echo base_url('shop/brand/') . $row['banner_id']; ?>">
                <div class="col-sm-2 ads_brand">
                    <img style="margin: 10px" src="<?php echo base_url($row['banner_img1']); ?>">
                </div>
            </a>
        <?php } ?>
    </div>
</div>
<div class="content-page">
    <div class="container">
        <?php #หมวดหมู่ที่ต้องการให้ใช้ lazyload
        ?>
        <?php foreach ($product_type_dis as $row) { ?>
            <div class="category-featured">
                <nav class="navbar nav-menu nav-menu-blue show-brand">
                    <div class="container">
                        <div class="navbar-brand" style="text-align: center;">
                            <a style="color: #3466cb;" href="<?php echo base_url('shop/category/') . $row['product_type_id']; ?>">
                                <?php echo $row['product_type_name']; ?>
                            </a>
                        </div>
                </nav>
            </div>
            <?php #ข้อมูลสินค้า lazyload
            ?>
            <div class="product-featured clearfix">
                <div class="product-featured-content">
                    <div class="product-featured-list">
                        <div class="tab-container">
                            <div class="tab-panel active">
                                <ul class="product-list owl-carousel owl-theme">
                                    <?php
                                    $this->load->model('common_model');
                                    $product = $this->common_model->custom_query("select tb_products.*,tb_products_units.product_unit_name from tb_products LEFT JOIN tb_products_units ON tb_products.product_unit_id = tb_products_units.product_unit_id where tb_products.fag_allow = 'allow' and tb_products.product_type ='" . $row['product_type_id'] . "'ORDER BY tb_products.product_id DESC");

                                    foreach ($product as $value) { ?>
                                        <li>
                                            <div class="left-block">
                                                <a href="#" data-toggle="modal" data-target="#my_modal" data-row-id='{"product_id":"<?php echo ($value['product_id']); ?>","product_name":"<?php echo ($value['product_name']); ?>","price":"<?php echo ($value['price']); ?>","product_unit_name":"<?php echo ($value['product_unit_name']); ?>","product_img1":"<?php echo ($value['product_img1']); ?>"}'>
                                                    <img class="owl-lazy" style="width:350px; height:350px; object-fit:contain" alt="product" data-src="<?php echo ($value['product_img1'] == '' ? 'assets/images/icon/file_not_found.png' : $value['product_img1']) ?> " /></a>
                                            </div>
                                            <div class="right-block">
                                                <h5 class="product-name" style="font-weight: bold;text-align: center;">
                                                    <? echo $value['product_name'] ?>
                                                </h5>
                                                <div style="text-align: center;">
                                                    <div class="content_price">
                                                        <span class="price product-price" style="color: #f30; font-weight: bold;">ราคา <? echo $value['price'] ?> บาท / <?php echo $value['product_unit_name'] ?></span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="button-container" style="align-items: center;justify-content: space-around;">
                                                        <div class="button-container">
                                                            <button class="cart-qty-minus" type="button" value="-">-</button>
                                                            <input type="text" min="1" name="qty" id="<?php echo $value['product_id'] ?>" class="qty form-control" value="1" OnKeyPress="return chkNumber(this)" />
                                                            <button class="cart-qty-plus" type="button" value="+">+</button>
                                                        </div>
                                                        <span>
                                                            <button style="width: 100px;" type="button" name="add_cart" class="btn btn-success add_cart add-cart" data-segment="ajax" data-productname="<?php echo $value['product_name'] ?>" data-price="<?php echo $value['price'] ?>" data-productid="<?php echo $value['product_id'] ?>" />สั่งซื้อ</button>
                                                        </span>
                                                    </div>
                                                    <input type="hidden" id="product_id" name="product_id" value="<? echo $value['product_id'] ?>">
                                                    <input type="hidden" name="segment" value="index">
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>
<div class='modal fade' id='my_modal' tabindex='-1' role='dialog' aria-labelledby='delModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-lg' role='document'>
        <div class='modal-content'>
            <div class="modal-header" style="border-bottom: 0px;">
                <button type="button" style="font-size: 25px;" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class='modal-body' style="text-align: center;">
                <div class="modal-body">
                    <img style="width:400px; height:400px; object-fit:contain" id="my_image" /></a>
                </div>
            </div>
            <div class='modal-footer text-left'>
                <form class="form-horizontal" id="formAddCart" accept-charset="utf-8">
                    {csrf_protection_field}
                    <div class="row vertical-align">
                        <div class="col-sm-12 col-md-5">
                            <div class="button-container" style="align-items: center;justify-content: center;">
                                <p style="font-size:14px;text-align: center;" id="product_name"></p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="button-container" style="align-items: center;justify-content: center;">
                                <p style="color: #f30; font-weight: bold;font-size:14px;text-align: center;" id="unit_text"></p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <div class="button-container" style="align-items: center;justify-content: space-around;">
                                <span>
                                    จำนวน
                                </span>
                                <button class="cart-qty-minus" type="button" value="-">-</button>
                                <input type="text" min="1" id="qty" name="qty" class="qty form-control" value="1" OnKeyPress="return chkNumber(this)" />
                                <button class="cart-qty-plus" type="button" value="+">+</button>
                                <span>
                                    <button id="btnSaveCart" style="width: 100px;" name='submit' value="submit" class="btn btn-success">สั่งซื้อ</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="product_id" name="product_id" value="">
                    <input type="hidden" name="segment" value="index">
                </form>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='myPromotion' tabindex='-1' role='dialog' aria-labelledby='delModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-lg' role='document'>
        <div class='modal-content'>
            <div class="modal-header" style="border-bottom: 0px;">
                <button type="button" style="font-size: 25px;" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class='modal-body' style="text-align: center;">
                <div class="modal-body">
                    <img style="width:400px; height:400px; object-fit:contain" id="my_image_promotion" /></a>
                </div>
            </div>
            <div class='modal-footer text-left'>
                <div class="row vertical-align">
                    <div class="col-sm-12 col-md-12">
                        <div class="button-container" style="align-items: center;justify-content: center;padding-bottom: 5px;">
                            <p style="font-size:14px;text-align: center;" id="promotion_detail_text"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Initialize Owl Carousel
        $('.owl-carousel').owlCarousel({
            items: 4,
            lazyLoad: true,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        });

        // Prevent form submit on Enter key press
        $(document).on('keypress', 'form', function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });

        // Modal handling for products
        $('#my_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var data = button.data('row-id');
            var parsedData = JSON.parse(data);

            $('#my_image').attr('src', parsedData.product_img1);
            $('#product_name').text(parsedData.product_name);
            $('#unit_text').text('ราคา ' + parsedData.price + ' บาท / ' + parsedData.product_unit_name);
            $('#product_id').val(parsedData.product_id);
        });

        // Modal handling for promotions
        $('#myPromotion').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var data = button.data('row-id');
            var parsedData = JSON.parse(data);

            $('#my_image_promotion').attr('src', parsedData.promotion_img1);
            $('#promotion_detail_text').text(parsedData.promotion_detail);
        });

        // Quantity increment/decrement handling
        $('.cart-qty-plus').click(function() {
            var $qty = $(this).siblings('.qty');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal)) {
                $qty.val(currentVal + 1);
            }
        });

        $('.cart-qty-minus').click(function() {
            var $qty = $(this).siblings('.qty');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal) && currentVal > 1) {
                $qty.val(currentVal - 1);
            }
        });

        // Function to ensure only numbers are entered
        window.chkNumber = function(e) {
            var charCode = (e.which) ? e.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        };
    });
</script>