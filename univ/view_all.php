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
					<option value="-1">--اختر الجامعة--</option>  
						
						<?php 
					
					$sql = 'SELECT distinct `ID`,`name` FROM `university`';
					$stmt = $con->prepare($sql);
					/* Execute statement */
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
					<option value="-1">--اختر طبيعة النشاط--</option>  
						
						<?php 
					
					$sql = 'SELECT distinct `ID`,`name` FROM `activity_natural`';
					$stmt = $con->prepare($sql);
					/* Execute statement */
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

 oninvalid="this.setCustomValidity('يجب اختيار طبيعة النشاط')"
                                oninput="setCustomValidity('')" onchange="validateForm()">  
                    </div>
					<option value="-1">--اختر نوعية النشاط--</option>  
						
						<?php 
					 $sql = "SELECT  distinct activity_type.`ID`,activity_type.`name` FROM `activity_type`,`activity_natural` where activity_natural.ID =activity_type.activity_natural_ID ";
					
					$stmt = $con->prepare($sql);
					/* Execute statement */
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
                    <div align="right">تاريخ النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <input type="date" id="date" name="date"readonly >
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
                        <input type="text" id="b_enroll_male" name="b_enroll_male" readonly >
									<oninvalid="this.setCustomValidity('يجب اختيار اسم النشاط')"
 oninput="setCustomValidity('')"  />
                    </div>
                </td></tr>
<!--------------------------------------------->
              <tr>
				 <td>
                    <div align="right">وصف النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                      <textarea name="comment" rows="5" cols="40"></textarea>
                    </div>
                </td>
                    </div>
                </td>
            </tr>
            <!------------------------------------------------>
			<tr>
                <td>
                    <div align="right"> ملف يحتوى على صورة</div>
                </td>
				  <td dir="rtl">
                    <div align="right">
                        <input type="file" id="myfile" name="myfile" readonly >
									<oninvalid="this.setCustomValidity('يجب اختيار الملف')"
 oninput="setCustomValidity('')"  />
                    </div>
                </td>
</tr>

        </table>
    </div>

	
    <tr>
      <td colspan="2" align="rtl"><label>
<a href="home.php" style= "color:black">
        <input type="button" value="رجوع" style="width:6em ;  height:2em;"style= "color:black"  /></a>
      </label>
	 
	  </td>
	</tr>
		
	<tr>
      <td colspan="2" align="center"><label>
        <input type="submit"   value="تعديل " style="width:8em ;height:2em;"  />
      </label>

	  </td>
</tr>
	
    
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