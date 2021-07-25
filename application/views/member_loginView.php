<style type="text/css">
	input[type='number']:focus,
	input:focus,
	textarea:focus,
	select:focus {
		border: .5px #7caff8 solid !important;
	}

	input,
	textarea {
		border: .5px #eee solid !important;
	}
</style>
<div class="container-scroller">
	<div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="content-wrapper d-flex align-items-center auth px-0" style="background-color: #7caff8;">
			<div class="row w-100 mx-0">
				<div class="col-lg-4 mx-auto">
					<div class="auth-form-light text-left py-5 px-4 px-sm-5">
						<div class="form-row justify-content-center ">
							<a href="{site_url}index" class="simple-text logo-normal">
								<img src="{base_url}/assets/themes/frontend/assets/img/icon/logo_yeejub.png" alt="logo" width="100%">
							</a>
						</div>
						<br>

						<h5 style="font-weight: bold;text-align: center;color:#063264">ร้านหยี่จั๊บ ทุกอย่าง 20 บาท</h5>
						<form class="form-signin pt-3" class="form-signin" role="form" method="post" id="frm_login" onsubmit="return LogIn();return false;">
							{csrf_protection_field}
							<div class="form-group">
								<input type="text" class="form-control form-control-lg" name="input_username" id="input_username" class="form-control" placeholder="เบอร์โทรศัพท์" required autofocus>
							</div>
							<div class="form-group">
								<input type="password" class="form-control form-control-lg" name="input_password" id="input_password" placeholder="รหัสผ่าน" required>
							</div>
							<div class="mt-3">
								<button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"  id="btn_login" type="submit"><i class="fas fa-store"></i> &nbsp;เข้าสู่เว็บไซต์&nbsp;&nbsp;</button>
							</div>
							<div class="mt-3">
								<button onclick="window.location.href='{base_url}registers/add'" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" id="btn_register" type="submit"><i class="fas fa-user"></i> &nbsp;สมัครสมาชิก&nbsp;&nbsp;</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- content-wrapper ends -->
	</div>
	<!-- page-body-wrapper ends -->
</div>
<script language="JavaScript">
	function chkNumber(ele)
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
	}
</script>