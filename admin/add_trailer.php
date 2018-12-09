<?php
session_start();
include_once('chk_login.php');
?><!--
<link rel="stylesheet" type="text/css" href="style.css">-->
<!DOCTYPE HTML>
<link href="select2.css" rel="stylesheet"/> 
<script src="jquery.js"></script>
<script src="select2.js"></script>

<script>
       $(function()
       {
        $('#moviesss').select2();

       });
</script>

<title>Add Theatres by admin</title>
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

echo $admin->menu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
<div id="content">
<form action="add_trailer_process.php" method="POST">
	<table cellspacing="18" style="  font-family: verdana;font-size: 13px;">
		<tr>
			<td>Movies</td>
			<td><select style="width:300px" name="moviesss" id="moviesss" required>
  <option value="">Select Movies...</option>
     <?php                
    while($size1>0)
  {
    ?>
         <option  value="<?php echo $array1[$s]['id'];?>"><?php echo $array1[$s]['name'];?></option>
<?php
         
   $size1--;
   $s++;
  }

  ?>          
              </select></td>
		</tr>
		<tr><td>Youtube Id</td><td><input type="text" name="youtubeid" required></td></tr>
		<tr><td> <input type="submit" name="submit" value="submit" id="submit"></td><td></td></tr>
		</table>

</form>
</div>