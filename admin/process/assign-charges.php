<?php
session_start();
error_reporting(0);
include('../../db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

if($_SESSION && $_POST)
{

  $show_id = $_POST['show_id'];
   $theater_id = $_POST['theater_id'];
	$seatNameArray = $_POST['getseatname']; 
	$seatIdArray = $_POST['getseatid'];
	$forLoop = count($seatIdArray);


	for($i=0; $i<$forLoop; $i++)
	{
		$tdidArr = array();
		$tdidArr = explode('.',$seatIdArray[$i]);
		$tdid = $seatIdArray[$i];
		$seatname = $seatNameArray[$i];
		$chargeName = 'charges'.$tdidArr[0];
		$charges = $_POST[$chargeName];
		
		$sql = "insert into charges(fk_show_id,td_id,seat_name,charges) values ('$show_id','$tdid','$seatname','$charges')";
		$result = mysql_query($sql);

	}
		echo"<script>alert('Charges saved successfully');</script>";
		echo"<script>self.location='../add-booking.php'</script>";
}