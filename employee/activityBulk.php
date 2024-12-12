<?php
include("../include/connection.php");

include ('header.php');



	$result = $con->query("SELECT USER_ID, Name FROM user");

	if ($result) {
		$users = $result->fetch_all(MYSQLI_ASSOC);
	} else {
		die("Query failed: " . $con->error);
	}

?>
<style>
th, td{
	padding-left:5px;
	padding-right:5px;
	border:1px solid;
}


select{
	margin:10px;
	width:45% !important;
	display:inline-block !important;
}
</style>
<?php
$quarPost="-1";
$tmpfilename = "";
$user_id="-1";
if(isset($_GET["SEARCH"]))
{
	$user_id=$_GET["user_id"];
	$quarPost=$_GET["quar"];
	$tmpfilename = $_GET['user_id']."/";
}
?>
<form method="get"  enctype="multipart/form-data" dir="rtl">

<div style="color:red;margin-bottom:20px;">برجاء الإلتزام بتزيل ملف الأنشطة المستقبلية واضافة الأنشطة المستقبلية دون تعديل شكل الملف</div>
	<div>
	</div>
	<div>اختر الجامعة و الربع </div>
	<select name="user_id" class="form-control" >
		<option value="-1" selected disabled>اختر الجامعة</option>

		<?php
			foreach ($users as $user) {
				$selected =  $user_id == $user['USER_ID'] ? 'selected' : '';
				echo '<option value="' . htmlspecialchars($user['USER_ID']) . '" ' . $selected . '>';
				echo htmlspecialchars($user['Name']);
				echo '</option>';
			}
		?>



	</select>
	<select name="quar" class="form-control">
		<option value="-1" selected disabled>اختر الربع</option>
		<option value="1" <?php if($quarPost=="1") echo "selected"?>>الربع الأول</option>
		<option value="2" <?php if($quarPost=="2") echo "selected"?>>الربع الثاني</option>
		<option value="3" <?php if($quarPost=="3") echo "selected"?>>الربع الثالث</option>
		<option value="4" <?php if($quarPost=="4") echo "selected"?>>الربع الأخير</option>
		<option value="0" <?php if($quarPost=="0") echo "selected"?>>الكل</option>

	</select>
	
	<button name = "SEARCH" type="submit" class="site-btn btn">بحث</button>
	<div>
	<?php
	$prvYear="";
	$prvQuar="";
	// echo $tmpfilename;
	foreach (glob('../uploads/futureAct/'.$tmpfilename.'/*.xlsx') as $filename) {
		$p = pathinfo($filename);
		$curYear = substr($p['basename'], 0, 4);
		$curQuar = substr($p['basename'], 5, 1);
		if($prvYear!=$curYear)
		{
			if(!empty($prvYear))
				echo '</div>';
			echo '<div class="row">';
		}
		if(empty($prvQuar) || $prvYear!=$curYear)
		{
			if($curQuar>"1")
				echo '<div class="col-lg-3 col-md-6 col-sm-6" style="float:right;"></div>';
			if($curQuar>"2")
				echo '<div class="col-lg-3 col-md-6 col-sm-6" style="float:right;"></div>';
			if($curQuar>"3")
				echo '<div class="col-lg-3 col-md-6 col-sm-6" style="float:right;"></div>';
		}
		elseif($prvQuar=="1")
		{
			if($curQuar>"2")
				echo '<div class="col-lg-3 col-md-6 col-sm-6" style="float:right;"></div>';
			if($curQuar>"3")
				echo '<div class="col-lg-3 col-md-6 col-sm-6" style="float:right;"></div>';
		}
		elseif($prvQuar=="2")
		{
			if($curQuar>"3")
				echo '<div class="col-lg-3 col-md-6 col-sm-6" style="float:right;"></div>';
		}
		

		if($quarPost =='0'){
			$hidden='';
		}
		elseif($curQuar != $quarPost){
			$hidden='hidden';
		}
		else{
			$hidden='';
		}
		?>
		<div class="col-lg-3 col-md-6 col-sm-6" <?php echo  $hidden?> style="float:right;"><a dir="rtl" class="btn btn-info" href="<?php echo $p['dirname']."/".$p['basename'];?>" target="_blank" 
style="width:250px;margin:5px;display:block;height:2em;font-size:20px;border: 1px solid #012880;background-image: linear-gradient(-180deg, #8998ff 0%, #290ce6 100%);
	box-shadow: 0 1rem 1.25rem 0 rgba(22,75,195,0.50),0 -0.25rem 1.5rem rgba(110, 15, 155, 1) inset, 0 0.75rem 0.5rem rgba(255,255,255, 0.4) inset,
							0 0.25rem 0.5rem 0 rgba(180, 70, 207, 1) inset;">
		<?php echo str_replace(substr($p['basename'], 0, 7),"",
					str_replace("أنشطة", "", str_replace(".xlsx", "", $p['basename'])));?>
		</a></div>
		<?php
		if($prvYear!=$curYear && !empty($prvYear))
			$prvQuar = "";
		else
			$prvQuar = $curQuar;
		$prvYear = $curYear;		
	}
	?>
	</div>
</form>


<?php include 'footer.php';
