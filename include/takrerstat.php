<style>
@media print {
  th:last-child, td:last-child {
   
  }
}


</style>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php
include ('header.php');
$currentTypeId=-1;
$currentNatureId=-1;
$currentUniversityId=-1;
		
$currentStatisticsType=-"university";

if (isset($_POST['show'])) 
{
	$currentStatisticsType=$_POST["statistics_type"];  
	
	$currentTypeId=$_POST["activity_type"];     
	$currentNatureId=$_POST["activity_nature"]; 
	$currentUniversityId=$_POST["univ_id"];
}
?>
<hr>
<div dir="rtl">
    <form id="searchForm" name="searchForm" method="post">
		<div>
			<label>احصائية وفقا ل:</label>
			<select style="width:15%;font-size:16px; display:inline-block" class="form-control" onchange="typeChange();"
					name="statistics_type" id="statistics_type">
				 <option value="university" <?php if($currentStatisticsType === "university") echo "selected"; ?>>الجامعات</option>
				 <option value="nature" <?php if($currentStatisticsType === "nature") echo "selected"; ?>>طبيعة النشاط</option>
				 <option value="type" <?php if($currentStatisticsType === "type") echo "selected"; ?>>نوعية النشاط</option>
			</select>
		</div>
		<label>معايير الإحصائية: </label>
        <select style="width:25%;font-size:16px; display:inline-block"
        class="form-control" name="univ_id" id="univ_id">
            <option value="-1">-- كل الجامعات --</option>
            <?php
                $sql = "SELECT distinct ID, name FROM university ORDER BY name ASC";
                $stmt = $con->prepare($sql);	
                $stmt->execute();
                $res = $stmt->get_result();
                while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                    $university_id = $row['ID'];
                    $university_name = $row['name'];
                    ?>
                    <option value="<?php echo $university_id ?>" <?php if($currentUniversityId == $university_id) echo "selected"; ?>><?php echo "جامعة $university_name" ?></option>
                    <?php
                }?>
        </select>

		<select name="activity_nature" style="width:25%;font-size:16px; display:inline-block"
		class="form-control" id="activity_nature"/>
			<option value="-1">--طبيعة النشاط-</option>  
			<?php
			$sqlRes = 'SELECT `id`,`name` FROM `activity_natural`';
			$stmtRes = $con->prepare($sqlRes);
			$stmtRes->execute();
			$resRes = $stmtRes->get_result();
			while($rowRes = $resRes->fetch_array(MYSQLI_ASSOC)) {
			   $nature_id =$rowRes['id'];
			   $nature_name=$rowRes['name'];
			  ?>
				<option value="<?php echo $nature_id ?>" <?php if($currentNatureId == $nature_id) echo "selected"; ?>><?php echo $nature_name?></option>
				
				<?php 
				}					
			?>
		</select>
        
		<select name="activity_type" style="width:25%;font-size:16px; display:inline-block"
	class="form-control" id="activity_type"/>
				<option value="-1">--نوعية النشاط--</option>  
				<?php
				$sqlRes = 'SELECT `id`,`name` FROM `activity_type`';
				$stmtRes = $con->prepare($sqlRes);
				$stmtRes->execute();
				$resRes = $stmtRes->get_result();
				while($rowRes = $resRes->fetch_array(MYSQLI_ASSOC)) {
				   $type_id =$rowRes['id'];
				   $type_name=$rowRes['name'];
				  ?>
					<option value="<?php echo $type_id ?>" <?php if($currentTypeId == $type_id) echo "selected"; ?>><?php echo $type_name?></option>
					
					<?php 
					}					
				?>
			</select>

        <label>
            <input type="submit" name="show" id="show" value="مشاهدة الأحصائيات" class=" btn btn-info" style="width:7em ;height:2em;font-size:18px;" />
        </label>
    </form>
