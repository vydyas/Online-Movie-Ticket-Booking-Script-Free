<?php
include('db/db.php');
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$mobile = $_POST['mobile'];
$bookid = $_POST['bookid'];

$getid = substr($bookid,4);
$chuduid = 'CHDU'.$getid;

if($bookid == $chuduid)
{
	$sql = "select * from customer_details where cust_id = '$getid' and mobile='$mobile'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$numcnt = mysql_num_rows($result);
	if($numcnt == 0)
	{
		echo"<script>alert('Invalid Details')</script>";
		echo"<script>self.location='index.php'</script>";
	}
	$cust_name = $row['name'];
	$email = $row['email'];
	$contact = $row['mobile'];
	

	$sql1 = "select * from customer_booking where fk_cust_id = '$getid'";
	$result1 = mysql_query($sql1);
	$numcnt1 = mysql_num_rows($result1);
	if($numcnt1 == 0)
	{
		echo"<script>alert('Invalid Details')</script>";
		echo"<script>self.location='index.php'</script>";
	}
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
?>
<!DOCTYPE html>
    <head>
        <title>Cinemachoodu - Book Show</title>
        <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
		<link href="site1.css" rel="stylesheet"/>
		<link href="select2.css" rel="stylesheet"/>
		<script src="jquery-1.8.0.min.js"></script>   
		<script src="select2.js"></script>
		<script src="form.js"></script>
		<script src="jquery.lightbox_me.js"></script>
    </head>
<body>
<div class="container">
	<?php
	include_once('header.php');
	?>
<div class='content'>
<div class='content-wrapper'>
<br/><br/>
<div class="ticket">
	<table cellpadding="10">
		<tr>
			<td style="border-right:solid 1px #999">
				Ticket Number:&nbsp;<b><?php echo "CHDU".$getid; ?></b><br/><br/>
				<?php echo $show_date." ".$show_time; ?><br/><br/>
				<?php echo $theatre_name; ?> Theatre<br/>
				<?php echo $location; ?>

			</td>
			<td valign="top">
				Film: <b><?php echo $movie_name; ?></b><br/><br/>
				Seats: <b><?php echo $seatname; ?></b>
			</td>

		</tr>
	</table>
</div><br/>
<center>Note: You should reach theatre before 30 min to get your tickets.</center><br/>
	<center><input type='button' value='Print' onclick='printTicket()'/></center>
<br/>
<br/>
<script>
function printTicket(){
	window.print();
}
</script>
<?php
}
else
{
	echo"<script>alert('Invalid Details')</script>";
	echo"<script>self.location='index.php'</script>";
}
?>