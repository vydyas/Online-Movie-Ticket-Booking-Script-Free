<?php
session_start();
include_once('chk_login.php');
?>
<!--<link rel="stylesheet" type="text/css" href="style.css"> -->
<style type="text/css">
ul > li {
    position:relative;
    font-size:19px;
}
 
ul > li > a {
    text-shadow:0px 1px 0px rgba(0,0,0,0.4);
}

li:hover .sub-menu {
    z-index:1;
    opacity:1;
}
 
.sub-menu {
    width:160%;
    padding:5px 0px;
    position:absolute;
    top:100%;
    left:0px;
    z-index:-1;
    opacity:0;
    transition:opacity linear 0.15s;
    box-shadow:0px 2px 3px rgba(0,0,0,0.2);
    background:#2e2728;
}
 
.sub-menu li {
    display:block;
}
 
.sub-menu li a {
    display:block;
}
#flash
{
	display: none;
}
</style>
<link href="select2.css" rel="stylesheet"/> 
<script src="jquery.js"></script>
<script src="select2.js"></script>

<!-- Date Input-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="script1.js"></script>

<script>
	$(function()
	{
		$('#th_location').select2();
        $('#th2').select2();
		$('#th_movie').select2();
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
	<div id="content" style="float: left; margin: 20px; width: 29%;">
	<form method='post' action='process/assign-show.php'>
	<table cellspacing="18" style="  font-family: verdana;font-size: 13px;">
		<tr>
		<td>Pick a Date: </td><td><input type="text" id="datepicker" name="datepicker" /></td>
	</tr>
	<tr><td>Select Location</td><td>
	<select id='th_location' name='th_location' onchange="get_theater()">
	<option value=''>Select Location</option>
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
	<select id='th2' name='th2' onchange="get_theater()">
	<option value=''>Select Theatre</option>
	<?php
	$sql = "select * from theatres";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		$theater_id = $row['id'];
		$theater = $row['name'];
		echo"<option value='$theater_id'>".$theater."</option>";
	}
	?>
	</select>
	</td></tr>
		<tr><td>Select Movie</td><td>
	<select id='th_movie' name='th_movie' onchange="get_theater()">
	<option value=''>Select Movie</option>
	<?php
	$sql = "select * from movies";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		$movie_id = $row['id'];
		$movie_name = $row['name'];
		echo"<option value='$movie_id'>".$movie_name."</option>";
	}
	?>
	</select>
	</td></tr>
	<tr>
	<td><span id="flash">Processing...</span></td>
	<td>
	</td></tr>
	</table>
	</form>
	</div>
	<div id="showbooking"></div>
	<div id="result"></div>
	<div id="showbooking1">
	   <input type="text" name="link" id="link"/>
	   <button id="submitlink">Submit Link</button>
	</div>
<script>
function get_theater()
{
	var theater_id = $('#th2').val();
	var location_id = $('#th_location').val();
	var movie_id = $('#th_movie').val();
	var date=$('#datepicker').val();
	//alert(location_id);
	if(theater_id!='' && location_id!='' && movie_id!='' && date!='')
	{
		$('#flash').show();

		var params ="theater_id="+theater_id+"&location_id="+location_id+"&movie_id="+movie_id+"&date="+date;
		var url ="edittodateprocess.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) 
		{
			$('#flash').hide();
		   alert("Todate Updated Successfully");
		}
	});
		
	}
}
</script>
<script>
$('#showbooking').css('display','none');
$('#showbooking1').css('display','none');
</script>
<script>
$(document).ready(function(){
	$('#links').css('display','none');
	$('#th_location').change(function(){
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