<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ar" lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-language" content="ar"/>
    <title>ادخال الأنشطة </title>
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



//echo $id ;


if(isset ($_POST['idd']) || isset($_GET["id"]) )
{
	if(isset ($_POST['idd']))
	{
	$id = $_POST['idd'];
	?> <input type="hidden"  id="idx" name="idx" value="<?php  echo $id; ?> "/>
<?php
}
else
{
	$id = $_GET["id"];
	?> <input type="hidden"  id="idx" name="idx" value="<?php  echo $id; ?> "/>
<?php
}
?>
	
<style>

    select, input {
        width: 250px;
    }
</style>
<?php


?> 
<p class="style4" align="center"  style="color:red">
	يــجـــب ادخـــال جميــع ملفـــات الأنـــشـــطة طبقا للترتيب الوارد بخلية نوعية النـــشـــاط *
		    </p>   

<form id="form1" name="form1" method="post"action="insert_data_result.php" 
enctype="multipart/form-data" >
<div  align="center" class="style2" dir="rtl" style="color:#" >
	  <?php 
	  if($id==1)
	  {
		   ?><p class="style4" align="center"  style="color:#000000">
		إدخـــــــــــال الأنـــــشـــــطــة الحـــــــــاليــــة
		    </p>
			<?php
	  }
	  else if($id==2)
	  {
		  
		  	 ?><p class="style4" align="center"  style="color:#000000">
			 إدخال الأنشطة المستقبلية
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
                                onchange="validateForm()">
                            <?php
                           if (isset($_GET["univ"])){
                                if ($_GET["univ"] == -1) {
                                    ?>
                                    <?php
                                    $sql = "SELECT distinct ID, name FROM university where ID=? ORDER BY name ASC";
                                    $stmt = $con->prepare($sql);
									 
            $stmt->bind_param("s", $univ_logins);
           
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                                        $ID = $row['ID'];
                                        $name = $row['name'];
                                        ?>
                                        <option value="<?php echo $ID ?>" selected><?php echo "جامعة $name" ?></option>
                                        <?php
                                    }
                                } else {
                                    $univ = $_GET["univ"];
                                    $sql = "SELECT ID, name FROM university WHERE ID =? ORDER BY name ASC";
                                    $stmt = $con->prepare($sql);
                                    $stmt->bind_param('s', $univ);
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
						   }
						   else
						   {
							    ?>
                                   
                                    <?php
                                     $sql = "SELECT distinct ID, name FROM university where ID=? ORDER BY name ASC";
                                    $stmt = $con->prepare($sql);
									 
            $stmt->bind_param("s", $univ_logins);
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
                <td></td>
            </tr>

            <!------------------------ الكلية ------------------->
            <tr>
                <td>
                    <div align="right"> الكلية</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <select name="college_select" id="college_select" required
                                oninvalid="this.setCustomValidity('يجب إختيار الكلية')" oninput="setCustomValidity('')"
                                onchange="validateForm()">
                            <?php
                            if (isset($_GET["univ"])) {
                                if (($_GET["univ"]) == -1) {
                                    ?>
                                    <option value="-1">-- اختر الكليه --</option>
                                    <?php
                                } else {
                                    $univ = $_GET["univ"];
                                    if (($_GET["coll"]) == -1) {
                                        ?>
                                        <option value="-1">-- اختر الكليه --</option>
                                        <?php
                                        $sql = "SELECT  distinct college.`ID`,college.`name` FROM college,univ_coll where college.ID = univ_coll.coll_id and univ_coll.univ_id =? ORDER BY name ASC";
                                        $stmt = $con->prepare($sql);
                                        $stmt->bind_param('s', $univ);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                                            $ID = $row['ID'];
                                            $name = $row['name'];
                                            ?>
                                            <option value="<?php echo $ID ?>"><?php echo " $name" ?></option>
                                        <?php }
                                    } else {
                                        $coll = $_GET["coll"];
                                        $sql = "SELECT  distinct college.`ID`,college.`name` FROM college,univ_coll where college.ID = univ_coll.coll_id and univ_coll.univ_id =? and univ_coll.coll_id =? ORDER BY name ASC";
                                        //$sql = "SELECT  distinct ID,`name` FROM college where ID`=? ORDER BY name` ASC";
                                        $stmt = $con->prepare($sql);
                                        $stmt->bind_param('ss',$univ , $coll);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                                            $ID = $row['ID'];
                                            $name = $row['name'];
                                            ?>
                                            <option value="<?php echo $ID ?>"><?php echo " $name" ?></option>
                                        <?php }
                                        ?>
                                 
                                        <?php
                                        $sql = "SELECT  distinct college.`ID`,college.`name` FROM college,univ_coll where college.ID = univ_coll.coll_id and univ_coll.univ_id=? and univ_coll.coll_id !=? ORDER BY name ASC";
                                        $stmt = $con->prepare($sql);
                                        $stmt->bind_param('ss', $univ, $coll);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                                            $ID = $row['ID'];
                                            $name = $row['name'];
                                            ?>
                                            <option value="<?php echo $ID ?>"><?php echo " $name" ?></option>
                                        <?php }

                                    }


                                }
                            } else {
                                ?>
                               
                                        <option value="-1">-- اختر الكليه --</option>
                                        <?php
                                        $sql = "SELECT  distinct college.`ID`,college.`name` FROM college,univ_coll where college.ID = univ_coll.coll_id and univ_coll.univ_id =? ORDER BY name ASC";
                                        $stmt = $con->prepare($sql);
                                        $stmt->bind_param('s', $univ_logins);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                                            $ID = $row['ID'];
                                            $name = $row['name'];
                                            ?>
                                            <option value="<?php echo $ID ?>"><?php echo " $name" ?></option>
                                      <?php   }
                                
                            }
                            ?>
                        </select>
                    </div>
                </td>
                <td></td>
                <td></td>
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
 oninput="setCustomValidity('')"  onchange="validateForm()"/>
                    </div>
                <?php    if (isset($_GET["topic"])) {
					?>	
					 
						
						<?php 
						if (($_GET["topic"]) == -1){
					?><option value="-1">--اختر طبيعة النشاط--</option>  <?php
					$sql = 'SELECT distinct `ID`,`name` FROM `activity_natural`';
					$stmt = $con->prepare($sql);
					/* Execute statement */
				//	$stmt->bind_param('s', $_GET["topic"]);
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
						else{
							$sql = 'SELECT distinct `ID`,`name` FROM `activity_natural` where ID=? ';
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->bind_param('s', $_GET["topic"]);
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
					  ?>
						<option value="<?php echo $ID ?>" ><?php echo $name?></option>
						
						<?php 
						}
						
							$sql = 'SELECT distinct `ID`,`name` FROM `activity_natural` where ID!=? ';
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->bind_param('s', $_GET["topic"]);
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
						
					}
					else
					{
						?><option value="-1">--اختر طبيعة النشاط--</option>  
						
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
					
					
				<?php	 if (isset($_GET["type"])) {
						 
						 if (($_GET["type"]) == -1){
							 
							 	if (($_GET["topic"]) == 3)
						{							
					 $sql = "SELECT  distinct activity_type.`ID`,activity_type.`name` FROM `activity_type` where ID=13";
					
					$stmt = $con->prepare($sql);
				//	$stmt->bind_param('s', $_GET["type"]);
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
						}
						else{
						?>	 <option value="-1">--اختر نوعية النشاط--</option>  
						
						<?php 
					 $sql = "SELECT  distinct activity_type.`ID`,activity_type.`name` FROM `activity_type` where ID!=13  ";
					
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
						}
						 }
						 else
						 {
							 
							  	if (($_GET["topic"]) == 3)
						{	
							 	 $sql = "SELECT  distinct activity_type.`ID`,activity_type.`name` FROM `activity_type` where ID=13";
					
					$stmt = $con->prepare($sql);
					$stmt->bind_param('s', $_GET["type"]);
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
						}
							 else
							 {
							 
							 	 $sql = "SELECT  distinct activity_type.`ID`,activity_type.`name` FROM `activity_type` where ID=? and ID!=13";
					
					$stmt = $con->prepare($sql);
					$stmt->bind_param('s', $_GET["type"]);
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


					 $sql = "SELECT  distinct activity_type.`ID`,activity_type.`name` FROM `activity_type` where ID!=? and ID!=13";
					
					$stmt = $con->prepare($sql);
					$stmt->bind_param('s', $_GET["type"]);
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

						 
						 
						 } 
						 }
					 }
					 else
					 {
						 ?>
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
					 }	?>
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
					<select name="taklefselect" id="taklefselect" 

 oninvalid="this.setCustomValidity('يجب اختيار طبيعة النشاط')"
                                oninput="setCustomValidity('')" onchange="validateForm()"> 
								
								<?php 
								if (($_GET["taklefid"])){
								if (($_GET["taklefid"]) == -1){
								?>
					<option value="-1">--اختر نوعية التكليف--</option>
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
						<option value="<?php echo $ID ?>"><?php echo $name?> </option>
						
						<?php 
						}
								}
								
								
						else if (($_GET["taklefid"]) == 5)
						{
								?>
				
                        <?php
						$sql = 'SELECT distinct `ID`,`name` FROM `taklef` WHERE `ID`=5';
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
					  ?>
						<option value="<?php echo $ID ?>"><?php echo $name?> </option>
						
						<?php 
						}
						
						?> 
						
							<?php	
							
							
							$sql = 'SELECT distinct `ID`,`name` FROM `taklef` WHERE `ID`!=?';
					$stmt = $con->prepare($sql);
					$stmt->bind_param('s', $_GET["taklefid"]);
					/* Execute statement */
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
					  ?>
						<option value="<?php echo $ID ?>"><?php echo $name?> </option>
						
						<?php 
						}	
							
						?>	
						<?php	}		
								
								
								
								
								
								
								
								
								
								else{
								
								$sql = 'SELECT distinct `ID`,`name` FROM `taklef` WHERE `ID`=?';
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->bind_param('s', $_GET["taklefid"]);
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
					  ?>
						<option value="<?php echo $ID ?>"><?php echo $name?> </option>
						
						<?php 
						}
							$sql = 'SELECT distinct `ID`,`name` FROM `taklef` WHERE `ID`!=?';
					$stmt = $con->prepare($sql);
					/* Execute statement */
					$stmt->bind_param('s', $_GET["taklefid"]);
					$stmt->execute();
					$res = $stmt->get_result();
					while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					   $ID =$row['ID'];
					   $name=$row['name'];
					  ?>
						<option value="<?php echo $ID ?>"><?php echo $name?> </option>
						
						<?php 
						}

							
								}
								}else{
									?>
									<option value="-1">--اختر نوعية التكليف--</option>
									
									<?php
								}
						?>
						</select>
                    </div>
                </td></tr>
				<!------------------------------------------------>
				<?php
				 if (isset($_GET["taklefid"]))
					 if($_GET["taklefid"] == 5)
					 {
						{
							
						?>
<tr>
                <td>
                    <div align="right"> الجهة الراعية</div>
                </td>

                <td dir="rtl">
                   
                          <input type="text" id="tak" name="tak" required> 
					
                </td>
				</tr>
					 <?php	}	}?>	
				
				
              <tr>
				 <td>
                    <div align="right">تاريخ بداية النشاط</div>
                </td>

                <td dir="rtl">
                    <div align="right">
				<?php 	if($id== 2)
				{
					$x=date('Y-m-d',strtotime('tomorrow'));
					 
					?>  <input type="date" id="date" name="date"  min="<?php echo $x; ?>" required >
			<?php	}
			
			else
			{
			?>	<input type="date" id="date" name="date" required >
			<?php }
			?>
                       
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
				<?php 	if($id== 2)
				{
					$x=date('Y-m-d',strtotime('tomorrow'));
					 
					?>  <input type="date" id="End_date" name="End_date"  min="<?php echo $x; ?>" required >
			<?php	}
			
			else
			{
			?>	<input type="date" id="End_date" name="End_date" required >
			<?php }
			?>
                       
                    </div>
                </td>
                    </div>
                </td>
            </tr>
			</tr>
			
				  
			    <!------------------------------------------------>
				  <tr>
                <td>
                    <div align="right"> نوعية المستفيدين</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <input type="text" id="b_enroll_male" name="b_enroll_male" required>
									<oninvalid="this.setCustomValidity('يجب اختيار نوعية المستفيدين')"
 oninput="setCustomValidity('')"  />
                    </div>
                </td></tr>

            <!------------------------------------------------>
						  <tr>
                <td>
                    <div align="right"> نوعية المشاركين</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <input type="text" id="wafed_student" name="wafed_student" required>
						<oninvalid="this.setCustomValidity('يجب اختيار نوعية المشاركين')"
 oninput="setCustomValidity('')"  />
                    </div>
                </td></tr>
