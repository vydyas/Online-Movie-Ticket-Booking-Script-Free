<?php
session_start();
include_once('chk_login.php');
?>
<?php
include("../db/db.php");
include("../db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

if($_POST)
{
	$name=$_POST['name'];
	$addr=$_POST['addr'];
	$id=$_POST['id'];

	mysql_query("INSERT INTO theaters VALUES('','$name','$addr','$id')");
}
?>
