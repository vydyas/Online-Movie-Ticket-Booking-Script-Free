<?php
session_start();
include_once('chk_login.php');
?>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Movies</title>
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
   url: "deletemovies.php",
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
<script>
       $(function()
       {
        $('#moviesss').select2();

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

$array1=$admin->movies();
$size1=sizeof($array1);
   
$s=0;
$j=1;

$id=$_SESSION['id'];
echo $admin->menu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
<div id="add">
		<a href="add_movies.php" title="Add Movie"><span>Add Movie<img src="table-images/add.png"></span></a>
</div>
<input type="text" id="filter" style="padding:3px;width:250px;" placeholder="Search Movies.." >
	<?php

	$array=$admin->movies();
	$size=sizeof($array);
   
	$i=0;
	$j=1;
?>
<table id="rounded-corner">
	<tr>
		<th>S.No</th>
		<th>Movie</th>
		<th>Image</th>
		<th>Rating</th>
		<th>Cast</th>
		<th>Operations</th>
	</tr>

<?php
    while($size>0)
	{
?>
<tr id="record">
        <td><?php  echo $j++; ?></td>
        <td><?php  echo $array[$i]['name']; ?></td>
        <td><img src="../uploads/<?php  echo $array[$i]['image']; ?>" style="width:50px;"/></td>
        <td><?php  echo $array[$i]['rating']; ?></td>
        <td><?php  echo $array[$i]['cast']; ?></td>
        <td>
        	<a href="deletemovies.php?id=<?php  echo $array[$i]['id']; ?>" class="deletebutton" title="Delete Movie" id="<?php echo $array[$i]['id'];?>"><img src="table-images/delete.png" /></a>
        	<a href="edit_movies.php?id=<?php  echo $array[$i]['id']; ?>" class="editbutton" title="Edit Movie" id="<?php echo $array[$i]['id'];?>"><img src="table-images/edit.png" /></a>
        </td>
</tr>

<?php
         $size--;
         $i++;
	}
?><br/>
</table>
<script type="text/javascript">
  $(document).ready(function(){
   alert("Hiee");
});
</script>