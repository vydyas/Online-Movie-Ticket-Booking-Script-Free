<?php
session_start();

include('../db/db.php');
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$clocation = $_REQUEST['clocation'];
$ctheatre = $_REQUEST['ctheatre'];
$cmovie = $_REQUEST['cmovie'];
$ctime = $_REQUEST['ctime'];
$bkdate = $_REQUEST['cdate'];
if(isset($_SESSION['agent_id']))
{
	$agent_id="agent".$_SESSION['agent_id'];
}
$sql = "select * from assign_show where fk_location_id = '$clocation' and fk_theater_id = '$ctheatre'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$show_id = $row['show_id'];

if($ctime == '' )
{
	$sql1 = "select customer_details.cust_id,customer_details.name,customer_details.email,customer_details.mobile from customer_booking join customer_details on customer_booking.fk_cust_id = customer_details.cust_id where fk_show_id = '$show_id' and fk_movie_id = '$cmovie' and show_date='$bkdate' ";
	if(isset($_SESSION['agent_id']) && $_SESSION['agent_id']!='')
	{
		$sql1.=" and customer_details.type='$agent_id' ";

	}

	$sql1.="group by fk_cust_id";


}
else
{
	$sql1 = "select customer_details.cust_id,customer_details.name,customer_details.email,customer_details.mobile from customer_booking join customer_details on customer_booking.fk_cust_id = customer_details.cust_id where fk_show_id = '$show_id' and fk_movie_id = '$cmovie' and show_date='$bkdate' and show_time='$ctime' ";
	if(isset($_SESSION['agent_id']) && $_SESSION['agent_id']!='')
	{
		$sql1.=" and customer_details.type='$agent_id' ";

	}

	$sql1.="group by fk_cust_id";
}


$result1 = mysql_query($sql1);
$cnt = mysql_num_rows($result1);
if($cnt >0)
{
	echo"<table border='1' cellpadding='5'>";
	echo"<tr><td>Sr No</td><td>Name</td><td>E-mail</td><td>Mobile</td><td>Booking ID</td><td>Persons</td><td>Seats</td><td>Charges</td><td>Show Time</td><td>Show date</td></tr>";
	$j = 1;
	while($row1 = mysql_fetch_array($result1))
	{
		$charges = '';
		$seats = '';
		$i = 0;
		$name = $row1['name'];
		$email = $row1['email'];
		$mobile = $row1['mobile'];
		$cust_id = $row1['cust_id'];
		$sql2 = "select * from customer_booking where fk_cust_id = '$cust_id'";
		$result2 = mysql_query($sql2);
		while($row2 = mysql_fetch_array($result2))
		{
			$seats .= $row2['seat_name']." ";
			$charges = $charges + $row2['charges'];
			$show_date = $row2['show_date'];
			$show_time = $row2['show_time'];
			$i++;
		}
		echo"<tr><td>".$j."</td><td>".$name."</td><td>".$email."</td><td>".$mobile."</td><td>CHDU".$cust_id."</td><td>".$i."</td><td>".$seats."</td><td>".$charges."</td><td>".$show_time."</td><td>".$show_date."</td></tr>";
		$j++;
	}
	echo"<table>";
}
else
{
	echo '0';
}
?>