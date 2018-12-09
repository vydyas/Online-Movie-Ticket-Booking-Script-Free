<?php
session_start();
include('db/db.php');
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$loc_id = $_REQUEST['loc_id'];
$movie_id = $_REQUEST['movie_id'];
$mdate = $_REQUEST['mdate'];
$_SESSION['showdate'] = $mdate;
echo "<table border='1'><tr><td colspan='4'>".$mdate."</td></tr><tr>";
$sql1 = "select * from theatres where movies_id = '$movie_id' and location_id='$loc_id'";
$result1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($result1))
{
	echo"<td><span><a href='savetime.php?time=".$row1['morning']."'>".$row1['morning']."</a></span></td><td><span><a href='seat-booking.php?time=".$row1['matney']."'>".$row1['matney']."</a></span></td><td><span><a href='seat-booking.php?time=".$row1['firstshow']."'>".$row1['firstshow']."</a></span></td><td><span><a href='seat-booking.php?time=".$row1['secondshow']."'>".$row1['secondshow']."</a></span></td>";
}
echo"</table>";
?>