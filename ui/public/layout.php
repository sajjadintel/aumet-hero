<?php
ob_start("compress_htmlcode");
function compress_htmlcode($codedata)
{
    $searchdata = array(
        '/\>[^\S ]+/s', // remove whitespaces after tags
        '/[^\S ]+\</s', // remove whitespaces before tags
        '/(\s)+/s' // remove multiple whitespace sequences
    );
    $replacedata = array('>', '<', '\\1');
    $codedata = preg_replace($searchdata, $replacedata, $codedata);
    return $codedata;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'head.php'?>
</head>

<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-align="left" data-mobile-nav-style="modern"
	data-mobile-nav-shceme="gray" data-mobile-header-scheme="gray" data-mobile-nav-breakpoint="1199">

	<div id="wrap">
		<header class="main-header main-header-overlay bg-white" data-react-to-megamenu="true" data-sticky-header="true"
			data-sticky-options='{ "stickyTrigger": "first-section" }'>

			<div class="mainbar-wrap">
				<div class="megamenu-hover-bg"></div><!-- /.megamenu-hover-bg -->
				<div class="container-fluid mainbar-container">
					<div class="mainbar">
						<div class="row mainbar-row align-items-lg-stretch px-4">

							<div class="col">
								<div class="navbar-header">
									<a class="navbar-brand" href="/en" rel="home">
										<span class="navbar-brand-inner">
											<img class="logo-dark" src="/assets/public/img/logo.svg" alt="Aumet ">
											<img class="logo-sticky" src="/assets/public/img/logo.svg" alt="Aumet ">
											<img class="mobile-logo-default" src="/assets/public/img/logo.svg" alt="Aumet ">
											<img class="logo-default" src="/assets/public/img/logo.svg" alt="Aumet ">
										</span>
									</a>
									<button type="button" class="navbar-toggle collapsed nav-trigger style-mobile"
										data-toggle="collapse" data-target="#main-header-collapse" aria-expanded="false"
										data-changeclassnames='{ "html": "mobile-nav-activated overflow-hidden" }'>
										<span class="sr-only">Toggle navigation</span>
										<span class="bars">
											<span class="bar"></span>
											<span class="bar"></span>
											<span class="bar"></span>
										</span>
									</button>
								</div><!-- /.navbar-header -->
							</div><!-- /.col -->

							<div class="col vc_col-sm-4 text-right text-lg-right">

								<?php include_once 'menu.php'; ?>
							</div><!-- /.col -->

						</div><!-- /.mainbar-row -->
					</div><!-- /.mainbar -->
				</div><!-- /.mainbar-container -->
			</div><!-- /.mainbar-wrap -->

		</header><!-- /.main-header -->

        <?php include_once "$pageCodeName.php"; ?>

		<?php include_once 'footer.php'?>

	</div><!-- /#wrap -->

	<script src="/assets/public/vendors/jquery.min.js"></script>
	<script src="/assets/public/js/theme-vendors.js"></script>
	<script src="/assets/public/js/theme.min.js" ></script>

</body>

</html>
<?php ob_end_flush(); ?>