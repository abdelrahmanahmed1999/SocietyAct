<?php
include_once("header.php");
include_once("../include/connection.php");
?>
<script>
function printfn() 
{
    window.print();
}
</script>


<form id="form1" name="form1" method="post" action="">
<div align="right">
<table class="table table-striped" border="0">
<tr>
		<td height="80">
			<div  >

			<?php


//////////////////////////////////////

	$univselect= $_POST['univ_select'];
$univselect = stripslashes($univselect);

	$college_select= $_POST['college_select'];
$college_select = stripslashes($college_select);
	$End_date = $_POST['End_date'];
$topicselect = $_POST['topicselect'];
$topicselect = stripslashes($topicselect);
	$typeselect = $_POST['typeselect'];
$typeselect = stripslashes($typeselect);
$id = $_POST['idd'];
$taklefselect = $_POST['taklefselect'];
$party_involved = $_POST['party_involved'];

$wafed_student = $_POST['wafed_student'];
$egy_student = $_POST['egy_student'];
$khas_student  = $_POST['khas_student'];
$no_student = $_POST['no_student'];
$m_enroll_male = $_POST['m_enroll_male'];
//echo $id ;
//echo $id ;

//echo "err";
$goals = implode(',', $_POST['goal']);
$n = stripslashes(trim($_POST['b_enroll_male']));
//$c = stripslashes(trim($_POST['myfile']));

$Nu = $_POST['date'];
$comm = stripslashes(trim($_POST['comment']));
////////////////////
					 $sqlxx = "SELECT max( `serial`) as serial  FROM `activity` ";
					
					$stmtxx = $con->prepare($sqlxx);
					/* Execute statement */
					$stmtxx->execute();
					$resxx = $stmtxx->get_result();
					while($rowxx = $resxx->fetch_array(MYSQLI_ASSOC)) 
					{
					   $serialxx =($rowxx['serial']+1);	
//echo 	$serialxx;				   
			   
}

//////////////////////////

$dest=$_POST['destination'];
//echo 	$dest;	
/////////////////////////////////////////
/*
$file_size = $_FILES['myfile']['size'];
    $file_type = $_FILES['myfile']['type'];
echo $file_size ;
echo  $file_type;
  /*  if (($file_size > 2097152)){      
        $message = 'File too large. File must be less than 2 megabytes.'; 
        echo '<script type="text/javascript">alert("'.$message.'");</script>'; 
    }
*/

if($topicselect==1)
{

$sql = "SELECT distinct `university_ID`,university.name
FROM `activity` ,university
where `university_ID`=university.id
and `Date`=? and university_ID <> ?";
//echo $sql;
					$stmt = $con->prepare($sql);
		$stmt->bind_param('si', $Nu, $univselect);
					$stmt->execute();
					$res = $stmt->get_result();
					$i=0;
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['university_ID'];
					   $name=$row['name'];
					  
					   $i++;
                         }
						 
						// echo "iiiiiiiiiiiiiii".$i;
						if($i==0)
						{
						 



////////////////////////////////////////////////////////////

	if($dest!="")
{ 
$destinationn_old=$_POST['destination'];


$ff=$_FILES['myfile']['name'];

//$ffff="";
$extinsion=".pdf";
$new="new";
$filename=$serialxx.$new.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn_new = '../uploads/univ/'.$filename;
	$destinationn_delete = '../uploads/delete/univ/'.$filename;
 $destinationn= '../uploads/univ/'.$filename;
    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn_new)) //find old file
{
//echo "yes";
//unlink($destination);
move_uploaded_file($file, $destinationn_delete);
if(unlink($destinationn_new)) // delete old file
{
//echo"unlink";

$file = $_FILES['myfile']['tmp_name'];

if ( move_uploaded_file($file, $destinationn_new)) {


}
else
{
//echo"not uplood in destinamtion";
}
}
else
{
//echo"can not delete old one";
}
}
else
{//elfile not found
if ( move_uploaded_file($file, $destinationn_new)) {
}
else
{
//echo"not uplood in destinamtion";
}
}

}
/////////////////////////////////////////////////////////////////
else
{
$ff=$_FILES['myfile']['name'];
//$ffff="_";
$extinsion=".pdf";
$filename=$serialxx.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn = '../uploads/univ/'.$filename;
$destinationn_delete = '../uploads/delete/univ/'.$filename;
    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn)) //find old file
{
//echo "yes";
//unlink($destination);
move_uploaded_file($file, $destinationn_delete);
if(unlink($destinationn)) // delete old file
{
//echo"unlink";

$file = $_FILES['myfile']['tmp_name'];

if ( move_uploaded_file($file,$destinationn)) {

}
else
{
//echo"not uplood in destinamtion";
}
}
else
{
//echo"can not delete old one";
}
}
else
{//elfile not found
if ( move_uploaded_file($file,$destinationn)) { 
//echo"upload";
}
else
{
//echo"not uplood in destinamtion";
}
}
}

	

	


