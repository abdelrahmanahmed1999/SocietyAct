<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ar" lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-language" content="ar"/>
    <title>ادخال الأنشطة الطلابية</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css"/>
</head>


<body>
<?php
include('header.php');
include_once("../include/connection.php");
//$univ_logins=$_SESSION['fk_university'];
//echo $univ_logins;
?>

<style>

    select, input {
        width: 250px;
    }
</style>
<?php


?>  
<?php


 $USER_ID=$_GET['id'];
 
 //echo  $USER_ID;

$q="SELECT distinct  `activity`.`serial` as serial,

`activity`.`activity_natural_ID` as activity_natural_ID ,

activity_natural.name as activity_natural_name ,

`activity`.`activity_type_ID`as activity_type_ID,

activity_type.name as  activity_type_name,

`activity`.`university_ID`,

university.name as  university_name,

`activity`.`Date` as Date,

`activity`.`title`as title,

`activity`.`pdf_image`as image,

`activity`.`activity_desc`as activity_desc,

`activity`.activity_top_ID as activvid,

`activity`.`End_Date` as End_Date,

`activity`.`fk_taklefselect` as fk_taklefselect ,

`activity`.`wafed_student` as wafed_student,

`activity`.`egy_student` as egy_student ,

`activity`.`khas_student` as khas_student ,

`activity`.`no_student` as no_student,

`activity`.`gehaaa` as gehaaa

FROM `activity`,activity_natural,activity_type,university
    
where `activity`.`activity_natural_ID`=activity_natural.ID

and `activity`.`activity_type_ID`=activity_type.ID

and `activity`.`university_ID`=university.ID

and `activity`.`serial`=?";
$stmt = $con->prepare($q);

 $stmt->bind_param('s',$USER_ID);
    $stmt->execute();
 $res = $stmt->get_result();
    while($row = $res->fetch_array(MYSQLI_ASSOC))
	{
	//	 echo"<script>self.location='res_view_all.php'</script>";
	$serial=$row['serial'];
		
		$university_name=$row['university_name'];
		$activity_natural_ID=$row['activity_natural_ID'];
		$activity_natural_name=$row['activity_natural_name'];
		$activity_type_ID=$row['activity_type_ID'];
		$activity_type_name= $row['activity_type_name'];
		$university_name= $row['university_name'];
		$Date= $row['Date'];
		$title= $row['title'];
		$destination= $row['image'];
		$university_ID=$row['university_ID'];
		$activity_desc=$row['activity_desc'];
		$activvid=$row['activvid'];
		$End_Date=$row['End_Date'];
		
		$fk_taklefselect=$row['fk_taklefselect'];
			$wafed_student= $row ['wafed_student']; 
			$egy_student= $row ['egy_student']; 	
			
		$khas_student= $row ['khas_student']; 
		$no_student= $row ['no_student']; 
		$gehaaa= $row ['gehaaa']; 
		
	//	echo $fk_taklefselect;
		
	}
?> 

<form id="form1" name="form1" method="post"action="insert_data_result.php">
    <div align="right">
        <table width="475" border="0" dir="rtl" class="table table-striped">
		
		  <tr>
                <td>
                    <div align="right"> الجامعة</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <select name="univselect" id="univselect" 

 				<oninvalid="this.setCustomValidity('يجب اختيار الجامعة')"
 oninput="setCustomValidity('')"  />
                    </div>
                    </div>
						
						<?php 
					
					$sql = 'SELECT distinct `ID`,`name` FROM `university` where ID=?';
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->bind_param('s',$university_ID);
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
					  ?>
						<option value="<?php echo $ID ?>" ><?php echo $name?></option>
						
						<?php 
}
						?>
				</select>
					
                </td>
                   </tr>
<!------------------------------------------------>
            <tr>
                <td>
                    <div align="right"> طبيعة النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <select name="topicselect" id="topicselect" 

 				<oninvalid="this.setCustomValidity('يجب اختيار طبيعة النشاط')"
 oninput="setCustomValidity('')"  />
                    </div>
                    </div>
				
						
						<?php 
					
					$sql = 'SELECT distinct `ID`,`name` FROM `activity_natural` where ID=?';
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->bind_param('s',$activity_natural_ID);
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
					  ?>
						<option value="<?php echo $ID ?>" ><?php echo $name?></option>
						
						<?php 
}
						?>
				</select>
					
                </td>
                   </tr>
				   <!------------------------------------------------>
                    <tr>
                <td>
                    <div align="right"> نوعية النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <select name="typeselect" id="typeselect" 

 oninvalid="this.setCustomValidity('يجب اختيار نوعية النشاط')"
                                oninput="setCustomValidity('')" onchange="validateForm()">  
                    </div>
					
						
						<?php 
					 $sql = "SELECT  distinct activity_type.`ID`,activity_type.`name` FROM `activity_type` where `ID`=?";
					
					$stmt = $con->prepare($sql);
					/* Execute statement */
$stmt->bind_param('s',$activity_type_ID);
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
					  ?>
						<option value="<?php echo $ID ?>" ><?php echo $name?></option>
						
						<?php 
}
						?>
				</select>
					
                </td>
                   </tr>
          
