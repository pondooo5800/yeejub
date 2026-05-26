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
                        <h2 class="page-heading no-line"><span class="page-heading-title2">สาขา</span></h2>
                    </div>
                    <div class="col-md-6" style="text-align: end;">
                        <a href="{site_url}index/member_addr_branch" class="btn btn-primary">
                            &nbsp;&nbsp;<i class="fa fa-plus"></i> &nbsp;เพิ่มสาขา &nbsp;&nbsp;
                        </a>
                    </div>
                </div>

                <!-- <div class="form-group">
                                        <div class="col-sm-12 text-center">
                                            <button type="button" id="btnConfirmSave" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
                                            &nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;
                                            </button>
                                        </div>
                                    </div>
 -->
                <!-- ../page heading-->
                <div class="box-border">
                    <ul>
                        <li class="row">
                            <div class="col-sm-12">
                                <?php
                                foreach ($branch as $key => $row) { ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label style="font-weight: bold;" for="member_shop">ชื่อร้าน : </label><span style="font-weight: normal;"> <?php echo $row['member_shop'] ?></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label style="font-weight: bold;" for="member_addr">ที่อยู่ : </label><span style="font-weight: normal;"> <?php echo $row['member_addr'] ?> </span>
                                        </div>

                                        <div class="col-md-3" style="text-align: end;">
                                            <a href="{site_url}index/member_edit_branch/<?php echo $row['member_branch_id'] ?>" class="btn btn-warning btn-sm">
                                                &nbsp;&nbsp;<i class="fa fa-edit"></i> &nbsp;แก้ไข &nbsp;&nbsp;
                                            </a>
                                            <a href="javascript:void(0);" class="btn-delete-branch btn btn-danger btn-sm" data-member_branch_id="<?php echo $row['member_branch_id'] ?>" data-row-number="<?php echo $key ?>">
                                                &nbsp;&nbsp;<i class="fa fa-trash"></i> &nbsp;ลบ &nbsp;&nbsp;
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                <?php } ?>
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