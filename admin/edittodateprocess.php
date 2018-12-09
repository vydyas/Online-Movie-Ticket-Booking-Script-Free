<?php
session_start();

include('../db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$theater_id=$_POST['theater_id'];
$movie_id=$_POST['movie_id'];
$location_id=$_POST['location_id'];
$date=$_POST['date'];


$query=mysql_query("UPDATE assign_show SET todate='$date' WHERE (fk_theater_id='$theater_id' AND fk_movie_id='$movie_id' AND fk_location_id='$location_id')");


?>