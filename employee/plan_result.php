<?php
include_once("header.php");
include_once("../include/connection.php");
?>
<script>
function printfn() {
    window.print();
}
</script>

<div align="center" class="style2" dir="rtl" style="color:#000000" >

</div>
<form id="form1" name="form1" method="post" action="">
<div align="right">
<table class="table table-striped" border="0">
<tr>
		<td height="80">
			<div  >

			<?php

//////////////////////////////////////
	
////////////////////
					 $sqlxx = "SELECT max( `serial`) as serial  FROM `planfiles` ";
					
					$stmtxx = $con->prepare($sqlxx);
					/* Execute statement */
					$stmtxx->execute();
					$resxx = $stmtxx->get_result();
					while($rowxx = $resxx->fetch_array(MYSQLI_ASSOC)) 
					{
					   $serialxx =$rowxx['serial'];	
//echo 	$serialxx;				   
			   
}

//////////////////////////

$dest=$_POST['destination'];
//echo 	$dest;	
/////////////////////////////////////////
if($dest!="")
{ 
$destinationn_old=$_POST['destination'];


$ff=$_FILES['myfile']['name'];
//$ffff="";
$extinsion=".pdf";
$new="new";
$filename=$serialxx.$new.$extinsion;
//$filename=$arname.$ffff.$extinsion;
    $destinationn_new = '../uploads/employees/'.$filename;
	$destinationn_delete = '../uploads/delete/employees/'.$filename;
 $destinationn= '../uploads/employees/'.$filename;
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
    $destinationn = '../uploads/employees/'.$filename;
$destinationn_delete = '../uploads/delete/employees/'.$filename;
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


	$cur_date= date('Y-m-d');

		$stmt = $con->prepare("INSERT INTO planfiles (insert_date,file_des)values (?,?)	");

						
						 $stmt->bind_param('ss',$cur_date,$destinationn);
					if($stmt->execute())
					{
						// Echo Success Message
						$theMsg = "<div class='alert alert-success'>تم الإضافة بنجاح</div>";
						echo $theMsg;
						//echo"<script>self.location='plan.php'</script>";
					}
					
					
					else
					{
						$theMsg = '<div class="alert alert-danger">لم يتم الإضافة بنجاح </div>'.mysqli_error($con);
						echo $theMsg;
					}



///////////////////////////////////////////////





			?>
			</div>
				 
		</td>
	</tr>
	
      
	  
	  
</table>
</div>
</form>




