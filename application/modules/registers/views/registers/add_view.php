<script>
	var data_id = {data_id};
	var state = 'add';
</script>
<style>
	.control-label {
		font-weight: bold;
	}
</style>
<!-- [ View File name : add_view.php ] -->
<div class="container-fluid">
	<div class="row" style="justify-content: center;">
		<div class="col-md-10">
			<div class="card">
				<div class="card-body">
					<div class="card-header" style="padding: 3%;padding-bottom: 10px;">
						<div class="brand-logo">
						<img src="{base_url}/assets/themes/frontend/assets/img/icon/logo_yeejub.png" alt="logo" style="width: 200px;">
						</div>
					</div>
					<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
						{csrf_protection_field}
						<div class="text-center">
							<h5 style="font-weight: bold;">สมัครสมาชิกใหม่</h5>
							<h6 class="font-weight-light">(เพื่อความสะดวกรวดเร็ว และสามารถตรวจสอบรายการสั่งซื้อย้อนหลังได้ตลอด 24 ชั่วโมง กรุณาระบุข้อมูลที่เป็นความจริงให้ครบถ้วน)</h6>
						</div>
						<br>
						<br>
						<div class="container">
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_mobile_no">เบอร์โทรศัพท์ (ใช้สำหรับเข้าสู่เว็บไซต์) :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_mobile_no" name="member_mobile_no" value="" OnKeyPress="return chkNumber(this)" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="cus_passwd">รหัสผ่าน (อย่างน้อย 6 ตัว) :</label>
									<div class="form-group has-success">
										<input type="password" class="form-control " id="cus_passwd" name="cus_passwd" value="" />
									</div>
								</div>
							</div>
							<div class="form-row justify-content-around">
							<div class="form-group col-md-4 ">
									<label class="control-label" for="member_email_addr">อีเมล :</label>
									<div class="form-group has-success">
										<input type="email" class="form-control " id="member_email_addr" name="member_email_addr" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="confirmpassword">ยืนยันรหัสผ่าน :</label>
									<div class="form-group has-success">
										<input type="password" class="form-control " id="confirmpassword" name="confirmpassword" value="" />
									</div>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_fname">ชื่อ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_fname" name="member_fname" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_lname">นามสกุล :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="member_lname" name="member_lname" value="" />
									</div>
								</div>
							</div>

							<br>
						</div>
						<hr>
						<div class="form-group">
							<div class="col-sm-12 text-center">
								<input type="hidden" id="add_encrypt_id" />
								<button onclick="window.location.href='{base_url}member_login'" type="button" class="btn btn-secondarying">
									&nbsp;&nbsp;<i class="fa fa-times"></i> &nbsp;ยกเลิก &nbsp;&nbsp;
								</button>

								<button type="button" id="btnConfirmSave" class="btn btn-success" data-toggle="modal" data-target="#addModal">
									&nbsp;&nbsp;<i class="fa fa-user"></i> &nbsp;สมัครสมาชิก &nbsp;&nbsp;
								</button>
							</div>
						</div>
					</form>
				</div>
				<!--panel-body-->
			</div>
			<!--panel-->
		</div>
		<!--contrainer-->
	</div>
	<!--contrainer-->
</div>
<!-- Modal Confirm Save -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addModalLabel">สมัครสมาชิก</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-info">ยืนยันสมัครสมาชิก ?</p>
			</div>
			<div class="modal-footer" style="justify-content: center;">
				<button type="button" class="btn btn-success" id="btnSave">&nbsp;&nbsp;<i class="fa fa-check-circle"></i> &nbsp;ยืนยัน &nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</div>

<script language="JavaScript">
	function chkNumber(ele)
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
	}
</script>