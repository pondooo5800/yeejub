<script>
    var state = 'edit';
</script>
<div class="columns-container">
    <div class="container" id="columns">
        <h2 class="page-heading"><span class="page-heading-title2">ข้อมูลส่วนตัวของสมาชิก</span></h2>
        <br>
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block category -->
                <div class="block left-module">
                    <p class="title_block">เมนู</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">

                                    <li><span></span><a href="{site_url}index/member_index/<?php echo ($this->session->userdata('url_encrypt_id')) ?>">ข้อมูลลูกค้า</a></li>
                                    <li><span></span><a href="{site_url}index/member_branch">สาขา</a></li>
                                    <li><span></span><a href="{site_url}index/member_order">ประวัติการสั่งซื้อ</a></li>
                                    <li><span></span><a href="{site_url}member_login/destroy">ออกจากระบบ</a></li>
                                    <!-- <li><span></span><a href="member-history.html">แจ้งชำระเงิน</a></li>
                                    <li><span></span><a href="member-howto_pay.html">การชำระเงิน</a></li>
                                    <li><span></span><a href="member-payment_detail.html">ประวัติการชำระเงิน</a></li> -->
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./block category  -->
                <!-- block filter -->


                <!-- left silide -->

            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- page heading-->
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="page-heading no-line"><span class="page-heading-title2">ประวัติการสั่งซื้อ</span></h2>
                    </div>
                </div>
                <div class="box-border">
                    <ul>
                        <li class="row">
                            <div class="col-sm-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="font-weight: bold;text-align: center;">เลขที่ใบสั่งซื้อ</th>
                                            <th scope="col" style="font-weight: bold;text-align: center;">วันที่</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($history_order as $key => $row) { ?>
                                            <tr>
                                                <th style="text-align: center;"><?php echo $row['id'] ?></th>
                                                <td style="text-align: center;"><?php echo $row['created'] ?></td>
                                                <td>
                                                    <a href="{site_url}cart/orderPDF/<?php echo $row['id'] ?>" target="_blank" class="btn btn-info btn-sm">
                                                        &nbsp;&nbsp;<i class="fa fa-print"></i> &nbsp;ใบสั่งซื้อสินค้า &nbsp;&nbsp;
                                                    </a>
                                                </td>
                                            </tr>
                                    </tbody>
                                <?php } ?>

                                </table>
                            </div>
                        </li>
                        <!--/ .row -->
                        <li>


                        </li>

                    </ul>
                </div>


            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
<div class="modal fade" id="confirmDelModalBranch" tabindex="-1" role="dialog" aria-labelledby="confirmDelModalBranchLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class='modal-content'>
            <div class="modal-header" style="border-bottom: 0px;">
                <button type="button" style="font-size: 25px;" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 style="font-weight: bold" class="text-center">* ท่านต้องการลบข้อมูลใช่หรือไม่ *</h4>
                <form id="formDelete">
                    <input type="hidden" name="encrypt_member_branch_id" />
                </form>
            </div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" style="background-color: #5a6268; color: #FFFFFF" class="btn btn-secondary" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ปิด &nbsp;&nbsp;</button>&emsp;
                <button type="button" class="btn btn-danger" id="btn_confirm_delete_ฺbranch">&nbsp;ยืนยัน&nbsp;</button>
            </div>
        </div>
    </div>
</div>