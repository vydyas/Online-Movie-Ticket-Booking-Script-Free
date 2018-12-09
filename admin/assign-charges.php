<?php
session_start();
include_once('chk_login.php');
?>
<link rel="stylesheet" type="text/css" href="style1.css">
<script src="jquery.js"></script>
<style>
table { 
	margin: 0 auto;
	font-size: 11px;
	text-align: center;
}
td { width: 20px;text-align: center; }
</style>
<title>Movies</title>
<?php
include('../db/db.php');
include("../db/admin.php");


//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$admin=new admin();

$id = $_SESSION['id'];
$show_id = $_REQUEST['show_id'];
$theater_id = $_REQUEST['theater_id'];
echo $admin->menu();
?>
	<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
	<?php
	$tdIdArray = array('');
	$seatNameArray = array('');
	$tdArray = array();
	$trArray = array();
	$sql = "select * from seats where fk_theater_id ='$theater_id'";
	if(!$result = mysql_query($sql))
	{
		die('SQL ERROR : '.mysql_error());
	}
	else
	{
		$_SESSION['show_id']=$show_id;
		while($row = mysql_fetch_array($result))
		{
			$idExplode = array();
			$idExplode = explode('.',$row['td_id']);
			array_push($trArray,$idExplode[0]);
			array_push($tdArray,$idExplode[1]);
			array_push($tdIdArray,$row['td_id']);
			array_push($seatNameArray,$row['seat_name']);
		}
		$maxTr = max($trArray); 
		$maxTd = max($tdArray);
		$colSpan = $maxTd + 1;
		echo"<form method='post' action='process/assign-charges.php'>";
		echo "<input type='hidden' name='show_id' value='$show_id'>";
		echo "<input type='hidden' name='theater_id' value='$theater_id'>";
		echo"<table>";
		for($i = 1;$i<=$maxTr;$i++)
		{
			echo"<tr>";
			$flag = false;
			for($j = 1; $j<=$maxTd; $j++)
			{
				$matchId = $i.'.'.$j;
				
				$flag1 = false;
				for($m=0; $m<count($tdIdArray); $m++)
				{
					if($matchId === $tdIdArray[$m])
					{
						$seatname = $seatNameArray[$m];
						echo"<td id='$matchId' title='$seatname'>$seatname<br/><img src='../images/unavailable.png' class='$seatname' /></td>";
						echo"<input type='hidden' name='getseatname[]' value='$seatname'>";
						echo"<input type='hidden' name='getseatid[]' value='$matchId'>";
						$flag1 = true;
						$flag = true;
					}
				}
				if(!$flag1)
				{
					echo"<td id='$matchId'></td>";
				}
			}
			if($flag)
			{
			echo"<td style='padding:0 0 0 15px;'><input type='text' name='charges".$i."' id='charges".$i."' placeholder = 'Enter Charges' /></td></tr>";
			}
			else{
				echo"<td></td></tr>";
			}
		}
		echo"<tr><td colspan='$colSpan' style='padding:10px 0 0 0;'><input type='submit' name='submit' value='Submit'></td></tr>";
		echo"</table>";
		echo"</form>";
	}
	?>