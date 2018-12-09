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
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="select2.js"></script>

<!-- Date Input-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

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
	<select id='th_location' name='th_location'>
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
	<select id='th2' name='th2'>
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
	<select id='th_movie' name='th_movie'>
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
	<tr><td><span id="flash">Processing...</span></td><td>
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
$('#showbooking').css('display','none')
$('#showbooking1').css('display','none');
$(document).ready(function(){
	$('#th_movie').change(function(){
			var theater_id = $('#th2').val();
	var location_id = $('#th_location').val();
	var movie_id = $('#th_movie').val();
	var date=$('#datepicker').val();
	//alert(location_id);
	if(theater_id!='' && location_id!='' && movie_id!='')
	{
		$('#flash').show();

		var params ="theater_id="+theater_id+"&location_id="+location_id+"&movie_id="+movie_id+"&date="+date;
		alert(params);
		var url ="chk_loc_ex.php";

		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) 
		{
			alert(data);
			if(data == 0)
			{
				$('#showbooking').css('display','none');
				$('#showbooking').html('');
				$('#showbooking1').show();
				alert("Seat arrangement for this theatre is not added.Please add it first");
				
			}
			else if(data == 2)
			{
			    $('#links').hide();
				$('#showbooking').css('display','none');
				$('#showbooking').html('');
				alert('Please assign show first to this theater and movie');
			}
			else
			{
				$('#flash').hide();
			    $('#links').hide();
				$('#showbooking').css('display','block');
				$('#showbooking').html(data);
			}
		}
	});
		
	}
	});
});
</script>

