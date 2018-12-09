<?php
session_start();
include('chk_login.php');
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

$id=$_SESSION['theater_id'];

echo $admin->theatermenu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
<div class="panelwrapper">
<center><h1>Welcome to Theater Admin Panel!!!</h1>	</center>
</div>

	