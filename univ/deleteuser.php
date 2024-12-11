<?php
  
include ('header.php');

 $USER_ID=$_GET['serial'];
 $id=$_GET['id'];
 if($id== 2)
				{
					
					
	$q="DELETE FROM `activity` WHERE `serial`=?";
$stmt = $con->prepare($q);

 $stmt->bind_param('s',$USER_ID);
    $stmt->execute();


		 echo"<script>self.location='add.php?id='+$id </script>";
	 
					
 //echo  $USER_ID;


				}
				else{
					 $sql = "SELECT `pdf_image` as dest  FROM `activity` where `serial`=?";
                                    $stmt = $con->prepare($sql);
                                    $stmt->bind_param('s', $USER_ID);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                                        $dest = $row['dest'];
                                       
									}
					
unlink($dest);				
//if() // delete old file
{
	$q="DELETE FROM `activity` WHERE `serial`=?";
$stmt = $con->prepare($q);

 $stmt->bind_param('s',$USER_ID);
    $stmt->execute();


		 echo"<script>self.location='add.php?id='+$id </script>";
	 
}
}
///////////////////////////////////////////////////////////////

?>