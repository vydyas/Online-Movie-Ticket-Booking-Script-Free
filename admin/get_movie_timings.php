<?php
session_start();
include_once('chk_login.php');
?>
<?php
include('db/db.php');
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$loc_id = $_REQUEST['loc_id'];
$movie_id = $_REQUEST['movie_id'];
$mdate = $_REQUEST['mdate'];
echo "<table id='show-timing' border='1'><tr><td colspan='4'>".$mdate."</td></tr><tr>";
$sql1 = "select * from theatres where movies_id = '$movie_id' and location_id='$loc_id'";
$result1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($result1))
{
	echo"<td><span id='book1'>".$row1['morning']."</span></td><td><span>".$row1['matney']."</span></td><td><span>".$row1['firstshow']."</span></td><td><span>".$row1['secondshow']."</span></td>";
}
echo"</table>";
?>