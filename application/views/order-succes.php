<!-- <body onload="setTimeout()"> -->
<div class="columns-container">
    <div class="container" id="columns">
        <div class="alert alert-success" style="text-align: center;">
            <h3><span style="font-weight: bold;">สั่งซื้อสินค้าสำเร็จ</span></h3>
        </div>
        <div class="page-content page-order">
            <div class="order-detail-content" id="view_cart">
                <div class="table-responsive">
                    <table class="table table-curved">
                    <table class="table table-curved">
                        <thead>
                            <tr>
                                <th style="font-weight: bold;text-align: center; vertical-align: middle;">เลขที่ใบสั่งซื้อ</th>
                                <th style="font-weight: bold;text-align: center; vertical-align: middle;">วันที่สั่งซื้อ</th>
                                <th style="font-weight: bold;text-align: center; vertical-align: middle; ;">ยอดที่ต้องชำระ</th>
                                <th style="font-weight: bold;text-align: center; vertical-align: middle;">ชื่อผู้ซื้อ</th>
                                <th style="font-weight: bold;text-align: center; vertical-align: middle;">เบอร์โทรศัพท์</th>
                                <th style="font-weight: bold;text-align: center; vertical-align: middle;">อีเมล</th>
                            </tr>
                        </thead>
                        <?php if (!empty($order)) { ?>
                            <tbody>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;"> #<?php echo $order['id']; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?php echo setThaiDateShortMonth($order['created']); ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?php echo number_format($order['grand_total'], 2); ?></td>
                                    <td style="text-align: center; vertical-align: middle;"> <?php echo $order['name']; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?php echo $order['phone']; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?php echo $order['email']; ?></td>
                                </tr>
                            </tbody>

                        <?php } else { ?>
                            <div class="col-md-12">
                                <div class="alert alert-danger">Your order submission failed.</div>
                            </div>
                        <?php } ?>
                    </table>

                    </table>
                </div>
                
                <div class="cart_navigation">
                    <a class="" href="{base_url}shop" style="background-color: #3366cc; color: #FFFFFF"> เลือกสินค้าอื่น เพิ่มเติม</a>
                    <a class="" href="{base_url}cart/orderPDF/<?php echo $order['id']; ?>" target="_blank" style="background-color: #5a6268; color: #FFFFFF"> พิมพ์ใบสั่งซื้อสินค้า</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="columns-container">
    <div class="container" id="columns">
        <h2 class="page-heading"><span class="page-heading-title2">วิธีการแจ้งชำระเงิน</span></h2>
        <div class="row">
            <div class="center_column col-xs-12 col-sm-12" id="center_column">
                <div class="content-text clearfix">
                    <div class="content-text clearfix">
                        <h2><span style="font-size:16px;font-weight: bold;">ชำระเงินที่</span></h2>
                        <br>
                        <div style="padding: 0px 50px;">
                            <img src="{base_url}assets/images/kbank.jpg" style="width: 300px; height: auto;" alt="">
                        </div>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ธนาคาร:</b> ธนาคารกสิกรไทย</span></p>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>สาขา:</b> บางมด</span></p>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>เลขที่บัญชี:</b> 09-02-633-677</span></p>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ชื่อบัญชี:</b> นิพนธ์ คุปตะนุรักษ์</span></p>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ประเภทบัญชี:</b> ออมทรัพย์</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        setTimeout(function() {
            var $order = <?php echo $order['id']; ?>;
            window.open('{base_url}cart/orderPDF/' + $order)
        }, 3000);
    </script> -->
    <!-- </body> -->