///////////////////////////////////////////////



		$stmt = $con->prepare("INSERT INTO activity (Date,End_Date,title,activity_desc,pdf_image,university_ID,activity_natural_ID,activity_type_ID,activity_top_ID,fk_coll,fk_taklefselect,no_student,wafed_student,egy_student,khas_student,gehaaa,goal,party_involved) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

						
						 $stmt->bind_param("ssssssssssssssssss",$Nu,$End_date,$n,$comm,$destinationn,$univselect,$topicselect,$typeselect,$id,$college_select,$taklefselect,$no_student,$wafed_student,$egy_student,$khas_student,$m_enroll_male,$goals,$party_involved);
					if($stmt->execute())
					{
						// Echo Success Message
						$theMsg = "<div class='alert alert-success'>تم الإضافة بنجاح</div>";
						echo $theMsg;
						//echo $m_enroll_male;
						echo"<script>self.location='add.php?id='+$id </script>";
					}
					
					
					else
					{
						$theMsg = '<div class="alert alert-danger">لم يتم الإضافة بنجاح </div>'.mysqli_error($con);
						echo $theMsg;
					}



///////////////////////////////////////////////



}
else
{
	$theMsg = '<div class="alert alert-danger"  align="center" ><p style="font-size:20px;"><strong>يوجد جامعة بالفعل مسجله نشاط قمى فى نفس التاريخ برجاء التواصل مع إدارة شؤون الطلاب المجلس الاعلى للجامعات </strong></p></div>';
						echo $theMsg;

			   
}

}	
else
{
	


////////////////////////////////////////////////////////////

	if($dest!="")
{ 
$destinationn_old=$_POST['destination'];


$ff=$_FILES['myfile']['name'];

//$ffff="";
$extinsion=".pdf";
$new="new";
$filename=$serialxx.$new.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn_new = '../uploads/univ/'.$filename;
	$destinationn_delete = '../uploads/delete/univ/'.$filename;
 $destinationn= '../uploads/univ/'.$filename;
    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn_new)) //find old file
{
//echo "yes";
//unlink($destination);
move_uploaded_file($file, $destinationn_delete);
if(unlink($destinationn_new)) // delete old file
{
//echo"unlink";

$file = $_FILES['myfile']['tmp_name'];

if ( move_uploaded_file($file, $destinationn_new)) {


}
else
{
//echo"not uplood in destinamtion";
}
}
else
{
//echo"can not delete old one";
}
}
else
{//elfile not found
if ( move_uploaded_file($file, $destinationn_new)) {
}
else
{
//echo"not uplood in destinamtion";
}
}

}
/////////////////////////////////////////////////////////////////
else
{
$ff=$_FILES['myfile']['name'];
//$ffff="_";
$extinsion=".pdf";
$filename=$serialxx.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn = '../uploads/univ/'.$filename;
$destinationn_delete = '../uploads/delete/univ/'.$filename;
    // get the file extension
  //  $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];

if(file_exists($destinationn)) //find old file
{
//echo "yes";
//unlink($destination);
move_uploaded_file($file, $destinationn_delete);
if(unlink($destinationn)) // delete old file
{
//echo"unlink";

$file = $_FILES['myfile']['tmp_name'];

if ( move_uploaded_file($file,$destinationn)) {

}
else
{
//echo"not uplood in destinamtion";
}
}
else
{
//echo"can not delete old one";
}
}
else
{//elfile not found
if ( move_uploaded_file($file,$destinationn)) { 
//echo"upload";
}
else
{
//echo"not uplood in destinamtion";
}
}
}

	

	


///////////////////////////////////////////////


		
		$stmt = $con->prepare("INSERT INTO activity (Date,End_Date,title,activity_desc,pdf_image,university_ID,activity_natural_ID,activity_type_ID,activity_top_ID,fk_coll,fk_taklefselect,no_student,wafed_student,egy_student,khas_student,gehaaa,goal,party_involved) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

						
						 $stmt->bind_param("ssssssssssssssssss",$Nu,$End_date,$n,$comm,$destinationn,$univselect,$topicselect,$typeselect,$id,$college_select,$taklefselect,$no_student,$wafed_student,$egy_student,$khas_student,$m_enroll_male,$goals,$party_involved);
					if($stmt->execute())
					{
						// Echo Success Message

						$theMsg = "<div class='alert alert-success'>تم الإضافة بنجاح</div>";
						echo $theMsg;
						echo "
							<script>
								// Show the message for 2 seconds, then redirect
								setTimeout(function() {
									self.location = 'add.php?id=' + $id;
								}, 2000);
							</script>
							";
					}
					
					
					else
					{
						$theMsg = '<div class="alert alert-danger">لم يتم الإضافة بنجاح </div>'.mysqli_error($con);
						echo $theMsg;
					}



///////////////////////////////////////////////



}?>		
			</div>
				 
		</td>
	</tr>
	
      
	  
	  
</table>
</div>
</form>




