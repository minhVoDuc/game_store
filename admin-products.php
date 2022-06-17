<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/admin.ico"/> 
    <title>HCMG Admin | Game List</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="js/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="css/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="js/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/dist/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="js/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="js/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="js/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="css/admin-style.css">
	<link rel="stylesheet" href="css/admin-table.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #1F4287;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i style="color: #fff" class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <a href='#' class="nav-link btn-logOut" style="color:white;">Log out</a>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #071E3D;">
            <!-- Brand Logo -->
            <a href="admin-home.php" class="brand-link">
                <img src="dummy/Logo.png" alt="HCMG Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">HCMG Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">Admin: <strong><?php echo $_SESSION['User_name']; ?></strong></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="admin-home.php" class="nav-link">
                            &nbsp;
                                <i class="ion-home"></i>
                                <p>
                                &ensp;   Home Page
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="admin-products.php" class="nav-link active">
                            &nbsp;
                                <i class="ion ion-ios-game-controller-b"></i>
                                <p>
                                &ensp;   Game List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="admin-users.php" class="nav-link">
                            &nbsp;
                                <i class="ion ion-person-stalker"></i>
                                <p>
                                &ensp;   Users List
                                </p>
                            </a>
                        </li>     
                        <li class="nav-item has-treeview">
                            <a href="admin-members.php" class="nav-link">
                            &nbsp;
                                <i class="ion ion-person"></i>
                                <p>
                                &ensp;   Admin Members
                                </p>
                            </a>
                        </li> 
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link btn-logOut">
                            &nbsp;
                                <i class="ion ion-android-exit"></i>
                                <p>
                                &ensp;   Log out
                                </p>
                            </a>
                        </li>                     
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- body -->
        <div class="content-wrapper" style="min-height: 365px; background-color: rgb(227, 227, 242);">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Game List</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="admin-home.php">HCMG Admin</a></li>
                                <li class="breadcrumb-item active">Game List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <a href="#" class="btn btn-primary m-b-1em btn-addProd" style="margin-bottom: 10px">New Product</a>
                <table class="table">
                    <thead class="thead-primary">
                        <tr>
                            <th width=5%>Game id</th>
                            <th width=10%>Image</th>
                            <th width=50%>Name</th>
                            <th width=5%>Price</th>
                            <th width=10%>Produce Studio</th>
                            <th width=10%>Type</th>
                            <th width=10%>Action</th>
                        </tr>
                    </thead>
                </table>
                <div class="center">
			        <div class="pagination">
                    </div>
                </div>
            </section>
        </div>
        <!-- body -->

        <!-- footer -->
        <footer class="main-footer" style="background-color: #1F4287;">
            <div style="color: #fff;">Copyright &copy; 2022 HCMG. All rights reserved.</div>
        </footer>
        <!-- footer -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <!-- for script -->
        <!-- ./wrapper -->
        <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
        <!-- jQuery -->
        <script src="js/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="js/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="js/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="js/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="js/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/moment/moment.min.js"></script>
        <script src="js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="js/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="js/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="js/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="js/dist/adminlte.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/dist/pages/dashboard.js"></script>
        <!-- Sweet alert 2 -->
	    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- ajax -->
        <script type="text/javascript"> 
            var adminId = "<?php echo isset($_SESSION['User_id']) ? $_SESSION['User_id'] : null; ?>";
            var curPage = "<?php echo isset($_GET['Page']) ? $_GET['Page'] : 1; ?>";
            var admin_home = false, admin_prod = true, admin_user = false, admin_admin = false;
        </script>
        <script src="js/admin-function.js"></script>
    <!-- for script -->
</body>
</html>