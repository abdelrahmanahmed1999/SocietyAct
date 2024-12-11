<style>

</style>

<?php
include("../include/connection.php");
$id = $_GET['id'];
if($id==1)
	$reportTitle = "<strong>الأنشــطة التى تــمت بالفــعل</strong>";
else if($id==2)
	$reportTitle = "خطة الأنشطة الطلابية المستقبلية";
$reportUniversityImg="";
$reportUniversityName = "";
if (isset($_POST['search']))
{	
	if (isset($_POST['univ_select'])&& ($_POST['univ_select'] !=-1))
	{
	$univ_select =$_POST['univ_select'];
	$univ="and  `activity`.`university_ID`=$univ_select";
	
	$sql = "SELECT DISTINCT `ID`,`name`, logo FROM `university` where `ID`=? ";
            $stmt = $con->prepare($sql);
			$stmt->bind_param('s', $_POST['univ_select']);
            $stmt->execute();
            $res = $stmt->get_result();
            while ($row = $res->fetch_array(MYSQLI_ASSOC)) 
			{
                $ID = $row['ID'];
                $univname = $row['name'];     
				$univnameheader = $row['name']; 
				$reportUniversityImg = $row ['logo'];
				$reportUniversityName = $univname;
            }
	}
	else
	{
		$univ="";
		  $univname ="";
	}
}

include ('header.php');
echo "<h1 style='font-weight:bold;font-size:28px;color: steelblue;text-align:center;'  class='web'>$reportTitle</h1>";

