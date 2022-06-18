<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<!--===============================================================================================-->	
		<link rel="icon" type="image/png" href="images/icons/sign_iu.ico"/>
		<title>HCMG | Sign In</title>

		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:100,300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="fonts/lineo-icon/style.css" rel="stylesheet" type="text/css">

		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
		<!--===============================================================================================-->	
			<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
		<!--===============================================================================================-->	
			<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="css/util.css">
			<link rel="stylesheet" type="text/css" href="css/style-SIU.css">
		<!--===============================================================================================-->
		<!-- Loading main css file -->
			<link rel="stylesheet" type="text/css" href="style.css">
		
	</head>
    <body>
        <div id="site-content">
			<div class="site-header">
				<div class="container">
					<a class="nav-home" id="branding">
						<img src="dummy/Logo.png" alt="" class="logo">
						<div class="logo-text">
							<h1 class="site-title">HCMG</h1>
							<small class="site-description">Ho Chi Minh Gaming laptop store</small>
						</div>
					</a> <!-- #branding -->
				</div> <!-- .container -->
			</div> <!-- .site-header -->

			<!--Begin-->
			<div class="limiter">
				<div class="container-login100" style="background-image: url('images/bg-05.jpg');">
					<div class="wrap-login100 p-t-30 p-b-50">
						<span class="login100-form-title p-b-41">
							Account Sign In
						</span>
						<form id="signIn-form" class="login100-form validate-form p-b-33 p-t-5" method="post">
		
							<div class="wrap-input100 validate-input" data-validate = "Enter username">
								<input class="input100" type="text" name="username" placeholder="User name">
								<span class="focus-input100" data-placeholder="&#xe82a;"></span>
							</div>
		
							<div class="wrap-input100 validate-input" data-validate="Enter password">
								<input class="input100" type="password" name="pass" placeholder="Password">
								<span class="focus-input100" data-placeholder="&#xe80f;"></span>
							</div>
		
							<div class="container-login100-form-btn m-t-32">
								<button id="btn-signIn" class="login100-form-btn">
									Login
								</button>
							</div>
							<div class="container-login100-form-btn m-t-10">
								<a class="SIU-nav" href="sign-up.html">Doesn't have an account? <span>Sign up here</span></a>
							</div>
						</form>
					</div>
				</div>
			</div>

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
										<li><a href="sign-in.html">Sign in</li>
										<li><a href="sign-up.html">Sign up</a></li>
									</div>
								</ul>
							</div> <!-- .widget -->
						</div> <!-- column -->
					</div><!-- .row -->
					<div class="copy">Copyright &copy; 2022 HCMG. All rights reserved.</div>
				</div> <!-- .container -->
			</div> <!-- .site-footer -->
        </div>
    </body>
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="js/function_SIU.js"></script>
</html>