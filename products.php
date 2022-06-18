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
	<link rel="icon" type="image/png" href="images/icons/single.ico"/> 
	<title>HCMG | PC Games</title>

	<!-- Loading third party fonts -->
	<link href="http://fonts.googleapis.com/css?family=Roboto:100,300,400,700|" rel="stylesheet" type="text/css">
	<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="fonts/lineo-icon/style.css" rel="stylesheet" type="text/css">

	<!-- Loading main css file -->
	<link rel="stylesheet" href="style.css">


	<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

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
						<li class="menu-item home nav-home"><a href="#"><i class="icon-home"></i></a>
						</li>
						<li class="menu-item current-menu-item"><a href="products.php">PC Game</a></li>
						<li class="menu-item"><a href="coming-soon.php">Game News</a></li>
						<li class="menu-item"><a href="coming-soon.php">Refund</a></li>
						<li class="menu-item"><a href="about-us.php">About us</a></li>
					</ul> <!-- .menu -->
					<div class="mobile-navigation"></div> <!-- .mobile-navigation -->
				</div> <!-- .main-navigation -->
			</div> <!-- .container -->
		</div> <!-- .site-header -->

		<main class="main-content">
			<div class="container">
				<div class="page">
					<div class="filter-bar">
						<div class="filter">
							<span>
								<label style="color:white;"><strong>Show:</strong></label>
								<select id="itemsPerPage" name="#" style="border-radius: 3px">
									<!-- <option value="1">1</option>  Demo feature -->
									<option value="8">8</option>
									<option value="16">16</option>
									<option value="24">24</option>
								</select>
							</span>
						</div> <!-- .filter -->

						<div class="pagination">
						</div> <!-- .pagination -->
					</div> <!-- .filter-bar -->
					
					<div class="product-area">
					</div>

					<div class="pagination-bar">
						<div class="pagination">
						</div> <!-- .pagination -->
					</div>
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
		var prodId = "<?php echo isset($_GET['Prod_id']) ? $_GET['Prod_id'] : null; ?>";
		var site_home = false, site_prod = true, site_cart = false, site_user = false;
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