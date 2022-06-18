<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/home.ico"/> 
	<title>HCMG | Home</title>

	<!-- Loading third party fonts -->
	<link href="http://fonts.googleapis.com/css?family=Roboto:100,300,400,700|" rel="stylesheet" type="text/css">
	<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="fonts/lineo-icon/style.css" rel="stylesheet" type="text/css">

	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" href="style.css">
</head>

<body class="slider-collapse" style="background-color: rgb(7, 30, 61);">
	<div id="site-content">
		<!-- header -->
		<div class="site-header">
			<div class="container">
				<a class="nav-home" id="branding">
					<img src="dummy/Logo.png" alt="" class="logo">
					<div class="logo-text">
						<h1 class="site-title">HCMG</h1>
						<small class="site-description">Ho Chi Minh Gaming laptop store</small>
					</div>
				</a> <!-- #branding -->

				<div class="right-section pull-right">
                    <div class="panel-user hidden">
                        <a href="cart.php" class="cart"><i class="icon-cart"></i> <span id="itemsInCart"></span> items in cart</a>
                        <a href="user-setting.php"><span class="icon-knight" data-placeholder="&#xe82a;"></span> <?php echo $_SESSION['User_name'];?></a>
                        <a href="#" class="btn-logOut">Logout</a>
						<span id="locator"></span>
                    </div>
                    <div class="panel-guest">
                        <a href="sign-in.php" class="login-button">Sign in</a>
                        <a href="sign-up.php" class="login-button">Sign up</a>
                    </div>
				</div> <!-- .right-section -->

				<div class="main-navigation">
					<button class="toggle-menu"><i class="fa fa-bars"></i></button>
					<ul class="menu">
						<li class="menu-item home current-menu-item nav-home"><a href="#"><i class="icon-home"></i></a>
						</li>
						<li class="menu-item"><a href="products.php">PC Game</a></li>
						<li class="menu-item"><a href="coming-soon.php">Game News</a></li>
						<li class="menu-item"><a href="coming-soon.php">Refund</a></li>
						<li class="menu-item"><a href="about-us.php">About us</a></li>
					</ul> <!-- .menu -->
					<div class="mobile-navigation"></div> <!-- .mobile-navigation -->
				</div> <!-- .main-navigation -->
			</div> <!-- .container -->
		</div> <!-- .site-header -->

		<!-- home slider -->
		<div class="home-slider">
			<ul class="slides">
			</ul> <!-- .slides -->
		</div> <!-- .home-slider -->

		<!-- main content -->
		<main class="main-content">
			<div class="container">
				<div class="page">
					<!-- New product -->
					<section id="sec_newProd">
						<header>
							<h2 class="section-title">New Products</h2>
							<a href="products.php" class="all">Show All</a>
						</header>

						<div class="product-list"></div>
					</section>

					
					<!-- Library -->
					<section id="sec_userLib">
						<header>
							<h2 class="section-title">Library</h2>
							<a href="user-setting.php#sec_fullLib" class="all hidden">Show All</a>
						</header>

						<div class="product-list">
							<div id="lib_asGuest">
								<h3 class="noti">SIGN IN TO VIEW</h3>
							</div>
							<div id="empty_lib" class="hidden">
								<h3 class="noti">EMPTY</h3>
							</div>
							<div id="lib_asUser" class="hidden"></div>
						</div> <!-- .product-list -->

					</section>
				</div>
			</div> <!-- .container -->
		</main> <!-- .main-content -->

		<div class="site-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<div class="widget">
							<h3 class="widget-title">Games</h3>
							<ul class="no-bullet">
								<li><a href="products.php">PC Game</a></li>
								<li><a href="coming-soon.php">Game News</a></li>
							</ul>
						</div> <!-- .widget -->
					</div> <!-- column -->
					<div class="col-md-2">
						<div class="widget">
							<h3 class="widget-title">Service</h3>
							<ul class="no-bullet">
								<li><a href="coming-soon.php">Refund</a></li>
								<li><a href="about-us.php">About us</a></li>
							</ul>
						</div> <!-- .widget -->
					</div> <!-- column -->
					<div class="col-md-2">
						<div class="widget">
							<h3 class="widget-title">My Account</h3>
							<ul class="no-bullet">
								<div class="panel-user hidden">
									<li><a href="user-setting.php">Setting</li>
									<li><a href="cart.php">Cart</a></li>
									<li><a href="#" class="btn-logOut">Logout</a></li>
								</div>
								<div class="panel-guest">
									<li><a href="sign-in.php">Sign in</li>
									<li><a href="sign-up.php">Sign up</a></li>
								</div>
							</ul>
						</div> <!-- .widget -->
					</div> <!-- column -->
				</div><!-- .row -->
				<div class="copy">Copyright &copy; 2022 HCMG. All rights reserved.</div>
			</div> <!-- .container -->
		</div> <!-- .site-footer -->
	</div>

	<!-- Assign $_SESSION var to js var -->
	<script type="text/javascript"> 
		var userId = "<?php echo isset($_SESSION['User_id']) ? $_SESSION['User_id'] : null; ?>";
		var isLogged = "<?php echo isset($_SESSION['isLogged']) ? $_SESSION['isLogged'] : null; ?>";
		var site_home = true, site_prod = false, site_cart = false, site_user = false;
	</script>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="js/plugins.js"></script>
	<script src="js/app.js"></script>
	<script src="js/function.js"></script>
</body>
</html>