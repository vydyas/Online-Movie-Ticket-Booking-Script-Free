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

if($_GET['id'])
{
	$id=$_GET['id'];
	$sql = "delete from agent where id='$id'";
	mysql_query( $sql);
}
?>