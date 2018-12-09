<?php
session_start();

include('db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

if($_POST['txnid'])
{
	//print_r($_POST);

	$Amounts= floor($_POST['amount']);
    $Order_Id= $_POST['txnid'];
	// $Merchant_Param= $_REQUEST['Merchant_Param'];
	 $Checksum= $_REQUEST['Checksum'];

    //echo "SELECT cust_id from customer_details WHERE transid=$Order_Id";
     $oidquery=mysql_query("SELECT cd.cust_id,cd.amount,cd.name,cd.email,cd.mobile,cb.* from customer_details cd LEFT JOIN customer_booking cb on cb.fk_cust_id=cd.cust_id 
     	WHERE transid=$Order_Id");
     $count=0;
	 while($oidrow=mysql_fetch_array($oidquery))
	 {
	 $count++;
	 $oid=$oidrow['cust_id'];
	 $name=$oidrow['name'];
	 $email=$oidrow['email'];
	 $cust_mobile=$oidrow['mobile'];
	 $amount=$oidrow['amount'];
	 $movie_id=$oidrow['fk_movie_id'];
	 $date=$oidrow['show_date'];
	 $showtime=$oidrow['show_time'];
	 $seats.=$oidrow['seat_name'].",";

	 }
	

    /* get movie name */
	$sql = "select * from assign_show where fk_movie_id = '$movie_id'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$location_id = $row['fk_location_id'];
	$theater_id = $row['fk_theater_id'];

	/* get movie name */
	$sql = "select name from movies where id = '$movie_id'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$movie_name = $row['name'];

	/* get location name */
	$sql = "select location from location where id = '$location_id'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$location_name = $row['location'];

	/* get theater name */
	$sql = "select name from theatres where id = '$theater_id'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$theater_name = $row['name'];


    $details = "";

	$details .= "Name : ".$name."<br/>E-mail Id : ".$email."<br/>Contact Number : ".$cust_mobile."<br/>Booking Number : CHDU".$oid;

	$details .= "<br/><br/>Movie Name : ".$movie_name."<br/>Location : ".$location_name."<br/>Theatre name : ".$theater_name."<br/>";

	$details .= "Date : ".$movie_date." Time : ".$movie_time."<br/><br/>";

	$details .= "<table border='1' width='300px' style='border-collapse:collapse;' cellpadding='5'><tr><td>Seat Name</td><td>Charges(Rs)</td></tr>";

	$cnt = $count;

	$total = 0;

	$eachcost=$amount/$cnt;

    $seatss=explode(",", $seats);

	for($i=0; $i<$cnt; $i++)
	{
		$details .= "<tr><td>".$seatss[$i]."</td><td>".$eachcost."</td></tr>";
	}

	$details .= "<tr><td>Total</td><td>".$amount."</td></tr>";
	$details .= "</table>";



	 if($_POST['status']=="success")
	{
            $booking_dt = date('Y-m-d h:i:s');

            if($amount==$Amounts)
            {
           $update_query="UPDATE `customer_details` SET `pay_amount`='$Amounts',`payment_status` = 'Y',`payment date`='$booking_dt' WHERE `transid`=$Order_Id";
            mysql_query($update_query);
            
               if($update_query)
               {
               	$adminmail = "You have one new booking<br/><br/>";
	$admin_email = 'vydyas@gmail.com';
	$admin_sub = 'Cinemachoodu New Booking';

	$customermail = "Your Ticket booking details are as follows : <br/><br/>";
	$customer_email = $email;
	$customer_sub = "Cinemachoodu Ticket Details";

	/* email to admin code here 

	$subject = $admin_sub;
	$to = $admin_email;
	$from = $admin_email;
	$message = $adminmail.$details;

	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	mail($to, $subject, $message, $headers);*/

	$customer_message="Name: ".$name." Email: " .$email." Booking Number: CHDU".$oid." Movie Name : ".$movie_name." Location: ".$location_name." Theatre Name: ".$theater_name." Date :".$movie_date." Time : ".$movie_time." Seats :".$seats." Note: You should bring print out of ticket or Message send by us.";
	 


	 	 /* email to customer code here 

	$subject = $customer_sub;
	$to = $customer_email;
	$from = $admin_email;
	$message = $customermail.$details;

	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	mail($to, $subject, $message, $headers);*/


	/* Message to Customer Code Here*/
    $username = "dialdestiny";
    $password = "vizag@123";
    $sender = "DDSTNY";
    $domain = "login.smsmoon.com";
    $method = "POST";
    $mobile = $cust_mobile;
    $username = urlencode($username);
    $password = urlencode($password);
    $sender = urlencode($sender);
    $message = urlencode($customer_message);
    $parameters = "username=$username&password=$password&from=$sender&to=$mobile&msg=$message";
    $fp = fopen("http://$domain/API/sms.php?$parameters", "r");
    $response = stream_get_contents($fp);
    fpassthru($fp);
    fclose($fp); 

               	echo"<script>self.location='print-ticket.php?cust_id=$oid'</script>";
               }
	            
            }
	}
}



?>