<!--------------------------------------------->
			  <tr>
                <td>
                    <div align="right"> عدد المستفيدين</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <input type="number" id="egy_student" name="egy_student"  />
                    </div>
                </td></tr>
<!--------------------------------------------->
			  <tr>
                <td>
                    <div align="right"> عدد القوافل</div>
                </td>

                <td dir="rtl">
                    <div align="right">
                        <input type="number" id="khas_student" name="khas_student"   />
                    </div>
                </td></tr>
<!--------------------------------------------->

				  <tr>
                <td>
                    <div align="right"> عدد المشاركين</div>
                </td>

                <td dir="rtl">
                    <div align="right">
				
                        <input type="number" id="no_student" name="no_student"  />
                    </div>
                </td></tr>
				
<!---------------------------------------------><!--------------------------------------------->
              <tr>
				 <td>
                    <div align="right">وصف النشاط  </div>
                </td>

                <td dir="rtl">
                    <div align="right">
                      <textarea name="comment" rows="5" cols="40" ></textarea> 
                    </div>
                </td>
                    </div>
                </td>
            </tr>


<?php 
if($id==1)
{
	?>

<tr >
        <td>
		<div align="right"> تحميل الملف التفصيلى
		</div>
		</td>   
   <td >
		<div align="right">
         <input type="file" name="myfile" id="myfile" accept="application/pdf"    onchange="checkextension()" required>
        </div>
		</td>
		

      </tr>
	  <tr >
	  <input type="hidden" name="destination" id="destination" value="<?php echo"" ?>"  />	
	  </tr>
<?php } 
if($id==2)
{
	?><tr  >
        <td>
		<div align="right"> تحميل الملف التفصيلى
		</div>
		</td>   
   <td >
		<div align="right">
         <input type="file" name="myfile" id="myfile" accept="application/pdf"    onchange="checkextension()"  >
        </div>
		</td>
		

      </tr>
	  <tr  >
	  <input type="hidden" name="destination" id="destination" value="<?php echo"" ?>"  />	
	  </tr>
<?php
}	
?>

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
}
else
{
	echo "لا يمكن الدخول لهذه الصفحه بهذه الطريقه";
}	
	 
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

