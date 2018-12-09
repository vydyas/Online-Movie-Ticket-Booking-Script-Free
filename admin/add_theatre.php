<?php
session_start();
include_once('chk_login.php');
?>
<!DOCTYPE HTML>
<link href="select2.css" rel="stylesheet"/> 
<script src="jquery.js"></script>
<script src="select2.js"></script>
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
<script>
	$(function()
	{
		$('#th_location').select2();
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
<form action="addlocation_process.php" method="POST">
	<table cellspacing="18">
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
		<tr>
			<td>Theatre Name</td>
			<td><input type="text" name="theatre_name" id="theatre_name" required></td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username" id="username" required></td>
		</tr>
		<tr>
			<td>Theatre Addr</td>
			<td><textarea name="theatre_addr" id="theatre_addr" required></textarea></td>
		</tr>
		<tr>
			<td>E-mail ID</td>
			<td><input type="text" name="email" id="email" required></td>
		</tr>
		<tr>
			<td>Mobile</td>
			<td><input type="text" name="mobile" id="mobile" required></td>
		</tr>
        <tr>
		<td><input type="submit" name="submit" value="submit" id="submit"></td><td></td>
		</tr>
		</table>

</form>
</div>