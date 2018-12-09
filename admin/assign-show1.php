<?php
session_start();
include_once('chk_login.php');
?>
<!--<link rel="stylesheet" type="text/css" href="style.css"> -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="select2.css" rel="stylesheet"/>
<link href="clockface.css" rel="stylesheet"/>
<script src="jquery.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <!-- Load jQuery UI Main JS  -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    
    <!-- Load SCRIPT.JS which will create datepicker for input field  -->
    <script src="script.js"></script>
<script src="select2.js"></script>
<script src="clockface.js"></script>
<script>
	$(function()
	{
		$('#th_location').select2();
        $('#th2').select2();
		$('#th_movie').select2();
	});
	$(function(){
    $('.t1').clockface();
    });
</script>
<title>Movies</title>
<?php
include('../db/db.php');
include("../db/admin.php");


//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$admin=new admin();

$id=$_SESSION['id'];
echo $admin->menu();
?>
	<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
	<div id='content'>
	<form method='post' action='process/assign-show.php' onsubmit='return validation()'>
	<table cellspacing="18" style="  font-family: verdana;font-size: 13px;">
	<tr><td>Select Location</td><td>
	<select id='th_location' name='th_location'>
	<option>Select Location</option>
	<?php
	$sql = "select * from location";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		$location_id = $row['id'];
		$loc_name = $row['location'];
		echo"<option value='$location_id'>".$loc_name."</option>";
	}
	?>
	</select>
	</td></tr>
	<tr><td>Select Theatre</td><td>
	<select id='th2' name='th2'>
	<option>Select Theatre</option>
	</select>
	</td></tr>
	<tr class='add-seats'><td></td></tr>
	<tr class='hideme'><td>Pick a Date: </td><td><input type="text" id="datepicker" name="datepicker" /></td></tr>
	<tr class='hideme'><td colspan='2'><input type='submit' name='submit' id='submit' value='Submit' /></td></tr>
	</table>
	</form>
	</div>
    <!-- Load jQuery UI Main JS  -->
   
	<script>
	function validation(){
		if($('#th_location').val() == '')
		{
			alert('Please select Location');
			return false;
		}
		else if($('#th_movie').val() == '')
		{
			alert('Please select movie');
			return false;
		}
		else if($('th2').val() == '')
		{
			alert('Please select theatre');
			return false;
		}
	}
	</script>
	<script>
	$(document).ready(function(){
		$('.hideme').css('visibility','hidden');
		$('#th_location').change(function(){
			$('.hideme').css('visibility','hidden');
			loc_id= $("#th_location").val();
			var params = "loc_id="+loc_id;
			var url = "get_theater.php";
			$.ajax({
				type: 'POST',
				url: url,
				dataType: 'html',
				data: params,
						
				success: function(data) {
					$('#th2').html(data);
				}
				});
				});
	});
	</script>
<script>
$(document).ready(function(){
	$('#th2').change(function(){
		theatre_id= $("#th2").val();
			var params = "theatre_id="+theatre_id;
			var url = "get_seats_availabel.php";
			$.ajax({
				type: 'POST',
				url: url,
				dataType: 'html',
				data: params,
						
				success: function(data) {//alert(data);
					if(data == 0)
					{
						alert('Please add seat arrangement for this theatre');
						$('.hideme').css('visibility','hidden');
						$(".add-seats").html("<a href='seat-arrangement.php?theater_id="+theatre_id+"&action=edit'>Arrange Seats</a>");
					}
					else
					{
						$('.hideme').css('visibility','visible');
					}
				}
				});
	});
});
</script>