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
					<h4 class="card-title">เพิ่มรายการสินค้า</h4>

				</div>
				<div class="card-body ">
					<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
						{csrf_protection_field}
						<div class="container">
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="product_name">ชื่อสินค้า :</label>
									<div class="form-group has-info">
										<input type="text" class="form-control" id="product_name" name="product_name" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="product_type">ประเภทสินค้า :</label>
									<div class="form-group has-success">
										<select id="product_type" name="product_type" value="">
											<option value="">- เลือก ประเภทสินค้า -</option>
											{products_types_option_list}
										</select>
									</div>
								</div>

							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="price">ราคา :</label>
									<div class="form-group has-info">
										<input type="number" class="form-control" id="price" name="price"></input>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="product_unit_id">หน่วยสินค้า :</label>
									<select id="product_unit_id" name="product_unit_id" value="">
										<option value="">- เลือก หน่วยสินค้า -</option>
										{product_unit_id_option_list}
									</select>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="product_pro_id">โปรโมชั่นสินค้า :</label>
									<select id="product_pro_id" name="product_pro_id" value="">
										<option value="">- เลือก โปรโมชั่นสินค้า -</option>
										{product_pro_id_option_list}
									</select>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="banner_type">แบรนด์สินค้า :</label>
									<select id="banner_type" name="banner_type" value="">
										<option value="">- เลือก แบรนด์สินค้า -</option>
										{banner_type_option_list}
									</select>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="fag_allow">สถานะ :</label>
									<select id="fag_allow" name="fag_allow" value="">
										<option value="">- เลือก สถานะ -</option>
										<option value="allow">เผยแพร่</option>
										<option value="block">ไม่เผยแพร่</option>
									</select>
								</div>
								<div class="form-group col-md-4 ">
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="col-sm-12 col-md-10">
									<label class="control-label" for="product_img1">รูปภาพสินค้า :</label>
									<div class="upload-box">
										<div class="hold input-group">
											<span class="btn-file"> คลิกเพื่อแนบไฟล์
												<input type="file" id="product_img1" name="product_img1" data-elem-preview="product_img1_preview" data-elem-label="product_img1_label" />
											</span><input class="form-control" id="product_img1_label" name="product_img1_label" placeholder=" กรุณาเลือกไฟล์ที่ต้องการอัพโหลด" readonly="readonly" value="{record_product_img1_label}" />
										</div>
									</div>
									{preview_product_img1}
									<input type="hidden" id="product_img1_old_path" name="product_img1_old_path" value="" />
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