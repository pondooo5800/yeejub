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
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-info card-header-text">
					<div class="card-icon">
						<i class="material-icons">note_add</i>
					</div>
					<h4 class="card-title">ตั้งค่าลำดับแสดงผล <span style="color: red;font-size: small;">(กรุณา เลือกลำดับการแสดงผลให้ครบทุกช่อง)</span></h4>

				</div>
				<div class="card-body ">
					<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
						{csrf_protection_field}

						<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class="text-center"style="width:10%"></th>
									<th class="text-center"style="width:20%">ชื่อหมวดหมู่สินค้า</th>
									<th class="text-center"style="width:20%">ลำดับ</th>
									<th class="text-center"style="width:10%"></th>

								</tr>
							</thead>
							<tbody>
							<?php
                                    foreach ($dis as $key => $value) { ?>
								<tr>
									<td style="text-align:center;"></td>
									<td style="text-align:center;">
									<?php echo $value['product_type_name'] ?>
									<input type="hidden" class="form-control" name="product_type_name[]" value="<?php echo $value['product_type_name'] ?>" />
									<input type="hidden" class="form-control" name="product_type_id[]" value="<?php echo $value['product_type_id'] ?>" />
</td>
									<td style="text-align:center;">
									<select style="text-align:center;" class="form-control" name="product_type_sort[] ?>">
											<option value=" ">- เลือก ลำดับ -</option>
											<!-- <option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option> -->
											<?php
                                    foreach ($dis_row as $key => $value) { ?>
											<option value="<?php echo $value['product_type_id'] ?>"><?php echo $value['product_type_id'] ?></option>
											<?php } ?>

									</select>

									</td>
									<td style="text-align:center;"></td>
								</tr>
								<?php } ?>

							</tbody>
						</table>
					</div>

						<br>
						<hr>
						<div class="form-group">
							<div class="col-sm-12 text-right">
								<input type="hidden" id="add_encrypt_id" />
								<a href="{page_url}" class="my-tooltip btn btn-Secondarying btn-md" data-toggle="tooltip">
							&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ยกเลิก &nbsp;&nbsp;
						</a>

								<button type="button" id="btnConfirmSaveDis" class="btn btn-success" data-toggle="modal" data-target="#addModal">
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
				<button type="button" class="btn btn-success" id="btnSaveDis">&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</div>