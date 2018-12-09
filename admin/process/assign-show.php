<?php
session_start();
include_once('../chk_login.php');
include('../../db/db.php');
include("../../db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

if($_SESSION)
{
	$location_id = $_POST['th_location'];
	$theater_id = $_POST['th2'];
	$morning = $_POST['morning'];
	$matney = $_POST['matney'];
	$firstshow = $_POST['firstshow'];
	$secondshow = $_POST['secondshow'];
	$date=$_POST['datepicker'];

	if($date=='')
	{
	$today = date('Y-m-d');
	}
	else
	{
	$today = $date;
	}

	$sql1 = "select * from assign_show where fk_location_id = '$location_id' and fk_theater_id ='$theater_id'";
	$result1 = mysql_query($sql1);
	$rescnt = mysql_num_rows($result1);
	if($rescnt <= 0)
	{
		$sql = "insert into assign_show (fk_location_id,fk_theater_id,morning,matney,firstshow,secondshow,addshowdate) values('$location_id','$theater_id','$morning','$matney','$firstshow','$secondshow','$today')";
		if(!$result = mysql_query($sql))
		{
			die('SQL ERROR : '.mysql_error());
		}
		else
		{
			$insertId = mysql_insert_id();
			echo"<script>alert('Show assigned to theatre successfully');</script>";
			echo"<script>self.location='../assign-charges.php?theater_id=$theater_id&show_id=$insertId'</script>";
		}
	}
	else
	{
		$sql = "update assign_show set morning = '$morning',matney = '$matney',firstshow = '$firstshow',secondshow = '$secondshow',addshowdate = '$today' where fk_location_id = '$location_id' and fk_theater_id='$theater_id'";
		if(!$result = mysql_query($sql))
		{
			die('SQL ERROR : '.mysql_error());
		}
		else
		{
			$sql = "select show_id from assign_show where fk_location_id = '$location_id' and fk_theater_id='$theater_id'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$show_id = $row['show_id'];
			echo"<script>alert('Show assigned to theatre successfully');</script>";
			echo"<script>self.location='../assign-charges.php?theater_id=$theater_id&show_id=$show_id'</script>";
		}
	}
}