<?php
session_start();
include('db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$seat_id_array = $_POST['seatid'];
$charges_array = $_POST['charges'];
$seatname = $_POST['seatname'];
$location_id = $_POST['location_id'];
$movie_id = $_POST['movie_id'];
$theater_id = $_POST['theater_id'];
$movie_time = $_POST['movie_time'];
$movie_date = $_POST['movie_date'];
$name = $_POST['fname'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$sql = "select * from assign_show where fk_movie_id = '$movie_id' and fk_location_id = '$location_id' and fk_theater_id = '$theater_id'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$show_id = $row['show_id'];


?>

<script src="jquery-1.8.0.min.js"></script>
<div class='confirm' style='visibility:hidden;'>
	<form method='post' action='process/bookticket.php' name='confirmform' id='confirmform'>
	<table>
		<tr><td>Enter your name</td><td><input type='text' name='fname' id='fname' value='<?php echo $name?>'/></td></tr>
		<tr><td>Contact Number</td><td><input type='text' name='mobile' id='mobile' value='<?php echo $contact?>' /></td></tr>
		<tr><td>E-mail Id</td><td><input type='text' name='email' id='email' value='<?php echo $email ?>' /></td></tr>
		<tr><td colspan='2'><input type='button' name='btn' id='btn' value='Confirm Booking' /></td></tr>
	</table>
	<?php
	$stCnt = count($seat_id_array);
	$amount=0;
	for($i=0; $i<$stCnt; $i++)
	{
	    $amount=$amount+$charges_array[$i];
		echo"<input type='hidden' name='tdid[]' value='".$seat_id_array[$i]."'>";
		echo"<input type='hidden' name='scharges[]' value='".$charges_array[$i]."'>";
		echo"<input type='hidden' name='sname[]' value='".$seatname[$i]."'>";
	}
	?>
	<input type='hidden' name='location_id' value='<?php echo $location_id ?>' />
	<input type='hidden' name='movie_id' value='<?php echo $movie_id ?>' />
	<input type='hidden' name='theater_id' value='<?php echo $theater_id ?>' />
	<input type='hidden' name='theater_id' value='<?php echo $theater_id ?>' />
	<input type='hidden' name='movie_time' value='<?php echo $movie_time ?>' />
	<input type='hidden' name='movie_date' value='<?php echo $movie_date ?>' />
	<input type='hidden' name='show_id' value='<?php echo $show_id ?>' />
	</form>
</div>
<?php
if(isset($_SESSION['agent_id']))
{
	$agent_id=$_SESSION['agent_id'];
	$amount_query="SELECT amount FROM `agent-recharge` WHERE fk_agent_id='$agent_id'";
	$result=mysql_query($amount_query);
	$row=mysql_fetch_array($result);

	$agentamount=$row['amount'];
	if($agentamount>=$amount)
	{
            echo "<script>
$(document).ready(function(){
	$('#confirmform').submit();
});
</script>";
	}
	else
	{   
		$date=base64_encode($movie_date);
            echo "<script>
            alert('Please Recharge to Book Tickets');
self.location='admin/get_seats.php?id=$show_id&mdate=$date&time=$movie_time&fk_theater_id=$theater_id'
</script>";
	}
}
else
{
	 echo "<script>
$(document).ready(function(){
	$('#confirmform').submit();
});
</script>";

}
?>

