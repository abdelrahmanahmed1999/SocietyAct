  <?php
include ('header.php');

 ?>
	<?php 
include_once("../include/connection.php");
if (isset($_POST['btnadd'])) {
    
     if(!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']){
                    http_response_code(403);
                    die('');
                    exit;
                }

		$username =$_POST['txtusname'];
$name =$_POST['txtname'];
		$password =$_POST['txtpassword'];
		$user_role=$_POST['user_role'];
		$user_sector=$_POST['user_sector'];
		
	
		
 $q="INSERT INTO `user`(`USER_NAME` ,`Name`,`roleid` ,`USER_PASSWORD`,`sectorid`) 
VALUES (?,?,?,?,?)";
$password=MD5( $password );
$stmt = $con->prepare($q);
$stmt->bind_param("sssss", $username,$name, $user_role, $password,$user_sector);
$stmt->execute();
$afrow=$stmt->affected_rows;

 if ($afrow > 0){
	?>


    <div align="center" class="lggraytitle style1" style="margin-bottom:20px"> 
				   <p style="border:2px double"> تم اضافة الموظف بنجاح </p>
         		</div>
	<?php }	else { ?>
	<div align="center" class="lggraytitle style1" style="margin-bottom:20px"> 
				   <p style="border:2px double"><strong> حدث خطأ </strong></p>
</div>
	<?php
	
	 }
					

} // if btnadd
?>
  <?php
include ('footer.php');

 ?>