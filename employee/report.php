<style>
@media print {
  th:last-child, td:last-child {
    display:none;
  }
}


</style>


<?php
include ('header.php');
if (isset($_POST['search']))
{
	
	if (isset($_POST['univ_select'])&& ($_POST['univ_select'] !=-1))
	{
	$univ_select =$_POST['univ_select'];
	$univ="and  `activity`.`university_ID`=$univ_select";
	}
	else
	{
		$univ="";
	}
	///////////////////////////////////
	if (isset($_POST['topicselect']) && ($_POST['topicselect'] !=-1))
	{
	$topicselect =$_POST['topicselect'];
	$topics="  and `activity`.`activity_natural_ID`=$topicselect";
	}
	else
	{
		$topics="";
	}
	//////////////////////////////////////////////////
	if (isset($_POST['typeselect']) && ($_POST['typeselect'] !=-1))
	{
	$typeselect =$_POST['typeselect'];
	$types="  and `activity`.`activity_type_ID`=$typeselect";
	}
	else
	{
		$types="";
	}
	//////////////////////////////////////////////////
	if (isset($_POST['taklefselect']) && ($_POST['taklefselect'] !=-1))
	{
	$taklefselect =$_POST['taklefselect'];
	$taklef="  and `activity`.`fk_taklefselect`=$taklefselect";
	}
	else
	{
		$taklef="";
	}
}
else
{
	$univ="";
	$topics="";
	$types="";
	$taklef="";
}
	

 ?>

 <form id="form1" name="form1" method="post" action="">
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
                       
                              if (isset($_POST['univ_select'])&& ($_POST['univ_select'] !=-1))
	{
                                    ?>
                                
                                    <?php
                                    $sql = "SELECT distinct ID, name FROM university where ID=? ORDER BY name ASC";
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
									?>
									<option value="-1">-- اختر الجامعه --</option>
									<?php
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
                                    <option value="-1">-- اختر الجامعه --</option>
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
				</tr>
				<!--------------------------------------------------------------------------------------------------------------------------------->

	
                   
            
							   <!------------------------------------------------------------------------------------->
				   
	
			
		 
			
			
			 <tr>
  <td colspan="2" align="center">
  <label>
        <input type="submit"   id="search" name="search" value="بحث " style="width:8em ;height:2em;" />
      </label>
	  </td>
	  </tr>
			
			
			</table>
</div>
 </form>
 
 <?php
echo '<table class="table  table-striped" align="center" dir="rtl" border="2" style="margin-right:17%; width:78%;align:center;margin-top:1%; ;"> 

  ';
  ?>
 
<!--------------------------------------------------------------------------------------------------------------------------------->
    <form id="form1" name="form1" method="post" action="">
	
        <div align="center" style="font-weight:bold" id="printt">
				<a href="#" onclick="printf();return false;" style="font-size:27px">  طباعة بيانــات التـــــــقريــر </a>
			</div>

 <?php
echo '<table width="20%" border="0" align="right" style="margin-bottom: 20px;" dir="rtl" >

  ';
  ?>
   <table>        
<tr>
    <!--  <td colspan="2" align="center"><label>
        <input type="submit"   value="إضافة نشاط جديد " style="width:8em ;height:2em;"  />
	
      </label>

	  </td>-->
</tr>
</table>
</div> 

<div class="content">
<center>

<table class="table  table-striped" align="center" dir="rtl" border="2" style="margin-right:17%; width:78%;align:center;margin-top:1%; ;"> 

<tr style="font-weight:bold;" align="center">
<td></td>
   <td>النشاط الرياضى</td>
   <td>النشاط الثقافى</td>
    <td>النشاط الفنى</td>
    <td>النشاط الاجتماعى</td>
    <td>أنشطة اعادة القادة</td> 
	<td>أنشطة الجوالة والخدمة العامة</td>
    <td>أنشطة الأسر والاتحادات الطلابية</td>
   <td>أنشطة ذوى الاحتياجات الخاصة</td> 
	<td>أنشطة رعاية الموهوبين</td> 
	<td>أنشطة التدريب المهنى</td>
    <td>أنشطة نادى العلوم والتكنولوجيا</td>
   <td>أنشطة المعسكرات</td> 
	 <td>أنشطة التوعية</td> 
  
</tr>
<tr style="font-weight:bold;" align="center">
   <td>الأنشطة القمية</td>
   
</tr>
<tr style="font-weight:bold;" align="center">
   <td>الأنشطة الطلابية العامة</td>
   </tr>
   <tr style="font-weight:bold;" align="center">
    <td>أنشطة التوعية</td>
	</tr>

 
		<?php
	
  $sql ="SELECT distinct  `activity`.`serial` as serial,`activity`.`activity_natural_ID` as activity_natural_ID ,activity_natural.name as activity_natural_name ,`activity`.`activity_type_ID`as activity_type_ID,
  activity_type.name as  activity_type_name,`activity`.`university_ID`,university.name as  university_name,`activity`.`Date` as Date,`activity`.`title`as title,`activity`.`pdf_image`as image,`activity`.`activity_desc`
  , `activity`.`fk_taklefselect`as fk_taklefselect , `taklef`.`Name`as fffName ,`activity`.fk_coll,college.name as collname FROM `activity`,activity_natural,activity_type,university , activity_top ,college ,taklef 
where `activity`.`activity_natural_ID`=activity_natural.ID  and `activity`.`activity_top_ID`=2
and `activity`.`activity_type_ID`=activity_type.ID
and `activity`.`university_ID`=university.ID and college.id=`activity`.fk_coll
and  `activity`.fk_taklefselect = taklef.ID
$univ
$topics
$types
$taklef
";
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
		
		?>		<tr> 
	<!--<td class="text-center">   <?php     echo  $id++ ; ?> </td>-->
	<!-- <td class="text-center"><?php echo $university_name?> </td>-->
	 <!-- <td class="text-center"><?php echo $collname?> </td>-->
	<!--<td class="text-center"> <?php echo $activity_natural_name ?> </td>-->
			  <!--  <td class="text-center"><?php echo $activity_type_name ?> </td>-->
				
				<!--  <td class="text-center"><?php echo $fffName?> </td>-->
				<!--  <td class="text-center"> <?php echo $title ?></td>-->
				<!--   <td class="text-center"><?php echo $image?> </td> -->
				   
				   <!--   <td class="text-center"><a href="res_view_all.php?id=<?php echo $row['serial'];?>">عرض</a> </td>-->
					  <!--      <td class="text-center"><a href="3ard.php?id=<?php echo $row['image'];?>">عرض</a> </td> -->
			   
			   <!-- <td class="text-center"><a href="view_all.php?id='.$row['ID'].'">تعديل </a> </td>-->
				<!--<td class="text-center"><a href="deleteuser.php?serial= ">حذف</a> </td>-->
			  
			   </tr>
			   
<?php	}
?>	
			
</center>

  </table>
</div>

</form>
	
<?php

include 'footer.php';
?>
<script>
function printf() {
 //  document.getElementById("printt").style.display = 'none';
  // document.getElementById("form11").style.display = 'none';
    //   document.getElementById("add_eval").style.visibility = 'hidden';
    // document.getElementById("back2").style.visibility = 'hidden';
    window.print();
  //  document.getElementById("printt").style.display = 'block';
	//document.getElementById("form11").style.display = 'block';
}
</script>