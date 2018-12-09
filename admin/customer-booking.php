<?php
session_start();
if(isset($_SESSION['id']) || isset($_SESSION['agent_id']))
{
?>
<!DOCTYPE HTML>
<title>Admin Customer Booking Details</title>
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
<link href="jquery-ui.css" rel="stylesheet">
<script src="jquery-ui.js"></script>
<script>
$(function()
{
	$('#clocation').select2();
	$('#ctheatre').select2();
	$('#cmovie').select2();
	$('#ctime').select2();
	$('#cdate').select2();
	$('#cday').select2();
	$('#cmonth').select2();
});
</script>

<!-- end of data tables -->
<style>
.list-customer { 
	width: 95%; 
	float: left;
	margin: 20px;
}

.select2-container .select2-choice > .select2-chosen { font-size: 13px; }


.select2-container, .select2-drop, .select2-search, .select2-search input {
    width: 188px;
}

#s2id_autogen5_search,
#s2id_autogen6_search,
#s2id_autogen7_search { width: 110px; }

#result > table {
    border-collapse: collapse;
    margin: 25px 0 0;
    width: 100%;
}

#ui-datepicker-div { font-size: 13px; }

</style>
<?php
include('../db/db.php');
include("../db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$admin=new admin();

$id=$_SESSION['id'];
if(isset($_SESSION['id']))
{
echo $admin->menu();
}
else
{
	$agent_id=$_SESSION['agent_id'];
	echo $admin->agentmenu();

}
@$amount=mysql_query("SELECT * FROM `agent-recharge` WHERE fk_agent_id='$agent_id'");
$row=mysql_fetch_array($amount);
?>
<li style="float:right;"><?php echo $row['amount'];?>&nbsp;Rs.</li>
<li style="float:right;"><a href="logout.php">Logout</a></li>
</ul></header>
<div class="list-customer">
<table>
<tr>
	<td>
		<select id='clocation' name='clocation'>
		<?php
		$sql = "select * from location";
		$result = mysql_query($sql);
		echo "<option value=''>Select Location</option>";
		while($row = mysql_fetch_array($result))
		{
			$id = $row['id'];
			$location = $row['location'];
			echo"<option value='$id'>".$location."</option>";
		}
		?>
		</select>
	</td>
	<td>
		<select id='ctheatre' name='ctheatre'>
		<option value=''>Select Theatre</option>;
		</select>
	</td>
	<td>
		<select id='cmovie' name='cmovie'>
		<?php
		$sql = "select * from movies";
		$result = mysql_query($sql);
		echo "<option value=''>Select Movie</option>";
		while($row = mysql_fetch_array($result))
		{
			$id = $row['id'];
			$name = $row['name'];
			echo"<option value='$id'>".$name."</option>";
		}
		?>
		</select>
	</td>
	<td>
		<select id='ctime' name='ctime'>
		<option value=''>Select Movie Time</option>
		</select>
	</td>
	<td>
		<input type='text' name='datepicker' id='datepicker' class='datepicker' style='height:22px;' />
	</td>
	<td>
		<input type='button' name='submit' id='submit' value='Submit' style="height:29px;cursor:pointer;" />
	</td>
	</tr>
</table>
<div id='result'>

</div>
</div>
<?php
}
else
{
header('Location:../404.php');
}
?>
<script>
$(document).ready(function() {
	$('#clocation').change(function(){
		clocation= $("#clocation").val();
		var params = "loc_id="+clocation;
		var url = "get_theater.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#ctheatre').html(data);
				gettime();
			}
			});
		});
	$('#ctheatre').change(function(){
		gettime();
	});
	$('#cmovie').change(function(){
		gettime();
	});
});
</script>
<script>
function gettime()
{
	var clocation = $('#clocation').val();
	var ctheatre = $('#ctheatre').val();
	var cmovie = $('#cmovie').val();
	if(clocation != '' && ctheatre != '' && cmovie != '')
	{
		var params = "clocation="+clocation+"&ctheatre="+ctheatre+"&cmovie="+cmovie;
		var url = "get_show_time.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#ctime').html(data);
			}
			});
	}
}
</script>
<script>
$(document).ready(function(){
	$('#submit').click(function(){
		var clocation = $('#clocation').val();
		var ctheatre = $('#ctheatre').val();
		var cmovie = $('#cmovie').val();
		var ctime = $('#ctime').val();
		var getdt = $('#datepicker').val();

		if(clocation == '' || ctheatre == '' || cmovie == '' || getdt== '')
		{
			alert('Please select all options');
		}
		else
		{
			var params = "clocation="+clocation+"&ctheatre="+ctheatre+"&cmovie="+cmovie+"&ctime="+ctime+"&cdate="+getdt;
			var url = "get_customer_booking.php";
			$.ajax({
			type: 'POST',
			url: url,
			dataType: 'html',
			data: params,
			
			success: function(data) {
					if(data == 0)
					{
						$('#result').html('');
						alert('No customer booking for this show');
					}
					else
					{
						$('#result').html(data);
					}
				}
			});
		}
	});
});
</script>
<script>

$( "#datepicker" ).datepicker({
	inline: true,
	dateFormat:"D d M,yy"

});
</script>
</table>