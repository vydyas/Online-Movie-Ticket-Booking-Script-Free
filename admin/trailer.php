<?php
session_start();
include_once('chk_login.php');
?>
<link rel="stylesheet" type="text/css" href="style.css">
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
   url: "deletetrailer.php",
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
<title>Trailer</title>
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
<div id="add">
		<a href="add_trailer.php" title="Add Trailer"><span>Add Trailer<img src="table-images/add.png"></span></a>
	</div>
	<?php

	$array=$admin->trailer();
	$size=sizeof($array);
   
	$i=0;
	$j=1;
?>
<table id="rounded-corner">
	<tr>
		<th>S.No</th>
		<th>Movie</th>
		<th>Yotube Id</th>
		<th>Operations</th>
	</tr>

<?php
    while($size>0)
	{
?>
<tr id="record">
        <td><?php  echo $j++; ?></td>
        <td><?php  echo $array[$i]['name']; ?></td>
        <td><?php  echo $array[$i]['youtubeid']; ?></td>
        <td><a href="#" class="deletebutton" title="Delete Trailer" id="<?php echo $array[$i]['id'];?>"><img src="table-images/delete.png" /></a></td>

</tr>

<?php
    $size--;
    $i++;
}
?>
</table>
