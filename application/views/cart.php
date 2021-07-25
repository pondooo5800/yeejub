        <!-- Inner Banner -->
        <div class="inner-banner bg-shape1 bg-color2">
        	<div class="d-table">
        		<div class="d-table-cell">
        			<div class="conatiner">
        				<div class="inner-title text-center">
        					<h3><?php echo lang('nav_shop_cart'); ?></h3>
        					<ul>
        						<li>
									<a href="{base_url}index"><?php echo lang('nav_home'); ?></a>
        						</li>
        						<li>
        							<i class="fas fa-chevron-right"></i>
        						</li>
        						<li>
        							<?php echo lang('nav_shop_cart'); ?>
        						</li>
        					</ul>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <!-- Inner Banner End -->

        <!-- Start Cart Area -->
        <section class="cart-area ptb-100">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-12 col-md-12">
        				<form>
        					<div class="cart-wraps">
        						<div class="cart-table table-responsive">
        							<table class="table table-bordered">
        								<thead>
        									<tr>
        										<th scope="col"><?php echo lang('cs_m1'); ?></th>
        										<th scope="col"><?php echo lang('cs_m2'); ?></th>
        										<th scope="col"><?php echo lang('cs_m9'); ?></th>
        										<th scope="col"><?php echo lang('cs_m3'); ?></th>
        										<th scope="col"><?php echo lang('cs_m4'); ?></th>
        										<th scope="col"><?php echo lang('cs_m5'); ?></th>
        									</tr>
        								</thead>

        								<tbody>
        									<?php if ($this->cart->total_items() > 0) {
												foreach ($cartItems as $item) {    ?>
        											<tr>
        												<td class="product-thumbnail">
        													<a href="#">
        														<?php $imageURL = !empty($item["image"]) ? base_url($item["image"]) : base_url('assets/images/pro-demo-img.jpeg'); ?>
        														<img src="<?php echo $imageURL; ?>" width="50" alt="Image" />
        													</a>
        												</td>

        												<td class="product-name">
        													<?php echo $item["name"]; ?>
        												</td>

        												<td class="product-size">
        													<?php echo $item["size"]; ?>
        												</td>

        												<td class="product-price">
        													<span class="unit-amount"><?php echo '฿' . $item["price"]; ?></span>
        												</td>

        												<td class="product-quantity">
        													<div class="input-counter">
        														<input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')">
        													</div>
        												</td>

        												<td class="product-subtotal">
        													<span class="subtotal-amount"><?php echo '$' . $item["subtotal"] . ' '. lang('cs_m8'); ?></span>
        														<a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete item?')?window.location.href='<?php echo base_url('cart/removeItem/' . $item["rowid"]); ?>':false;"><i class="fas fa-trash-alt"></i> </a>
														</td>

        											</tr>
        										<?php }
											} else { ?>
        										<tr>
        											<td colspan="6">
        												<p><?php echo lang('cs_m6'); ?></p>
        											</td>
        										<?php } ?>
        										<?php if ($this->cart->total_items() > 0) { ?>
        										<tr>
        											<td></td>
        											<td></td>
        											<td></td>
        											<td><strong><?php echo lang('cs_m7'); ?></strong></td>
        											<td class="text-right"><strong><?php echo '฿' . $this->cart->total() . ' '. lang('cs_m8'); ?></strong></td>
        											<td></td>
        										</tr>
        									<?php } ?>
        								</tbody>
        							</table>
        						</div>

        						<div class="cart-buttons">
        							<div class="row align-items-center">
        								<div class="col-lg-7 col-sm-7 col-md-7">
        									<div class="continue-shopping-box">
        										<a href="<?php echo base_url('shop'); ?>" class="default-btn1">
												<?php echo lang('cs_b1'); ?>
        										</a>
        									</div>
        								</div>

        								<div class="col-lg-5 col-sm-5 col-md-5 text-right">
        									<a href="{base_url}checkout" <?php echo ($this->cart->total_items() > 0) ? 'class="default-btn1"' : 'class="default-btn1 disabled"' ?> >
											<?php echo lang('cs_b2'); ?>
        									</a>
        								</div>
        							</div>
        						</div>
        					</div>

        					<!-- <div class="row">
        						<div class="col-lg-12">
        							<div class="cart-totals">
        								<h3>Cart Totals</h3>
        								<ul>
        									<li>Subtotal <span>$150.00</span></li>
        									<li>Shipping <span>$30.00</span></li>
        									<li>Coupon <span>$20.00</span></li>
        									<li>Total <span><b>$160.00</b></span></li>
        								</ul>
        								<a href="{site_url}checkout" class="default-btn1">
        									Proceed To Checkout
        								</a>
        							</div>
        						</div>
        					</div> -->
        				</form>
        			</div>
        		</div>
        	</div>
        </section>
		<!-- End Cart Area -->
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
        				alert('Cart update failed, please try again.');
        			}
        		});
        	}
        </script>