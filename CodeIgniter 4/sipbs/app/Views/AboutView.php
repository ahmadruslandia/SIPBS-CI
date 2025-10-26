<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Page Title -->
	<title>Tentang</title>

	<!-- Page header -->
	<meta charset="utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width" />
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url('theme/css/bootstrap.min.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('theme/css/style.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('theme/css/padding-margin.css') ?>" />
	<!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo base_url('theme/images/' . $icon); ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'theme/css/font-awesome.min.css' ?>" />

</head>

<body class="content-animate">

	<!-- PRELOADER
		==================================================-->
	<div class="page-loader">
		<div class="loader-area"></div>
		<div class="loader font-face1">loading...
		</div>
	</div>

	<!-- PAGE
		==================================================-->
	<div id="top" class="page">

		<!-- Navigation panel
			================================================== -->
		<?php echo $header; ?>
		<!-- End Navigation panel -->

		<!-- Main Content
			==================================================-->
		<main class="cd-main-content mt-100">



			<!-- SECTION ABOUT
				================================================== 	-->
			<section class="page-section small-section">
				<div class="shadow-title shadow-gray unselectable parallax-1">Tentang</div>
				<div class="container relative">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 mb-10 mb-sm-40 text-center">
							<h2 class="font-face1 section-heading fw800 mt-0 text-center">Tentang</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<!-- SECTION BLOG ITEM
								================================================== -->
							<div class="blog-item clearfix">

								<img src="<?php echo base_url() . 'theme/images/' . $about_img; ?>">

							</div>

						</div>

						<div class="col-md-6">
							<!-- SECTION BLOG ITEM
								================================================== -->
							<div class="blog-item clearfix">
								<?php echo $about_desc; ?>
							</div>

						</div>
					</div>
				</div>
			</section>


			<hr class="nomargin nopadding" />

			<!-- FOOTER
				================================================== -->
			<?php echo $footer; ?>

		</main>

	</div>



	<!-- JAVASCRIPT
		==================================================-->
	<script src="<?php echo base_url('theme/js/jquery-2.2.4.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/jquery.easing.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/waypoints.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/jquery.scrollTo.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/jquery.localScroll.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/jquery.viewport.mini.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/jquery.sticky.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/jquery.fitvids.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/jquery.parallax-1.1.3.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/isotope.pkgd.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/imagesloaded.pkgd.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/masonry.pkgd.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/jquery.magnific-popup.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/jquery.counterup.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/slick.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/wow.min.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/script.js') ?>"></script>
	<script src="<?php echo base_url('theme/js/jssocials.min.js') ?>"></script>

</body>

</html>