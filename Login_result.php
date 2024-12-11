<?php

include_once("include/connection.php");
session_start();

if (isset($_POST['btnlogin'])) {
    if (!isset($_POST['txtusname']) || !isset($_POST['txtpassword'])) {
        $error = 'You Must Enter Username and Password To Login';
        exit;
    }


//convert the field values to simple variables 
//add slashes to the username and md5() the password 

    $usname = stripslashes(trim($_POST['txtusname']));
    $pass = md5(stripslashes(trim($_POST['txtpassword'])));
//$Tpass = md5('scucomp');
//echo "usname ".$usname;
//echo "<br />";
//echo "pass  ".$pass;
//set the database connection variables


    $q = "SELECT `USER_ID`,`USER_NAME`,`USER_PASSWORD`,`roleid`,`fk_university`,`Name` FROM `user` where `USER_NAME`=? and `USER_PASSWORD` =? and `active`>0";
    $stmt = $con->prepare($q);
    $stmt->bind_param('ss', $usname, $pass);

    $stmt->execute();

    $res = $stmt->get_result();

    if ($row = $res->fetch_array(MYSQLI_ASSOC)) {
	
		  //$_SESSION['active'] = $row['active'];
		  $_SESSION['myUSER_ID'] = $row['USER_ID'];
      	$userid = $_SESSION['myUSER_ID']; 
        $_SESSION['loginusername'] = $row['USER_NAME'];
        $_SESSION['name'] = $row['Name'];
        $roleid = $row['roleid'];
        $_SESSION['roleid'] = $row['roleid'];
        $_SESSION['fk_university'] = $row['fk_university'];
		//echo $_SESSION['fk_university'];

        if ($roleid == '5') {
            echo "<script>self.location='employee/home.php'</script>";
        }
        if ($roleid == '7') {
            echo "<script>self.location='univ/home.php'</script>";
        }

    } else {

       // if ($active == '0') {
            //$errorx = '<center>	<h3 style="color:red;">
              // هذا المستخدم غير مفعل<br/></h3>
             //  </center>';
          //  $_SESSION['errorx'] = $errorx;
           // echo "<script>self.location='logins.php'</script>";
        //} else {
           // $errorx = '<center>	<h3 style="color:red;">
             // echo $errorx = '<center>	<h3 style="color:red;"> برجاء ادخال اسم المستخدم وكلمة المرور الصحيحة 
              // </center>';
          //  $_SESSION['errorx'] = $errorx;
         //   echo   "<script>self.location='logins.php'  </script>";   
			 // echo $errorx = '<center>	<h3 style="color:red;"> برجاء ادخال اسم المستخدم وكلمة المرور الصحيحة 
			 $errorx = '<center>	<h3 style="color:red;">
                اسم المستخدم او كلمة المرور  غير صحيحة رجاءا ادخل اسم المستخدم وكلمة المرور الصحيحة<br/></h3>
               </center>';
            $_SESSION['errorx'] = $errorx;
            echo "<script>self.location='logins.php'</script>";
        }
    }

?>