<script>
	var data_id = {data_id};
	var state = 'edit';
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
						<i class="material-icons">edit</i>
					</div>
					<h4 class="card-title">แก้ไขสาขา</h4>

				</div>
				<div class="card-body ">
					<form class="form-horizontal" id="formEdit" accept-charset="utf-8">
						{csrf_protection_field}
						<div class="container">
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4">
									<label class="control-label" for="member_shop">ชื่อร้าน :</label>
									<div class="form-group has-info">
										<input type="text" class="form-control" id="member_shop" name="member_shop" value="{record_member_shop}" />
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="member_addr">ที่อยู่ในการจัดส่งสินค้า :</label>
									<div class="form-group has-info">
										<textarea class="form-control" id="member_addr" name="member_addr" rows="3">{record_member_addr}</textarea>
									</div>
                                    <br>
								</div>
							</div>
						</div>
						<br>
						<input type="hidden" name="submit_case" value="edit" />
							<input type="hidden" class="input form-control" name="member_id" id="member_id" value="<?php echo $check_member_id?>">
                            <input type="hidden" name="encrypt_member_branch_id" value="{encrypt_member_branch_id}" />

						<div class="form-group">
							<div class="col-sm-12 text-right">
								<input type="hidden" id="add_encrypt_id" />
								<a href="{page_url}" class="my-tooltip btn btn-Secondarying btn-md" data-toggle="tooltip">
							&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ยกเลิก &nbsp;&nbsp;
						</a>

								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">
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
				<button type="button" class="btn btn-success" id="btnSaveEditฺBranchBackend">&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</div>