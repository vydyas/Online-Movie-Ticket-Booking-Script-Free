<?php
session_start();
include('../../db/db.php');
include("../../db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

if($_SESSION)
{
	/*..................get session variavle ....................*/
    $theater_id = $_POST['theater_id'];
	echo $action = $_POST['action'];
	$bookdt = date('Y-m-d h:i:s');
	
	/*........................check for existence of booking id......................*/
	$sql = "select * from seats where fk_theater_id = '$theater_id'";
	$result = mysql_query($sql);
	$cnt = mysql_num_rows($result);
	
	$tdId = $_POST['tdId'];
		//$charges = $_POST['charges'];
	$seatName = $_POST['seatName'];
	$dataCnt = count($tdId);// to get the total number of seats
		
	if($action == 'edit')
	{
		$sql = "delete from seats where fk_theater_id = '$theater_id'";
		$result = mysql_query($sql);
	}
			
	for($i=0; $i<$dataCnt; $i++)
	{
		$td_id = $tdId[$i];
		//$seat_charges = $charges[$i];
		$seat_name = $seatName[$i];
			
		$sql1 = "insert into seats(seat_name,td_id,fk_theater_id) values ('$seat_name','$td_id','$theater_id')";
		if(!$result1 = mysql_query($sql1))
		{
				die('SQL1 ERROR : '.mysql_error());
		}
	}
	if($action == 'edit')
	{
		echo"<script>alert('Seat arrangement updated successfully');</script>";
		echo"<script>self.location='../theatre.php'</script>";
	}
	else
	{
		echo"<script>alert('Seat arrangement saved successfully');</script>";
		echo"<script>self.location='../theatre.php'</script>";
	}	
}