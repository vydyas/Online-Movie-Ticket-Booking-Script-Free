
<head>
	<title>Movie Theatres Search</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript">
$(document).ready(function()
{
	$('.search').keyup(function()
	{
		var location =$(this).val();
		var dataString = 'location='+ location;
if(location=='')
{
	$('#display').hide();
}
else
{
$.ajax({
type: "POST",
url: "search.php",
data: dataString,
cache: false,
success: function(html)
{
$("#display").html(html).show();
}
});
}
return false;
	});

$("#search_result").live("click",function()
{
var username=$(this).html();
$(".search").val(username);
$("#display").hide();
});

})
</script>
</head>
<?php

include('db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

?>

<body>
	<div class="bar">
	</div>
	<img src="images/logo.png" style="margin-left:200px">
	<center>
	<div class="Quote" style="margin-top:70px">
	<h1>Discover Great <b>Theatres</b> to Watch around you</h1>
    </div>
    </center>
    <div style="margin-left:440px">
	<form class="form-wrapper cf">
	<input type="text" placeholder="Search Location..." name="location" class="search" required>
	<button type="submit">Search</button>
	<div id="display"></div>
    </form>
   </div>
   <center><span style="color:white;">Note: please search by location name</span></center>

</body>