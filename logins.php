<?php 
$loginsPage = true;
include_once("header.php");

?>
<form id="form1" name="form1" method="post" action="Login_result.php">
<center>
    <h2 class="style1">
    صفحة دخول النظام</h2>
    </center>

    <table class="table ">
        <tr>
        <td dir="rtl" style="width: 100%;display: block;">
            <input type="text" class="form-control" name="txtusname" placeholder="اسم المستخدم" style="width: 50%;
    text-align: center;
    margin: 10px auto;" dir="ltr" id="txtusname"  required  />
            </td>
        </tr>
        <tr>
        <td dir="rtl" style="width: 100%;display: block;">
            <input type="password" style="width: 50%;
    text-align: center;
    margin: 10px auto;" dir="ltr" placeholder="كلمة المرور" class="form-control" name="txtpassword" id="txtpassword"  required />
        </td>
        </tr>
        <tr>
        <td dir="rtl" style="width: 58%;display: block; border-top:0px">
                <input type="submit" class="btn btn-warning" name="btnlogin" id="btnlogin" value="دخول" 
                style="width:6em ;height:2em;"/>
		</td>
        </tr>
    </table>
	  <?php
if(isset($_SESSION['errorx']))
{
$errorx=$_SESSION['errorx'];

 echo $errorx; 
$_SESSION['errorx']=' ';
}
 ?>
    </tr>
  </table>

 
</form>

<?php 
include_once("footer.php");
?>
