  <?php
include ('header.php');
function generate_token(){
    //Generate a random string.
    $token = openssl_random_pseudo_bytes(16);

    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    //Return token
    return $token;
}
 $_SESSION['csrf_token'] = generate_token();
 ?>
<form id="form1" name="form1" method="post" action="add_employee_result.php">
    <input type='hidden' name='csrf_token' value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>

  <div align="center">
    <table width="569" border="0">
     

      <tr>
        <td>
            <input type="text" name="txtusname" id="txtusname"  style="width:20em;"   
                   oninvalid="this.setCustomValidity(' يجب إدخال اسم المستخدم حروف لغه انجليزية او ارقام ')"
 oninput="setCustomValidity('')" pattern="[0-9A-Za-z. ]+$" title="حروف لغه انجليزية و ارقام " required />
          </td>
      
        <td><div align="right" class="style2">اسم المرور</div></td>
      </tr>

      <tr>
        <td>
            <input type="password" name="txtpassword" id="txtpassword"  style="width:20em;" required  autocomplete="off" />
          </td>
       
        <td><div align="right" class="style2">كلمة المرور</div></td>
      </tr>

      <tr>
        <td>
            <input type="text" name="txtname" id="txtname"  style="width:20em;" oninvalid="this.setCustomValidity('يجب إدخال اسم المستخدم  حروف لغه انجليزية و عربية و ارقام')"
 oninput="setCustomValidity('')" pattern="^[\u0621-\u064A0-9A-Za-z ]+$" title="حروف لغه انجليزية و عربية و ارقام  "  required  />
            
             <input type='hidden' name='csrf_token' value='<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'>
          </td>
      
        <td><div align="right" class="style2">الاسم</div></td>
      </tr>
     
	  <tr>
	  <td > 
        
       <select id="user_role" name="user_role" required >  
           <?php 
include_once("../include/connection.php");
	  
   $q2="SELECT   `id`,`name` from `user_role`   ";
	
 $stmt = $con->prepare($q2);
    /* Execute statement */

    $stmt->execute();
    $res = $stmt->get_result();
 //echo $stmt->num_rows ;

 while($row = $res->fetch_array(MYSQLI_ASSOC)) {
	 $id=$row['id'];
		   $name =$row['name'];?>
		   
	   <option value="<?php echo $id ; ?>" > <?php echo $name ; ?> </option>
	  <?php
	
}
	?>
  </select>
	 
       </td>
	
	   <td>   <div align="right" class="style2">دور الموظف</div></td>
      </tr>
	  
	   <tr>
	  <td > 
        
       <select id="user_sector" name="user_sector" >  
           <?php 
include_once("../include/connection.php");
	  
   $q2="SELECT   `serial`,`university_exam`.`sector` from `university_exam`  ";
	
 $stmt = $con->prepare($q2);
    /* Execute statement */

    $stmt->execute();
    $res = $stmt->get_result();
 //echo $stmt->num_rows ;

 while($row = $res->fetch_array(MYSQLI_ASSOC)) {
	 $id=$row['serial'];
		   $name =$row['sector'];?>
		   
	   <option value="<?php echo $id ; ?>" > <?php echo $name ; ?> </option>
	  <?php
	
}
	?>
  </select>
	 
       </td>
	
	   <td>   <div align="right" class="style2">القطاع</div></td>
      </tr>
	  
	  
	   <tr><td colspan="3"> 
        
        <div align="center">
          <input type="submit" name="btnadd" id="btnadd" value="اضافة" style="width:8em;height:2em;font:'Times New Roman', Times, serif;font-size:16px" />
          </div></td>
      </tr>
      </table>
	  
	  
	  
	  
	  
	  <div class="style3">
<a href="" onclick=" window.print(); return false;">
<h2 align="center">تعديل موظفين او حذفهم
</a>
</div>
          </div>
</form>
<?php 
echo "
<div align='center'>
<form id='form2' name='form2' method='post' dir='rtl'>
<table class='table table-striped' dir='rtl'  >";

echo'<tr>
<td>م</td>

<td>USER_NAME</td>
<td>name</td>
<td>roleid</td>
<td>sectorid</td>
<td>active</td>

<td>delete</td>
<td>change password</td>
  </tr>';
//=====================values ==============

   
  $query ="SELECT activity.title, activity.activity_desc,  activity.Date,activity.pdf_image
FROM `activity`

  	$stmt = $con->prepare($query);
 // $stmt->bind_param('ss',$lostedsector,$lostedtype);
    $stmt->execute();
    $res = $stmt->get_result();
 $count=0;
  while($row = $res->fetch_array(MYSQLI_ASSOC) ){
      $USER_ID=$row['USER_ID'];
     $USER_NAME= $row['USER_NAME'];
    $USER_PASSWORD=  $row['USER_PASSWORD'];
     $Name= $row['Name'];
  	$count++;
	  echo'<tr>
<td>'.$count.'</td>
<td>'.$row['USER_NAME'].'</td>
<td>'.$row['Name'].'</td>
<td>'.$row['user_role_name'].'</td>
<td>'.$row['university_exam_sector'].'</td>';

if($row['active']==0)
	echo '<td><a href="activeuser.php?id='.$row['USER_ID'].'&active=1">Activate</a></td>';
else	
	echo '<td><a href="activeuser.php?id='.$row['USER_ID'].'&active=0">Deactivate</a></td>';

echo '<td><a href="deleteuser.php?id='.$row['USER_ID'].'">delete</a></td>';
      
echo '<td>
<a><input type="submit" name="submitt"  style="background: none;border:none;font-weight:normal;" onclick="reqid('.$USER_ID.');" value="change password"></a>
</td>
 </tr>';
}
echo "</table>
<input type='hidden' value='' id='USER_ID' name='USER_ID'>

"; 

?>
    </form>
    </div>
  
  <?php
include ('footer.php');

 ?>

<script>
    
    function reqid(id){
//        alert("fd");
//        alert(id);
//        
        document.getElementById("USER_ID").value=id;
        
        document.getElementById("form2").action="changepassword.php";
        document.form2.submit();
        
    }
</script>