<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="expires" content="never" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>YeeJub | ร้านหยี่จั๊บทุกอย่าง 20 บาท</title>
	<meta name="keywords" content="YeeJub, ร้านหยี่จั๊บทุกอย่าง 20 บาท" />
	<link rel="shortcut icon" type="image/png" href="{base_url}assets/themes/frontend/assets/img/favicon_io/favicon.png" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/select2/css/select2.min.css" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/jquery.bxslider/jquery.bxslider.css" />
	<!-- <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/owl.carousel/owl.carousel.css" /> -->
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/jquery-ui/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/animate.css" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/style.css" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/cart.css" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/responsive.css" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/fancyBox/jquery.fancybox.css" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/fancybox.css" />

	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"> -->

	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/owl.carousel2/owl.carousel.min.css" />
	<link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/owl.carousel2/owl.theme.default.min.css" />

	<style type="text/css">
		* {
			font-family: 'Sarabun', sans-serif;
		}

		.carousel-wrapper {
			width: 1000px;
			margin: auto;
			position: relative;
			text-align: center;
			font-family: sans-serif;
		}

		.owl-carousel .owl-nav {
			overflow: hidden;
			height: 0px;
		}

		.owl-theme .owl-dots .owl-dot.active span,
		.owl-theme .owl-dots .owl-dot:hover span {
			background: #5110e9;
		}


		.owl-carousel .item {
			text-align: center;
		}

		.owl-carousel .nav-button {
			height: 50px;
			width: 25px;
			cursor: pointer;
			position: absolute;
			top: 110px !important;
		}

		.owl-carousel .owl-prev.disabled,
		.owl-carousel .owl-next.disabled {
			pointer-events: none;
			opacity: 0.25;
		}

		.owl-carousel .owl-prev {
			left: -55px;
		}

		.owl-carousel .owl-next {
			right: -35px;
		}

		.owl-theme .owl-nav [class*=owl-] {
			color: #ffffff;
			font-size: 30px;
			background: #3466CB;
			border-radius: 3px;
			margin-top: 100px;
		}

		.owl-carousel .prev-carousel:hover {
			background-position: 0px -53px;
		}

		.owl-carousel .next-carousel:hover {
			background-position: -24px -53px;
		}

		/* preloader */
		.body_load {
			position: fixed;
			z-index: 888888;
			background: transparent;
			backdrop-filter: blur(6px);
			-webkit-backdrop-filter: blur(6px);
			width: 100%;
			height: 100%;
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 100vh;
			text-align: center;
		}

		.container_load {
			position: relative;
			width: 100%;
			display: flex;
			justify-content: center;
		}

		.wrapper {
			position: absolute;
			top: -35px;
			transform: scale(1.5);
		}

		.loader {
			height: 25px;
			width: 1px;
			position: absolute;
			animation: rotate 3.5s linear infinite;
			background: #fff;


		}

		.loader .dot {
			top: 30px;
			height: 7px;
			width: 7px;
			background: #fff;
			border-radius: 50%;
			position: relative;
		}

		.text {
			position: absolute;
			bottom: -85px;
			font-size: 25px;
			font-weight: bold;
			color: #fff;
			text-transform: uppercase;
			text-shadow: 0 0 10px #000;

		}

		@keyframes rotate {
			30% {
				transform: rotate(220deg);
			}

			40% {
				transform: rotate(450deg);
				opacity: 1;
			}

			75% {
				transform: rotate(720deg);
				opacity: 1;
			}

			76% {
				opacity: 0;
			}

			100% {
				opacity: 0;
				transform: rotate(0deg);
			}
		}

		.loader:nth-child(1) {
			animation-delay: 0.15s;
		}

		.loader:nth-child(2) {
			animation-delay: 0.3s;
		}

		.loader:nth-child(3) {
			animation-delay: 0.45s;
		}

		.loader:nth-child(4) {
			animation-delay: 0.6s;
		}

		.loader:nth-child(5) {
			animation-delay: 0.75s;
		}

		.loader:nth-child(6) {
			animation-delay: 0.9s;
		}
	</style>
	{another_css}
	<script>
		var baseURL = '{base_url}/';
		var siteURL = '{site_url}/';
		var csrf_token_name = '{csrf_token_name}';
		var csrf_cookie_name = '{csrf_cookie_name}';
	</script>
