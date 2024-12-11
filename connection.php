<?php
	$dbHost = "localhost";
/*	$dbUser = "walaa";
	$dbPass = "wul7@cAB";*/
	
//	$dbDatabase = "ucce2018";
		
//	$dbUser = "root";
//	$dbPass = "kh@lid_1990";
	//$dbDatabase = "scu_comp";
	// Create connection
	
	
	$dbDatabase = "statistics2";
		
	 
$dbUser = "root";
	//$dbPass = "mis@2018";
$dbPass = "mis@2018";
	
$con = new mysqli($dbHost, $dbUser, $dbPass,$dbDatabase);
$con->set_charset("utf8");

$tableYear2="2017";

$tableYear1="2016";

$currentYear=2018;
$prevYear=2017;
$prevprevYear=2016;
$copyRight="حقوق الملكية الفكرية ©  $currentYear  محفوظة لوحدة نظم المعلومات الادارية ودعم اتخاذ القرار بمركز الخدمات الالكترونية والمعرفية -المجلس الأعلى للجامعات";

//$db = new mysqli($dbHost, $dbUser, $dbPass,$dbDatabase);
//$db->set_charset("utf8");
//echo " Connection scucceed ";
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

	
	
?>
