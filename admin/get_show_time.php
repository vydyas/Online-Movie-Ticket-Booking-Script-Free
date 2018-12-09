<?php
session_start();
include_once('chk_login.php');
?>
<?php
include('../db/db.php');
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$clocation = $_REQUEST['clocation'];
$ctheatre = $_REQUEST['ctheatre'];
$cmovie = $_REQUEST['cmovie'];

$sql = "select * from assign_show where fk_location_id = '$clocation' and fk_theater_id = '$ctheatre'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$show_id = $row['show_id'];

$sql1 = "select * from customer_booking where fk_show_id = '$show_id' and fk_movie_id = '$cmovie' group by show_time";
$result1 = mysql_query($sql1);
echo"<option value=''>Select Time</option>";
while($row1 = mysql_fetch_array($result1))
{
	$time = $row1['show_time'];
	echo"<option value='$time'>".$time."</option>";
}
?>