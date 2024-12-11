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
	if (isset($_POST['typeselect']) && ($_POST['typeselect'] ==1))
	{
	$typeselect =$_POST['typeselect'];
	$types="  and `activity`.`activity_type_ID`=$typeselect";
	}
	else
	{
		$types="";
	}
	//////////////////////////////////////////////////
	
	if (isset($_POST['date'])&& isset($_POST['End_date']))
	{
	//	echo "date".$_POST['date'];
	$date =$_POST['date'];
	$ff="'".$date."'";
	$End_date =$_POST['End_date'];
	$fff="'".$End_date."'";
	$dateq=" and `activity`.`Date` between $ff  and $fff"  ;
	$rrr="(`activity`.`Date` between $ff  and $fff)"  ;
	 
	}
	else
	{
		$dateq="";
		$ff="";
		$rrr="(`activity`.`Date` between '2023-03-01'  and '2090-03-01')"  ;
	}
		//////////////////////////////////////////////////

}
else
{
	$univ="";
	$topics="";
	$types="";
	$dateq="";
		$ff="";
	$rrr="(`activity`.`Date` between '2023-03-01'  and '2090-03-01')"  ;
	
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
                                        <option value="<?php echo $ID ?>"><?php echo "جامعة $name" ?></option>
                                        <?php
                                    }
}	
						
                          ?>	
	
	
				</select>
					
                </td>
                   </tr>   
            
				<!--------------------------------------------------------------------------------------------------------------------------------->
			

				           <tr>
				 <td>
                    <div align="right">من تاريخ</div>
                </td>

                <td dir="rtl">
                    <div align="right">

<input type="date" id="date" name="date" required >
			 
                    </div>
                </td>
                    
            
			</tr>
			<!------------------------------------------------>
              <tr>
				 <td>
                    <div align="right">حتى تاريخ</div>
                </td>
				  <td dir="rtl">
 <div align="right">
             <input type="date" id="End_date" name="End_date" required >
			
                       
                    </div>
                </td>
                    
            
			</tr>
<!------------------------------------------------------------------------------------->				
	                       <tr>
                <td>
                    <div align="right"> ظهور نوعية النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
					 <select name="typeselect" id="typeselect" required

 				oninvalid="this.setCustomValidity('يجب اختيار ظهور نوعية النشاط')"
 oninput="setCustomValidity('')"  />
 <?php
                       
                              if (isset($_POST['typeselect'])&& ($_POST['typeselect'] ==2))
	{
		?>
		
  <option value="2" selected>لا </option>
   <option value="1">نعم </option>
    
<?php 	}
	else
	{
		?>
		
		<option value="1" selected>نعم </option>
  <option value="2">لا </option>

	<?php
	}
	
                                    ?>
 

  </select>
					</div>
                </td>
                   </tr>   
				   		 
            
			<!--------------------------------------------------------------------------------------------------------------------------------->
			
			
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
				<a href="#" onclick="printf();return false;" style="font-size:27px">  طباعة بيانــات التـــــــقريــر </a>
			</div>

 <?php
echo '<table width="20%" border="0" align="right" style="margin-bottom: 20px;" dir="rtl" >

  ';
  ?>
 
<!--------------------------------------------------------------------------------------------------------------------------------->
    <form id="form1" name="form1" method="post" >
        <div align="right">
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

<table class="table  table-striped" align="center" dir="rtl" border="2" style=" width:66%;align:center;"> 


  <tr style="font-weight:bold;" align="center">
<td>م</td>
   <td>الجامعة</td>
 
   <?php 

     if (isset($_POST['typeselect'])&& ($_POST['typeselect'] ==1))
	 {
		 ?>
		  <td>نوعية النشاط</td>
		  <?php
	 }
	 else
	 {
	 }
	 
	
   ?>
 
		<?php
		
	/*	echo $univ."<br>";
echo $topics."<br>";
echo $dateq."<br>";
echo $dateq2."<br>";

*/
 if (isset($_POST['typeselect'])&& ($_POST['typeselect'] ==1))
	 {
		$f="`activity`.`activity_type_ID`as activity_type_ID,";
		$r="activity_type.name as activity_type_name,";
		$g=",activity_type";
		$kk="and `activity`.`activity_type_ID`=activity_type.ID";
	 }
	 else
		 	 {
		$f="";
		$r="";
		$g="";
		$kk="";
	 }
	 