if (isset($_POST['search']))
{
	///////////////////////////////////
	if (isset($_POST['topicselect']) && ($_POST['topicselect'] !=-1))
	{
	$topicselect =$_POST['topicselect'];
	$topics="  and `activity`.`activity_natural_ID`=$topicselect";
	$sql = "SELECT DISTINCT `ID`,`name` FROM `activity_natural` where `ID`=? ";
            $stmt = $con->prepare($sql);
			$stmt->bind_param('s', $_POST['topicselect']);
            $stmt->execute();
            $res = $stmt->get_result();
            while ($row = $res->fetch_array(MYSQLI_ASSOC)) 
			{
                $ID = $row['ID'];
                $topicname = $row['name'];    
 $topicnameheader = $row['name'];  				
            }
	}
	else
	{
		$topics="";
		$topicname ="";
	}
	//////////////////////////////////////////////////
	if (isset($_POST['typeselect']) && ($_POST['typeselect'] !=-1))
	{
	$typeselect =$_POST['typeselect'];
	$types="  and `activity`.`activity_type_ID`=$typeselect";
	
	$sql = "SELECT DISTINCT `ID`,`name` FROM `activity_type` where `ID`=? ";
            $stmt = $con->prepare($sql);
			$stmt->bind_param('s', $_POST['typeselect']);
            $stmt->execute();
            $res = $stmt->get_result();
            while ($row = $res->fetch_array(MYSQLI_ASSOC)) 
			{
                $ID = $row['ID'];
                $typename = $row['name'];     
				$typenameheader = $row['name'];  
            }
	
	}
	else
	{
		$types="";
		 $typename ="";  
	}
	//////////////////////////////////////////////////
	if (isset($_POST['taklefselect']) && ($_POST['taklefselect'] !=-1))
	{
	$taklefselect =$_POST['taklefselect'];
	$taklef="  and `activity`.`fk_taklefselect`=$taklefselect";
	
	
		$sql = "SELECT DISTINCT `ID`,`name` FROM `taklef` where `ID`=? ";
            $stmt = $con->prepare($sql);
			$stmt->bind_param('s', $_POST['taklefselect']);
            $stmt->execute();
            $res = $stmt->get_result();
            while ($row = $res->fetch_array(MYSQLI_ASSOC)) 
			{
                $ID = $row['ID'];
                $taklefname = $row['name'];     
				$taklefnameheader = $row['name'];  
            }
	}
	else
	{
		$taklef="";
		$taklefname = "";
	}
	
	//////////////////////////////////////////////////
	if (isset($_POST['date'])&& isset($_POST['End_date'])&& (($_POST['End_date']) !="")&& (($_POST['date'])!=""))
	{
	//	echo "date".$_POST['date'];
	$date =$_POST['date'];
	$ff="'".$date."'";
	$End_date =$_POST['End_date'];
	$fff="'".$End_date."'";
	$dateq=" and `activity`.`Date` between $ff  and $fff"  ;
	$rrr="(`activity`.`Date` between $date  and $End_date)"  ;
	 
	}
	else
	{
		$dateq="";
		$ff="";
		$rrr="(`activity`.`Date` between '2023-03-01'  and '2090-03-01')"  ;
	}
	//////////////////////////////////////////////////
	
	
	if (isset($_POST['nashat_name'])&&(($_POST['nashat_name']) !=""))
	{
		$nashat_name=$_POST['nashat_name'];
		$nashat_nameq=" and `activity`.`title` LIKE '%$nashat_name%'";
	}
	else
	{
		$nashat_nameq="";
	}
	//////////////////////////////////////////////////
	if (isset($_POST['wafed_student'])){
	
		$wafed_student=$_POST['wafed_student'];
		$wafed_studentq=" and `activity`.`wafed_student` !=0";
		$wafed_student_title="الطلاب الوافدين  ";
	}
	else
	{
		$wafed_studentq="";
		$wafed_student_title="";
	}
	
	
	/////////////
	if (isset($_POST['egy_student'])){
	
		$egy_student=$_POST['egy_student'];
		$egy_studentq=" and `activity`.`egy_student` !=0";
		$egy_student_title="الطلاب المصريين  ";
	}
	else
	{
		$egy_studentq="";
		$egy_student_title="";
	}
	///////////////
	if (isset($_POST['khas_student'])){
	
		$khas_student=$_POST['khas_student'];
		$khas_studentq=" and `activity`.`khas_student` !=0";
		$khas_student_title="الطلاب ذوى الاحتياجات الخاصة  ";
	}
	else
	{
		$khas_studentq="";
		$khas_student_title="";
	}
	//////////////////////////////////////////////////
	if(($wafed_student_title=="")&&($egy_student_title=="")&&($khas_student_title==""))
	{
		$student_title="كل الطلاب المشتركين";
	}
	else
	{
		$student_title=$wafed_student_title.$egy_student_title.$khas_student_title;
	}
	////////////////////////////////////////////////
}
else
{
	$univ="";
	$topics="";
	$types="";
	$taklef="";
	$univname ="";
	$topicname ="";
	$typename =""; 
	$taklefname = "";
		$dateq="";
		$ff="";
	$rrr="(`activity`.`Date` between '2023-03-01'  and '2090-03-01')"  ;
	$nashat_nameq="";
	$wafed_studentq ="";
	$egy_studentq ="";
	$khas_studentq ="";
}
	///////////////////////////////////


	

 ?>

 <form id="form11" name="form1" method="post" action=""  class="web">
    <div align="right">
        <table width="475" border="0" dir="rtl" class="table table-striped">
			<!------------------------------------------------>
			<tr>
                <td><div align="right"> الجامعة</div></td>
                <td dir="rtl">
                    <div align="right">
                        <select name="univ_select" id="univ_select" required  class="form-control" style="width:250px" 
                                oninvalid="this.setCustomValidity('يجب إختيار الجامعة')" oninput="setCustomValidity('')">
                            <?php
							if (isset($_POST['univ_select'])&& ($_POST['univ_select'] !=-1))
							{
								$sql = "SELECT distinct ID, name FROM university where ID=? ORDER BY name ASC";
                                $stmt = $con->prepare($sql);
								$stmt->bind_param('s', $_POST['univ_select']);
								$stmt->execute();
                                $res = $stmt->get_result();
                                while ($row = $res->fetch_array(MYSQLI_ASSOC)) 
								{
									$ID = $row['ID'];
									$name = $row['name'];
									echo "<option value=\"$ID\">جامعة $name</option>";
                                }
								echo "<option value=\"-1\">-- كل الجامعات--</option>";
								$sql = "SELECT distinct ID, name FROM university where ID!=? ORDER BY name ASC";
                                    $stmt = $con->prepare($sql);
							$stmt->bind_param('s', $_POST['univ_select']);
           
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                                        $ID = $row['ID'];
                                        $name = $row['name'];
                                        ?>
                                        <option value="<?php echo $ID ?>"><?php echo "جامعة $name" ?></option>
                                        <?php
                                    }
                                
                                   
	} 
