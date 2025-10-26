<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Page Title -->
	<title>Login</title>

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
	<link rel="stylesheet" href="<?php echo base_url('theme/common/styles.css') ?> ">
	<link rel="stylesheet" href="<?php echo base_url('theme/css/padding-margin.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url() . 'theme/css/font-awesome.min.css' ?>" />
	<link rel="stylesheet" href="<?php echo base_url() . 'theme/fonts/ion/ionicons.css' ?>" />
	<!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo base_url('theme/images/' . $icon); ?>">

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
				<div class="container relative">

					<div class="row">
						<div class="comments-heading text-center mb-30">
							<hgroup>
								<h2 class="font-face1 section-heading">LOGIN</h2>
							</hgroup>
						</div>
						<div class="col-md-8 col-md-offset-4">
							<!-- SECTION BLOG ITEM
								================================================== -->
							<div class="blog-item clearfix">
								<!--POST LEAVE COMMENT-->
								<div class="col-md-6">
									<div class="login-box">
										<p class="text-center m-t-md">Please login into your account.</p>
										<!-- Menampilkan pesan flash jika ada -->
										<?php if (isset($msg)): ?>
											<?= $msg; ?>
										<?php endif; ?> <form class="m-t-md" action="<?php echo site_url('backend/login/auth'); ?>" method="post">
											<div class="form-group">
												<input type="email" class="form-control" name="username" placeholder="Email" required>
											</div>
											<div class="form-group">
												<input type="password" class="form-control" name="password" placeholder="Password" required>
											</div>
											<button type="submit" class=" btn-success btn-block">Login</button>
										</form>
									</div>
								</div>
								<!--END POST LEAVE COMMENT-->

							</div>

						</div>
					</div>
				</div>
			</section>
		</main>


		<!-- FOOTER
				================================================== -->
		<?php echo $footer; ?>

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