    <style>
    	.currency {
    		font-size: 1.2em;
    		text-align: center;
    		margin-bottom: 10px;
    	}

    	.user-info {
    		text-align: center;
    	}

    	.user-info img {
    		height: 30px;
    	}

    	.user-info p,
    	.user-info li {
    		display: inline-block;
    		margin: 0 10px;
    	}

    	.user-info li {
    		list-style-type: none;
    	}

    	.desktop-only {
    		display: none;
    	}

    	.mobile-only {
    		display: block;
    	}

    	@media (min-width: 768px) {
    		.desktop-only {
    			display: block;
    		}

    		.mobile-only {
    			display: none;
    		}
    	}
    </style>
    <div id="" class="header">
    	<!--/.top-header -->
    	<div class="top-header bg-light">
    		<div class="container">
    			<div class="currency">
    				เจ้แขก ถูกดี ส่งไว บริการถูกใจ
    			</div>
    			<div id="user-info-top" class="user-info pull-right">
    				<!-- Mobile view -->
    				<div class="mobile-only">
    					<a href="https://line.me/ti/p/~@yeejub" target="_blank">
    						<img border="0" alt="line" src="https://scdn.line-apps.com/n/line_add_friends/btn/en.png">
    					</a>
    					<p>Hi <?php echo ($this->session->userdata('member_fname')) ?></p>
    					<hr style="margin-bottom: 0;">
    					<li><a href="{site_url}index/member_index/<?php echo ($this->session->userdata('url_encrypt_id')) ?>">ข้อมูลบัญชี</a></li>
    					<li><a href="{site_url}member_login/destroy">ออกจากระบบ</a></li>
    				</div>
    				<!-- Desktop view -->
    				<div class="desktop-only">
    					<span>Hi <?php echo ($this->session->userdata('member_fname')) ?></span>
    					<li><a href="{site_url}index/member_index/<?php echo ($this->session->userdata('url_encrypt_id')) ?>">ข้อมูลบัญชี</a></li>
    					<li><a href="{site_url}member_login/destroy">ออกจากระบบ</a></li>

    				</div>
    			</div>
    		</div>
    	</div>
    	<!--/.top-header -->
    	<!-- MAIN HEADER -->
    	<div class="container main-header">
    		<div class="row">
    			<div class="col-xs-12 col-sm-3 col-md-3 logo">
    				<a href="{site_url}"><img class="img-logo" alt="Kute Shop" src="{base_url}/assets/themes/frontend/assets/img/icon/logo_yeejub.png"></a>
    			</div>
    			<div class="col-xs-7 col-sm-7 col-md-6 header-search-box">
    				<form class="form-inline" action="{site_url}shop/search" method="post">
    					<div class="form-group form-category">
    					</div>
    					<div class="form-group input-serach">
    						<input type="text" name="search" placeholder="ค้นหาสินค้า" value="<?php echo ($this->uri->segment(2) == "search" ? "{txt_search}" : "") ?>">
    					</div>
    					<button type="submit" class="pull-right btn-search"></button>
    				</form>
    			</div>
    			<div id="cart-block" class="col-xs-5 col-sm-2 col-md-3 shopping-cart-box">
    				<a class="cart-link" href="{site_url}cart">
    					<span class="title">ตะกร้าสินค้าของคุณ</span>
    					<?php
						$member_id = $this->session->userdata('member_id');
						$price_result = $this->common_model->custom_query("
						SELECT SUM(qty * price) as total
						FROM `product_cats`
						WHERE member_id = '$member_id'
					");
						$total_price = isset($price_result[0]['total']) ? $price_result[0]['total'] : 0;
						?>

    					<span class="total">ราคาทั้งหมด <span><?php echo number_format($total_price) . ' ' . 'บาท'; ?></span></span>
    				</a>
    			</div>
    		</div>

    	</div>
    	<!-- END MANIN HEADER -->
    	<div id="nav-top-menu" class="nav-top-menu">
    		<div class="container">
    			<div class="row fix_menu">
    				<div class="col-sm-3" id="box-vertical-megamenus">
    					<div class="box-vertical-megamenus" style="background: none; border: 0px">
    						<h4 class="title" style="background: none;  border: 0px">
    						</h4>
    					</div>
    				</div>
    				<div id="main-menu" class="col-sm-12 main-menu">
    					<nav class="navbar navbar-default">
    						<div class="container-fluid">
    							<div class="navbar-header">
    								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
    									<i class="fa fa-bars"></i>
    								</button>
    								<a class="navbar-brand" href="#">MENU</a>
    							</div>
    							<div id="navbar" class="navbar-collapse collapse">
    								<ul class="nav navbar-nav">
    									<li class="<?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'index') { ?>active<?php } ?>"><a href="{site_url}">หน้าแรก</a></li>
    									<li class="<?php if ($this->uri->segment(1) == 'shop') { ?>active<?php } ?>"><a href="{site_url}"><a href="{site_url}shop">สินค้าทั้งหมด</a></li>
    									<li class="<?php if ($this->uri->segment(1) == 'how_order') { ?>active<?php } ?>"><a href="{site_url}"><a href="{site_url}how_order">วิธีการสั่งซื้อ</a></li>
    									<li class="<?php if ($this->uri->segment(1) == 'how_payment') { ?>active<?php } ?>"><a href="{site_url}"><a href="{site_url}how_payment">วิธีการแจ้งชำระเงิน และการจัดส่ง</a></li>
    									<li class="<?php if ($this->uri->segment(1) == 'about') { ?>active<?php } ?>"><a href="{site_url}"><a href="{site_url}about">เกี่ยวกับเรา</a></li>
    									<li class="<?php if ($this->uri->segment(1) == 'contact') { ?>active<?php } ?>"><a href="{site_url}"><a href="{site_url}contact">ติดต่อเรา</a></li>
    								</ul>
    							</div>
    							<!--/.nav-collapse -->
    						</div>
    					</nav>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>