else
{
	 ?>
                                    <option value="-1">-- كل الجامعات --</option>
                                    <?php
                                    $sql = "SELECT distinct ID, name FROM university ORDER BY name ASC";
                                    $stmt = $con->prepare($sql);
							
           
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                                        $ID = $row['ID'];
                                        $name = $row['name'];
                                        ?>
                                        <option value="<?php echo $ID ?>"><?php echo "جامعة $name" ?></option>
                                        <?php
                                    }
}	
						
                          ?>
                        </select>
                    </div>
                </td>
				<td></td>
				</tr>
				<!--------------------------------------------------------------------------------------------------------------------------------->

	
                <tr>
                <td>
                    <div align="right"> طبيعة النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <select name="topicselect" id="topicselect" class="form-control" style="width:250px"

 				<oninvalid="this.setCustomValidity('يجب اختيار طبيعة النشاط')"
 oninput="setCustomValidity('')"  />
                 
					
					<?php
                       
                              if (isset($_POST['topicselect'])&& ($_POST['topicselect'] !=-1))
	{
                                    ?>
                                
						
						<?php 
					
					$sql = 'SELECT distinct `ID`,`name` FROM `activity_natural` where ID=?';
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->bind_param('s', $_POST['topicselect']);
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
	<option value="-1">-- كل طبيعة النشاط --</option>		
<?php	
					
					$sql = 'SELECT distinct `ID`,`name` FROM `activity_natural` where ID!=?';
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->bind_param('s', $_POST['topicselect']);
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
					?> 
						<option value="<?php echo $ID ?>" ><?php echo $name?></option>
						
						<?php 
}
	}
else
{
	 ?>
                                    <option value="-1">-- كل طبيعة النشاط --</option>
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
                                        <option value="<?php echo $ID ?>"><?php echo $name ?></option>
                                        <?php
                                    }
}	
						
                          ?>	
	
	
				</select>
					
                </td>
				<td></td>
                   </tr>   
            
				<!--------------------------------------------------------------------------------------------------------------------------------->
			
                       <tr>
                <td>
                    <div align="right"> نوعية النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <select name="typeselect" id="typeselect" class="form-control" style="width:250px"

 				<oninvalid="this.setCustomValidity('يجب اختيار نوعية النشاط')"
 oninput="setCustomValidity('')"  />
                 
					
					<?php
                       
                              if (isset($_POST['typeselect'])&& ($_POST['typeselect'] !=-1))
	{
                                    ?>
                                
						
						<?php 
					
					 $sql = "SELECT  distinct activity_type.`ID`, activity_type.`name` FROM `activity_type` where ID=?";
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->bind_param('s', $_POST['typeselect']);
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
<option value="-1">-- كل نوعية النشاط --</option>
<?php				
					
					$sql =  $sql = "SELECT  distinct activity_type.`ID`,activity_type.`name` FROM `activity_type` where ID!=?";
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->bind_param('s', $_POST['typeselect']);
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
					?> 
						<option value="<?php echo $ID ?>" ><?php echo $name?></option>
						
						<?php 
}
	}
