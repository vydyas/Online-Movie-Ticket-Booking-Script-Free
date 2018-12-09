<?php
session_start();

include('../db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$theater_id = $_POST['theater_id'];
$movie_id = $_POST['movie_id'];
$location_id = $_POST['location_id'];
$link=$_POST['link'];
$date=$_POST['date'];

$checkquery=mysql_query("SELECT * FROM assign_show WHERE (fk_theater_id='$theater_id' and fk_location_id = '$location_id' and fk_movie_id='$movie_id')");
if(mysql_num_rows($checkquery)>0)
{
	echo "Link Updated Successfully";
	$query=mysql_query("UPDATE assign_show SET todate='$date' WHERE fk_theater_id='$theater_id' and fk_location_id = '$location_id' and fk_movie_id='$movie_id'");
}
else
{
	echo "Link Inserted Successfully";
$query=mysql_query("INSERT INTO links VALUES ('','$theater_id','$movie_id','$link')");
$sql = "select * from assign_show where fk_theater_id='$theater_id' and fk_location_id = '$location_id'";
		$result = mysql_query($sql);
		$rescnt = mysql_fetch_array($result);
		$morning=$rescnt['morning'];
		$matney=$rescnt['matney'];
		$firstshow=$rescnt['firstshow'];
		$secondshow=$rescnt['secondshow'];
		$addshowdate=date('Y-m-d');
		$moviesql=mysql_query("INSERT INTO assign_show VALUES ('','$movie_id','$theater_id','$location_id','$morning','$matney','$firstshow','$secondshow','$addshowdate','$date')");

}
?>