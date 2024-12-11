
<?php
include ('header.php');
// $user_name = $_SESSION['name'];
// echo $user_name;
// echo "test";
$univ_logins=$_SESSION['fk_university'];
// Code Search Into Database
$id = $_GET['id'];
$idnewpage = $_GET['id'];
//echo $id;
if($id ==1)
{
}
else if($id ==2)
{
}
else
{
}
 ?>

  
 
	

<?php if($id==2){
	include_once "activityBulk.php";	
} 
else
{
	?>
    <form id="form1" name="form1" method="post" action="insert_data.php">
        <div align="right">
   <table>        
<tr>
      <td colspan="2" align="center"><label>
        <input type="submit"   value="إضافة نشاط جديد " style="width:8em ;height:2em;"  />
	
		<input type="hidden"   id="idd" name="idd" value="<?php echo $id; ?> "   />
      </label>

	  </td>
</tr>
</table>
</div> 
<div class="content">
<center>







<table class="table table-bordered table-striped" align="center" dir="rtl" border="2" style="margin-right:17%; width:100%;align:center;margin-top:1%; background-color:#e9eef3;border-radius:10px;"> 

<tr style="font-weight:bold;background-color:#a7d2ff;" align="center" >
<td>م</td>
   <td>الجامعة</td>
    <td>الكليه</td>
    <td>طبيعة النشاط</td>
    <td>نوعية النشاط</td>
<!--  <td>تاريخ النشاط</td>-->
    <td>نوعية المستفيدين</td>
	 <td>تاريخ النشاط</td>
	<!-- <td>عدد الطلاب المشتركين</td>-->
  <!--  <td>ملف لرفع الصورة</td> -->
	<td colspan=4></td>
	
  
</tr>
 
		<?php
		/*echo $id;
		echo "DDD";
		echo $univ_logins;
		exit();*/
  $sql ="SELECT distinct  `activity`.`serial` as serial,`activity`.`activity_natural_ID` as activity_natural_ID ,activity_natural.name as activity_natural_name ,`activity`.`activity_type_ID`as activity_type_ID,
  activity_type.name as  activity_type_name,`activity`.`university_ID`,university.name as  university_name,`activity`.`Date` as Date,`activity`.`title`as title,`activity`.`pdf_image`as image,`activity`.`activity_desc`
,`activity`.fk_coll,college.name as collname ,`activity`.Date as Date,`activity`.no_student
FROM `activity`,activity_natural,activity_type,university,college
where activity.active=1 and `activity`.`activity_natural_ID`=activity_natural.ID
and `activity`.`activity_type_ID`=activity_type.ID
and `activity`.`university_ID`=university.ID
and college.id=`activity`.fk_coll
and `activity_top_ID`=$id
and `activity`.`university_ID`=$univ_logins
order by `activity`.Date, collname, activity_natural.name, activity_type_name, title
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
		//$no_student = $row['no_student'];
		
		
	?>		<tr> 
	<td class="text-center">   <?php     echo  $id++ ; ?> </td>
	 <td class="text-center"><?php echo $university_name?> </td>
	 <td class="text-center"><?php echo $collname?> </td>
	<td class="text-center"> <?php echo $activity_natural_name ?> </td>
			    <td class="text-center"><?php echo $activity_type_name ?> </td>
				<!-- <td class="text-center"><?php echo $Date ?> </td>-->
				  <td class="text-center"> <?php echo $title ?></td>
				   <td class="text-center"> <?php echo $Date ?></td>
				   <!--  <td class="text-center"> <?php echo $no_student ?></td>-->
				<!--   <td class="text-center"><?php echo $image?> </td> -->
				   
				      <td class="text-center"><a href="viewEdit.php?activityId=<?php echo $row['serial'];?>" target="_blank">عرض</a> </td>
					  
				      <td class="text-center">
						<!-- remove the blow line to disable edit-->
						<a href="viewEdit.php?oper=EDIT&activityId=<?php echo $row['serial'];?>" target="_blank">تعديل</a> 
					  </td>
					  <!--      <td class="text-center"><a href="3ard.php?id=<?php echo $row['image'];?>">عرض</a> </td> -->
			   
			 <!--   <td class="text-center"><a href="view_all.php?id='.$row['ID'].'">تعديل </a> </td>-->
				<td class="text-center"><a href="deleteuser.php?serial=<?php echo $row['serial'];?> && id=<?php echo $idnewpage;?>">حذف</a> </td>
			  
			   </tr>
			   
<?php	}
?>	
			
</center>

  </table>
</div>
</form>

<?php }?>
	
<?php

include 'footer.php';
?>
