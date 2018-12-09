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

if($_POST)
{
$location=$_POST['location'];
$youtubeid=$_POST['youtubeid'];


	$query=mysql_query("INSERT INTO trailers VALUES('','$youtubeid','$location')");
	if($query)
	{
           header('location:trailer.php');
	}
	else
	{
		echo "failed";
	}
}
?>