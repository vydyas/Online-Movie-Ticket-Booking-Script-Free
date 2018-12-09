<?php
session_start();
include_once('../chk_login.php');
?>
<?php
include('../../db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();


if($_POST)
{
	$theatre_name = $_POST['theatre_name'];
	$addr = $_POST['theatre_addr'];
	$theater_id = $_POST['theater_id'];
	$location_id = $_POST['th_location'];
	$status=$_POST['status'];
    $type=$_POST['type'];
    $notifications=$_POST['notifications'];

	$sql = "update theatres set name='$theatre_name',notifications='$notifications',address='$addr',fk_location_id='$location_id',status='$status',type='$type' where id='$theater_id'";
	if(!$result = mysql_query($sql))
	{
		die('SQL ERROR : '.mysql_error());
	}
	else
	{
		echo"<script>alert('Theatre updated successfully')</script>";
		echo"<script>self.location='../theatre.php'</script>";
	}
}

?>