//////////////////////////////	 
$sqlx ="
 SELECT distinct `Date` FROM `activity` $g where $rrr $kk
  $univ
  $topics
  order by  `Date`
";

//echo  $sqlx;

$stmtx = $con->prepare($sqlx);
    $stmtx->execute();
    $resx = $stmtx->get_result();
	$num_rows = mysqli_num_rows($resx);

    while($rowx = $resx->fetch_array(MYSQLI_ASSOC))
	{
		
		$datecoulm=$rowx['Date'];
		$datecoulmx="'".$datecoulm."'";
	?>
	
	 <td class="text-center">   <?php     echo  $datecoulm ; ?> </td>
	
	<?php 	
	}
	?> </tr> <?php 
	
	
	
	$sqlxx ="
 SELECT distinct `Date` FROM `activity` $g where $rrr $kk
  $univ
  $topics
  order by  `Date`
";

//echo  $sqlx;

$stmtxx = $con->prepare($sqlxx);
    $stmtxx->execute();
    $resxx = $stmtxx->get_result();
	$id = 1;
	$flag=0;
	 while($rowxx = $resxx->fetch_array(MYSQLI_ASSOC))
	{
	$datecoulmxx=$rowxx['Date'];
		$datecoulmxxx="'".$datecoulmxx."'";
//////////////////	 
	 
  $sql ="
  
  SELECT distinct `activity`.`serial` as serial,
$f
$r
`activity`.`university_ID`,
university.name as university_name,
`activity`.`Date` as Date,
`activity`.`End_Date` as End_Date,
`activity`.`title`as title,
`activity`.`activity_desc` 
FROM `activity`$g,university  where `activity`.`university_ID`=university.ID
$kk
  $univ
  $topics
  and `activity`.`Date`=$datecoulmxxx

  
";

//echo  $sql;

$stmt = $con->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
	$w=1;
    while($row = $res->fetch_array(MYSQLI_ASSOC))
	{
		
		$serial=$row['serial'];
		
		$university_name=$row['university_name'];

	 if (isset($_POST['typeselect'])&& ($_POST['typeselect'] ==1))
	 {
		$activity_type_ID=$row['activity_type_ID'];
		$activity_type_name= $row['activity_type_name'];
	 }
		$university_name= $row['university_name'];
		$Date= $row['Date'];
		$End_Date= $row['End_Date'];
		$title= $row['title'];
		$activity_desc= $row['activity_desc'];
		
		
		
			
//echo "flag".$flag."<br>";
?>
		<tr> 
	<td class="text-center">   <?php     echo  $id++ ; ?> </td>
	 <td class="text-center"><?php echo $university_name?> </td>
<?php 	
 if (isset($_POST['typeselect'])&& ($_POST['typeselect'] ==1))
	 {
		?>	    <td class="text-center"><?php echo $activity_type_name ?> </td>
<?php
	 }
else
{
}
$klm=$num_rows-$flag;

if($flag>0)
{
	?>	
	<?php for($i=0;$i<$flag;$i++)
	{
	?><td class="text-center"></td>
	<?php
	}?>	
	<td class="text-center"><?php echo $title.$Date?> </td> 
	  <?php for($i=0;$i<$klm-1 ;$i++)
	{
	?><td class="text-center"></td>
	<?php
	}?>	
<?php
}
else
{
	 ?>
	 
	  <td class="text-center"><?php echo $title.$Date?> </td> 
	 
	  <?php for($i=0;$i<$num_rows-1 ;$i++)
	{
	?><td class="text-center"></td>
	<?php
	}?>	
	  
<?php
}
	?>		

			  
			   </tr>
	
			   
<?php	

}
	?>	   
	
<?php 	$flag++;
}
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
   document.getElementById("printt").style.display = 'none';
   document.getElementById("form11").style.display = 'none';
    //   document.getElementById("add_eval").style.visibility = 'hidden';
    // document.getElementById("back2").style.visibility = 'hidden';
    window.print();
    document.getElementById("printt").style.display = 'block';
	document.getElementById("form11").style.display = 'block';
}
</script>