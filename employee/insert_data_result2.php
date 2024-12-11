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
	$univselect= $_POST['univselect'];
$univselect = stripslashes($univselect);	
$topicselect = $_POST['topicselect'];
$topicselect = stripslashes($topicselect);
	$typeselect = $_POST['typeselect'];
$typeselect = stripslashes($typeselect);

//echo "err";


$n = stripslashes(trim($_POST['b_enroll_male']));
$c = stripslashes(trim($_POST['myfile']));
$Nu = stripslashes(trim($_POST['date']));
$comm = stripslashes(trim($_POST['comment']));

/////////////////////////////////////////

///////////////////////////////////////////////


	

		$stmt = $con->prepare("INSERT INTO activity_taw (Date,title,activity_desc,pdf_image,university_ID,activity_natural_ID,activity_type_ID)values (?,?,?,?,?,?,?)	");

						
						 $stmt->bind_param('sssssss',$Nu,$n,$comm,$c,$univselect,$topicselect,$typeselect);
					if($stmt->execute())
					{
						// Echo Success Message
						$theMsg = "<div class='alert alert-success'>تم الإضافة بنجاح</div>";
						echo $theMsg;
						echo"<script>self.location='add.php'</script>";
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




