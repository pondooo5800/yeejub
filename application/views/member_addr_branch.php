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
                <h2 class="page-heading no-line"><span class="page-heading-title2">เพิ่มสาขา</span></h2>
                <!-- ../page heading-->
                <div class="box-border">
                    <ul>
                        <li class="row">
                        <form class="form-horizontal" id="formAdd" accept-charset="utf-8">
                            {csrf_protection_field}
                            <div class="col-sm-12">
                                    <label for="member_shop" class="required">ชื่อร้าน <spen style="color: red;">*</spen> </label>
                                    <input type="text" class="input form-control" name="member_shop" id="member_shop" value="">
                                    <br>
                                    <label for="member_addr">ที่อยู่ในการจัดส่งสินค้า  <spen style="color: red;">*</spen></label>
                                    <textarea class="input form-control" id="member_addr" name="member_addr" rows="3"></textarea>
                                    <br>
                                    <input type="hidden" class="input form-control" name="member_id" id="member_id" value="<?php echo ($this->session->userdata('member_id'))?>">

                                    <div class="form-group">
                                        <div class="col-sm-12 text-center">
                                        <button type="button" onclick="window.location.href='{site_url}index/member_branch'" style="background-color: #5a6268; color: #FFFFFF" class="btn btn-secondary">
                                            &nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ยกเลิก &nbsp;&nbsp;
                                            </button>

                                            <button type="button" id="btnConfirmSave" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                            &nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

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
<!-- Modal -->
<div class='modal fade' id='addModal' tabindex='-1' role='dialog' aria-labelledby='addModalLabel' aria-hidden='true'>
	<div class='modal-dialog' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h4 class='modal-title' id='addModalLabel'>บันทึกข้อมูล</h4>
			</div>
			<div class='modal-body' style="text-align: center;">
				<p class="alert alert-info">ยืนยันการเปลี่ยนแปลงแก้ไขข้อมูล ?</p>
				<form class="form-horizontal" onsubmit="return false;">
					<div class="form-group">
					</div>
				</form>
			</div>
			<div class='modal-footer text-center'>
            <button type="button" style="background-color: #5a6268; color: #FFFFFF" class="btn btn-secondary" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ปิด &nbsp;&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSaveฺBranch">&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</div>