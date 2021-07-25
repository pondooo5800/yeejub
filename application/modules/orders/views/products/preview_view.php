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
					<h4 class="card-title">รายละเอียดสินค้า</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover preview">
							<tbody>
								<tr>
									<td class="text-right fit"><b>รหัสสินค้า :</b></td>
									<td>{record_product_code}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ชื่อสินค้า ภาษาไทย :</b></td>
									<td>{record_product_name_th}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ชื่อสินค้า ภาษาอังกฤษ :</b></td>
									<td>{record_product_name_en}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>คำอธิบาย ภาษาไทย :</b></td>
									<td>{record_description_th}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>คำอธิบาย ภาษาอังกฤษ :</b></td>
									<td>{record_description_en}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>Keyword :</b></td>
									<td>{record_keyword}</td>
								</tr>

								<tr>
									<td class="text-right fit"><b>ราคา :</b></td>
									<td>{record_price}</td>
								</tr>

								<tr>
									<td class="text-right fit"><b>สถานะ :</b></td>
									<td>{preview_fag_allow}</td>
								</tr>

								<tr>
									<td class="text-right fit"><b>วันเวลาที่เพิ่ม :</b></td>
									<td>{record_datetime_add}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>รูปภาพสินค้าที่ 1 (รูปหลัก) :</b></td>
									<td>{preview_products_img1}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>รูปภาพสินค้าที่ 2 :</b></td>
									<td>{preview_products_img2}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>รูปภาพสินค้าที่ 3 :</b></td>
									<td>{preview_products_img3}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>รูปภาพสินค้าที่ 4 :</b></td>
									<td>{preview_products_img4}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>รูปภาพสินค้าที่ 5 :</b></td>
									<td>{preview_products_img5}</td>
								</tr>
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