</div>
<form id="form1" name="form1" method="post" action="statistics.php">
          
	<div class="content">
		<center>            
		
			<div align="center" style="font-weight:bold" id="printt">
				<a href="#" onclick="printf();return false;" style="font-size:27px"> بيانــات التـــــــقريــر </a>
			</div>
		<?php

			//DEFINE LIMIT for PER PAGE now 10 is page limit
			$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 1000;
				
			//DEFAULT PAGE NUMBER if No page in url
			$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;

			//Number of frequency links to show at one time ; 
			$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;

			$sortby = ( isset( $_GET['sortby'] ) ) ? $_GET['sortby'] : "";
			$sortbyOrg=$sortby;
			$sorttype = ( isset( $_GET['sorttype'] ) ) ? $_GET['sorttype'] : "";
			
			$headerText = "";
			$sql = "SELECT count(*) as count";
			$where = "where 1 = 1";
			$groupBy = "";
			if($currentStatisticsType == "university")
			{
				$headerText = "الجامعات";
				$sql .= ", university.name as cat from activity inner join university on university.ID=university_id ";
				$groupBy = " group by university.name ";
			}
			else if($currentStatisticsType=="type")
			{
				$headerText = "نوعية النشاط";
				$sql .= ", activity_type.name as cat from activity 
						inner join activity_type on activity_type.id=activity_type_id ";
				$groupBy = " group by activity_type.name ";
			}
			else if($currentStatisticsType=="nature")
			{
				$headerText = "طبيعة النشاط";
				$sql .= ", activity_natural.name as cat from activity 
						inner join activity_natural on activity_natural.id=activity_natural_id ";
				$groupBy = " group by activity_natural.name ";
			}
			$where .= " and ? in (activity.`activity_natural_id`, -1) and ? in (activity.`activity_type_id`, -1) 
						and ? in (activity.`university_id`, -1)";
			
			$sql .= $where . $groupBy . " order by count desc";
				
			$stmt = $con->prepare($sql);
			
			$stmt->bind_param('iii', $currentNatueId, $currentTypeId, $currentUniversityId);
			$stmt->execute();
			$res = $stmt->get_result();
			$total = mysqli_num_rows($res);
			$stmt->close();

			$pagerSql = $sql;
			if($total<=($page-1)*$limit)
					$page = 1;
				
				//get the results from paginator class
				if ( $limit == 'all' ) {
					//$pagerSql      = $sql;
				} else {
					$offset=( ( $page - 1 ) * $limit );
					$pagerSql      = $pagerSql . " LIMIT " . $offset . ", $limit";
				}

				$stmt = $con->prepare($pagerSql);                
				$stmt->bind_param('iii', $currentNatureId, $currentTypeId, $currentUniversityId);
				
				$stmt->execute();
				$res = $stmt->get_result();

				$results=array();
				while ( $row = $res->fetch_assoc() ) {
					$results[]  = $row;
				} 
				$result         = new stdClass();
				$result->page   = $page;
				$result->limit  = $limit;
				$result->total  = $total;
				$result->data   = $results;	
				
				$pagesLink = "";
				$list_class = "pagination";
				function append_existing_query_string($qstring)
				{
					if(isset($_GET))
					{
						foreach($_GET as $k=>$v)
						{
							if($k!=="limit" && $k!=="page")
								$qstring.="&".$k."=".$v;
						}
					}
					return $qstring;
				}
				$qstring='';
				if ( $limit != 'all' && $total>$limit)
				{ 
					$last       = ceil( $total / $limit );	 
					$start      = ( ( $page - $links ) > 0 ) ? $page - $links : 1;
					$end        = ( ( $page + $links ) < $last ) ? $page + $links : $last;	 
					$pagesLink       = '<ul style="direction:rtl;padding:0px;margin:0px;" class="' . $list_class . '">';	 
					$class      = ( $page == 1 ) ? "disabled" : "";			
					//
					$qstring='?limit=' . $limit . '&page=' . ( $page - 1 );
					$qstring=append_existing_query_string($qstring);
					//		
					$pagesLink       .= '<li class="' . $class . '"><a href="'.$qstring.'">&raquo;</a></li>';	 
					if ( $start > 1 ) {			
						//
						$qstring='?limit=' . $limit . '&page=1';
						$qstring=append_existing_query_string($qstring);
						//
						$pagesLink   .= '<li><a href="'.$qstring.'">1</a></li>';
						
						$qstring='?limit=' . $limit . '&page=' . $start;
						$qstring=append_existing_query_string($qstring);
						$pagesLink   .= '<li><span><a href="'.$qstring.'"> ... </a></span></li>';
					}	 
					for ( $i = $start ; $i <= $end; $i++ ) {
						$class  = ( $page == $i ) ? "active" : "";
						//
						$qstring='?limit=' . $limit . '&page=' . $i;
						$qstring=append_existing_query_string($qstring);
						//
						$pagesLink   .= '<li class="' . $class . '"><a href="'.$qstring.'">' . $i . '</a></li>';
					}	 
					if ( $end < $last ) {
						$qstring='?limit=' . $limit . '&page=' . $end;
						$qstring=append_existing_query_string($qstring);
						$pagesLink   .= '<li><span><a href="'.$qstring.'"> ... </a></span></li>';
						//
						$qstring='?limit=' . $limit . '&page=' . $last;
						$qstring=append_existing_query_string($qstring);
						//
						$pagesLink   .= '<li><a href="'.$qstring.'">' . $last . '</a></li>';
					}	 
					$class      = ( $page == $last ) ? "disabled" : "";		
					$qstring='?limit=' . $limit . '&page=' . ( $page + 1 );
					$qstring=append_existing_query_string($qstring);		
					$pagesLink       .= '<li class="' . $class . '"><a href="'.$qstring.'">&laquo;</a></li>';	 
					$pagesLink       .= '</ul>';
				}
				//$pagesLink .= '<span style="float:right;color:blue">إجمالي عدد '.$headerText.' : '.$total.'</span>';
			?>
				<table class="table" style="margin-bottom:0px;"><tr> <td colspan="10" align="center"><p><?php echo $pagesLink; ?></p></td></tr></table>
					<table class="table  table-striped" align="center" dir="rtl" border="2" 
						style="margin-right:auto; width: fit-content;align:center;margin-top:10px;min-width: 800px;"> 
						<tr style="font-weight:bold;font-size: 20px;" align="center">
							<th style="width:60px;">م</th>
							<?php echo "<th style='text-align:right;'>$headerText</th>";?>
							<th  style="width:160px;">عدد الأنشطة</th>
						</tr>
				<?php
				$itr = 1;
				$dataPoints = array();

				for( $i = 0; $i < count( $result->data ); $i++ )
				{
					$count=$result->data[$i]['count'];
					$cat=$result->data[$i]['cat'];
					$chartItem = array("label"=> "$cat", "y"=> $count);
					$dataPoints[] = $chartItem;
				?>		
						<tr> 
							<td class="text-center" style="vertical-align: middle;">   <?php     echo $itr++ ; ?> </td>
							<td class="text-center" style="vertical-align: middle;text-align:right;"><?php echo $cat?> </td>
							<td class="text-center" style="vertical-align: middle;"><?php echo $count?> </td>
						</tr>
			<?php	
			}          
			?>	
					</table>
			<table class="table" style="margin-bottom:0px;"><tr> <td colspan="10" align="center"><p><?php echo $pagesLink; ?></p></td></tr></table>
			<div style="page-break-inside: avoid;">
			<div id="chartContainer" style="height: 370px; width: 100%;"></div>
			<div id="chartContainer2" style="height: 370px; width: 100%;"></div>
			</div>
		</center>
	</div>

