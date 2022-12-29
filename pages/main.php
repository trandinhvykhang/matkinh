<?php 
session_start();
if (!isset($_SESSION["page"]))
    $_SESSION["page"] = "dssp";
if (isset($_POST["p"])) {
    $_SESSION["page"] = $_POST["p"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/root.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/alert.css">
    <link rel="stylesheet" href="<?="../css/".$_SESSION["page"].".css";?>">
</head>
<body>
    <div class="nav-bar">
        <div class="nav-img">
            <img class="glasses" src="../assets/imgs/matkinh.svg">
        </div>
        <div class="nav-title">
            Quản lý cửa hàng mắt kính
        </div>
        <div class="nav-space"></div>
        <button class="nav-signout btn" onclick="window.location.href='../index.php'">
            <img class="signout-icon" src="../assets/icons/log-out.svg">
        </button>
    </div>
    <div class="center">
        <div class="sidebar">
            <div class="sidenav-box">
                <img class="list-icon" src="../assets/icons/list.svg">
            </div>
            <form class="sidenav-content" method="POST">
                <button class="sidenav-title <?=($_SESSION["page"] == "dssp" ? "sidenav-active" : "")?>" name="p" value="dssp" type="submit">Danh sách sản phẩm</button>
                <button class="sidenav-title <?=($_SESSION["page"] == "dshd" ? "sidenav-active" : "")?>" name="p" value="dshd" type="submit">Danh sách hoá đơn</button>
                <button class="sidenav-title <?=($_SESSION["page"] == "dsnv" ? "sidenav-active" : "")?>" name="p" value="dsnv" type="submit">Danh sách nhân viên</button>
                <button class="sidenav-title <?=($_SESSION["page"] == "dscv" ? "sidenav-active" : "")?>" name="p" value="dscv" type="submit">Danh sách chức vụ</button>
            </form>
        </div>
        <div class="main">
            <?php
                include '../pages/'.$_SESSION["page"].'.php';
                if(isset($alert) && isset($alert_type))
                    include '../pages/alert.php';
                unset($alert, $alert_type);
            ?>
        </div>
    </div>
</body>
</html>