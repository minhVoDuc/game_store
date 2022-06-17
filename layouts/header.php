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
                <a href="sign-in.html" class="login-button">Sign in</a>
                <a href="sign-up.html" class="login-button">Sign up</a>
            </div>
        </div> <!-- .right-section -->

        <div class="main-navigation">
            <button class="toggle-menu"><i class="fa fa-bars"></i></button>
            <ul class="menu">
                <li class="menu-item home nav-home"><a href="#"><i class="icon-home"></i></a>
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