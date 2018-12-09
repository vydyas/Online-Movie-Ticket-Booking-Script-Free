<?php
session_start();
include_once('chk_login.php');
?>
<link rel="stylesheet" type="text/css" href="style.css">
<?php
include('../db/db.php');
include("../db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$admin=new admin();

if($_REQUEST['name'])
{
	echo $admin->menu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
<form action="update_location_process.php" method="POST">
	<span>Add new location</span>
	<input type="text" name="location" id="location" value="<?php echo $_REQUEST['name'];?>" placeholder="Eg:Tekkali" style="margin-top:20px;">
	<input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id'];?>" placeholder="Eg:Tekkali" style="margin-top:20px;">
	<button style="margin-top:20px;margin-left: 10px;float:left;">Update Location</button>
	<a href="location.php" style="margin-top:10px;margin-left: 10px;float:left;">Cancel</a>
</form>
<?php
}
?>

