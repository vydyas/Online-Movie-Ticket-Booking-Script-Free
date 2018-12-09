<?php
session_start();

include('db/db.php');
include('frontend.php');
include("db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();
$frontend=new frontend();

$admin=new admin();

//loation
$array=$frontend->getlocation();
  $size=sizeof($array);
  $t_size=$size;
  $i=0;
  $t=0;

//slider
$array1=$frontend->slider();
  $size1=sizeof($array1);
   
  $s=0;
  $j=1;

  $today = date('D-d-M');
  $tomorrow = date('D-d-M', time()+86400);
  $dayAftT = date('D-d-M', time()+172800);

$cust_id = $_REQUEST['cust_id'];

$sql = "select * from customer_details where cust_id = '$cust_id' and payment_status='Y'" ;
$result = mysql_query($sql);
if(mysql_num_rows($result))
{
$row = mysql_fetch_array($result);
$cust_name = $row['name'];
$email = $row['email'];
$contact = $row['mobile'];

$sql1 = "select * from customer_booking where fk_cust_id = '$cust_id' ";
$result1 = mysql_query($sql1);

$seatname = '';
$totalcharges = '';
while($row1 = mysql_fetch_array($result1))
{
	$sname = $row1['seat_name'];
	$charges = $row1['charges'];
	$seatname .= $sname.' ';
	
	$totalcharges = $totalcharges + $charges;
	$show_id = $row1['fk_show_id'];
	$show_date = $row1['show_date'];
	$show_time = $row1['show_time'];
}

$sql2 = "select movies.name N1,location.location,theatres.name N2 from assign_show join movies on assign_show.fk_movie_id = movies.id join location on assign_show.fk_location_id = location.id join theatres on assign_show.fk_theater_id = theatres.id where assign_show.show_id ='$show_id'";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_array($result2);

$movie_name = $row2['N1'];
$location = $row2['location'];
$theatre_name = $row2['N2'];
}
else
{
	header('Location:404.php');
}
?>
<!DOCTYPE html>
    <head>
        <title>Cinemachoodu - Book Show</title>
        <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
		<link href="site1.css" rel="stylesheet"/>
    </head>
<body>
<div class="container">
<header>
	<?php
	if(isset($_SESSION['agent_id']))
	{
$agent_id=$_SESSION['agent_id'];
	}
	else
	{
	include_once('header.php');		
	}

	?>
</header>
<div class='content'>
	<br/>
<div class='content-wrapper'>
<br/>
<br/>
<center><h2>You Have Successfully Booked Tickets for <?php echo $movie_name;?>.</h2>
	</center>
<div class="ticket">
	<table cellpadding="10">
		<tr>
			<td style="border-right:solid 1px #999">
				Ticket Id:&nbsp;<b><?php echo "CHDU".$cust_id; ?></b><br/><br/>
				<?php echo $show_date." "."<b>".$show_time."</b>";?><br/><br/>
				<?php echo $theatre_name; ?> Theatre<br/>
				<?php echo $location; ?>

			</td>
			<td valign="top">
				Film Name: <b><?php echo $movie_name; ?></b><br/><br/>
				Seats: <b><?php echo $seatname; ?></b><br/><br/>
				Charges: <b><?php echo $totalcharges; ?></b>
			</td>

		</tr>
	</table>

</div><br/>
<center>Note: You should reach theatre with Print Out of Ticket (or) Message Sent By us .</center><br/>
	<center><input type='button' value='Print' onclick='printTicket()'/>&nbsp;&nbsp;
		<input type='button' value='return back' onclick='redirect()'/></center>
<br/>
<br/>
</div>

<?php
include ('footer.php');
?>
<script>
function printTicket(){
	window.print();
}
function redirect(){
	self.location='admin/booking.php';
}
</script>
</body>
</html>