</head>

<body class="home">
	<?php
	$this->load->model('common_model');
	$popup = $this->common_model->custom_query("SELECT `tb_popups`.* FROM`tb_popups` WHERE `tb_popups`.`fag_allow` = 'allow' ORDER BY `tb_popups`.`datetime_update` DESC LIMIT 1");
	?>

	<?php
	if ($this->uri->segment(1) == '') { ?>
		<?php foreach (@$popup as $value) { ?>
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-exclamation-circle"></i>&nbsp; <? echo $value['popup_name'] ?> </h4>
						</div>
						<div class="modal-body">
							<img class="img-responsive center-block" src="<?php echo base_url($value['popup_img1']); ?>">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
						</div>
					</div>

				</div>
			</div>
		<?php } ?>
	<?php }
	?>



	<div class="body_load">
		<div class="container_load">
			<div class="wrapper">
				<div class="loader">
					<div class="dot"></div>
				</div>
				<div class="loader">
					<div class="dot"></div>
				</div>
				<div class="loader">
					<div class="dot"></div>
				</div>
				<div class="loader">
					<div class="dot"></div>
				</div>
				<div class="loader">
					<div class="dot"></div>
				</div>
				<div class="loader">
					<div class="dot"></div>
				</div>
			</div>
			<div class="text">
				รอสักครู่
			</div>
		</div>
	</div>

	<?php
	$member_id = $this->session->userdata('member_id');
	$qty = $this->common_model->custom_query("SELECT SUM(qty) as total FROM `product_cats` WHERE member_id = $member_id");
	$total_qty = isset($qty[0]['total']) ? $qty[0]['total'] : 0;
	?>

	<a href="{site_url}cart">
		<div class="br-icon">
			<span class="notify notify-left cartcount"><?php echo $total_qty; ?></span>
		</div>
	</a>

	<!-- HEADER -->
	{page_header}
	<!-- END HEADER -->

	<!-- CONTENT -->
	{page_content}
	<!-- END CONTENT -->

	<!-- Footer -->
	{page_footer}
	<!-- END Footer -->

	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/js/fancybox.umd.js"></script>
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/select2/js/select2.min.js"></script>
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
	<!-- <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/owl.carousel/owl.carousel.min.js"></script> -->
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery.countdown/jquery.countdown.min.js"></script>
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/js/jquery.actual.min.js"></script>
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/js/theme-script.js"></script>
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery.elevatezoom.js"></script>
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/fancyBox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="{base_url}assets/js/jquery.cookie.min.js"></script>
	<script type="text/javascript" src="{base_url}assets/js/ci_utilities.js?ver=1541805506"></script>
	<script src="{base_url}assets/bootstrap_extras/bootstrap-notify.min.js"></script>
	<script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/owl.carousel2/owl.carousel.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->
	<script>
		setTimeout(function() {
			$('.body_load').fadeToggle();
		});
		$('.product-list').owlCarousel({
			items: 4,
			lazyLoad: true,
			loop: true,
			margin: 15,
			nav: true,
			dots: false,
			navText: ["<div class='nav-button owl-prev'>‹</div>", "<div class='nav-button owl-next'>›</div>"],
			responsive: {
				"0": {
					"items": 1
				},
				"600": {
					"items": 3
				},
				"1000": {
					"items": 4
				}
			}
		});
		$(window).on('load', function() {
			$('#myModal').modal('show');
		});

		$('#owl-two').owlCarousel({
			loop: true,
			margin: 10,
			autoplay: true,
			autoplayTimeout: 2000,
			autoplayHoverPause: true,
			responsiveClass: true,
			dots: false,
			responsive: {
				0: {
					items: 1,
					nav: true,
					loop: true

				},
				600: {
					items: 4,
					nav: false,
					loop: true
				},
				1000: {
					items: 6,
					nav: false,
					loop: false
				}
			}
		});
	</script>
	{another_js}
</body>

</html>
