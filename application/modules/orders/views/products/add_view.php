<script>
	var num = {
		count_image
	};
	var data_id = {
		data_id
	};
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
							<div class="form-row justify-content-between">
								<div class="form-group col-md-6 ">
									<label class="control-label" for="product_code">รหัสสินค้า :</label>
									<div class="form-group has-info">
										<input type="text" class="form-control" id="product_code" name="product_code" value="" />
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6 ">
									<label class="control-label" for="product_name_th">ชื่อสินค้า ภาษาไทย :</label>
									<div class="form-group has-info">
										<input type="text" class="form-control" id="product_name_th" name="product_name_th" value="" />
									</div>
								</div>
								<div class="form-group col-md-6 ">
									<label class="control-label" for="description_th">คำอธิบาย ภาษาไทย :</label>
									<div class="form-group has-info">
										<input class="form-control" id="description_th" name="description_th"></input>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6 ">
									<label class="control-label" for="product_name_en">ชื่อสินค้า ภาษาอังกฤษ :</label>
									<div class="form-group has-info">
										<input type="text" class="form-control" id="product_name_en" name="product_name_en" value="" />
									</div>
								</div>
								<div class="form-group col-md-6 ">
									<label class="control-label" for="description_en">คำอธิบาย ภาษาอังกฤษ :</label>
									<div class="form-group has-info">
										<input class="form-control" id="description_en" name="description_en"></input>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6 ">
									<label class="control-label" for="keyword">Keyword :</label>
									<div class="form-group has-info">
										<input class="form-control input-tags" type="text" data-role="tagsinput" id="keyword" name="keyword">
										<!-- <input id="keyword" name="keyword" type="text" value="" data-role="tagsinput" /> -->
									</div>
								</div>
								<div class="form-group col-md-6 ">
									<label class="control-label" for="price">ราคา :</label>
									<div class="form-group has-info">
										<input type="number" class="form-control" id="price" name="price"></input>
									</div>
								</div>
							</div>
							<div class="row ">
								<div class="col-sm-12 col-md-6">
									<label class="control-label" for="product_img1">รูปภาพสินค้าที่ 1 (รูปหลัก) :</label>
									<div class="upload-box">
										<div class="hold input-group">
											<span class="btn-file"> คลิกเพื่อแนบไฟล์
												<input type="file" id="product_img1" name="product_img1" data-elem-preview="product_img1_preview" data-elem-label="product_img1_label" />
											</span><input class="form-control" id="product_img1_label" name="product_img1_label" placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด" readonly="readonly" value="{record_product_img1_label}" />
										</div>
									</div>
									{preview_product_img1}
									<input type="hidden" id="product_img1_old_path" name="product_img1_old_path" value="" />
									<div style="clear:both"></div>
								</div>

								<div class="col-sm-12 col-md-6">
									<label class="control-label" for="product_img2">รูปภาพสินค้าที่ 2 :</label>
									<div class="upload-box">
										<div class="hold input-group">
											<span class="btn-file"> คลิกเพื่อแนบไฟล์
												<input type="file" id="product_img2" name="product_img2" data-elem-preview="product_img2_preview" data-elem-label="product_img2_label" />
											</span><input class="form-control" id="product_img2_label" name="product_img2_label" placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด" readonly="readonly" value="{record_product_img2_label}" />
										</div>
									</div>
									{preview_product_img2}
									<input type="hidden" id="product_img2_old_path" name="product_img2_old_path" value="" />
									<div style="clear:both"></div>
								</div>
							</div>
							<div class="row ">
								<div class="col-sm-12 col-md-6">
									<label class="control-label" for="product_img3">รูปภาพสินค้าที่ 3 :</label>
									<div class="upload-box">
										<div class="hold input-group">
											<span class="btn-file"> คลิกเพื่อแนบไฟล์
												<input type="file" id="product_img3" name="product_img3" data-elem-preview="product_img3_preview" data-elem-label="product_img3_label" />
											</span><input class="form-control" id="product_img3_label" name="product_img3_label" placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด" readonly="readonly" value="{record_product_img3_label}" />
										</div>
									</div>
									{preview_product_img3}
									<input type="hidden" id="product_img3_old_path" name="product_img3_old_path" value="" />
									<div style="clear:both"></div>
								</div>

								<div class="col-sm-12 col-md-6">
									<label class="control-label" for="product_img4">รูปภาพสินค้าที่ 4 :</label>
									<div class="upload-box">
										<div class="hold input-group">
											<span class="btn-file"> คลิกเพื่อแนบไฟล์
												<input type="file" id="product_img4" name="product_img4" data-elem-preview="product_img4_preview" data-elem-label="product_img4_label" />
											</span><input class="form-control" id="product_img4_label" name="product_img4_label" placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด" readonly="readonly" value="{record_product_img4_label}" />
										</div>
									</div>
									{preview_product_img4}
									<input type="hidden" id="product_img4_old_path" name="product_img4_old_path" value="" />
									<div style="clear:both"></div>
								</div>
							</div>
							<div class="row ">
								<div class="col-sm-12 col-md-6">
									<label class="control-label" for="product_img5">รูปภาพสินค้าที่ 5 :</label>
									<div class="upload-box">
										<div class="hold input-group">
											<span class="btn-file"> คลิกเพื่อแนบไฟล์
												<input type="file" id="product_img5" name="product_img5" data-elem-preview="product_img5_preview" data-elem-label="product_img5_label" />
											</span><input class="form-control" id="product_img5_label" name="product_img5_label" placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด" readonly="readonly" value="{record_product_img5_label}" />
										</div>
									</div>
									{preview_product_img5}
									<input type="hidden" id="product_img5_old_path" name="product_img5_old_path" value="" />
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
				<button type="button" class="btn btn-Secondary" data-dismiss="modal">&nbsp;ปิด&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSave">&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>