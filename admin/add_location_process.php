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

$query1=mysql_query("SELECT * FROM location WHERE location='$location' ");
if(mysql_num_rows($query1))
{
	echo "Already Location Existed";
}
else
{
	$query=mysql_query("INSERT INTO location VALUES('','$location')");

if($query)
{
    header('Location:location.php');
}
else
{
	echo "Insertion Failed";
}

}
?>