<?php
session_start();
include_once('chk_login.php');
?>
<!DOCTYPE HTML>
<link rel="stylesheet" type="text/css" href="style.css">
<?php
include('../db/db.php');
include("../db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();
$admin=new admin();

echo $admin->menu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
<form action="add_location_process.php" id="addlocation" method="POST">
	<span>Add new location</span>
	<input type="text" name="location" id="location" placeholder="Eg:Tekkali" style="margin-top:20px;" required>
	<button style="margin-top:20px;margin-left: 10px;float:left;">Add</button>
</form>