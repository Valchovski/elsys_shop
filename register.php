<?php
session_start();
$toast = '';

if(isset($_POST['user'])){
    $username = $_POST['user']; $password = sha1($_POST['password']); $re_password = sha1($_POST['password2']);

    $db_server = "localhost";
    $db_username = "root";
    $db_pw = "";
    $db = "elsys_shop";

    $conn = new mysqli($db_server, $db_username, $db_pw, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($password != $re_password) {
        header('Location: register.php?error=Passwords%20must%20match!'); die();
    }
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['login'] = true;
        $_SESSION['welcome'] = true;
        $_SESSION['user'] = $username;
        header('Location: index.php?success=User%20created');
    } else {
        header('Location: index.php?error=Error%20in%20database');
    }
    die();
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
                    <div class="col-md-3 col-sm-3">
                        <div class="card card-underline">
                            <div class="card-head">
                                <header>Login</header>
                            </div><!--end .card-head -->
                            <div class="card-body">
                                <?php if( isset($_GET['error']) ) { ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger" role="alert">
                                                <strong>Error:</strong> <?=$_GET['error']?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <form class="form" role="form" action="" method="post">
                                    <div class="form-group floating-label">
                                        <input type="text" name="user" class="form-control" id="regular2" autocomplete="off">
                                        <label for="regular2">Username</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <input type="password" name="password" class="form-control" id="regular2" autocomplete="off">
                                        <label for="password2">Password</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <input type="password" name="password2" class="form-control" id="regular2" autocomplete="off">
                                        <label for="password2">Repeat Password</label>
                                    </div>
                                    <button type="submit" class="btn ink-reaction btn-raised btn-primary"> Register </button>
                                </form>
                            </div><!--end .card-body -->
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
                <!-- END DASHBOARD -->
            </ul><!--end .main-menu -->
            <!-- END MAIN MENU -->

            <div class="menubar-foot-panel">
                <small class="no-linebreak hidden-folded">
                    <span class="opacity-75">Copyright &copy; 2016</span> <strong>Etera</strong>
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