function sum() {
     // alert("gggg");
	  
	  
        var wafed_student = document.getElementById("wafed_student").value;
        var egy_student = document.getElementById("egy_student").value;
		 var khas_student = document.getElementById("khas_student").value;
		var all=parseInt(wafed_student) +parseInt(egy_student)+parseInt(khas_student);
		 if (!isNaN(all)) 
		 {
         document.getElementById('no_student').value = all;
      }
		
		// document.getElementById(no_student).innerText =all;


    }
</script>
<script>
function validateForm() {
      
        var u = document.getElementById("univ_select").value;
        var co = document.getElementById("college_select").value;
		 var top = document.getElementById("topicselect").value;
		  var type = document.getElementById("typeselect").value;
        var id = document.getElementById("idx").value;
		var taklefid = document.getElementById("taklefselect").value;
	  
       
        window.location.href = "insert_data.php?univ=" + u + "&" + "coll=" + co+ "&" + "topic=" + top+ "&" + "type=" + type + "&" + "taklefid=" + taklefid + "&" + "id=" + id;
    }
</script>
<script>

function checkextension() {
//alert("hhhhhhhhhhhhh");
  var file = document.querySelector("#myfile");
  if ( /\.(pdf)$/i.test(file.files[0].name) === false ) 
  {
	  alert("not an pdf!"); 
   }
 // else {alert(" an pdf");}
}



    $("#topicselect").select2({minimumResultsForSearch: -1});
    $("#topicselect").select2();
   
