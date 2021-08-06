<div class="columns-container">
	<div class="container" id="columns">
		<!-- page heading-->
		<h2 class="page-heading"><span class="page-heading-title2">รายการสั่งซื้อสินค้าทั้งหมด</span></h2>
		<!-- ../page heading-->
		<div class="page-content page-order">
			<div class="order-detail-content" id="view_cart">
				<table class="table table-bordered table-responsive cart_summary">
					<thead>
						<tr>
							<th class="cart_product" style="font-weight: bold;text-align: center; vertical-align: middle;">รูปสินค้า</th>
							<th style="font-weight: bold;text-align: center; vertical-align: middle;">ชื่อสินค้า</th>
							<th style="font-weight: bold;text-align: center; vertical-align: middle;width: 10%">ราคา</th>
							<th style="font-weight: bold;text-align: center; vertical-align: middle; width: 10%;">จำนวน</th>
							<th style="font-weight: bold;text-align: center; vertical-align: middle;"></th>
							<th style="font-weight: bold;text-align: right; vertical-align: middle;">รวมเป็น</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($this->cart->total_items() > 0) {
							foreach ($cartItems as $item) {    ?>
								<tr>
									<td class="cart_product" style="text-align: center; vertical-align: middle;">
										<img src="<?php echo $item["image"] ?>" alt="Image" />
									</td>
									<td class="cart_description">
										<p class="product-name"><?php echo $item["name"] ?></p>
									</td>
									<td class="price" style="text-align: center; vertical-align: middle;">
										<span>
											<?php echo $item["price"] ?>
										</span>
									</td>

									<td class="product-quantity" style="text-align: center; vertical-align: middle;">
										<div class="input-counter">
											<input type="number" min="1" id="qty" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')">
										</div>
									</td>
									<td class="product-subtotal" style="text-align: center; vertical-align: middle;">
										<a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#my_modal" data-row-id="<?php echo $item["rowid"] ?>"><i class="fa fa-trash"></i> </a>
									</td>
									<td class="price">
										<span class="subtotal-amount"><?php echo $item["subtotal"]; ?></span>
									</td>
								</tr>
							<?php }
						} else { ?>
							<tr>
								<td colspan="6">
									<p style="text-align: center;">รถเข็นของคุณว่างเปล่า .....</p>
								</td>
							<?php } ?>
							<?php if ($this->cart->total_items() > 0) { ?>
					<tfoot>
						<tr>
							<td colspan="3" rowspan="4"></td>
							<td colspan="2">รวมเป็น :</td>
							<td colspan="2"><?php echo $this->cart->total(); ?></td>
						</tr>
						<tr>
						</tr>
						<tr>
						</tr>
						<tr>
							<td colspan="2">ค่าจัดส่ง :</td>
							<td colspan="2"> 0 </td>
						</tr>
						<tr>
							<td colspan="3">
							</td>
							<td colspan="2"><strong>รวมทั้งสิ้น :</strong></td>
							<td colspan="2"><strong><label id="dc_price_total"><?php echo $this->cart->total() . ' ' . 'บาท' ?></label></strong></td>
						</tr>
					</tfoot>
				<?php } ?>

				</tbody>
				</table>
				<div class="cart_navigation">
					<a class="prev-btn" href="{base_url}shop" style="background-color: #3366cc; color: #FFFFFF"> เลือกสินค้าอื่น เพิ่มเติม</a>
				</div>
				<br><br><br>
				<br><br>
				<?php if ($this->cart->total_items() > 0) { ?>
					<h4 class="page-heading"><span class="page-heading-title2" style="font-weight: bold;color: red;font-size:20px">เงื่อนไขการสั่งซื้อสินค้า</span></h4>
				<div class="box-border">
					<div style="padding-left: 25px;padding-right: 25px;text-align: center;">
						<br><b><label style="font-size: 18px;">กรุณาสั่งซื้อสินค้าขั้นต่ำ 5,000 บาทขึ้นไป</label></b>
						<br>
						<br><b><label class="required"> Yeejub ขอขอบคุณทุกท่านที่ให้ความสนใจซื้อสินค้าของเรา
								สำหรับการสั่งซื้อสินค้าทางเราได้กำหนดยอดสั่งซื้อขั้นต่ำ 5,000 บาท
								โดยจะมีค่าขนส่ง 300 บาทสำหรับยอดสั่งซื้อไม่ถึง 10,000 บาท
								และฟรีค่าจัดส่งเมื่อสั่งซื้อสินค้าตั้งแต่ 10,000 บาทขึ้นไป</label></b>
						<br>
						<br>
						<label class="required"><input type="checkbox" id="checkboxDetermine">
							ยอมรับเงื่อนไข</label>
					</div>
					<hr>
					<div class="cart_navigation text-center">
						<button type="submit" id="checkboxConditioned" class="btn btn-success" onclick="cart_submit()">
							&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i> &nbsp;สั่งซื้อสินค้า &nbsp;&nbsp;
						</button>
					</div>
				</div>

				<?php } ?>
			</div>
		</div>
	</div>
</div>

<div class='modal fade' id='my_modal' tabindex='-1' role='dialog' aria-labelledby='delModalLabel' aria-hidden='true'>
	<div class='modal-dialog' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h4 class='modal-title' id='delModalLabel'>ยืนยันการลบรายการ</h4>
			</div>
			<div class='modal-body' style="text-align: center;">
				<p class="alert alert-danger">คุณต้องการลบรายการนี้ใช่หรือไม่ ?</p>
				<form id="formDelete">
					<input type="hidden" name="rowId" />
				</form>
			</div>
			<div class='modal-footer text-center'>
				<button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ปิด &nbsp;&nbsp;</button>&emsp;
				<button type="button" class="btn btn-danger" onclick="removeCartItem()" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-trash"></i> &nbsp;ลบ &nbsp;&nbsp;</button>&emsp;
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script>
	// Update item quantity
	function updateCartItem(obj, rowid) {
		$.get("<?php echo base_url('cart/updateItemQty/'); ?>", {
			rowid: rowid,
			qty: obj.value
		}, function(resp) {
			if (resp == 'ok') {
				location.reload();
			} else {
				alert('โปรดกรอกจำนวนมากกว่า 1 ชิ้น');
				document.getElementById('qty').value = '1'
			}
		});
	}
	function removeCartItem() {
		var fdata = $('#formDelete').serialize();
		var str = fdata.substring(6);
		window.location.replace('cart/removeItem/'+str);
	}
	function cart_submit()
	{
		setTimeout(function(){
			window.location.replace('cart/checkout');
		}, 1000);

	}
</script>
<script>
	// Get your checkbox who determine the condition
	var determine = document.getElementById("checkboxDetermine");
	// Make a function who disabled or enabled your conditioned checkbox
	var disableCheckboxConditioned = function() {
		if (determine.checked) {
			document.getElementById("checkboxConditioned").disabled = false;
			document.getElementById('checkboxConditioned').value = ''
		} else {
			document.getElementById("checkboxConditioned").disabled = true;
		}
	}
	// On click active your function
	determine.onclick = disableCheckboxConditioned;
	disableCheckboxConditioned();
</script>
<script>
	$(document).ready(function() {
		$('#my_modal').on('show.bs.modal', function(e) {
			var rowId = $(e.relatedTarget).data('row-id');
			$(e.currentTarget).find('input[name="rowId"]').val(rowId);
		});
	});
</script>