else
{
	 ?>
                                    <option value="-1">-- كل نوعية النشاط --</option>
                                    <?php
                                  $sql = 'SELECT  distinct activity_type.`ID`,activity_type.`name` FROM `activity_type`';
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
                                        ?>
                                        <option value="<?php echo $ID ?>"><?php echo $name ?></option>
                                        <?php
                                    }
}	
						
                          ?>	
						  
	
	
				</select>
					
                </td>
				<td></td>
                   </tr>   
				   <!------------------------------------------------------------------------------------->
				   
				   <tr>
                <td>
                    <div align="right"> نوعية التكليف</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <select name="taklefselect" id="taklefselect" class="form-control" style="width:250px"

 				<oninvalid="this.setCustomValidity('يجب اختيار نوعية التكليف')"
 oninput="setCustomValidity('')"  />
                   
					
					<?php
                       
                              if (isset($_POST['taklefselect'])&& ($_POST['taklefselect'] !=-1))
	{
                                    ?>
                                
						
						<?php 
					
					 $sql = "SELECT distinct `ID`,`name` FROM `taklef` WHERE ID =?";
					$stmt = $con->prepare($sql);
					/* Execute statement */
					
					$stmt->bind_param('s', $_POST['taklefselect']);
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

<?php				
					
					  $sql = "SELECT distinct `ID`,`name` FROM `taklef` WHERE ID !=?";
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->bind_param('s', $_POST['taklefselect']);
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
					?> 
						<option value="<?php echo $ID ?>" ><?php echo $name?></option>
						
						<?php 
}
	}
else
{
	 ?>
                                    <option value="-1">-- كل نوعية التكليف --</option>
                                    <?php
                                  $sql = 'SELECT distinct `ID`,`name` FROM `taklef`';
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
                                        ?>
                                        <option value="<?php echo $ID ?>"><?php echo $name ?></option>
                                        <?php
                                    }
}	
						
                          ?>	
						  
	
	
				</select>
					
                </td>
				<td></td>
                   </tr>   
				   
				   
			<!------------------------------------------------>				   
				           <tr>
				 <td>
                    <div align="right">من تاريخ</div>
                </td>

                <td dir="rtl">
                    <div align="right">
<?php if (isset($_POST['date']))
{
	?><input type="date" id="date" name="date" value=<?php echo $_POST['date'];?> >
<?php
}
else
{
?>
<input type="date" id="date" name="date" class="form-control" style="width:250px" >
<?php
}?>		 
                    </div>
                </td>
                 <td></td>   
            
			</tr>
			<!------------------------------------------------>

            
			
            
			<!------------------------------------------------>
              <tr>
				 <td>
                    <div align="right">جزء من اسم النشاط</div>
                </td>
				  <td dir="rtl">
 <div align="right">
 
  <?php  if (isset($_POST['nashat_name'])&&(($_POST['nashat_name'])!="") )
   {
      ?>       <input type="text" id="nashat_name" name="nashat_name" value=<?php echo $_POST['nashat_name'];?> >
<?php   }
else
{
	  ?>  <input type="text" id="nashat_name" name="nashat_name" class="form-control" style="width:250px" >
<?php }	?>
                       
                    </div>
                </td>
                <td></td>    
            
			</tr>			
			
			
			<!------------------------------------------------>
			
			 <tr>
  <td colspan="2" align="center">
  <label>
        <input type="submit"   id="search" name="search" value="بحث " style="width:8em ;height:2em;" />
      </label>
	  </td>
	  <td></td>
	  </tr>
			
			
			</table>
