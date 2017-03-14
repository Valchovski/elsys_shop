<?php
session_start();
$toast = '';

$db_server = "localhost";
$db_username = "root";
$db_pw = "";
$db = "elsys_shop";

$conn = new mysqli($db_server, $db_username, $db_pw, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$item_id = $_GET["item"];

$sql = "SELECT * FROM items WHERE id=$item_id";
$result = $conn->query($sql) or die ($conn->error);

if ($result -> num_rows > 0) {
	$row = $result->fetch_assoc();
} else {
	$toast = "item doesn't exist";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>E - Shop</title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">
    <!-- END META -->

    <!-- BEGIN STYLESHEETS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
    <link type="text/css" rel="stylesheet" href="assets/css/theme-default/bootstrap.css?1422792965" />
    <link type="text/css" rel="stylesheet" href="assets/css/theme-default/materialadmin.css?1425466319" />
    <link type="text/css" rel="stylesheet" href="assets/css/theme-default/font-awesome.min.css?1422529194" />
    <link type="text/css" rel="stylesheet" href="assets/css/theme-default/material-design-iconic-font.min.css?1421434286" />
    <!-- END STYLESHEETS -->
    <![endif]-->
</head>
<body class="menubar-hoverable header-fixed menubar-pin ">

<!-- BEGIN HEADER-->
<header id="header" >
    <div class="headerbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="headerbar-left">
            <ul class="header-nav header-nav-options">
                <li class="header-nav-brand" >
                    <div class="brand-holder">
                        <a href="/">
                            <span class="text-lg text-bold text-primary">CONTROL PANEL</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- END HEADER-->

<!-- BEGIN BASE-->
<div id="base">
    <!-- BEGIN CONTENT-->
    <div id="content">

        <!-- BEGIN BLANK SECTION -->
        <section>
            <div class="section-header">
                <ol class="breadcrumb">
                    <li class="active">E - Shop | Demo</li>
                </ol>
            </div><!--end .section-header -->
            <div class="section-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-underline">
                            <div class="card-head">
                                <header>Item</header>
                            </div><!--end .card-head -->
                        </div><!--end .card -->
						<div class="card">
							<div class="card-head">
								<header><?= $row['name'] ?></header>
							</div>
							<div class="card-body">
								<h3>Price: BGN <?= number_format($row['price'], 2, '.', '') ?> </h3>
							</div><!--end .card-body -->

							<div class="card-actionbar">
								<div class="card-actionbar-row">
									<form class="form" role="form" action="/command.php?cmd=removeFromCart"
										  method="post">
										<input name="user_id" value="<?= $_SESSION['user_id'] ?>"
											   type="hidden">
										<input name="item_id" value="<?= $item_id ?>" type="hidden">
									</form>
								</div>
							</div><!--end .card-actionbar -->
						</div><!--end .card -->
                    </div>
                </div>
            </div>
        </section>

        <!-- BEGIN BLANK SECTION -->
    </div><!--end #content-->
    <!-- END CONTENT -->

    <!-- BEGIN MENUBAR-->
    <div id="menubar" class="menubar-inverse ">
        <div class="menubar-scroll-panel">
            <!-- BEGIN MAIN MENU -->
            <ul id="main-menu" class="gui-controls">
                <!-- BEGIN DASHBOARD -->
                <li>
                    <a href="index.php" >
                        <div class="gui-icon"><i class="md md-home"></i></div>
                        <span class="title">Demo</span>
                    </a>
                </li><!--end /menu-li -->
                <li>
                    <a href="login.php" >
                        <div class="gui-icon"><i class="md md-computer"></i></div>
                        <span class="title">Login</span>
                    </a>
                </li>
                <li>
                    <a href="register.php" >
                        <div class="gui-icon"><i class="md md-computer"></i></div>
                        <span class="title">Register</span>
                    </a>
                </li>
                <li>
                    <a href="cart.php" >
                        <div class="gui-icon"><i class="md md-computer"></i></div>
                        <span class="title">My Cart</span>
                    </a>
                </li>
                <!-- END DASHBOARD -->
            </ul><!--end .main-menu -->
            <!-- END MAIN MENU -->

            <div class="menubar-foot-panel">
                <small class="no-linebreak hidden-folded">
                    <span class="opacity-75">Copyright &copy; 2016</span> <strong>Bat gergi</strong>
                </small>
            </div>
        </div><!--end .menubar-scroll-panel-->
    </div><!--end #menubar-->
    <!-- END MENUBAR -->
</div><!--end #base-->
<!-- END BASE -->

<!-- BEGIN JAVASCRIPT -->
<script src="assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
<script src="assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/js/libs/bootstrap/bootstrap.min.js"></script>
<script src="assets/js/libs/spin.js/spin.min.js"></script>
<script src="assets/js/libs/autosize/jquery.autosize.min.js"></script>
<script src="assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="assets/js/core/source/App.js"></script>
<script src="assets/js/core/source/AppNavigation.js"></script>
<script src="assets/js/core/source/AppOffcanvas.js"></script>
<script src="assets/js/core/source/AppCard.js"></script>
<script src="assets/js/core/source/AppForm.js"></script>
<script src="assets/js/core/source/AppNavSearch.js"></script>
<script src="assets/js/core/source/AppVendor.js"></script>
<script src="assets/js/core/demo/Demo.js"></script>
<!-- END JAVASCRIPT -->

</body>
</html>