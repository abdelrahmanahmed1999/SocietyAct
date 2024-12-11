<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ar" lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-language" content="ar"/>
    <title>عرض وتعديل أنشطة خدمة المجتمع</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css"/>
</head>


<body>
<?php
include('../univ/header.php');
include_once("../include/connection.php");


$univ_logins=$_SESSION['fk_university'];
$activityId = "0";
$canEdit = false;
if(isset($_GET["activityId"]) && !empty($_GET["activityId"]) && is_numeric($_GET["activityId"]))
{
	$activityId = $_GET["activityId"];
}
if(isset($_GET["oper"]) && !empty($_GET["oper"]) && $_GET["oper"] == "EDIT")
{
	$canEdit = true;
}
$serial = "";
$title = "";
$pdf_image = "";
$desc = "";
$Date = "";
$End_Date = "";
$wafed_student = "";
$egy_student = "";
$khas_student = "";
$no_student = "";
$natural_ID = "";
$natural_name = "";
$top_ID = "";
$top_name = "";
$type_ID = "";
$type_name = "";
$taklef_id = "";
$taklef_name = "";
$university_ID = "";
$university_name = "";
	
$q = "SELECT activity.serial, activity.title, activity.pdf_image, activity.activity_desc, gehaaa,
	activity.Date, activity.End_Date, activity.wafed_student, activity.egy_student, activity.khas_student, activity.no_student,
	activity.activity_natural_ID, activity_natural.name activity_natural_name, 
	activity.activity_top_ID, activity_top.name activity_top_name, 
	activity.activity_type_ID, activity_type.name activity_type_name, 
	activity.fk_taklefselect, taklef.name taklef_name, 
	activity.university_ID, university.name university_name,
	activity.fk_coll, college.name college_name
	FROM `activity`
	inner join activity_natural on activity_natural.ID=activity.activity_natural_ID
	INNER join activity_top on activity_top.ID = activity.activity_top_ID
	INNER JOIN activity_type on activity_type.ID = activity.activity_type_ID
	left join taklef on taklef.ID = activity.fk_taklefselect
	inner join university on university.ID = activity.university_ID
    INNER JOIN college on college.ID = activity.fk_coll
	where activity.serial = $activityId";