</form>

<script>
function printf() {
   document.getElementById("searchForm").style.display = 'none';
    //   document.getElementById("add_eval").style.visibility = 'hidden';
    // document.getElementById("back2").style.visibility = 'hidden';
    window.print();
	document.getElementById("searchForm").style.display = 'block';
}
</script>

<script>
	function typeChange()
	{		
		var statistics_type = document.getElementById("statistics_type"); 
		
        var activity_type = document.getElementById("activity_type"); 				
        var activity_nature = document.getElementById("activity_nature"); 			
        var univ_id = document.getElementById("univ_id");
		
		activity_type.style.display = "inline-block";
		activity_nature.style.display = "inline-block";
		univ_id.style.display = "inline-block";
		
		if(statistics_type.value=="university")
		{
			univ_id.style.display = "none";
			univ_id.value = "-1";
		}
		else if(statistics_type.value=="type")
		{
			activity_type.style.display = "none";
			activity_type.value = "-1";
		}
		else if(statistics_type.value=="nature")
		{
			activity_nature.style.display = "none";
			activity_nature.value = "-1";
		}
	}
	
	document.addEventListener('DOMContentLoaded', function() {
							   typeChange();
							   var chart = new CanvasJS.Chart("chartContainer", {
								animationEnabled: true,
								exportEnabled: true,
								title:{
									text: " "
								},
								subtitles: [{
									text: " "
								}],
								data: [{
									type: "pie",
									showInLegend: "true",
									legendText: "{label}",
									indexLabelFontSize: 16,
									indexLabel: "{label} - #percent%",
									yValueFormatString: "#,##0",
									dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
								}]
							});
							chart.render();
							
							var chart2 = new CanvasJS.Chart("chartContainer2", {
							animationEnabled: true,
							exportEnabled: true,
							theme: "light1", // "light1", "light2", "dark1", "dark2"
							title:{
								text: " "
							},
							axisY:{
								includeZero: true
							},
							data: [{
								type: "column", //change type to bar, line, area, pie, etc
								indexLabel: "{y}", //Shows y value on all Data Points
								indexLabelFontColor: "#5A5757",
								indexLabelPlacement: "outside",   
								dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
							}]
						});
						chart2.render();

							}, false);
</script>