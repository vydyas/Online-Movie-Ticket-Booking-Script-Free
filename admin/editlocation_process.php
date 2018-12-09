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


if($_REQUEST && $_POST)
{

$theatre_name=$_POST['theatre_name'];
$addr=$_POST['theatre_addr'];
$location=$_POST['location'];
$status=$_POST['status'];
$type=$_POST['type'];
$id=$_REQUEST['id'];


echo "UPDATE theatres SET name='$theatre_name',address='$addr',fk_location_id='$location',status='$status',type='$type' WHERE id='$id' "

$query=mysql_query("UPDATE theatres SET name='$theatre_name',address='$addr',fk_location_id='$location',status='$status',type='$type' WHERE id='$id' ");

if($query)
{

	header('location:theatre.php');
}
else
echo "failed";
}
?>