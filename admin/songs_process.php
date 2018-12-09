<?php
session_start();
?>
<?php
include('../db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$movie_id = $_POST['movie_id'];
$name = $_POST['name'];
$link=$_POST['link'];

$query="INSERT INTO songs VALUES ('','$name','$link','$movie_id')";
if(!$result = mysql_query($query))
{
	die('SQL ERROR : '.mysql_error());
}
?>