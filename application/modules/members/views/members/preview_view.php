<!-- [ View File name : preview_view.php ] -->

<style>
	.table th.fit,
	.table td.fit {
		white-space: nowrap;
		width: 2%;
		font-weight: bold;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">

			<div class="card">
				<div class="card-header card-header-success card-header-text">
					<div class="card-icon">
						<i class="material-icons">list</i>
					</div>
					<h4 class="card-title">รายละเอียดสมาชิก</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover preview">
							<tbody>
								<tr>
									<td class="text-right fit"><b>รหัสสมาชิก :</b></td>
									<td>{record_member_user_id}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ชื่อ :</b></td>
									<td>{record_member_fname}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>สกุล :</b></td>
									<td>{record_member_lname}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>เบอร์โทรศัพท์ :</b></td>
									<td>{record_member_mobile_no}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>อีเมล :</b></td>
									<td>{record_member_email_addr}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ชื่อร้าน :</b></td>
									<td>{record_member_shop}</td>
								</tr>

								<tr>
									<td class="text-right fit"><b>ที่อยู่ในการจัดส่งสินค้า :</b></td>
									<td>{record_member_addr}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>หมายเหตุ (ถ้ามี) :</b></td>
									<td>{record_member_note}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>สถานะ :</b></td>
									<td style="{preview_status_color}">{preview_status}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>วันเวลาที่สมัคร :</b></td>
									<td>{record_datetime_add}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<br>
					<div class="container-fluid">

					<div class="row">
							<div class="col-sm-12">
								<div class="row align-items-left">
									<div class="col-md-2">
									<h4 style="font-weight: bold;">ที่อยู่สาขา</h4>
									</div>
								</div>
							</div>
						</div>

					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class="text-center"style="width:30%">สาขา</th>
									<th class="text-center"style="width:50%">ที่อยู่</th>
								</tr>
							</thead>
							<tbody>
							<?php
                                    foreach ($branch as $key => $value) { ?>
								<tr>
									<td style="text-align:center;"><?php echo $value['member_shop'] ?></td>
									<td style="text-align:center;"><?php echo $value['member_addr'] ?></td>
								</tr>
								<?php } ?>

							</tbody>
						</table>
					</div>

				</div>
				<div class="form-group">
					<div class="col-sm-12 text-right">
						<input type="hidden" id="add_encrypt_id" />
						<a href="{page_url}" class="my-tooltip btn btn-Secondarying btn-md" data-toggle="tooltip">
							&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ยกเลิก &nbsp;&nbsp;
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>