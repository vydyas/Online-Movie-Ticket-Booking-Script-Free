<?php
session_start();
?><!--
<link rel="stylesheet" type="text/css" href="style.css">-->
<!DOCTYPE HTML>
<link href="select2.css" rel="stylesheet"/> 
<script src="jquery.js"></script>
<script src="select2.js"></script>

<script>
	$(function()
	{
		$('#thlocation').select2();
		$('#agent').select2();
	});
</script>

<title>Add Theatres by admin</title>
<?php
include('../db/db.php');
include("../db/admin.php");
include('../frontend.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();
include_once('chk_login.php');
$frontend=new frontend();

$array=$frontend->getlocation();
$size=sizeof($array);
$size1=$size;
$i=0;

$admin=new admin();

$array1=$admin->movies();
$size1=sizeof($array1);
$s=0;
$j=1;

echo $admin->menu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
<div id="content">
<form action="make_recharge_process.php" method="POST">
	<table cellspacing="18" style="  font-family: verdana;font-size: 13px;">
	<tr><td>Select Location</td><td>
	<select id='thlocation' name='thlocation'>
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
		<tr>
			<td>Agent Name</td>
			<td>
				<select id='agent' name='agent' required/>
		<option value=''>Select Agent</option>;
		</select>
			</td>
		</tr>
		<tr>
			<td>Amount</td>
			<td><input type="text" name="amount" id="amount" required></td>
		</tr>
		
        <tr>
		<td><input type="submit" name="submit" value="submit" id="submit"></td><td></td>
		</tr>
		</table>

</form>
</div>
<script type="text/javascript">
$(function()
{
$('#thlocation').change(function()
{
clocation= $("#thlocation").val();
		var params = "loc_id="+clocation;
		var url = "get_agents.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#agent').html(data);
				gettime();
			}
			});
});
});
</script>