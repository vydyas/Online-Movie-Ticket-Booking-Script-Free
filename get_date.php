<?php
include('db/db.php');
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$loc_id = $_REQUEST['loc_id'];
$mov_id = $_REQUEST['mov_id'];

$sql = "SELECT m.release_date,a.todate  FROM movies m LEFT JOIN assign_show a on a.fk_movie_id=m.id WHERE fk_location_id=$loc_id AND fk_movie_id=$mov_id AND a.todate >= curdate() ";

$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$date = $row['release_date'];
$todate=$row['todate'];

$release_date=strtotime($date)."<br>";

$today = date('D j M,Y');
$today = strtotime($today);
$todate = strtotime(date("D j M,Y", strtotime($todate)));

if($today>$release_date)
{

  $today = date('D j M,Y');
  $tomorrow = date('D j M,Y', time()+86400);
  $dayAftT = date('D j M,Y', time()+172800);

  if(strtotime($today)<=$todate)
  {
  	echo "<option value='$today'>".$today."</option>";
  }
  
  if(strtotime($tomorrow)<=$todate)
  {
  	echo "<option value='$tomorrow'>".$tomorrow."</option>";
  }
	
  if(strtotime($dayAftT)<=$todate)
  {
  	echo "<option value='$dayAftT'>".$dayAftT."</option>";
  }
	
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