<?php
session_start();
include_once('chk_login.php');

include('../../db/db.php');
include("../../db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

if($_SESSION)
{
    $showid = $_POST['showid'];
	$tdIdArray = $_POST['tdid'];
	$charges = $_POST['charges'];
	$movie_id = $_POST['movie_id'];
	$tcnt = count($tdIdArray);
	
	$bk_date = date('Y-m-d h:i:s');
	
	$sql = "update assign_show set fk_movie_id='$movie_id' where show_id = '$showid'";
	$result = mysql_query($sql);
	
	$sql1 = "delete from admin_booking where fk_show_id='$showid'";
	$result1 = mysql_query($sql1);
	
	for($i=0; $i<$tcnt; $i++)
	{
		$seatid = $tdIdArray[$i];
		$seatcharges = $charges[$i];
		$sql = "insert into admin_booking(fk_show_id,seat_id,booking_dt) values ('$showid','$seatid','$bk_date')";
		$result = mysql_query($sql);
		echo"<script>alert('Booking done successfully')</script>";
		echo"<script>self.location='../add-booking.php'</script>";
	}
}