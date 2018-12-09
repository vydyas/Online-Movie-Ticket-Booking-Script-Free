<?php
session_start();
include_once('chk_login.php');

include('../db/db.php');
include("../db/admin.php");


//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();
include_once('chk_login.php');
$admin=new admin();

	$str = $_REQUEST['q'];
	$str = strtolower($str);
	$getid = $_REQUEST['getid'];
	
	if($getid == 'movie')
	{
		$sql = "select * from movies where LOWER(name) LIKE '%$str%'";
		$result = mysql_query($sql);
		$cnt = mysql_num_rows($result);
		if($cnt > 0)
		{
			echo"<ul>";
			while($row = mysql_fetch_array($result))
			{
				$name = $row['name'];
				$mid = $row['id'];
				echo"<li id='$mid' onclick='addData($mid,\"$getid\")'>".$name."</li>";
			}
			echo"</ul>";
		}
	}
	else if($getid == 'tlocation')
	{
		$sql = "select * from location where LOWER(location) LIKE '%$str%'";
		$result = mysql_query($sql);
		$cnt = mysql_num_rows($result);
		if($cnt > 0)
		{
			echo"<ul>";
			while($row = mysql_fetch_array($result))
			{
				$tlocation = $row['location'];
				$mid = $row['id'];
				echo"<li id='$mid' onclick='addData($mid,\"$getid\")'>".$tlocation."</li>";
			}
			echo"</ul>";
		}
	}
	else if($getid == 'th1')
	{
		$sql = "select * from theatres where LOWER(name) LIKE '%$str%'";
		$result = mysql_query($sql);
		$cnt = mysql_num_rows($result);
		if($cnt > 0)
		{
			echo"<ul>";
			while($row = mysql_fetch_array($result))
			{
				$name = $row['name'];
				$mid = $row['id'];
				echo"<li id='$mid' onclick='addData($mid,\"$getid\")'>".$name."</li>";
			}
			echo"</ul>";
		}
	}

?>