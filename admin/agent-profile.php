<?php
session_start();
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

$id=$_SESSION['agent_id'];

echo $admin->agentmenu();
$amount=mysql_query("SELECT * FROM `agent-recharge` WHERE fk_agent_id='$id'");
$row=mysql_fetch_array($amount);
?>

<li style="float:right;">
     <b><?php echo $row['amount'];?></b>&nbsp;Rs.
</li>
<li style="float:right;">
	<a href="logout.php">Logout</a>
</li>
</ul>
</header><br/>
<center><br/><br/><h1>Welcome to Agent Panel of CinemaChoodu</h1></center>
	
