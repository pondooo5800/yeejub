<div class="columns-container">
	<div class="container" id="columns">
		<!-- page heading-->
		<h2 class="page-heading"><span class="page-heading-title2">รายการสั่งซื้อสินค้าทั้งหมด</span></h2>
		<!-- ../page heading-->
		<div class="page-content page-order">
			<div class="order-detail-content" id="view_cart">
				<div class="table-responsive">
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
							<?php if (!empty($cartItems)) {
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
												<?php echo number_format($item["price"]) ?>
											</span>
										</td>

										<td class="product-quantity" style="text-align: center; vertical-align: middle;">
											<div class="button-container" style="align-items: center;justify-content: space-around;">
												<button class="cart-qty-minus" type="button" value="-">-</button>
												<input type="text" min="1" id="qty" name="qty" class="qty form-control" value="<?php echo $item["qty"]; ?>" />
												<input type="hidden" class="rowid form-control" value="<?php echo $item["id"]; ?>" />
												<button class="cart-qty-plus" type="button" value="+">+</button>
											</div>

										</td>
										<td class="product-subtotal" style="text-align: center; vertical-align: middle;">
											<a class="btn btn-sm btn-danger passingID" data-toggle="modal" data-target="#my_modal" data-row-id="<?php echo $item['id']; ?>"><i class="fa fa-trash"></i> </a>
										</td>
										<td class="price">
											<span class="subtotal-amount"><?php echo number_format($item["subtotal"]) ?></span>
										</td>
									</tr>
								<?php }
							} else { ?>
								<tr>
									<td colspan="6">
										<p style="text-align: center;">รถเข็นของคุณว่างเปล่า .....</p>
									</td>
								<?php } ?>
								<?php if (!empty($cartItems)) { ?>
						<tfoot>
							<tr>
								<td colspan="3" rowspan="4"></td>
								<td colspan="2">รวมเป็น :</td>
								<!-- <td colspan="2"><?php echo number_format($cartTotals); ?></td> -->
								<td colspan="2"><?php echo number_format($cartTotals); ?></td>
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
								<td colspan="2"><strong><label id="dc_price_total"><?php echo number_format($cartTotals) . ' ' . 'บาท' ?></label></strong></td>
							</tr>
						</tfoot>
					<?php } ?>

					</tbody>
					</table>
				</div>
				<div class="content-text clearfix">
					<form class="form-inline" method='post' action='<?php echo base_url('cart/checkout'); ?>'
						onsubmit="var b=this.querySelector('button[type=submit]'); if(b){ if(b.disabled){return false;} b.disabled=true; b.innerHTML='กำลังสั่งซื้อ กรุณารอสักครู่...'; } return true;">

						<div class="container">
							<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-6">
								<div class="form-group">
									<span style="font-size:16px;font-weight: bold;">เลือกที่อยู่/สาขาในการจัดส่ง</span>
								</div>
								<div class="form-group">
									<select style="width: 100%" class="form-control" name="member_addr">
										<?php
										$this->load->model('common_model');
										$rows = rowArray($this->common_model->custom_query("select member_addr from tb_members where member_id ='" . $this->session->userdata('member_id') . "' and fag_allow = 'allow'"));
										?>
										<option value="<?php echo $rows['member_addr'] ?>"><?php echo $rows['member_addr'] ?></option>
										<?php
										$branch = $this->common_model->custom_query("select * FROM tb_members_branch WHERE member_id =" . $this->session->userdata('member_id') . " and fag_allow = 'allow' ORDER BY member_branch_id ASC");
										foreach ($branch as $result) { ?>
											<option value="<?php echo $result['member_shop'] . ' ' . $result['member_addr']; ?>">
												<?php echo $result['member_shop']; ?> <?php echo $result['member_addr']; ?>
											</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
				</div>
				<hr>

				<div class="cart_navigation">
					<a class="prev-btn" href="{base_url}shop" style="background-color: #3366cc; color: #FFFFFF"> เลือกสินค้าอื่น เพิ่มเติม</a>
					<a class="next-btn" href="{base_url}index/member_branch" style="background-color: #3366cc; color: #FFFFFF"> เพิ่มสาขา</a>

				</div>
				<br><br><br>
				<br><br>
				<?php if (!empty($cartItems)) { ?>
					<h4 class="page-heading"><span class="page-heading-title2" style="font-weight: bold;color: red;font-size:20px">เงื่อนไขการสั่งซื้อสินค้า</span></h4>
					<div class="box-border">
						<div style="padding-left: 10%;padding-right: 10%;text-align: center;">
							<br><b><label style="font-size: 18px;">ร้านหยี่จั๊บ ขอขอบคุณทุกท่านที่ให้ความสนใจซื้อสินค้าของเรา</label></b>
							<br>
							<br>
							<div class="text-center" style="font-size: 15px;">
								<label class="required">
									- กรณีลูกค้าที่อยู่ต่างจังหวัดต้องมียอดสั่งซื้อตั้งแต่ 5,000 บาทขึ้นไปเราจะจัดการส่งสินค้าให้ทางขนส่ง (ลูกค้าเป็นผู้ชำระค่าขนส่งปลายทาง)
									<br>
									- ลูกค้าใน กรุงเทพฯ บริการส่งฟรี ขึ้นอยู่กับระยะทาง และยอดการสั่งซื้อสินค้า
									<br>
									- ติดต่อสอบถามข้อมูลเพิ่มเติม โทร. 088-025-8888 <br>
								</label>

							</div>
							<br>
						</div>
						<hr>
						<div class="cart_navigation text-center">
							<button type="submit" class="btn btn-success">
								&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i> &nbsp;สั่งซื้อสินค้า &nbsp;&nbsp;
							</button>
						</div>
					</div>

				<?php } ?>
				</form>
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
					<input type="hidden" class="form-control" name="rowId" id="rowId" value="">
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
	$(document).ready(function() {
		var plusBtn = $(".cart-qty-plus");
		var minusBtn = $(".cart-qty-minus");

		plusBtn.click(function() {
			var $n = $(this).siblings(".qty");
			$n.val(Number($n.val()) + 1);
			updateCartItem($n);
		});

		minusBtn.click(function() {
			var $n = $(this).siblings(".qty");
			var QtyVal = Number($n.val());
			if (QtyVal > 1) {
				$n.val(QtyVal - 1);
				updateCartItem($n);
			}
		});

		// Event listener for quantity input change
		$('.qty').change(function() {
			var $n = $(this);
			var currentQty = parseInt($n.val());
			if (!isNaN(currentQty) && currentQty > 0) {
				updateCartItem($n);
			} else {
				alert('โปรดกรอกจำนวนมากกว่า 0 ชิ้น');
				$n.val('1');
			}
		});

		// Update item quantity
		function updateCartItem($n) {
			var qty = $n.val();
			var rowid = $n.siblings('.rowid').val();
			console.log('Quantity: ' + qty);
			console.log('Row ID: ' + rowid);

			$.get("<?php echo base_url('cart/updateItemQty/'); ?>", {
				rowid: rowid,
				qty: qty
			}, function(resp) {
				if (resp == 'ok') {
					location.reload();
				} else {
					alert('โปรดกรอกจำนวนมากกว่า 1 ชิ้น');
					$n.val('1');
				}
			});
		}

		// Function to submit cart
		function cart_submit() {
			setTimeout(function() {
				window.location.replace('cart/checkout');
			}, 300);
		}
	});
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
	function removeCartItem() {
		var rowId = $('#rowId').val();
		window.location.replace('cart/removeItem/' + rowId);
	}
	$(".passingID").click(function() {
		var ids = $(this).attr('data-row-id');
		$("#rowId").val(ids);
		$('#my_Modal').modal('show');
	});
</script>