<!------------------------------------------------>
	  <tr>
                <td>
                    <div align="right"> تم التكليف من قبل</div>
                </td>

                <td dir="rtl">
                    <div align="right">
					<select name="taklefselect" id="taklefselect"  onchange="validateForm()"> 
								
							
                        
						<?php 
					 $sql = "SELECT DISTINCT `ID`,`Name` FROM `taklef` where `ID`=?";
					
					$stmt = $con->prepare($sql);
					/* Execute statement */
                    $stmt->bind_param('s',$fk_taklefselect);
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['Name'];
					  ?>
						<option value="<?php echo $ID ?>" ><?php echo $name?></option>
						
						<?php 
}
?>
                   
						
						
						</select>
                    </div>
                </td></tr>
<!----------------------------------------------------------------------------------------------------->
<?php
if($fk_taklefselect == 5) {
?>
<tr>
                <td>
                    <div align="right"> الجهة الراعية</div>
                </td>

                <td dir="rtl">
                   
                          <input type="text" id="tak" name="tak" readonly value ="<?php  echo $gehaaa; ?>" > 
					
                </td>
				</tr>
				
<?php } ?>				
              <tr>
				 <td>
                    <div align="right">تاريخ بداية النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <input type="date" id="date" name="date"readonly value ="<?php  echo $Date; ?>" >
                    </div>
                </td>
                    </div>
                </td>
            </tr>
			</tr>
			<!------------------------------------------------>
              <tr>
				 <td>
                    <div align="right">تاريخ انتهاء النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <input type="date" id="End_date" name="End_date"readonly value ="<?php  echo $End_Date; ?>" >
                    </div>
                </td>
                    </div>
                </td>
            </tr>
			</tr>
			    <!------------------------------------------------>
				  <tr>
                <td>
                    <div align="right"> اسم النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <textarea name="b_enroll_male" readonly ><?php  echo $title; ?>  </textarea>
									<oninvalid="this.setCustomValidity('يجب اختيار اسم النشاط')"
 oninput="setCustomValidity('')"  />
                    </div>
                </td></tr>

         
            <!------------------------------------------------>
						  <tr>
                <td>
                    <div align="right"> عدد الطلاب الوافدين</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <input type="number" id="wafed_student" name="wafed_student" readonly value ="<?php  echo $wafed_student; ?>"  />
                    </div>
                </td></tr>
<!--------------------------------------------->
			  <tr>
                <td>
                    <div align="right"> عدد الطلاب المصريين</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <input type="number" id="egy_student" name="egy_student" readonly value ="<?php  echo $egy_student; ?>"  />
                    </div>
                </td></tr>
<!--------------------------------------------->
			  <tr>
                <td>
                    <div align="right"> عدد الطلاب ذوى الاحتياجات الخاصة</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <input type="number" id="khas_student" name="khas_student" readonly value ="<?php  echo $khas_student; ?>"   />
                    </div>
                </td></tr>

            <!------------------------------------------------>

				  <tr>
                <td>
                    <div align="right"> عدد الطلاب المشتركين</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <input type="number" id="no_student" name="no_student" readonly value ="<?php  echo $no_student; ?>"  >
									<oninvalid="this.setCustomValidity('يجب اختيار اسم النشاط')"
 oninput="setCustomValidity('')"  />
                    </div>
                </td></tr>

   <!------------------------------------------------>
 <tr>
				 <td>
                    <div align="right">وصف النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                      <textarea name="comment" rows="5" cols="40" readonly > <?php  echo $activity_desc; ?> </textarea>
                    </div>
                </td>
                    </div>
                </td>
            </tr>
			
   <!------------------------------------------------>
<?php



 if($destination=="")
{
?>
  <tr>
  
          <td>
		<div align="right">  ملف يحتوى على صورة
		</div>
		</td>
		
        <td >
		<div align="right">
         <input type="file" name="myfile" id="myfile" accept="application/pdf"  required="" >
        </div>
		</td>
		

      </tr>
	  <tr>
	  <input type="hidden" name="destination" id="destination" value="<?php echo"" ?>"  />	
	  </tr>
<?php }
else
{ 
    
        ?>
  <tr>
        <td>
		<div align="right">  ملف يحتوى على صورة
		</div>
		</td>
		 <td   align="right" dir="rtl">
     <iframe id="iframepdf" src="<?php echo $destination; ?>" title="PDF in an i-Frame" style="border:1px solid #666CCC" scrolling="auto" height="500" width="500" ></iframe>
 
    </td>

      </tr>
	  <tr>
	  <input type="hidden" name="destination" id="destination" value="<?php echo $destination; ?>"  />	
	  </tr>
<?php 
} 
?>
<!-------------------------------------->

        </table>
    </div>
    <tr>
      <td colspan="2" align="rtl"><label>
<a href="home.php" style= "color:black">
        <input type="button" value="رجوع" style="width:6em ;  height:2em;"style= "color:black"  /></a>
      </label>
	 
	  </td>
	
    
      <!--<td colspan="2" align="center"><label>
        <input type="submit"   value="إضافة " style="width:8em ;height:2em;" onclick="validatename();return false;" />
      </label>

	  </td>--!>
	  </tr>
	 
 <?php
	  
	 
if(isset($_SESSION['errorx']))
{
$errorx=$_SESSION['errorx'];

 echo $errorx; 
$_SESSION['errorx']=' ';
}
 ?>
    </tr>
<?php
include('footer.php');

?>