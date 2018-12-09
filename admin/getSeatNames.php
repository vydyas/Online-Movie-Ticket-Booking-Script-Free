<?php
session_start();
include_once('chk_login.php');
?>
<?php
include('../db/db.php');
include("../db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$theater_id = $_REQUEST['theater_id'];
$td_idArray = array('');
$seat_nameArray = array('');

$sql = "select * from seats where fk_theater_id = '$theater_id'";
if(!$result = mysql_query($sql)){
	die('SQL ERROR : '.mysql_error());
}
else
{
	while($row = mysql_fetch_array($result))
	{
		array_push($td_idArray,$row['td_id']);
		array_push($seat_nameArray,$row['seat_name']);
	}
	$arrCnt = count($seat_nameArray);
	$maxTd = max($td_idArray);
	$matchIndex = 0;
	echo"<table border='1' id='adminSeatArrange' style='float:left;margin:20px;'>";
	for($i = 0; $i<$maxTd; $i++)
	{
		echo"<tr>";
		for($j = 0; $j<$maxTd; $j++)
		{
			if($i == 0 || $j == 0)
			{
				if($i ==0 && $j == 0)
				{
					echo"<td style='border:1px solid #666;'>0</td>";
				}
				else if($i == 0)
				{
					echo"<td style='border:1px solid #666;'>$j</td>";
				}
				else if($j == 0)
				{
					echo"<td style='border:1px solid #666;'>$i</td>";
				}
				
			}
			else
			{
				$matchIndex = array_search($i.$j,$td_idArray);
				$seatname = $seat_nameArray[$matchIndex];
				if($matchIndex>0)
				{
					echo"<td id='$i$j' title='$seatname'><img src='../images/unavailable.png' class='$seatname' /></td>";
				}
				else
				{
					echo"<td id='$i$j'></td>";
				}
			}
		}
		echo"</tr>";
		if($arrCnt == $matchIndex)
		{
			break;
		}
	}
	echo"</table>";
}

?>