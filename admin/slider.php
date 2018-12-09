<?php
session_start();
include_once('chk_login.php');
?>
<link rel="stylesheet" type="text/css" href="style.css">
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
<div id="add">
	<a title="Add Location" href="add_movies.php"><span>Add Movies<img src="table-images/add.png"></span></a>
</div>
	<?php

	$array=$admin->slider();
	$size=sizeof($array);
   
	$i=0;
	$j=1;
?>
<table id="rounded-corner">
	<tr>
		<th>S.No</th>
		<th>Image</th>
		<th>Operations</th>
	</tr>

<?php
    while($size>0)
	{
?>
<tr>
        <td><?php  echo $j++; ?></td>
        <td><img src="../slider/<?php  echo $array[$i]['image']; ?>" height=40px style="width:100px !important"/></td>
        <td><a title="Add Slider" href="slider_edit.php?id=<?php  echo $array[$i]['id']; ?>"><img src="table-images/edit.png"></a></td>
</tr>

<?php
         $size--;
         $i++;
	}
?><br/>
</table>