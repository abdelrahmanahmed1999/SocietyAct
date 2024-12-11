<style>
@media print {
  th:last-child, td:last-child {
   
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
	
	$sql = "SELECT DISTINCT `ID`,`name` FROM `university` where `ID`=? ";
            $stmt = $con->prepare($sql);
			$stmt->bind_param('s', $_POST['univ_select']);
            $stmt->execute();
            $res = $stmt->get_result();
            while ($row = $res->fetch_array(MYSQLI_ASSOC)) 
			{
                $ID = $row['ID'];
                $univname = $row['name'];     
				$univnameheader = $row['name'];  
            }
	}
	else
	{
		$univ="";
		  $univname ="";
		  
	}

	
	//////////////////////////////////////////////////
	
}
else
{
	$univ="";
    $univname ="";


}
	

 ?>

 <form id="form11" name="form1" method="post" action="">
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
									<option value="-1">-- كل الجامعات--</option>
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
				</tr>
				<!--------------------------------------------------------------------------------------------------------------------------------->

	
			<!------------------------------------------------>
			
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
<div align="center" style="font-weight:bold" id="printt">
				<a href="#" onclick="printf();return false;" style="font-size:27px">طباعة بيانــات التـــــــقريــر </a>
			</div>

 
<!--------------------------------------------------------------------------------------------------------------------------------->
    <form id="form1" name="form1" method="post" action="">
	

	


<div class="content">


<center>
<?php 
echo "<br>";


//////////////////////////////////////////////////
if($univname=="")
{
 $univnameheader="كل الجامعات"; 
}

?>
</center>
<?php echo'

<div align="center"><strong style="color:blue"><u>إحصائية بالأنشطة الطلابيه للجامعات المصريه</u></strong></div>';
?>
<table class="table table-bordered table-striped" align="center" dir="rtl" border="2" style="background-color:#e9eef3;border-radius:10px;" > 
<br>
<tr style="font-weight:bold;background-color:#a7d2ff;" align="center" >
<td>م</td>
   <td>الجامعة</td>
   <td> عدد الأنشطة القمية بمشاركة الجامعات</td>
    <td>عدد الأنشطة الطلابية العامة</td>
   <td>عدد أنشطة برامج التوعية</td>
     <td>الإجمالى</td>
</tr>

  
   
 
  
 
		<?php
	
  $sql ="SELECT distinct `university_ID` as university_id ,university.name as university_name FROM `activity`,university
where `university_ID`=university.ID
$univ
";

//echo  $sql;


$stmt = $con->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
	$id = 1;
    while($row = $res->fetch_array(MYSQLI_ASSOC))
	{
		
		$university_id=$row['university_id'];
		
		$university_name=$row['university_name'];
?><tr> 
<td class="text-center">   <?php     echo  $id++ ; ?> </td>
 <td class="text-center"><?php echo $university_name?> </td>
 <?php
$sqlnatural1 ="SELECT count(`serial`) as natural1 FROM `activity` where  `activity_natural_ID`=1 and `university_ID`=$university_id";
$stmtnatural1 = $con->prepare($sqlnatural1);
    $stmtnatural1->execute();
    $resnatural1 = $stmtnatural1->get_result();
	 while($rownatural1 = $resnatural1->fetch_array(MYSQLI_ASSOC))
	{
		$natural1=$rownatural1['natural1'];
		?> <td class="text-center"><?php echo $natural1?> </td>
		
		
	<?php	$sqlnatural2 ="SELECT count(`serial`) as natural2 FROM `activity` where  `activity_natural_ID`=2 and `university_ID`=$university_id";
$stmtnatural2 = $con->prepare($sqlnatural2);
    $stmtnatural2->execute();
    $resnatural2 = $stmtnatural2->get_result();
	 while($rownatural2= $resnatural2->fetch_array(MYSQLI_ASSOC))
	{
		$natural2=$rownatural2['natural2'];
		?> 

		<td class="text-center"><?php echo $natural2?> </td>
		
	<?php	$sqlnatural3 ="SELECT count(`serial`) as natural3 FROM `activity` where  `activity_natural_ID`=3 and `university_ID`=$university_id";
$stmtnatural3 = $con->prepare($sqlnatural3);
    $stmtnatural3->execute();
    $resnatural3 = $stmtnatural3->get_result();
	 while($rownatural3= $resnatural3->fetch_array(MYSQLI_ASSOC))
	{
		$natural3=$rownatural3['natural3'];
		$x=$natural1+$natural2+$natural3;
		?> 

		<td class="text-center"><?php echo $natural3?> </td>
		
		<td class="text-center"><?php echo $x?> </td>
		
			   </tr>
	
<?php	
}
	}
	}
}
?>	
			


  </table>

</div>

</form>
	
<?php

//include 'footer.php';
?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
 
<script>
function printf() {
   document.getElementById("printt").style.display = 'none';
   document.getElementById("form11").style.display = 'none';
    //   document.getElementById("add_eval").style.visibility = 'hidden';
    // document.getElementById("back2").style.visibility = 'hidden';
    window.print();
    document.getElementById("printt").style.display = 'block';
	document.getElementById("form11").style.display = 'block';
}
</script>