<style>
	td.product a img {
    display: none;
    position: absolute;
    left: -80px;
    top: -80px;
	z-index:999;
}
td.product a {
    display: inline-block;
    position: relative;
}
td.product {
    margin-left: 100px;
}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-info card-header-icon">
					<div class="card-icon">
						<i class="material-icons">category</i>
					</div>
					<h4 class="card-title">สินค้า</h4>
				</div>
				<div class="card-body">
					<form class="form-horizontal" name="formSearch" method="post" action="{page_url}/search">
						{csrf_protection_field}
						<div class="row">
							<div class="col-sm-12">
								<div class="row justify-content-end">
									<div class="col-md-4">
										<div class="form-group bmd-form-group">
											<a href="#" data-toggle="modal" data-target="#add_img" class="btn btn-success" data-toggle="tooltip" title="เพิ่มข้อมูลใหม่" id="btn-search">
												<i class="fa fa-picture-o"></i></span>&nbsp;&nbsp;เพิ่มรูปภาพสินค้าหลายรายการ
											</a>
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="row align-items-center">
									<div class="col-md-2">
										<div class="form-group has-info bmd-form-group">
											<a href="{page_url}" id="btn-search" class="btn btn-success ">ทั้งหมด</a>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group has-warning bmd-form-group" id="search">
											<select class="select2-search" name="search_field" class="span2">
												<option value="product_code">รหัสสินค้า</option>
												<option value="product_name">ชื่อสินค้า</option>
												<option value="product_type_name">ประเภทสินค้า</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group has-info bmd-form-group">
											<input type="text" class="form-control col" id="txtSearch" name="txtSearch" value="{txt_search}">
										</div>
									</div>
									<input type="hidden" value="{order_by}" name="order_by" />
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<button type="submit" name="submit" class="btn btn-info" id="btn-search">
												<span class="glyphicon glyphicon-search"></span> ค้นหา
											</button>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<select class="select2-search" id="set_order_by" class="span2" value="{order_by}">
												<option value="">- จัดเรียงตาม -</option>
												<option value="product_id|asc">รหัสสินค้า เก่า - ใหม่</option>
												<option value="product_id|desc">รหัสสินค้า ใหม่ - เก่า</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<a href="{page_url}/add" class="btn btn-success" data-toggle="tooltip" title="เพิ่มข้อมูลใหม่" id="btn-search">
												<i class="fa fa-plus-square"></i></span>&nbsp;&nbsp;เพิ่มรายการ
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">รหัสสินค้า</th>
									<th class="text-center">ชื่อสินค้า</th>
									<th class="text-center">โปรโมชั่น</th>
									<th class="text-center">แบรนด์สินค้า</th>
									<th class="text-center">หน่วยสินค้า</th>
									<th class="text-center">ประเภทสินค้า</th>
									<th class="text-center">ราคา</th>
									<th class="text-center">สถานะ</th>
									<th class="text-center" style="width:200px">เครื่องมือ</th>
								</tr>
							</thead>
							<tbody>
								<tr parser-repeat="[data_list]" id="row_{record_number}">
									<td style="text-align:center;">{record_number}</td>
									<td class="product" style="text-align:left;">
										<a><img class="img-responsive" style="width:350px; height:350px; object-fit:contain" alt="product" src="{base_url}{product_img1}">{product_code}</a>
									</td>
									<td class="product" style="text-align:left;">
										<a><img class="img-responsive" style="width:350px; height:350px; object-fit:contain" alt="product" src="{base_url}{product_img1}">{product_name}</a>
									</td>
									<td style="text-align:center;">
										{record_promotion_name}
									</td>
									<td style="text-align:center;">{record_banner_name}</td>
									<td style="text-align:center;">{record_product_unit_name}</td>
									<td style="text-align:center;">{product_type_name}</td>
									<td style="text-align:center;">{price}</td>
									<td style="text-align:center;">{preview_fag_allow}</td>
									<td class="td-actions text-center">
										<a href="#" data-toggle="modal" data-target="#p_b_u" class="my-tooltip btn btn-secondarying btn-md" data-toggle="tooltip" title="ประเภท โปรโมชั่น แบรนด์ หน่วย" data-row-id='{
											"product_code":"{product_code}"
											,"record_product_id":"{record_product_id}"
											,"product_type":"{record_product_type}"
											,"banner_type":"{record_banner_type}"
											,"product_unit_id":"{record_product_unit_id}"
											,"product_pro_id":"{record_product_pro_id}"
											,"promotion_name":"{record_promotion_name}"
											,"banner_name":"{record_banner_name}"
											,"product_unit_name":"{record_product_unit_name}"
											,"product_type_name":"{product_type_name}"
										}'>
											<i class="material-icons">tune</i>
										</a>

										<a href="{page_url}/preview/{url_encrypt_id}" class="my-tooltip btn btn-info btn-md" data-toggle="tooltip" title="แสดงข้อมูลรายละเอียด">
											<i class="material-icons">list</i>
										</a>
										<a href="{page_url}/edit/{url_encrypt_id}" class="my-tooltip btn btn-warning " data-toggle="tooltip" title="แก้ไขข้อมูล">
											<i class="material-icons">edit</i>
										</a>
										<a href="javascript:void(0);" class="btn-delete-row my-tooltip btn btn-danger" data-toggle="tooltip" title="ลบรายการนี้" data-product_id="{encrypt_product_id}" data-row-number="{record_number}">
											<i class="material-icons">delete_forever</i>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="row dataTables_wrapper">
						<div class="col-sm-12 col-md-5">
							<div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
								แสดงรายการที่ <b>{start_row}</b> ถึง <b>{end_row}</b> จากทั้งหมด <span class="badge badge-info"> {search_row}</span> รายการ
							</div>
						</div>
						<div class="col-sm-12 col-md-7">
							<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
								{pagination_link}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Delete -->
