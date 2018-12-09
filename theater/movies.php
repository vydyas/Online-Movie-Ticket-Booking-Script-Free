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
<center><h1>Now Playing!!</h1>	</center>
<?php
$query=mysql_query("SELECT m.* FROM assign_show a left join movies m on m.id=a.fk_movie_id WHERE a.fk_theater_id='$id' AND a.todate>=CURDATE()");
while($row=mysql_fetch_array($query))
{
?>
<table>
	<tr>
	<td><img src="../uploads/<?php echo $row['image'];?>" width="100px" height="100px"/></td>
	<td valign="top"><?php echo $row['name'];?><br/><?php echo $row['cast'];?><br/><?php echo $row['director'];?><br/>
	<input type="button" value="Book Tickets" name="booktickets"/>
	</td>
		
	</tr>
</table>
<?php
}
?>
</div>

	