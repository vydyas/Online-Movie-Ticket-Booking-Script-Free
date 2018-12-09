<?php

session_start();

include('db/db.php');

include_once('phpToPDF.php');

date("h:i A")."<br/>";

//Database connection selection

$db=new db();

$db->db_connect();

$db->db_select();



$sql = "select * from assign_show";

$result = mysql_query($sql);

$html = '';

while($row = mysql_fetch_array($result))

{

	$flag1 = false;

	$flag2 = false;

	$flag3 = false;

	$flag4 = false;

	

	$morning = $row['morning'];

    $matney = $row['matney'];

    $firstshow = $row['firstshow'];

    $secondshow = $row['secondshow'];

	

	$show_id = $row['show_id'];

	$fk_movie_id = $row['fk_movie_id'];

	$fk_location_id = $row['fk_location_id'];

	$fk_theater_id = $row['fk_theater_id'];

	

	$sql2 = "select location from location where id='$fk_location_id'";

	$result2 = mysql_query($sql2);

	$row2 = mysql_fetch_array($result2);

	$location = $row2['location'];

	

	$sql2 = "select name from movies where id='$fk_movie_id'";

	$result2 = mysql_query($sql2);

	$row2 = mysql_fetch_array($result2);

	$movie_name = $row2['name'];

	

    $sql2 = "select * from theatres where id='$fk_theater_id' AND ( status='1' AND notifications='1')";

	$result2 = mysql_query($sql2);

	if(mysql_num_rows($result2)>0)
	{

	$row2 = mysql_fetch_array($result2);

	$theater_name = $row2['name'];

	$th_email = $row2['email'];

    $th_mobile=$row2['mobile'];


	$today = date('D j M,Y');

	$current_time = date("h:i A");



	/* check morning show */

    $movietime = $morning;
	$closetime = strtotime("-120 minutes", strtotime($movietime));
    $closetime = date('h:i A', $closetime);


	if($closetime == $current_time)

	{

		$flag1 = true;

		$sql1 = "select customer_details.cust_id,customer_details.name,customer_details.email,customer_details.mobile from customer_booking join customer_details on customer_booking.fk_cust_id = customer_details.cust_id where fk_show_id = '$show_id' and fk_movie_id = '$fk_movie_id' and show_date='$today' and show_time='$morning' group by fk_cust_id";

		
		$result1 = mysql_query($sql1);

		$cnt = mysql_num_rows($result1);

		if($cnt >0)

		{

			$html .="<div class='morning'>".$location." ".$theater_name." ".$movie_name." ".$today." ".$morning;

			$html .="<table border='1' cellpadding='5'>";

			$html .="<tr><td>Sr No</td><td>Name</td><td>E-mail</td><td>Mobile</td><td>Booking ID</td><td>Persons</td><td>Seats</td><td>Charges</td><td>Show Time</td><td>Show date</td></tr>";

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

					$mobile_message="Show Time:".$show_time." List: ";

				}

				$mobile_message1.=" CHDU".$cust_id." - ".$seats." ; ";

				$html .="<tr><td>".$j."</td><td>".$name."</td><td>".$email."</td><td>".$mobile."</td><td>CHDU".$cust_id."</td><td>".$i."</td><td>".$seats."</td><td>".$charges."</td><td>".$show_time."</td><td>".$show_date."</td></tr>";

				$j++;

			}

			$html .="<table></div>";



		}

		else{

			$mobile_message= " No Customer Booking for ".$movie_name." ,Show Time :".$morning." ";

			$html .="<div class='morning'>No customer Booking for ".$location." ".$theater_name." ".$movie_name." ".$today." ".$morning."</div>";

		}

	}	

	

	/* check matney show */

	$movietime = $matney;

	$closetime = strtotime("-120 minutes", strtotime($movietime));

   $closetime = date('h:i A',$closetime);
   $current_time;
	if($closetime == $current_time)

	{

		$flag2 = true;

		$sql1 = "select customer_details.cust_id,customer_details.name,customer_details.email,customer_details.mobile from customer_booking join customer_details on customer_booking.fk_cust_id = customer_details.cust_id where fk_show_id = '$show_id' and fk_movie_id = '$fk_movie_id' and show_date='$today' and show_time='$matney' group by fk_cust_id";

		

		$result1 = mysql_query($sql1);

		$cnt = mysql_num_rows($result1);

		if($cnt >0)

		{

			$html .="<div class='morning'>".$location." ".$theater_name." ".$movie_name." ".$today." ".$morning;

			$html .="<table border='1' cellpadding='5'>";

			$html .="<tr><td>Sr No</td><td>Name</td><td>E-mail</td><td>Mobile</td><td>Booking ID</td><td>Persons</td><td>Seats</td><td>Charges</td><td>Show Time</td><td>Show date</td></tr>";

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

					$mobile_message="Show Time:".$show_time." List: ";

				}

			$mobile_message1.=" CHDU".$cust_id." - ".$seats." ; ";

        	$html .="<tr><td>".$j."</td><td>".$name."</td><td>".$email."</td><td>".$mobile."</td><td>CHDU".$cust_id."</td><td>".$i."</td><td>".$seats."</td><td>".$charges."</td><td>".$show_time."</td><td>".$show_date."</td></tr>";

				$j++;

			}

			$html .="<table></div>";

		}

		else{

			$mobile_message= " No Customer Booking for ".$movie_name." ,Show Time :".$matney." ";

			$html .="<div class='morning'>No customer Booking for ".$location." ".$theater_name." ".$movie_name." ".$today." ".$matney."</div>";

		}

	}	

	

	/* check firstshow show */

	$movietime = $firstshow;

	$closetime = strtotime("-120 minutes", strtotime($movietime));

    $closetime = date('h:i A',$closetime);

	if($closetime == $current_time)

	{

		$flag3 = true;

		$sql1 = "select customer_details.cust_id,customer_details.name,customer_details.email,customer_details.mobile from customer_booking join customer_details on customer_booking.fk_cust_id = customer_details.cust_id where fk_show_id = '$show_id' and fk_movie_id = '$fk_movie_id' and show_date='$today' and show_time='$firstshow' group by fk_cust_id";

		

		$result1 = mysql_query($sql1);

		$cnt = mysql_num_rows($result1);

		if($cnt >0)

		{

			$html .="<div class='morning'>".$location." ".$theater_name." ".$movie_name." ".$today." ".$morning;

			$html .="<table border='1' cellpadding='5'>";

			$html .="<tr><td>Sr No</td><td>Name</td><td>E-mail</td><td>Mobile</td><td>Booking ID</td><td>Persons</td><td>Seats</td><td>Charges</td><td>Show Time</td><td>Show date</td></tr>";

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

					$mobile_message="Show Time:".$show_time." List: ";

				}

				$mobile_message1.=" CHDU".$cust_id." - ".$seats." ; ";

				$html .="<tr><td>".$j."</td><td>".$name."</td><td>".$email."</td><td>".$mobile."</td><td>CHDU".$cust_id."</td><td>".$i."</td><td>".$seats."</td><td>".$charges."</td><td>".$show_time."</td><td>".$show_date."</td></tr>";

				$j++;

			}

			$html .="<table></div>";

		}

		else{

			$mobile_message= " No Customer Booking for ".$movie_name." ,Show Time :".$firstshow." ";

			$html .="<div class='morning'>No customer Booking for ".$location." ".$theater_name." ".$movie_name." ".$today." ".$firstshow."</div>";

		}

	}

	

	/* check secondshow show */

    $movietime = $secondshow;

	$closetime = strtotime("-120 minutes", strtotime($movietime));

    $closetime = date('h:i A',$closetime);

    $current_time;

	if($closetime == $current_time)

	{

		$flag4 = true;

		$sql1 = "select customer_details.cust_id,customer_details.name,customer_details.email,customer_details.mobile from customer_booking join customer_details on customer_booking.fk_cust_id = customer_details.cust_id where fk_show_id = '$show_id' and fk_movie_id = '$fk_movie_id' and show_date='$today' and show_time='$secondshow' group by fk_cust_id";

		

		$result1 = mysql_query($sql1);

		$cnt = mysql_num_rows($result1);

		if($cnt >0)

		{

			$html .="<div class='morning'>".$location." ".$theater_name." ".$movie_name." ".$today." ".$morning;

			$html .="<table border='1' cellpadding='5'>";

			$html .="<tr><td>Sr No</td><td>Name</td><td>E-mail</td><td>Mobile</td><td>Booking ID</td><td>Persons</td><td>Seats</td><td>Charges</td><td>Show Time</td><td>Show date</td></tr>";

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

					$mobile_message="Show Time:".$show_time." List: ";

				}

				$mobile_message1.=" CHDU".$cust_id." - ".$seats." ; ";

				$html .="<tr><td>".$j."</td><td>".$name."</td><td>".$email."</td><td>".$mobile."</td><td>CHDU".$cust_id."</td><td>".$i."</td><td>".$seats."</td><td>".$charges."</td><td>".$show_time."</td><td>".$show_date."</td></tr>";

				$j++;

			}

			$html .="<table></div>";

		}

		else{

	 		$mobile_message= " No Customer Booking for ".$movie_name." ,Show Time :".$secondshow." ";

			$html .="<div class='morning'>No customer Booking for ".$location." ".$theater_name." ".$movie_name." ".$today." ".$secondshow."</div>";

		}

	}

	
	if($flag1 || $flag2 || $flag3 || $flag4)

	{

		phptopdf_html($html,'pdf/', 'pdf.pdf');

		header("Content-disposition: attachment; filename=pdf.pdf");

		header("Content-type: application/pdf");

		readfile("pdf/pdf.pdf");

		

		// Settings



		$to_admin = 'vydyas@gmail.com';

		$to_thadmin = $th_email;


		$from = 'aparnathule@gmail.com';

		$subject = "Customer Booking Details";

		$mainMessage = $html;

		$fileatt = "pdf/pdf.pdf";

		$fileatttype = "application/pdf";

		$fileattname = "booking_".$movie_name."_".$theater_name.".pdf";

		$headers = "From: $from";

		// File

		$file = fopen($fileatt, 'rb');

		$data = fread($file, filesize($fileatt));

		fclose($file);

		// This attaches the file

		$semi_rand = md5(time());

		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

		$headers .= "\nMIME-Version: 1.0\n" .

		"Content-Type: multipart/mixed;\n" .

		" boundary=\"{$mime_boundary}\"";

		$message = "This is a multi-part message in MIME format.\n\n" .

		"-{$mime_boundary}\n" .

		"Content-Type: text/plain; charset=\"iso-8859-1\n" .

		"Content-Transfer-Encoding: 7bit\n\n" .

		$mainMessage . "\n\n";

		$data = chunk_split(base64_encode($data));

		$message .= "--{$mime_boundary}\n" .

		"Content-Type: {$fileatttype};\n" .

		" name=\"{$fileattname}\"\n" .

		"Content-Disposition: attachment;\n" .

		" filename=\"{$fileattname}\"\n" .

		"Content-Transfer-Encoding: base64\n\n" .

		$data . "\n\n" .

		"-{$mime_boundary}-\n";

		// Send the email

     	mail($to_admin, $subject, $message, $headers);

		mail($to_thadmin, $subject, $message, $headers);


    $username = "dialdestiny";
    $password = "vizag@123";
    $sender = "DDSTNY";
    $domain = "login.smsmoon.com";
    $method = "POST";
    $mobile = $th_mobile;
    $username = urlencode($username);
    $password = urlencode($password);
    $sender = urlencode($sender);
    $message = urlencode($mobile_message.$mobile_message1);
    $parameters = "username=$username&password=$password&from=$sender&to=$mobile&msg=$message";
    $fp = fopen("http://$domain/API/sms.php?$parameters", "r");
    $response = stream_get_contents($fp);
    fpassthru($fp);
    fclose($fp); 

		

		unlink("pdf/pdf.pdf");

	}

}


}

?>