<?php
function generateRandomString($length) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
function uploadFile($uploadName, $fileName, &$message, $messageFileName)
 {
	 $uploadDirCardio = "../uploads/futureAct/";
	 $uploadNameCurrent="current_".$uploadName;
	 $uploadNameCurrentOrg=$uploadNameCurrent."_org";
	$ret=true;
	
	if(!empty($_FILES) && isset($_FILES["$uploadName"]) && isset($_FILES["$uploadName"]['name']) && !empty($_FILES["$uploadName"]['name']))  
	{  
		if($_FILES["$uploadName"]['size']>13000000)
		{
			$message= "File maximum size is 12 Megabytes"; 
			$ret=false;
		}
		else
		{
			$orgFileName = $_FILES["$uploadName"]['name'];
			$extension = pathinfo($orgFileName, PATHINFO_EXTENSION);
			//mime check, chmod, etc. here
			if(strtoupper($extension) !== "XLSX")
			{
				$message= "Only XLSX Files can be uploaded!!!";
				$ret=false;
			}
			else
			{
				$tmpfilename = "emptyUniv/";
				if(isset($_SESSION['fk_university']) && !empty($_SESSION['fk_university']))
					$tmpfilename = $_SESSION['fk_university']."/";
				
				if (!file_exists($uploadDirCardio.$tmpfilename)) {
					mkdir($uploadDirCardio.$tmpfilename, 0777, true);
				}
				$path = $uploadDirCardio . $tmpfilename.$fileName;  
				if(file_exists($path))
				{
					if (!file_exists($uploadDirCardio."deleted/".$tmpfilename)) {
						mkdir($uploadDirCardio."deleted/".$tmpfilename, 0777, true);
					}
					move_uploaded_file($path, $uploadDirCardio."deleted/".$tmpfilename.time()."_".$fileName);
				}
				if (!is_dir($uploadDirCardio))
				{
					$message= "error code (200) There is an unknown error. Please try again later!!!";
					$ret=false;
				}
				elseif (!is_writable($uploadDirCardio))
				{
					$message= "error code (300) There is an unknown error. Please try again later!!!";
					$ret=false;
				}
				elseif(!move_uploaded_file($_FILES["$uploadName"]['tmp_name'], $path))
				{
					$message= "(error code:105) File Uploaded Error.  Please try again later!!!"; 
					$ret=false;
				}
			}
		}
	}	
	return $ret;
 }
?>
<style>
th, td{
	padding-left:5px;
	padding-right:5px;
	border:1px solid;
}
</style>
<?php
$quarPost="-1";
$yearPost="-1";
$tmpfilename = "emptyUniv/";
if(isset($_SESSION['fk_university']) && !empty($_SESSION['fk_university']))
	$tmpfilename = $_SESSION['fk_university']."/";
if(isset($_POST["ADD"]))
{
	$quar="الربع الأول";
	$year="2025";
	if(isset($_POST["quar"]) && !empty($_POST["quar"]) && is_numeric($_POST["quar"]) && $_POST["quar"]!="-1")
	{
		$quarPost = $_POST["quar"];
		switch($_POST["quar"])
		{
			case "1":
				$quar="الربع الأول";
			break;
			case "2":
				$quar="الربع الثاني";
			break;
			case "3":
				$quar="الربع الثالث";
			break;
			case "4":
				$quar="الربع الأخير";
			break;
		}
	
		if(isset($_POST["year"]) && !empty($_POST["year"]) && is_numeric($_POST["year"]) && $_POST["year"]>="2025" && $_POST["year"]!="-1")
		{
			$yearPost = $_POST["year"];
			$year = $_POST["year"];
		
			$filename.=$yearPost."-".$quarPost."-خطة أنشطة ".$quar." لعام ".$year.".xlsx";
			uploadFile("receipt_pdf_file", $filename, $err, "receipt pdf file");
			echo "<div style='color:red;direction:ltr;'>$err</div>";
		}
	}
}
?>
<form method="post"  enctype="multipart/form-data" dir="rtl">
<a dir="rtl" class="btn btn-info" href="SocietyServAct_Template.xlsx" target="_blank" 
style="width:400px;margin:10px;display:block;height:2em;font-size:20px;border: 1px solid #012880;background-image: linear-gradient(-180deg, #FF89D6 0%, #C01F9E 100%);
	box-shadow: 0 1rem 1.25rem 0 rgba(22,75,195,0.50),0 -0.25rem 1.5rem rgba(110, 15, 155, 1) inset, 0 0.75rem 0.5rem rgba(255,255,255, 0.4) inset,
							0 0.25rem 0.5rem 0 rgba(180, 70, 207, 1) inset;">تحميل نموذج لملف الخطة المستقبلية بامتداد xlsx</a>

<div style="color:red;margin-bottom:20px;">برجاء الإلتزام بتزيل ملف الأنشطة المستقبلية واضافة الأنشطة المستقبلية دون تعديل شكل الملف</div>
	<label>إضافة خطة أنشطة</label>
	<select name="quar">
		<option value="-1" <?php if($quarPost=="-1") echo "selected"?>>اختر الربع</option>
		<option value="1" <?php if($quarPost=="1") echo "selected"?>>الربع الأول</option>
		<option value="2" <?php if($quarPost=="2") echo "selected"?>>الربع الثاني</option>
		<option value="3" <?php if($quarPost=="3") echo "selected"?>>الربع الثالث</option>
		<option value="4" <?php if($quarPost=="4") echo "selected"?>>الربع الأخير</option>
	</select>
	<select name="year">
		<option value="-1" <?php if($yearPost=="-1") echo "selected"?>>اختر العام</option>
		<option value="2025" <?php if($yearPost=="2025") echo "selected"?>>لعام 2025</option>
		<option value="2026" <?php if($yearPost=="2026") echo "selected"?>>لعام 2026</option>
		<option value="2027" <?php if($yearPost=="2027") echo "selected"?>>لعام 2027</option>
		<option value="2028" <?php if($yearPost=="2028") echo "selected"?>>لعام 2028</option>
		<option value="2029" <?php if($yearPost=="2029") echo "selected"?>>لعام 2029</option>
		<option value="2030" <?php if($yearPost=="2030") echo "selected"?>>لعام 2030</option>
		<option value="2031" <?php if($yearPost=="2031") echo "selected"?>>لعام 2031</option>
		<option value="2032" <?php if($yearPost=="2032") echo "selected"?>>لعام 2032</option>
		<option value="2033" <?php if($yearPost=="2033") echo "selected"?>>لعام 2033</option>
		<option value="2034" <?php if($yearPost=="2034") echo "selected"?>>لعام 2034</option>
		<option value="2035" <?php if($yearPost=="2035") echo "selected"?>>لعام 2035</option>
	</select>
	<input type="file" id="receipt_pdf_file" name="receipt_pdf_file" style="display: inline;"/>
	<button name = "ADD" type="submit" class="site-btn">إضافة</button>
	<div>
	<?php
	$prvYear="";
	$prvQuar="";
	echo $tmpfilename;
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
		?>
		<div class="col-lg-3 col-md-6 col-sm-6" style="float:right;"><a dir="rtl" class="btn btn-info" href="<?php echo $p['dirname']."/".$p['basename'];?>" target="_blank" 
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