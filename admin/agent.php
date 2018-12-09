<?php
session_start();
include_once('chk_login.php');
?>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin Agent Adding</title>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(function()
{
$('.deletebutton').click(function()
     {
           var id=$(this).attr("id");
           var info = 'id=' + id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deleteagent.php",
   data: info,
   success: function()
   {
   
   }
 });
    $(this).parents("#record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");     

 }
     });
});
</script>

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
		<a href="add_agent.php" title="Add Theatre"><span>Add Agent<img src="table-images/add.png"></span></a>
	</div>
	<?php

	$array=$admin->agent();
	$size=sizeof($array);
   
	$i=0;
	$j=1;
?>
<table id="rounded-corner">
	<tr>
		<th>S.No</th>
		<th>Username</th>
		<th>Address</th>
    <th>Mobile</th>
		<th>Operations</th>
	</tr>

<?php
    while($size>0)
	{
?>
<tr id="record">
        <td><?php  echo $j++; ?></td>
        <td><?php  echo $array[$i]['name']; ?></td>
        <td><?php  echo $array[$i]['loation']; ?></td>
        <td><?php  echo $array[$i]['mobile']; ?></td>
        <td>
          <a href="#" class="deletebutton" title="Delete Agent" id="<?php echo $array[$i]['id'];?>"><img src="table-images/delete.png" /></a> &nbsp;
          <a href="edit_agent.php?id=<?php echo $array[$i]['id'];?>" title="Edit Theatre"><img src="table-images/edit.png" /></a>
        </td>
</tr>

<?php
         $size--;
         $i++;
	}

?><br/>
</table>
