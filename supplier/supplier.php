<?php session_start() ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="stylesheet" type="text/css" href="css/admin_style.css">

</head>

<body>
    <?php
    if (isset($_SESSION['ten_dangnhap']) && !empty($_SESSION['ten_dangnhap'])) {
        ?>
        <div id="wrapper">
            <div style="background: #5fa533;height: auto;" id="header2">
                <?php require_once('giaodien/header.php'); ?>
            </div>
            <div id="body">
                <div style="background:darkgreen; height: auto; border-bottom-right-radius: 10px ;" id="leftmenu">
                    <?php require_once('giaodien/leftmenu.php'); ?>
                </div>
                <div id="content" style="margin-left:10px">
                    <?php require_once('giaodien/content.php'); ?>
                </div>
            </div>

            <div id="footer"></div>
        </div>
        <?php
    } else {
        echo "<script type='text/javascript'>alert('Vui lòng đăng nhập!');window.location='../index.php?act=login';</script>";
    }
    ?>
</body>
<script src="js/style.js"></script>

</html>