</script>


<script>
    function validatename() {
		//alert("hggggggg");
		
		   var univ_select = document.getElementById("univ_select").value;
      
		
	   if (univ_select.length == 0 || univ_select == -1) 
		{
            var str = "يرجى اختيار الجامعه";
            alert(str);
        }
		else{
			  var college_select = document.getElementById("college_select").value;
			if (college_select.length == 0 || college_select == -1) 
		{
            var str = "يرجى اختيار الكليه";
            alert(str);
        }
		
		
		
		
		else
		{
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
			
            var taklefselect = document.getElementById("taklefselect").value;
            if (taklefselect.length == 0 || typeselect == -1) {
                var str = "يرجى اختيار تم التكليف من قبل";
                alert(str);
         }
		 
		  else
		 {
		
	 var date = document.getElementById("date").value;
            if (date.length == "") {
                var str = "يرجى اختيار تاريخ بداية النشاط";
                alert(str);
         }
		 else
		 {
			  var date = document.getElementById("End_date").value;
            if (date.length == "") {
                var str = "يرجى اختيار تاريخ نهاية النشاط";
                alert(str);
         }
		 else
		 {
		
	 var b_enroll_male = document.getElementById("b_enroll_male").value;
            if (b_enroll_male.length == "") {
                var str = "يرجى ادخال نوعية المستفيدين";
                alert(str);
         }
		 else
		 {
			 var wafed_student= document.getElementById("wafed_student").value;
            if (wafed_student.length == "") {
                var str = "يرجى ادخال نوعية المشاركين";
                alert(str);
         }
		 else 
		 { 
	  var egy_student= document.getElementById("egy_student").value;
            if (egy_student.length == "") {
                var str = "يرجى ادخال عدد المستفيدين";
                alert(str);
         }
		 else 
		 { 
	  var khas_student= document.getElementById("khas_student").value;
            if (khas_student.length == "") {
                var str = "يرجى ادخال عدد القوافل";
                alert(str);
         }
		 else 
		 { 
	  var no_student= document.getElementById("no_student").value;
            if (no_student.length == "") {
                var str = "يرجى ادخال عدد المشاركين";
                alert(str);
         }
		 else 
		 { 
	 
	 
	 
	 
	 
	 
		  var id = document.getElementById("idx").value;
		  
		 //alert(id);
		  
		  if(id==2)
		  {
			 // alert(id);
			  form.submit();
		  }
		  else
		  {
		  
		var myfile = document.getElementById("myfile").value;
		
            if (myfile.length == "") {
                var str = "يرجى اختيار الملف";
                alert(str);
         }
		
		 else
		 {
			  form.submit();
		
	

		
   }
   
			  
		 }
		}
		 }
	}
		 }
		 }
		 }
		}
	}
		}
	}
		}
		}
	}
</script>