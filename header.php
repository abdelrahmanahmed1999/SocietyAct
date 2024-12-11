<style>
    .navbar {
        width: 100%;
        background-color: #f8f8f8;
        overflow: auto;
    }

    /* Navbar links */
    .navbar a {
        float: right;
        text-align: center;
        padding: 12px;
        color: #153eef;
        text-decoration: none;
        font-size: 20px;
    }

    /* Navbar links on mouse-over */
    .navbar a:hover {
        background-color: #337ab7;
        text-decoration: none;
        color: #f8f8f8;
    }
    .container-fluid2 {
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
</style>

<?php
include_once("include/connection.php");
session_start();
$error='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8" />

<title>نظام أنشطة خدمة المجتمع</title>

 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- jQuery library -->
<script src="js/jquery.js"></script>


<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/></head>

<script type="text/javascript" src="../media/js/mootools.js"></script>
<script type="text/javascript" src="../media/js/calendar.js"></script>


<link rel="stylesheet" type="text/css" href="../media/css/calendar.css" media="screen" />


<!--
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<link href="../css/navigation.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

style type="text/css">

.style1 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;direction:rtl;
}
.style2 {font-family: "Times New Roman", Times, serif;}
.style3 {font-family: "Times New Roman", Times, serif; font-weight: bold;font-size:12px;}

</style

<link href="../css/navigation.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="../favicon.ico" type="image/x-icon"/><link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/></head>
 -->

<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <center><a href="index.php">
                    <img class="img-responsive" src="images/header.jpeg" width="1200"   /></a>
            </center>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12" style="padding-bottom: 10px;">
            <div class="navbar navbar-default">
                <div class="container-fluid2">
                    <ul class="nav navbar-nav">
				
                        <!--a class="active" href="index.php"> الصفحة الرئيسية<i class="fa fa-fw fa-home"></i></a-->
                        <a style="padding-right: 25px;" href="logins.php"> دخول النظام <i class="fa fa-fw fa-sign-in"></i></a>	
						<!--a class="active" href="about.php"> عن النظام<i class="fa fa-fw fa-home"></i></a-->

                </div>
                </ul>
            </div>

        </div>
    </div>