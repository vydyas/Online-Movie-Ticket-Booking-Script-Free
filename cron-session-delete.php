<?php

session_start();

include('db/db.php');


//Database connection selection

$db=new db();

$db->db_connect();

$db->db_select();

$datetime=date('Y-m-d H:i:s');

$query=mysql_query("select cd.cust_id,cb.booking_dt from customer_details cd left join customer_booking cb on cb.fk_cust_id=cd.cust_id WHERE payment_status='N'");
if(mysql_num_rows($query))
{
	while($row=mysql_fetch_array($query))
	{
	$id=$row['cust_id'];
	$time=$row['booking_dt'];

	 $time1=strtotime($datetime);
	 $time2=strtotime($time);
	 $diff=round(abs($time1 - $time2) / 60,2);
	if($diff>10)
	{
	  mysql_query("DELETE customer_details,customer_booking FROM customer_details LEFT JOIN customer_booking on customer_details.cust_id=customer_booking.fk_cust_id WHERE customer_details.cust_id=$id ");	
	}
	

	}

}


?>