$stmt = $con->prepare($q);
$stmt->execute();
$res = $stmt->get_result();
if ($row = $res->fetch_array(MYSQLI_ASSOC)) 
{
	$serial = $row["serial"];
	$title = $row["title"];
	$pdf_image = $row["pdf_image"];
	$desc = $row["activity_desc"];
	$Date = $row["Date"];
	$End_Date = $row["End_Date"];
	$wafed_student = $row["wafed_student"];
	$egy_student = $row["egy_student"];
	$khas_student = $row["khas_student"];
	$no_student = $row["no_student"];
	$natural_ID = $row["activity_natural_ID"];
	$natural_name = $row["activity_natural_name"];
	$top_ID = $row["activity_top_ID"];
	$top_name = $row["activity_top_name"];
	$type_ID = $row["activity_type_ID"];
	$type_name = $row["activity_type_name"];
	$taklef_id = $row["fk_taklefselect"];
	$taklef_name = $row["taklef_name"];
	$university_ID = $row["university_ID"];
	$university_name = $row["university_name"];
	$college_ID = $row["fk_coll"];
	$college_name = $row["college_name"];
	$gehaaa = $row["gehaaa"];
	
	if($university_ID == $univ_logins && $canEdit)
		$canEdit = true;

	if(isset($_GET["topic"]) && !empty($_GET["topic"]) && is_numeric($_GET["topic"]))
		$natural_ID = $_GET["topic"];	
	
	if(isset($_GET["taklefid"]) && !empty($_GET["taklefid"]) && is_numeric($_GET["taklefid"]))
		$taklef_id = $_GET["taklefid"];	
	
	if($canEdit && isset($_POST["Edit"]))
	{
		$title = $_POST["title"];
		//$pdf_image = $row["pdf_image"];
		$desc = $_POST["comment"];
		$Date = $_POST["Date"];
		$End_Date = $_POST["End_Date"];
		
		$wafed_student = $_POST["wafed_student"];
		$egy_student = $_POST["egy_student"];
		$khas_student = $_POST["khas_student"];
		$no_student = $_POST["no_student"];
		
		$natural_ID = $_POST["activity_natural_ID"];
		$type_ID = $_POST["activity_type"];
		$taklef_id = $_POST["fk_taklefselect"];
		$college_ID = $_POST["college_select"];
		
		if(isset($_POST["gehaaa"]))
			$gehaaa = $_POST["gehaaa"];
		
		$stmt = $con->prepare("update activity set Date=?, End_Date=?, title=?, activity_desc=?, activity_natural_ID=?, activity_type_ID=?, fk_coll=?, fk_taklefselect=?, no_student=?, wafed_student=?, egy_student=?, khas_student=?, gehaaa=? where serial = $serial");


		$stmt->bind_param("ssssiiiisssss",$Date,$End_Date,$title,$desc, $natural_ID, $type_ID, $college_ID, $taklef_id, $no_student,$wafed_student,$egy_student,$khas_student,$gehaaa);
		if($stmt->execute())
		{
			// Echo Success Message
			$theMsg = "<div class='alert alert-success'>تم التعديل بنجاح</div>";
			echo $theMsg;
		}
	}
	?>
	<style>
    select, input {
        width: 90%;
    }
	</style>
	<form id="form1" name="form1" method="post">
        <table width="475" border="0" dir="rtl" class="table table-striped" style="font-weight: bold;">
			<tr>
				<td style="width: 200px;">حالة النشاط</td>
				<td><label style="font-weight:normal;"><?php echo $top_name; ?></label></td>
			</tr>
			<tr>
				<td>الجامعة</td>
				<td><label style="font-weight:normal;"><?php echo $university_name; ?></label></td>
			</tr>
			<?php if(!empty($college_name)||$canEdit) {?>
			<tr>
				<td>الكلية</td>
				<td>
					<?php if($canEdit) {?>
						<select name="college_select" id="college_select" required oninvalid="this.setCustomValidity('يجب إختيار الكلية')">
                            <option value="-1">-- اختر الكليه --</option>
                            <?php
                            $sql = "SELECT  distinct college.`ID`,college.`name` FROM college,univ_coll where college.ID = univ_coll.coll_id and univ_coll.univ_id =? ORDER BY name ASC";
							$stmt = $con->prepare($sql);
							$stmt->bind_param('i', $university_ID);
							$stmt->execute();
							$res = $stmt->get_result();
							while ($row = $res->fetch_array(MYSQLI_ASSOC)) 
							{
								$ID = $row['ID'];
								$name = $row['name'];
								$selected = "";
								if($ID == $college_ID)
									$selected = "selected";
								echo "<option value='$ID' $selected>$name</option>";
							}
							?>
						</select>
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $college_name; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }?>			
			<?php if(!empty($natural_name)||$canEdit) {?>
			<tr>
				<td>طبيعة النشاط</td>
				<td>
					<?php if($canEdit) {?><select name="activity_natural_ID" id="activity_natural_ID" required 
					oninvalid="this.setCustomValidity('يجب إختيار طبيعة النشاط')" oninput="setCustomValidity('')"  onchange="validateForm()">
                            <option value="-1">-- اختر طبيعة النشاط --</option>
                            <?php
                            $sql = "SELECT  distinct `ID`, `name` FROM activity_natural order by name ASC";
							$stmt = $con->prepare($sql);
							$stmt->execute();
							$res = $stmt->get_result();
							while ($row = $res->fetch_array(MYSQLI_ASSOC)) 
							{
								$ID = $row['ID'];
								$name = $row['name'];
								$selected = "";
								if($ID == $natural_ID)
									$selected = "selected";
								echo "<option value='$ID' $selected>$name</option>";
							}
							?>
						</select>
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $natural_name; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<?php if(!empty($type_name)||$canEdit) {?>
			<tr>
				<td>نوعية النشاط</td>
				<td>
					<?php if($canEdit) {?>
					<select name="activity_type" id="activity_type" required oninvalid="this.setCustomValidity('يجب إختيار نوعية النشاط')">
                            <option value="-1">-- اختر نوعية النشاط --</option>
                            <?php
                            $sql = "SELECT  distinct `ID`, `name` FROM activity_type order by name ASC";
							$stmt = $con->prepare($sql);
							$stmt->execute();
							$res = $stmt->get_result();
							while ($row = $res->fetch_array(MYSQLI_ASSOC)) 
							{
								$ID = $row['ID'];
								$name = $row['name'];
								$selected = "";
								if($natural_ID != 3 && $ID == 13)
									continue;
								
								if($ID == $type_ID)
									$selected = "selected";
								echo "<option value='$ID' $selected>$name</option>";
							}
							?>
						</select>
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $type_name; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<?php if(!empty($taklef_name)||$canEdit) {?>
			<tr>
				<td>تم التكليف من قبل</td>
				<td>
					<?php if($canEdit) {?>
					<select name="fk_taklefselect" id="fk_taklefselect" required 
						oninvalid="this.setCustomValidity('يجب إختيار مصدر التكليف')"  onchange="validateForm()">
						<option value="-1">-- اختر مصدر التكليف  --</option>
						<?php
						$sql = "SELECT  distinct `ID`, `name` FROM taklef order by name ASC";
						$stmt = $con->prepare($sql);
						$stmt->execute();
						$res = $stmt->get_result();
						while ($row = $res->fetch_array(MYSQLI_ASSOC)) 
						{
							$ID = $row['ID'];
							$name = $row['name'];
							$selected = "";							
							if($ID == $taklef_id)
								$selected = "selected";
							echo "<option value='$ID' $selected>$name</option>";
						}
						?>
					</select>
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $taklef_name; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }
			if(!empty($gehaaa)||$canEdit) {
			if($taklef_id == 5) {
			?>
			<tr>
				<td>الجهة الراعية</td>
				<td>
					<?php if($canEdit) {?>
						<input type="text" id="gehaaa" name="gehaaa" value="<?php echo $gehaaa; ?>" required /> 
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $gehaaa; ?></label>
					<?php } ?>
				</td>
			</tr>							
			<?php } 
			}
			if(!empty($Date)||$canEdit) {?>
			<tr>
				<td>تاريخ بداية النشاط</td>
				<td>
					<?php if($canEdit) {?>
						<input style="text-align: right;" type="date" id="Date" name="Date" value="<?php echo $Date; ?>" required />
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $Date; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<?php if(!empty($End_Date)||$canEdit) {?>
			<tr>
				<td>تاريخ انتهاء النشاط</td>
				<td>
					<?php if($canEdit) {?>
						<input style="text-align: right;" type="date" id="End_Date" name="End_Date" value="<?php echo $End_Date; ?>" required />
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $End_Date; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<?php if(!empty($title)||$canEdit) {?>
			<tr>
				<td>نوعية المستفيدين</td>
				<td>
					<?php if($canEdit) {?>						
                        <input type="text" id="title" name="title" required value="<?php echo $title; ?>"
						oninvalid="this.setCustomValidity('يجب اختيار اسم النشاط')" oninput="setCustomValidity('')"  />
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $title; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<?php if(!empty($wafed_student)||$canEdit) {?>
			<tr>
				 <td>نوعية المشاركين</td>
				<td>
					<?php if($canEdit) {?>
						<input type="text" id="wafed_student" name="wafed_student" onkeyup="sum();" value="<?php echo $wafed_student; ?>" />
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $wafed_student; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<?php if(!empty($egy_student)||$canEdit) {?>
			<tr>
				<td>عدد المستفيدين</td>
				<td>
					<?php if($canEdit) {?>
						<input type="text" id="egy_student" name="egy_student" onkeyup="sum();" value="<?php echo $egy_student; ?>" />
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $egy_student; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<?php if(!empty($khas_student)||$canEdit) {?>
			<tr>
				<td>عدد القوافل</td>
				<td>
					<?php if($canEdit) {?>
						<input type="text" id="khas_student" name="khas_student" onkeyup="sum();" value="<?php echo $khas_student; ?>" />
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $khas_student; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<?php if(!empty($no_student)||$canEdit) {?>
			<tr>
				<td>عدد المشاركين</td>
				<td>
					<?php if($canEdit) {?>
						<input type="text" id="no_student" name="no_student" value="<?php echo $no_student; ?>" readonly />
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $no_student; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<?php if(!empty($desc)||$canEdit) {?>
			<tr>
				<td>وصف النشاط</td>
				<td>
					<?php if($canEdit) {?>
						<textarea name="comment" rows="5" style="width:90%;" ><?php echo $desc; ?></textarea> 
					<?php } else {?>
					<label style="font-weight:normal;"><?php echo $desc; ?></label>
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<?php if((!empty($pdf_image) && file_exists($pdf_image))&&!$canEdit) {?>
			<tr>
				<td>ملف يحتوى على صورة</td>
				<td>
					<?php if($canEdit) {?>
					<?php }?>
					<?php if(!empty($pdf_image) && file_exists($pdf_image)) {?>
					 <iframe id="iframepdf" src="<?php echo $pdf_image; ?>" title="PDF in an i-Frame" style="border:1px solid #666CCC" scrolling="auto" height="500" width="98%" ></iframe>
					<?php }?>
				</td>
			</tr>
			<?php }
			if($canEdit){?>
			<tr>
				<td colspan="2" align="center">
					<label><input type="submit"   value="تعديل " style="width:8em ;height:2em;" name="Edit" onclick="validatename();return false;" /></label>
				</td>
			</tr>
			<?php }?>
		</table>
	</form>
	<?php
}
else
{
	echo "<div style='color:red;'>عفوا ليس لديك الصلاحية للاطلاع علي هذا النشاط</div>";
}

include('footer.php');

if($canEdit)
{
?>
<script>

function sum() {
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
		var top = document.getElementById("activity_natural_ID").value;
		/*var type = document.getElementById("typeselect").value;
        var id = document.getElementById("idx").value;*/
		var taklefid = document.getElementById("fk_taklefselect").value;
        window.location.href = "viewEdit.php?activityId=<?php echo $serial;?>&oper=EDIT&" + "topic=" + top +"&taklefid="+ taklefid;
		//+ "&" + "type=" + type + "&" + "taklefid=" + taklefid + "&" + "id=" + id
    }
</script>
<script>
    function validatename() 
	{
		var college_select = document.getElementById("fk_coll").value;
		var topicselect = document.getElementById("activity_natural_ID").value;
		var typeselect = document.getElementById("activity_type_ID").value;
		var date = document.getElementById("End_Date").value;
		var date = document.getElementById("Date").value;
		var b_enroll_male = document.getElementById("title").value;
	 
		if (college_select.length == 0 || college_select == -1) 
		{
            var str = "يرجى اختيار الكليه";
            alert(str);
        }		
		else if (topicselect.length == 0 || topicselect == -1) 
		{
            var str = "يرجى اختيار طبيعة النشاط";
            alert(str);
        }
		else if (typeselect.length == 0 || typeselect == -1) 
		{
                var str = "يرجى اختيار نوعية النشاط";
                alert(str);
        }
		else if (date.length == "") 
		{
                var str = "يرجى اختيار تاريخ بداية النشاط";
                alert(str);
        }
		 else if (date.length == "") 
		 {
                var str = "يرجى اختيار تاريخ نهاية النشاط";
                alert(str);
         }
		 else if (b_enroll_male.length == "") 
		 {
                var str = "يرجى اختيار اسم النشاط";
                alert(str);
         }
		 else
		 {
			  form.submit();
		 }
	}
</script>
<?php }?>