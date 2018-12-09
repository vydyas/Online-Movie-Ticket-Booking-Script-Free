<?php
session_start();
include_once('chk_login.php');
?>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin Ticket Booking</title>
<script type="text/javascript" src="../js/jquery.js"></script>
<?php
include('../db/db.php');
include("../db/admin.php");


//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();
include_once('chk_login.php');
$admin=new admin();

$id=$_SESSION['id'];
echo $admin->menu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>

<div class="leftmenu">
	<?php include_once('leftmenu.php'); ?>
</div>
<div class="rightcontent">
</div>