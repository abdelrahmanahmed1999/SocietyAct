<?php
	$dbHost = "localhost";
/*	$dbUser = "walaa";
	$dbPass = "wul7@cAB";*/
	
//	$dbDatabase = "ucce2018";
		
//	$dbUser = "root";
//	$dbPass = "kh@lid_1990";
	//$dbDatabase = "scu_comp";
	// Create connection
	
	
	$dbDatabase = "ansheta_tolabya";
		
	 
$dbUser = "root";
	$dbPass = "mis@2018";
//$dbPass = "";
	
$con = new mysqli($dbHost, $dbUser, $dbPass,$dbDatabase);
$con->set_charset("utf8");


$copyRight="حقوق الملكية الفكرية ©    محفوظة لوحدة نظم المعلومات الادارية ودعم اتخاذ القرار بمركز الخدمات الالكترونية والمعرفية -المجلس الأعلى للجامعات";

//$db = new mysqli($dbHost, $dbUser, $dbPass,$dbDatabase);
//$db->set_charset("utf8");
//echo " Connection scucceed ";
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

	
	
?>
