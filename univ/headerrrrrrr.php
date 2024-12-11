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
	.web
	{
		display:block;
	}
	.forPrint, .forPrintBlock
	{
		display:none;
	}
	@media print 
	{
		 .web
		{
			display:none;
		} 
		.printContainer
		{
		  position:fixed;
		  left: 15px;
		  right: 15px;
		  top: 10px;
		  bottom: 10px;
		  border: 2px solid black;
			//z-index:10000;
		}
		.container
		{
			padding:10px;
		}
		.forPrint
		{
			display:inline-table;
		}
		.forPrintBlock
		{
			display:block;
		}
		#researchesdiv 
		{
			page-break-inside: avoid;
		}
	}
</style>
<style media="print">
@page {
    size: auto;
    margin-bottom: 0px;
    margin-top: 10px;
	padding:10px;
}
.header, .footer {
/*position: fixed;
height:100px;*/
width:95%;
}
</style>

<?php

include("../include/connection.php");
session_start();

$isAdmin = false;
$isViewer = false;
$isEmployee = false;
$isLogin = false;
$name="";
$universityName = "";
$universityId = "";
$userId = "";
$username = "";

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    unset($_SESSION['loginusername']);
    echo "<script>self.location='../logins.php'</script>";
}
$_SESSION['LAST_ACTIVITY'] = time();

if (strlen($_SESSION['loginusername']) == 0 && $_SESSION['roleid'] != 3) {

    echo "<script>self.location='../logins.php'</script>";
}
else
{
	$usname = $_SESSION['loginusername'];
	$q = "SELECT `USER_ID`,`USER_NAME`,`USER_PASSWORD`,`roleid`,`fk_university`,user.`Name` `Name`,
	university.name university_name FROM `user` 
	left join university on university.id = fk_university
	where `USER_NAME`=? and active>0";
	$stmt = $con->prepare($q);
	$stmt->bind_param('s', $usname);
	$stmt->execute();
	$res = $stmt->get_result();
	if ($row = $res->fetch_array(MYSQLI_ASSOC)) 
	{
		$roleid = $row['roleid'];
		$isAdmin = ($roleid == '5');
		$isEmployee = ($roleid == '7');
		$isViewer = ($roleid == '8');
		$isLogin = true;
		$name=$row['Name'];
		$universityId =  $row['fk_university'];
		$universityName = $row['university_name'];
		$userId =  $row['USER_ID'];
		$username = $row['USER_NAME'];
	}
}


$error = '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8" />

<title>نظام أنشطة خدمة المجتمع</title>

 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- jQuery library -->
<script src="../js/jquery.js"></script>


<link rel="icon" href="../favicon.ico" type="image/x-icon"/><link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/></head>

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
<div class="printContainer">
</div>
<div class="container">
		<table  style="border:none;width: 100%;">
			<thead style="width:100%;"><tr style="width:100%;"><th style="border:5px solid 0000ff;margin-top:10px;padding-top:10px;width:100%;" class="forPrint">
					<div id="firsttb" style="width:100%;" class="forPrint">
						<table style="width:95%;border:none;margin-left:20px;padding-top: 20px;height:200px;" dir="rtl">
							<tr>
								<td style="border:none;width: 200px;text-align: center;">
									<img class="img-responsive" src="../images/magles.png" width="100" style="margin-right: auto;margin-left: auto;" />
									<p style="font-size:20px;padding-top:5px;"><strong>المجلس الاعلى للجامعات</strong> </p>
									<p style="text-decoration:underline;font-size:18px"><strong>ادارة الشئون الفنية للمجالس</strong> </p>										
								</td>
								<td>															
									<div align="center" style="font-weight:bold">
										<div style="font-size:27px"><?php if(isset($reportTitle)) echo $reportTitle;?></div>
									</div>
								</td>
								<td style="border:none;padding-top: 10px;text-align:left;">
									<div style="width:100px;float:left;text-align:center;"><?php 
									if(isset($reportUniversityImg) && !empty($reportUniversityImg)) 
										echo "<img class='img-responsive' src='$reportUniversityImg' width='100' style='margin-right: auto;margin-left: auto;' />";
									
									/*if(isset($reportUniversityName) && !empty($reportUniversityName)) 
										echo "<p style='font-size:18px;margin:15px auto 15px auto;width: fit-content;'>$reportUniversityName</p>";*/
									?>
									</div>
								</td>
							</tr>
						</table>
					</div>	
				</th></tr></thead>
			<tbody><tr><td  style="border:none;padding:20px;padding-top:2px;width:100%">
  <div class="row web">
    <div class="col-sm-12">
<center><a >
      <img class="img-responsive" src="../images/header.jpeg" width="1200"   /></a>
      </center> 
    </div>
  </div>
	<div class="row" style="padding-bottom: 20px;">
		<div class="col-sm-12" style="padding-bottom: 0px;">
			<div class="navbar navbar-default" style="margin-bottom: 0px;">
				<div class="container-fluid2">
					<ul class="nav navbar-nav">
						<a class="active" href="index.php"> الصفحة الرئيسية<i class="fa fa-fw fa-home"></i></a> 
						<a style="padding-right: 25px;" href="../logout.php"> خروج<i class="fa fa-fw fa-sign-out"></i></a>
						<!--a class="active" href="about.php">عن النظام<i class="fa fa-fw fa-home"></i></a-->
					</ul>
				</div>
			</div>
		</div>
        <div align="right" dir="rtl" class="col-sm-12">
           <!-- <h3 style="font-size:20px; color:#1a4395; display:inline-block;padding-left:25px;">مرحبا :- <?php// echo $name ?></h3>-->
            <?php if( $isEmployee)
            {?>
           <!-- <h3  style="font-size:20px; color:#1a4395;display:inline-block;padding-right:25px;">مسئول جامعة :- <?php// echo $universityName ?> </h3> -->
            <?php }
            else if( $isAdmin)
            {?>
            <h3  style="font-size:20px; color:#1a4395;display:inline-block;padding-right:25px;">المجلس الأعلي للجامعات </h3> 
            <?php }
            else if( $isViewer)
            {?>
            <h3  style="font-size:20px; color:#1a4395;display:inline-block;padding-right:25px;">المجلس الأعلي للجامعات (مشاهدة فقط) </h3> 
            <?php }?>
        </div>
	</div>
