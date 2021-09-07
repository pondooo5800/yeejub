<script>
	var num = {count_image};
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
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-info card-header-text">
					<div class="card-icon">
						<i class="material-icons">note_add</i>
					</div>
					<h4 class="card-title">เพิ่มรายการ โปรโมชั่นสินค้า</h4>

				</div>
				<div class="card-body ">
					<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
						{csrf_protection_field}
						<div class="container">
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="promotion_name">ชื่อ โปรโมชั่นสินค้า :</label>
									<div class="form-group has-info">
										<input type="text" class="form-control" id="promotion_name" name="promotion_name" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="promotion_type">ประเภท :</label>
									<select id="promotion_type" name="promotion_type" value="">
										<option value="">- เลือก ประเภท -</option>
										<option value="0">โปรโมชั่น ประกาศ</option>
										<option value="1">โปรโมชั่น สินค้า</option>
									</select>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="promotion_detail">รายละเอียด :</label>
									<div class="form-group has-info">
										<textarea class="form-control" id="promotion_detail" name="promotion_detail" rows="3"></textarea>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="fag_allow">สถานะ :</label>
									<select id="fag_allow" name="fag_allow" value="">
										<option value="">- เลือก สถานะ -</option>
										<option value="allow">เผยแพร่</option>
										<option value="block">ไม่เผยแพร่</option>
									</select>
								</div>

							</div>
							<div class="form-row justify-content-around">
								<div class="col-sm-12 col-md-10">
									<label class="control-label" for="promotion_img1">รูปภาพ โปรโมชั่นสินค้า :</label>
									<div class="upload-box">
										<div class="hold input-group">
											<span class="btn-file"> คลิกเพื่อแนบไฟล์
												<input type="file" id="promotion_img1" name="promotion_img1" data-elem-preview="promotion_img1_preview" data-elem-label="promotion_img1_label" />
											</span><input class="form-control" id="promotion_img1_label" name="promotion_img1_label" placeholder=" กรุณาเลือกไฟล์ที่ต้องการอัพโหลด" readonly="readonly" value="{record_promotion_img1_label}" />
										</div>
									</div>
									{preview_promotion_img1}
									<input type="hidden" id="promotion_img1_old_path" name="promotion_img1_old_path" value="" />
									<div style="clear:both"></div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 text-right">
								<input type="hidden" id="add_encrypt_id" />
								<a href="{page_url}" class="my-tooltip btn btn-Secondarying btn-md" data-toggle="tooltip">
									&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ยกเลิก &nbsp;&nbsp;
								</a>

								<button type="button" id="btnConfirmSave" class="btn btn-success" data-toggle="modal" data-target="#addModal">
									&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;
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
</div>


<!-- Modal Confirm Save -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addModalLabel">บันทึกข้อมูล</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-info">ยืนยันการบันทึกข้อมูล ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-Secondary" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ปิด &nbsp;&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSave">&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</div>