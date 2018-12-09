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
$location=$_POST['location'];
$id=$_POST['id'];

$query=mysql_query("UPDATE location SET location='$location' WHERE id='$id' ");

if($query)
{
    header('Location:location.php');
}
else
{
	echo "Updation Failed";
}
?>