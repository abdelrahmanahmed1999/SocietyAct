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



	?>
	
<style>

    select, input {
        width: 250px;
    }
</style>
 
<form id="form1" name="form1" method="post"action="plan_result.php" 
enctype="multipart/form-data" >
<div  align="center" class="style2" dir="rtl" style="color:#" >
<p class="style4" align="center"  style="color:#000000">
			 الخطة المجمهة (رفع ملف ال pdf)
		    </p>
		
</div>

    <div align="right">
        <table width="475" border="0" dir="rtl" class="table table-striped">
		
		<!------------------------------------------------>




<tr  >
        <td colspan="2">
		<div align="right"> تحميل الملف التفصيلى
		</div>
		</td>   
   <td  colspan="2">
		<div align="right">
         <input type="file" name="myfile" id="myfile" accept="application/pdf"    onchange="checkextension()"  >
        </div>
		</td>
		

      </tr>
	  <tr  >
	  <input type="hidden" name="destination" id="destination" value="<?php echo"" ?>"  />	
	  </tr>


     
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
	   </table>
    </div>
	 
 <?php
	
	 
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

function checkextension() {
//alert("hhhhhhhhhhhhh");
  var file = document.querySelector("#myfile");
  if ( /\.(pdf)$/i.test(file.files[0].name) === false ) 
  {
	  alert("not an pdf!"); 
   }
 // else {alert(" an pdf");}
}

   
</script>


<script>
    function validatename() {
		
		 
		  
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
</script>