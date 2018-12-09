<?php
session_start();
include_once('chk_login.php');
?>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin Location Adding</title>
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
   url: "delete.php",
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
		<a href="add_location.php" title="Add Location"><span>Add Location<img src="table-images/add.png"></span></a>
	</div>
      <input type="text" id="filter" style="padding:3px;width:250px;" placeholder="Search Location.." >
<?php

	$array=$admin->location();
	$size=sizeof($array);

	$i=0;
	$j=1;
?>
<table id="rounded-corner">
	<tr>
		<th>S.No</th>
		<th>Location</th>
		<th>Operation</th>
	</tr>

<?php
    while($size>0)
	{
?>
<tr id="record">
        <td><?php  echo $j++; ?></td>
        <td><?php  echo $array[$i]['name']; ?></td>
        <td>
        	<a href="#" class="deletebutton" title="Delete Location" id="<?php echo $array[$i]['id'];?>"><img src="table-images/delete.png" /></a>
        	<a href="edit_location.php?name=<?php  echo $array[$i]['name']; ?>&id=<?php  echo $array[$i]['id']; ?>" class="editbutton" title="Edit Location"><img src="table-images/edit.png" /></a>
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
    $("#filter").keyup(function(){
 
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val();
 
        // Loop through the comment list
        $("table tr").each(function(){
 
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
                count++;
            }
        });
 
    });
});
</script>