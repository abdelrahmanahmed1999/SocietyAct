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
include('../univ/header.php');
include_once("../include/connection.php");
$univ_logins=$_SESSION['fk_university'];
//echo $univ_logins;
$id = $_POST['idd'];
echo $id ;
?>

<style>

    select, input {
        width: 250px;
    }
</style>
<?php


?>   

<form id="form1" name="form1" method="post"action="insert_data_result.php" 
enctype="multipart/form-data" >
<div align="center" class="style2" dir="rtl" style="color:#" >
     
	  <?php 
	  if($id==1)
	  {
		   ?><p class="style4" align="center"  style="color:#000000">
		   إدخال الأنشطة الطلابية الحالية
		    </p>
			<?php
	  }
	  else if($id==2)
	  {
		  
		  	 ?><p class="style4" align="center"  style="color:#000000">
			 إدخال الأنشطة الطلابية المستقبلية
		    </p>
			<?php
	  }
	  else
	  {
	  }
	  ?>




</div>

    <div align="right">
        <table width="475" border="0" dir="rtl" class="table table-striped">
		
		<!------------------------------------------------>
			 <tr>
                <td>
                    <div align="right"> الجامعة</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <select name="univ_select" id="univ_select" required
                                oninvalid="this.setCustomValidity('يجب إختيار الجامعة')" oninput="setCustomValidity('')"
                               >
                            <?php
                            
                               
                                   
                                    $sql = "SELECT `ID`, `name` FROM `university` WHERE `ID` =? ORDER BY `name` ASC";
                                    $stmt = $con->prepare($sql);
                                    $stmt->bind_param('s', $univ_logins);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                                        $ID = $row['ID'];
                                        $name = $row['name'];
                                        ?>
                                        <option  selected value="<?php echo $ID ?>"><?php echo "جامعة $name" ?></option>
                                        <?php
                                    }
                                   
                                
                          ?>
                        </select>
						
                    </div>
                </td>
                <td></td>
                <td></td>
            </tr>

 
			<!------------------------------------------------>
			
			
				   
				   
				   
				   
				   
				   
				   
				   
				   
	
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
					 $sql = "SELECT  distinct activity_type.`ID`,activity_type.`name` FROM `activity_type` ";
					
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
                        <input type="date" id="date" name="date" required >
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
                        <input type="text" id="b_enroll_male" name="b_enroll_male" required>
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
		<div align="right"> ملف يحتوى على صورة
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
	  


        </table>
    </div>
    <tr>
      <td colspan="2" align="rtl"><label>
<a href="home.php" style= "color:black">
        <input type="button" value="رجوع" style="width:6em ;  height:2em;"style= "color:black"  /></a>
      </label>
	 
	  </td>
	
    
      <td colspan="2" align="center"><label>
        <input type="submit"   value="إضافة " style="width:8em ;height:2em;" onclick="validatename();return false;" />
		<input type="hidden"   id="idd" name="idd" value="<?php echo $id; ?> "   />
      </label>

	  </td>
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
<script>
    $("#topicselect").select2({minimumResultsForSearch: -1});
    $("#topicselect").select2();
   
    function validatename() {
        var y = document.getElementById("topicselect").value;
        var u = document.getElementById("typeselect").value;
       
       
        window.location.href = "insert_data.php?year=" + y + "&" + "univ=" + u + "&" ;
    }

</script>
<script>
    function validatename() {
        var topicselect = document.getElementById("topicselect").value;
        if (topicselect.length == 0 || topicselect == -1) 
		{
            var str = "يرجى اختيار طبيعة النشاط";
            alert(str);
        }
		else 
		{
            var typeselect = document.getElementById("typeselect").value;
            if (typeselect.length == 0 || typeselect == -1) {
                var str = "يرجى اختيار نوعية النشاط";
                alert(str);
         }
		 else
		 {
			  form.submit();
		 }
		}
	}
</script>
    