<?php
session_start();
include_once('chk_login.php');
?>
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
</style>

<link href="select2.css" rel="stylesheet"/>
<link href="clockface.css" rel="stylesheet"/>
<script src="jquery.js"></script>
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
	<tr class='hideme'><td>Morning Show</td><td><input id="morning" data-format="hh:mm A" class="t1" type='text' name='morning' /></td></tr>
	<tr class='hideme'><td>Matney Show</td><td><input type='text' data-format="hh:mm A" class="t1" name='matney' id='matney' /></td></tr>
	<tr class='hideme'><td>First Show</td><td><input type='text' data-format="hh:mm A" class="t1" name='firstshow' id='firstshow' /></td></tr>
	<tr class='hideme'><td>Second Show</td><td><input type='text' data-format="hh:mm A" class="t1" name='secondshow' id='secondshow' /></td></tr>
	<tr class='hideme'><td colspan='2'><input type='submit' name='submit' id='submit' value='Submit' /></td></tr>
	</table>
	</form>
	</div>
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
						//alert('Please add seat arrangement for this theatre');
						$('.hideme').css('visibility','visible');
					//	$(".add-seats").html("<a href='seat-arrangement.php?theater_id="+theatre_id+"&action=edit'>Arrange Seats</a>");
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