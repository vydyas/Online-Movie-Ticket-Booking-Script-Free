<?php
session_start();
include_once('chk_login.php');

include('../db/db.php');
include("../db/admin.php");
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$theater_id = $_REQUEST['id'];
$movie_time = $_REQUEST['time'];

$movie_id = $_SESSION['movie_id'];
$location_id = $_SESSION['location_id'];
$movie_date = $_SESSION['movie_date'];

$_SESSION['theater_id'] = $theater_id;
$_SESSION['movie_time'] = $movie_time;

?>

<script src="jquery-1.8.0.min.js"></script>
<link href="style.css" rel="stylesheet"/>
<div class="seat-arrangement">
<?php
echo $sql = "select * from booking where fk_movie_id = '$movie_id' and fk_theater_id = '$theater_id' and fk_location_id = '$location_id'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
if(count($row) > 0)
{
	$booking_id = $row['booking_id'];
	$sql1 = "select distinct seat_name from seats where fk_booking_id='$booking_id'";
	$result1 = mysql_query($sql1);
	echo"<table border='1' cellpadding='10' style='border-collapse:collapse;'>";
	while($row1 = mysql_fetch_array($result1))
	{
		$stname = $row1['seat_name'];
		$sql = "select * from seats where fk_booking_id = '$booking_id' and seat_name='$stname'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		echo"<tr>";
		for($i = 0; $i<$count; $i++)
		{
			$row = mysql_fetch_array($result);
			$seat_id = $row['seat_id'];
			$seatname = $row['seat_name'];
			$seat_num = $row['seat_num'];
			$charges = $row['seat_charges'];
			/* ..... code to check availability of seat ...*/
			$sql2 = "select * from customer_booking where fk_seat_id = '$seat_id' and movie_date='$movie_date' and movie_time = '$movie_time'";
			$result2 = mysql_query($sql2);
			$st_cnt = mysql_num_rows($result2);
			/* ..... end of code to check availability of seat ...*/
			if($st_cnt == 0)
			{
				echo"<td class='seat'>".$seatname.$seat_num."<br/><img src='images/available.png' class='a' id='$seat_id' /></td><input type='hidden' id='charges".$seat_id."' value='$charges'>";
			}
			else
			{
				echo"<td class='seat'>".$seatname.$seat_num."<br><img src='images/unavailable.png' class='u' id='$seat_id'/></td>";
			}
		}
		echo"</tr>";
	}
	echo"</table>";
	echo"<input type='button' id='book_seat' value='Book Movie' />";
	echo"<input type='text' name='totalcharges' id='totalcharges' value='0' readonly />";
	echo"<div id='result'></div>";
}
else
{
	echo "sorry no setas available";
}
?>
</div>
<script>
$(document).ready(function(){
	var tcharges = 0;
	$('.seat img').click(function(){
		chk_status = $(this).attr('class');
		if(chk_status == 'a')
		{
			img_src = $(this).attr('src');
			if(img_src == 'images/available.png')
			{
				$(this).attr('src','images/selected.png');
				img_id = $(this).attr('id');
				charge_id = 'charges'+img_id;
				charges = $('#'+charge_id).val();
				tcharges = parseInt(tcharges) + parseInt(charges);
				
			}
			else
			{
				$(this).attr('src','images/available.png');
				img_id = $(this).attr('id');
				charge_id = 'charges'+img_id;
				charges = $('#'+charge_id).val();
				tcharges = tcharges - charges;
			}
			$('#totalcharges').val(tcharges);
		}
	});
});
</script>
<script>
$(document).ready(function(){
	$('#book_seat').click(function(){
		var get_imgs = $('.seat img').length;
		flag = false;
		myform = "<form method='post' action='process/bookticket.php' name='bookform' id='bookform'>";
		for(i = 0; i<get_imgs; i++)
		{
			if($('.seat img').eq(i).attr('src') == 'images/selected.png')
			{
				flag = true;
				seat_id = $('.seat img').eq(i).attr('id');
				chargeid = "charges"+seat_id;
				charges = $("#"+chargeid).val();
				myform = myform + "<input type='text' name='seatid[]' value='"+seat_id+"'>";
				myform = myform + "<input type='text' name='charges[]' value='"+charges+"'>";
			}
		}
		myform = myform + "</form>";
		if(flag)
		{
			document.getElementById('result').innerHTML = myform;
			document.forms['bookform'].submit();
		}
		else
		{
			alert('Please select seats');
		}
	})
});
</script>