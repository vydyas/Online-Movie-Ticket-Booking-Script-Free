<?php
session_start();

include('../db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$name = $_POST['fname'];
$name1 = trim($name);
$name1 = addslashes($name1);
$name1 = htmlspecialchars($name1);

$email = $_POST['email'];
if($email!='')
{
$email1 = trim($email);
$email1 = addslashes($email1);
$email1 = htmlspecialchars($email1);
}
else
{
	$email1="vydyas@gmail.com";
}
if(isset($_SESSION['id']))
{
	$type=1;
}
else if(isset($_SESSION['agent_id']))
{
	$type="agent".$_SESSION['agent_id'];
}
else if(isset($_SESSION['tagent_id']))
{
	$type="tagent".$_SESSION['agent_id'];
}
else
{
	$type=0;
}

$cust_mobile = $_POST['mobile'];
$tdArray = $_POST['tdid'];
$chargesArray = $_POST['scharges'];
$seatnmArray = $_POST['sname'];
$location_id = $_POST['location_id'];
$movie_id = $_POST['movie_id'];
$theater_id = $_POST['theater_id'];
$show_id = $_POST['show_id'];
$movie_time = $_POST['movie_time'];
$movie_date = $_POST['movie_date'];

$booking_dt = date('Y-m-d H:i:s');

$encode_date = base64_encode($movie_date);
$seatInArray = '';
$seatidinArray = '';

$j = count($seatnmArray) - 1;
/* get seats inarray */
for($i=0; $i<count($seatnmArray); $i++){
	$seatInArray .= "'".$seatnmArray[$i]."'";
	if($i < $j)
	{
		$seatInArray .= ",";
	}
}
for($i=0; $i<count($tdArray); $i++){
	$seatidinArray .= "'".$tdArray[$i]."'";
	if($i < $j)
	{
		$seatidinArray .= ",";
	}
}

/* adding data into database */

$forloop = count($tdArray);

/* check seats booking */
$sql3 = "select * from customer_booking where seat_name in ($seatInArray) and show_date='$movie_date' and show_time='$movie_time' and fk_show_id='$show_id' and fk_movie_id='$movie_id' and seat_id in ($seatidinArray)";
$result3 = mysql_query($sql3);
$cnt3 = mysql_num_rows($result3);



if($cnt3 > 0)
{
	echo"<script>alert('Sorry, Try After Some Time')</script>";
	echo"<script>self.location='../showbookings.php?id='$show_id'&time='$movie_time'&mdate='$encode_date'</script>";
}
else
{
    $check_query="SELECT c.* FROM customer_details c LEFT JOIN customer_booking cb on c.cust_id=cb.fk_cust_id WHERE (c.email='$email' OR c.mobile='$cust_mobile') AND cb.show_date='$movie_date'";
	$check_query=mysql_query($check_query);
 	$check_query_rows=mysql_num_rows($check_query);

if($check_query_rows<=0)
{
	$transid=date("ymdHis").rand(100,999);
	$sql = "insert into customer_details (name,mobile,email,type,payment_status,transid) values ('$name1','$cust_mobile','$email1','$type','N','$transid')";
	$result = mysql_query($sql);
	$cust_id = mysql_insert_id();
    $amount=0;

	for($j=0; $j<$forloop; $j++)
	{
		$seat_id = $tdArray[$j];
		$seat_name = $seatnmArray[$j];
		$charges = $chargesArray[$j];
		$amount=$amount+$charges;
		
		$sql1 = "insert into customer_booking (fk_show_id,seat_id,seat_name,charges,show_date,show_time,booking_dt,fk_cust_id,fk_movie_id) values('$show_id','$seat_id','$seat_name','$charges','$movie_date','$movie_time','$booking_dt','$cust_id','$movie_id')";
		if(!$result1 = mysql_query($sql1))
		{
			die('SQL ERROR : '.mysql_error());
		}
		else
		{
			$booking_id = mysql_insert_id();
		}
	}


	mysql_query("UPDATE customer_details SET amount='$amount' where cust_id=$cust_id");

      
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

	$details .= "Name : ".$name."<br/>E-mail Id : ".$email."<br/>Contact Number : ".$cust_mobile."<br/>";

	$details .= "<br/><br/>Movie Name : ".$movie_name."<br/>Location : ".$location_name."<br/>Theatre name : ".$theater_name."<br/>";

	$details .= "Date : ".$movie_date." Time : ".$movie_time."<br/><br/>";

	$details .= "<table border='1' width='300px' style='border-collapse:collapse;' cellpadding='5'><tr><td>Seat Name</td><td>Charges(Rs)</td></tr>";

	$cnt = count($seatnmArray);

	$total = 0;

	for($i=0; $i<$cnt; $i++)
	{
		$seats.=$seatnmArray[$i]." ";
		$details .= "<tr><td>".$seatnmArray[$i]."</td><td>".$chargesArray[$i]."</td></tr>";
		$total = $total + $chargesArray[$i];
	}

	$details .= "<tr><td>Total</td><td>".$total."</td></tr>";
	$details .= "</table>";

	$adminmail = "You have one new booking<br/><br/>";
	$admin_email = 'vydyas@gmail.com';
	$admin_sub = 'Cinemachoodu New Booking';

	$customermail = "Your Ticket booking details are as follows : <br/><br/>";
	$customer_email = $email;
	$customer_sub = "Cinemachoodu Ticket Details";
	
if(isset($_SESSION['agent_id']))
{
      $tid=base64_encode($transid);
   echo "<script>self.location='../agent-booking.php?tid=$tid'</script>";
}
else
{
	$reg_date=date('d-m-Y');
          $paymentParts[]=array('name'=>'Cinemachoodu',
                            'description'=>'Cinemachoodu Registration',
                            'value'=>'1',
                             'isRequired'=>true,
                             'settlementEvent'=>'EmailConfirmation'
                               );
           $paymentIdentifiers=array(
               array('field'=>'CompletionDate',
               'value'=>$reg_date ),
               array('field'=>'TxnId',
               'value'=>$row['transaction_id'])
           );
       $amount=$amount;
       $transaction_id=$transid;
       $Productinfo=array($paymentParts,$paymentIdentifiers);
       $products= $Productinfo;
       $first_name3="Siddhu";
       $last_name3="Vydyabhushana";
       $email="vydyas@gmail.com";
       $mobile="9581594325";
       $address="Vizag";
       /*
       $surl='http://cinemachoodu.com/redirecturl.php';
       $furl='http://cinemachoodu.com/redirecturl.php';
       $curl='http://cinemachoodu.com/redirecturl.php';*/

       $surl='http://localhost/moviesearch/redirecturl.php';
       $furl='http://localhost/moviesearch/redirecturl.php';
       $curl='http://localhost/moviesearch/redirecturl.php';

      $content.='

          <form action="../PayUMoney_form.php" method="post" name="payment_values">
           <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
           <input type="hidden" name="txnid" value="'.$transaction_id.'">
           <input type="hidden" name="amount" value="'.$amount.'">  
           <input type="hidden" name="productinfo" value='.$products.'>
               <input type="hidden" name="address1" value="'.$address.'">
               <input type="hidden" name="firstname" value="'.$first_name3.'">
                       <input type="hidden" name="email" value="'.$email.'">
                           <input type="hidden" name="phone" value="'.$mobile.'">
                               <input type="hidden" name="udf1" value="'.$_REQUEST['id'].'">
                               <input type="hidden" name="surl" value="'.$surl.'">
                                   <input type="hidden" name="furl" value="'.$furl.'">
                                       <input type="hidden" name="curl" value="'.$curl.'">
                                                           <INPUT TYPE="submit" value="Click Here To Pay">
       </form>';

?>
<center>
	<h1>Pay Money Within 10 Minutes Otherwise Session Will Be Expired</h1><br/><br/>
<div class="payment_form">

<?php echo $details; ?>	<br/>
<?php echo $content; ?>

</div>
</center>
<?php
}
	
}
else
{
	echo"<script>alert('Sorry,Tickets Already Booked By You ')</script>";
	echo"<script>self.location='../index.php'</script>";

}
}
?>