<div class="modal fade" id="confirmDelModal" tabindex="-1" role="dialog" aria-labelledby="confirmDelModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="confirmDelModalLabel">ยืนยันการลบข้อมูล !</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
				<h4 style="font-weight: bold" class="text-center">* ท่านต้องการลบข้อมูลใช่หรือไม่ *</h4>
				<form id="formDelete">
					<input type="hidden" name="encrypt_product_id" />
				</form>
			</div>
			<div class="modal-footer" style="justify-content: center;">
				<button type="button" class="btn btn-Secondary" data-dismiss="modal">&nbsp;ยกเลิก&nbsp;</button>&emsp;
				<button type="button" class="btn btn-danger" id="btn_confirm_delete">&nbsp;ยืนยัน&nbsp;</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_img" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" onClick="window.location.reload();" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					เพิ่มรูปภาพสินค้าหลายรายการ
				</h4>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">
				<br>
				<div class="container"">
						<div class=" form-row justify-content-center">
					<input type="file" name="files" id="files" multiple />
					<div id="uploaded_images"></div>

				</div>
			</div>
			<br>
		</div>
		<div class="modal-footer" style="justify-content: center;">
			<button onClick="window.location.reload();" type="button" class="btn btn-success  " data-dismiss="modal">
				ตกลง
			</button>
		</div>

	</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPreview" tabindex="-1" role="dialog" aria-labelledby="modalPreviewLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">ปิด</span></button>
				<h4 class="modal-title" id="modalPreviewLabel">แสดงข้อมูล</h4>
			</div>
			<div class="modal-body">
				<div id="divPreview"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-Secondary" data-dismiss="modal">ปิด</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id='p_b_u' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="text_product_code">
				</h4>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">

				<form class="form-horizontal" role="form">
					<p style="font-size: 16px; text-align: center;">
						แก้ไขโปรโมชั่น แบรนด์ หน่วย ประเภท
					</p>

					<div class="container"">
						<div class=" form-row justify-content-around">
						<div class="form-group col-md-6 ">
							<label style="font-weight: bold;" class="control-label" for="product_pro_id" id="text_promotion_name"></label>
							<select id="product_pro_id" class="product_pro_id" name="product_pro_id" value="">
								<option value="">- เลือก โปรโมชั่นสินค้า -</option>
								{product_pro_id_option_list}
							</select>
						</div>
						<div class="form-group col-md-6 ">
							<label style="font-weight: bold;" class="control-label" for="banner_type" id="text_banner_type"></label>
							<select id="banner_type" class="banner_type" name="banner_type" value="">
								<option value="">- เลือก แบรนด์สินค้า -</option>
								{banner_type_option_list}
							</select>
						</div>
					</div>
					<div class="form-row justify-content-around">
						<div class="form-group col-md-6">
							<label style="font-weight: bold;" class="control-label" for="product_unit_id" id="text_product_unit_id"></label>
							<select id="product_unit_id" class="product_unit_id" name="product_unit_id" value="">
								<option value="">- เลือก หน่วยสินค้า -</option>
								{product_unit_id_option_list}
							</select>
						</div>
						<div class="form-group col-md-6">
							<label style="font-weight: bold;" class="control-label" for="product_type" id="text_product_type"></label>
							<select id="product_type" class="product_type" name="product_type">
								<option value="">- เลือก ประเภทสินค้า -</option>
								{products_types_option_list}
							</select>
						</div>
					</div>
			</div>
			</form>

		</div>

		<!-- Modal Footer -->
		<div class="modal-footer" style="justify-content: center;">
			<button onClick="window.location.reload();" type="button" class="btn btn-success  " data-dismiss="modal">
				ตกลง
			</button>
		</div>
	</div>
</div>
</div>
<script>
	var param_search_field = '{search_field}';
	var param_current_page = '{current_page_offset}';
</script>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>

<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function () {
    $(".product a").mouseover(function () {
        $(".product a img").css("display", "none"); // hide all product images
        $(this).find("img").css("display", "inline-block"); // show current hover image
    })
    $(".product a").mouseout(function () {
        $(".product a img").css("display", "none"); // hide all product images
    })
});
</script>
