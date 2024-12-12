<?php
	$dbHost = "localhost";
	$dbDatabase = "ansheta_tolabya";
	$dbUser = "root";
	$dbPass = "mis@2018";
	$con = new mysqli($dbHost, $dbUser, $dbPass,$dbDatabase);
	$con->set_charset("utf8");


	$copyRight="حقوق الملكية الفكرية ©    محفوظة لوحدة نظم المعلومات الادارية ودعم اتخاذ القرار بمركز الخدمات الالكترونية والمعرفية -المجلس الأعلى للجامعات";

	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}

?>