</div>
 </form>
 
 <?php 
	if (isset($_POST['search']))
	{
?>
<div align="center" style="font-weight:bold" id="printt" class="web">
				<a href="#" onclick="printf();return false;" style="font-size:27px">طباعة بيانــات التـــــــقريــر </a>
			</div>

 
<!--------------------------------------------------------------------------------------------------------------------------------->
    <form id="form1" name="form1" method="post" action="">
	

	


<div class="content">


<center>
<?php 

if (isset($_POST['End_date'])&&isset($_POST['date'])&&(($_POST['End_date']) !="")&& (($_POST['date'])!=""))
{
	$month1 = date("m",strtotime($date));
	$month2 = date("m",strtotime($End_date));
	
	$months = array(
    "01" => "1",
    "02" => "2",
    "03" => "3",
    "04" => "4",
    "05" => "5",
    "06" => "6",
    "07" => "7",
    "08" => "8",
    "09" => "9",
    "10" => "10",
    "11" => "11",
    "12" => "12"
);



$en_month1 = $months[$month1];
$en_month2 = $months[$month2];




}
else
{
}

//////////////////////////////////////////////////
if($univname=="")
{
 $univnameheader="كل الجامعات"; 
}
if($topicname=="")
{
 $topicnameheader="كل طبيعة النشاط"; 
}
if($typename=="")
{
 $typenameheader="كل نوعية النشاط"; 
}
if($taklefname=="")
{
 $taklefnameheader="كل أنواع التكليف"; 
}
//if($tolabname=="")
//{
 //$tolabnameheader="كل الطلاب المشتركين"; 
//}
if($nashat_nameq=="")
{
 $nashat_nameqheader="كل الأنشطة"; 
}
////////////////////
if(isset($_POST['End_date'])&&($_POST['End_date'])!="")
{
 //$End_dateheader="إلـــى شـــهـــر               ".$en_month2; 
 $End_dateheader="إلى           ".$_POST['End_date']; 
}
else
{
 $End_dateheader=""; 
}
/////////////////////
if(isset($_POST['date'])&&($_POST['date'])!="")
{
// $dateheader="مــــــن شــهـــر                ".$en_month1; 
 $dateheader="من                ".$_POST['date']; 
}
else
{
 $dateheader=""; 
}
/////////////////////////////////////////////////

?>
</center>


<?php
if($univname=="")
{

	  echo'
<table align="center" style="width:100%">
<tr>
<td colspan="2">
<div align="right"><strong style="color:blue">طبيعة النشاط : ' . $topicnameheader . '</strong></div>
</td>
<td colspan="2">
<div align="right"><strong style="color:blue">الجامعة : ' . $univnameheader . ' </strong></div>
</td>
</tr>


<tr>
<td colspan="2">
<div align="right"><strong style="color:blue">نوعية النشاط : ' . $typenameheader . '    </strong></div>
</td>
<td colspan="2">
<div align="right">
<strong style="color:blue">نوعية التكليف : ' .  $taklefnameheader . ' </strong></div>
</td>
</tr>


<tr>
<td colspan="2">
<div align="right"><strong style="color:blue"> جزء من اسم النشاط : ' .   $nashat_nameqheader . ' </strong></div>
</td>


</tr>



<tr>
<td colspan="2">
</td>
<td colspan="2">
<div align="right"><strong style="color:blue">' . $dateheader . ' ' . $End_dateheader . '</strong></div>
</td>
</tr>
</table>
';

}
else
{
	$unividddddddddd=$_POST['univ_select'];
	//echo $unividddddddddd;
	
	$sql6="SELECT `logo` FROM `university` where `ID`= $unividddddddddd ";
	$stmt6 = $con->prepare($sql6);
    $stmt6->execute();
    $res6 = $stmt6->get_result();
	  while($row6 = $res6->fetch_array(MYSQLI_ASSOC))
	{
		
		$logo_path =$row6['logo'];
	//echo $logo_path;
		
	?>


<?php


 echo'
<table align="center" style="width:100%">
<tr>
<td colspan="2">
<div align="right"><strong style="color:blue">طبيعة النشاط : ' . $topicnameheader . '</strong></div>
</td>
<td colspan="2">
<div align="right"><strong style="color:blue">الجامعة : ' . $univnameheader . ' </strong></div>
</td>
</tr>


<tr>
<td colspan="2">
<div align="right"><strong style="color:blue">نوعية النشاط : ' . $typenameheader . '    </strong></div>
</td>
<td colspan="2">
<div align="right">
<strong style="color:blue">نوعية التكليف : ' .  $taklefnameheader . ' </strong></div>
</td>
</tr>


<tr>
<td colspan="2">
<div align="right"><strong style="color:blue"> جزء من اسم النشاط : ' .   $nashat_nameqheader . ' </strong></div>
</td>
<td colspan="2">
<div align="right"><strong style="color:blue"> الطلاب المشتركين : ' .  $student_title . ' </strong></div>
</td>

</tr>



<tr>
<td colspan="2">
</td>
<td colspan="2">
<div align="right"><strong style="color:blue">' . $dateheader . ' ' . $End_dateheader . '</strong></div>
</td>
</tr>
</table>
';


?>
		
	<?php
}
	
}
?>

<table class="table table-bordered table-striped" align="center" dir="rtl" border="2" style="background-color:#e9eef3;border-radius:10px;width:98%;" > 
<tr style="font-weight:bold;background-color:#a7d2ff;" align="center" >
<td>م</td>
   <td>الجامعة</td>
   
   <td>الكليه</td>
    <td>طبيعة النشاط</td>
   <td>نوعية النشاط</td>

	<td>نوعية التكليف</td>
    <td>اسم النشاط</td>
	    <td>تاريخ النشاط</td>
	<td>عدد المشاركين</td>
	<td class="web"></td>
  <!--  <td>ملف لرفع الصورة</td> -->
	<!--<td colspan=3></td>-->
	
  
</tr>

  
   
 
  
 
		<?php
	
  $sql ="SELECT distinct  `activity`.`serial` as serial,`activity`.`activity_natural_ID` as activity_natural_ID ,activity_natural.name as activity_natural_name ,`activity`.`activity_type_ID`as activity_type_ID,
  activity_type.name as  activity_type_name,`activity`.`university_ID`,university.name as  university_name,`activity`.`Date` as Date,`activity`.`title`as title,`activity`.`pdf_image`as image,`activity`.`activity_desc`
  , `activity`.`fk_taklefselect`as fk_taklefselect , `taklef`.`Name`as fffName ,`activity`.fk_coll,college.name as collname ,`activity`.`Date` as Date,`activity`.`End_Date` as End_Date,`activity`.no_student
  
  FROM `activity`,activity_natural,activity_type,university , activity_top ,college ,taklef 
  
where `activity`.`activity_natural_ID`=activity_natural.ID  and `activity`.`activity_top_ID`= $id 
and `activity`.`activity_type_ID`=activity_type.ID
and `activity`.`university_ID`=university.ID and college.id=`activity`.fk_coll
and  `activity`.fk_taklefselect = taklef.ID
$univ
$topics
$types
$taklef
$dateq
$nashat_nameq
$wafed_studentq
$egy_studentq 
$khas_studentq
";

//echo  $sql;


$stmt = $con->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
	$id = 1;
    while($row = $res->fetch_array(MYSQLI_ASSOC))
	{
		
		$serial=$row['serial'];
		
		$university_name=$row['university_name'];

		$activity_natural_ID=$row['activity_natural_ID'];
		$activity_natural_name=$row['activity_natural_name'];
		$activity_type_ID=$row['activity_type_ID'];
		$activity_type_name= $row['activity_type_name'];
		$university_name= $row['university_name'];
		$Date= $row['Date'];
		$title= $row['title'];
		$image= $row['image'];
		$collname= $row['collname'];
		$fffName = $row['fffName'];
		$no_student = $row['no_student'];
		
		
		?>		<tr> 
	<td class="text-center">   <?php     echo  $id++ ; ?> </td>
	 <td class="text-center"><?php echo $university_name?> </td>
	  <td class="text-center"><?php echo $collname?> </td>
	<td class="text-center"> <?php echo $activity_natural_name ?> </td>
			    <td class="text-center"><?php echo $activity_type_name ?> </td>
				
				  <td class="text-center"><?php echo $fffName?> </td>
				  <td class="text-center"> <?php echo $title ?></td>
				  	  <td class="text-center"><?php echo $Date?> </td> 
				   <td class="text-center"> <?php echo $no_student ?></td>
			
				   
				      <td class="text-center web"><a href="res_view_all.php?id=<?php echo $row['serial'];?>">عرض</a> </td>
					  <!--      <td class="text-center"><a href="3ard.php?id=<?php echo $row['image'];?>">عرض</a> </td> -->
			   
			   <!-- <td class="text-center"><a href="view_all.php?id='.$row['ID'].'">تعديل </a> </td>-->
				<!--<td class="text-center"><a href="deleteuser.php?serial= ">حذف</a> </td>-->
			  
			   </tr>
			   
<?php	}
?>	
			


  </table>

</div>

</form>
	
<?php
	}
include 'footer.php';
?>
<script>
function printf() {
    window.print();
}
</script>








<!----------------------------------->

