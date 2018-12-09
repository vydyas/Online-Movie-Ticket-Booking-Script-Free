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

$the_id = $_REQUEST['the_id'];

echo $sql = "SELECT m.release_date  FROM assign_show a LEFT JOIN theatres t on t.id=a.fk_theater_id LEFT JOIN movies m on m.id=a.fk_movie_id WHERE t.id=$the_id";

$result = mysql_query($sql);
$row = mysql_fetch_array($result);
 $date = $row['release_date'];

 $release_date=strtotime($date)."<br>";

 $today = date('D j M Y');
 $today = strtotime($today);

if($today>$release_date)
{
  $today = date('D j M Y');
  $tomorrow = date('D j M,Y', time()+86400);
  $dayAftT = date('D j M,Y', time()+172800);

	echo"<option value='$today'>".$today."</option>";
	echo"<option value='$tomorrow'>".$tomorrow."</option>";
	echo"<option value='$dayAftT'>".$dayAftT."</option>";
}
else
{
  $today = $date;

  $tomorrow = date('D j M Y', strtotime($today. ' + 1 day'));
  $dayAftT = date('D j M Y', strtotime($today. ' + 2 day'));

	echo"<option value='$today'>".$today."</option>";
	echo"<option value='$tomorrow'>".$tomorrow."</option>";
	echo"<option value='$dayAftT'>".$dayAftT."</option>";

}
?>