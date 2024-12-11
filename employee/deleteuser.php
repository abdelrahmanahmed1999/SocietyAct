<?php

include ('header.php');

 $USER_ID=$_GET['serial'];
 //$id=$_GET['id'];
 
 //echo  $USER_ID;

$q="DELETE FROM `activity` WHERE `serial`=?";
$stmt = $con->prepare($q);

 $stmt->bind_param('s',$USER_ID);
    $stmt->execute();

		 echo"<script>self.location='add.php?' </script>";
	 
?>