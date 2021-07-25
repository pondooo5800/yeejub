        <div class="inner-banner bg-shape3 bg-color4">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="conatiner">
                        <div class="inner-title text-center">
                            <h3><?php echo lang('ch_h1'); ?></h3>
                            <ul>
                                <li>
								<a href="{base_url}index"><?php echo lang('nav_home'); ?></a>
                                </li>
                                <li>
                                    <i class="fas fa-chevron-right"></i>
                                </li>
                                <li>
                                    <?php echo lang('ch_h1'); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Checkout Area -->
		<section class="checkout-area pt-100 pb-70">
			<div class="container">
            <form  method="post">
					<div class="row">
						<div class="col-lg-6 col-md-12">
							<div class="billing-details">
								<h3 class="title"><?php echo lang('ch_h2'); ?></h3>

								<div class="row">
									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label><?php echo lang('ch_m1'); ?> <span class="required">*</span></label>
											<input type="text" class="form-control" name="name" value="<?php echo !empty($custData['name'])?$custData['name']:''; ?>" placeholder="<?php echo lang('ch_m2'); ?>" required>
                   	 						<?php echo form_error('name','<p class="help-block error">','</p>'); ?>
										</div>
									</div>

									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label><?php echo lang('ch_m3'); ?> <span class="required">*</span></label>
											<input type="email" class="form-control" name="email" value="<?php echo !empty($custData['email'])?$custData['email']:''; ?>" placeholder="<?php echo lang('ch_m4'); ?>" required>
                    						<?php echo form_error('email','<p class="help-block error">','</p>'); ?>
										</div>
									</div>

									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label><?php echo lang('ch_m5'); ?></label>
											<input type="text" class="form-control" name="phone" value="<?php echo !empty($custData['phone'])?$custData['phone']:''; ?>" placeholder="<?php echo lang('ch_m6'); ?>" required>
                   							 <?php echo form_error('phone','<p class="help-block error">','</p>'); ?>
										</div>
									</div>

									<div class="col-lg-12 col-md-6">
										<div class="form-group">
											<label><?php echo lang('ch_m7'); ?> <span class="required">*</span></label>
											<input type="text" class="form-control" name="address" value="<?php echo !empty($custData['address'])?$custData['address']:''; ?>" placeholder="<?php echo lang('ch_m8'); ?>" required>
                    						<?php echo form_error('address','<p class="help-block error">','</p>'); ?>
										</div>
									</div>

									<!-- <div class="col-lg-12 col-md-6">
										<div class="form-group">
											<label>Town / City <span class="required">*</span></label>
											<input type="text" class="form-control">
										</div>
									</div>

									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>State / County <span class="required">*</span></label>
											<input type="text" class="form-control">
										</div>
									</div>

									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Postcode / Zip <span class="required">*</span></label>
											<input type="text" class="form-control">
										</div>
									</div>

									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Email Address <span class="required">*</span></label>
											<input type="email" class="form-control">
										</div>
									</div>

									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Phone <span class="required">*</span></label>
											<input type="text" class="form-control">
										</div>
									</div> -->
                                <!--
									<div class="col-lg-12 col-md-12">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="create-an-account">
											<label class="form-check-label" for="create-an-account">Create an account?</label>
										</div>
									</div>

									<div class="col-lg-12 col-md-12">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="ship-different-address">
											<label class="form-check-label" for="ship-different-address">Ship to a different address?</label>
										</div>
									</div>
                                -->

									<!-- <div class="col-lg-12 col-md-12">
										<div class="form-group">
											<textarea name="notes" id="notes" cols="30" rows="5" placeholder="Order Notes" class="form-message"></textarea>
										</div>
									</div> -->
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-12">
							<div class="order-details">
								<div class="order-table table-responsive">
									<h3><?php echo lang('ch_h3'); ?></h3>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th scope="col"><?php echo lang('ch_m10'); ?></th>
												<th scope="col"><?php echo lang('ch_m11'); ?></th>
											</tr>
										</thead>
										<tbody>

                <?php if($this->cart->total_items() > 0){ foreach($cartItems as $item){ ?>
											<tr>
												<td class="product-name">
													<a><?php echo $item["name"]; ?></a>
													<small class="text-muted"><?php echo '฿'.$item["price"]; ?>(<?php echo $item["qty"]; ?>) <?php echo lang('cs_m9'); ?> (<?php echo $item["size"]; ?>)</small>
												</td>

												<td class="product-total">
													<span class="subtotal-amount"><?php echo '฿'.$item["price"]; ?> <?php echo lang('cs_m8'); ?></span>
												</td>
											</tr>

				<?php } }else{ ?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <p><?php echo lang('ch_m12'); ?></p>
                </li>
                <?php } ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span><?php echo lang('ch_m9'); ?></span>
                    <strong><?php echo '฿'.$this->cart->total(); ?></strong>
                </li>
				</tbody>

									</table>
									<br>
									<input class="btn btn-info btn-lg btn-block" type="submit" name="placeOrder" value="<?php echo lang('ch_m13'); ?>">

								</div>

								<!-- <div class="payment-box">
									<div class="payment-method">
										<p>
											<input type="radio" id="direct-bank-transfer" name="radio-group" checked>
											<label for="direct-bank-transfer">Direct Bank Transfer</label>
                                            Make your payment directly into our bank account. Please use your Order
                                            ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
										</p>
										<p>
											<input type="radio" id="paypal" name="radio-group">
											<label for="paypal">PayPal</label>
										</p>
										<p>
											<input type="radio" id="cash-on-delivery" name="radio-group">
											<label for="cash-on-delivery">Cash On Delivery</label>
										</p>
									</div>

									<input class="btn btn-info btn-lg btn-block" type="submit" name="placeOrder" value="Place Order">
								</div> -->
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
		<!-- Checkout Area End
