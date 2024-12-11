<?php 
include_once("headerlogin.php");

?>
<form id="form1" name="form1" method="post" action="Login_result.php">
<center>
    <h2 class="style1">
    صفحة دخول النظام</h2>
    </center>

    <table class="table table-striped">
        <tr>
        <td dir="rtl" style="width: 65%;display: block;">
            <input type="text" class="form-control" name="txtusname" placeholder="اسم المستخدم" style="width: 300px;" dir="ltr" id="txtusname"  required  />
            </td>
        </tr>
        <tr>
        <td dir="rtl" style="width: 65%;display: block;">
            <input type="password" style="width: 300px;" dir="ltr" placeholder="كلمة المرور" class="form-control" name="txtpassword" id="txtpassword"  required />
        </td>
        </tr>
        <tr>
        <td dir="rtl" style="width: 58%;display: block;">
                <input type="submit" class="btn btn-info" name="btnlogin" id="btnlogin" value="دخول" 
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
