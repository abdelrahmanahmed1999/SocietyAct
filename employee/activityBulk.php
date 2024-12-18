<?php

include ('header.php');

	$result = $con->query("SELECT ID, name FROM university");
	if ($result) {
		$users = $result->fetch_all(MYSQLI_ASSOC);
	} else {
		die("Query failed: " . $con->error);
	}

?>
<style>


	select{
		margin:10px;
		width:45% !important;
		display:inline-block !important;
	}

	.Quard{
		width:250px;
		margin:5px;
		display:block;
		height:2em;
		font-size:20px;
		border: 1px solid #012880;
		background-image: linear-gradient(-180deg, #8998ff 0%, #290ce6 100%);
		box-shadow: 0 1rem 1.25rem 0 rgba(22,75,195,0.50),0 -0.25rem 1.5rem rgba(110, 15, 155, 1) inset, 0 0.75rem 0.5rem rgba(255,255,255, 0.4) inset,
							0 0.25rem 0.5rem 0 rgba(180, 70, 207, 1) inset;"
	}
</style>
<?php
	$quarPost="-1";
	$tmpfilename = "";
	$filtered_user_id="-1";
	$yearPost="-1";
	$length=1;

	if(isset($_GET["user_id"]) && isset($_GET["quar"]) && isset($_GET["year"]))
	{
		$quarPost=$_GET["quar"];
		$yearPost=$_GET["year"];
		$filtered_user_id=$_GET["user_id"];
		$planusers=$users;
		if($_GET["user_id"] == '0'){
			$length = $result->num_rows;
		}
	}
?>
<form method="get"  enctype="multipart/form-data" dir="rtl">

	<h1 style='font-weight:bold;font-size:28px;color: steelblue;text-align:center;'  class='web'>خطـــة الأنــشــطــة المــســتقبليــة بالعام الجامعى</h1>

	<select name="user_id" class="form-control" required>
		<option  selected disabled>اختر الجامعة</option>
		<?php
			foreach ($users as $user) {
				$selected =  $filtered_user_id == $user['ID'] ? 'selected' : '';
				echo '<option value="' . htmlspecialchars($user['ID']) . '" ' . $selected . '>';
				echo htmlspecialchars($user['name']);
				echo '</option>';
			}
		?>
		<option value="0" <?php if($filtered_user_id=="0") echo "selected"?>>الكل</option>

	</select>
	<select name="quar" class="form-control" required>
		<option selected disabled>اختر الربع</option>
		<option value="1" <?php if($quarPost=="1") echo "selected"?>>الربع الأول</option>
		<option value="2" <?php if($quarPost=="2") echo "selected"?>>الربع الثاني</option>
		<option value="3" <?php if($quarPost=="3") echo "selected"?>>الربع الثالث</option>
		<option value="4" <?php if($quarPost=="4") echo "selected"?>>الربع الأخير</option>
		<option value="0" <?php if($quarPost=="0") echo "selected"?>>الكل</option>
	</select>
	<select name="year" class="form-control" required>
		<option selected disabled>اختر العام</option>
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
		<option value="0" <?php if($yearPost=="0") echo "selected"?>>الكل</option>

	</select>
	<button  type="submit" class="site-btn btn">بحث</button>
	<div>
		<?php
		$prvYear="";
		$prvQuar="";
		for($i=0;$i<$length;$i++){
			if($filtered_user_id == '0'){
				$user_id=$users[$i]['ID'];
			}
			else{
				$user_id=$filtered_user_id;
			}
			$tmpfilename = $user_id."/";

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
					
					$hidden = false;

					if ($user_id != "0" && strpos($filename, $user_id) === false) {
						$hidden = true; 
					}
				
					if ($quarPost != "0" && $curQuar != $quarPost) {
						$hidden = true; 
					}
				
					if ($yearPost != "0" && strpos($filename, $yearPost) === false) {
						$hidden = true; 
					}
				

					if (!$hidden) {
						echo "<div class=\"col-lg-3 col-md-6 col-sm-6\" style=\"float:right;\">";
							echo "<a dir=\"rtl\" class=\"btn btn-info Quard\" href=\"{$p['dirname']}/{$p['basename']}\" target=\"_blank\">";
							echo str_replace(
								substr($p['basename'], 0, 7),
								"",
								str_replace("أنشطة", "", str_replace(".xlsx", "", $p['basename']))
							);
						echo "</a></div>";
					}

				if($prvYear!=$curYear && !empty($prvYear))
					$prvQuar = "";
				else
					$prvQuar = $curQuar;
				$prvYear = $curYear;		
			}
		}
		?>
	</div>
</form>


<?php include 'footer.php';