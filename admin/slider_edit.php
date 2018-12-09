<?php
session_start();
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
include_once('chk_login.php');
$admin=new admin();

$id = $_REQUEST['id'];
$query = mysql_query("SELECT image from slider Where id='$id'");
$row = mysql_fetch_array($query);
echo $admin->menu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
<div id="add">
		<a title="Add Location" href="add_movies.php"><span>Add Movies<img src="table-images/add.png"></span></a>
</div>
<div id="content">
<form action="slider_edit_process.php" method="post" enctype="multipart/form-data">
Image:<img src="../slider/<?php echo $row['image'];?>" style="width:100%;" /><br/><br/>
Upload image: <input type="file" name="photoimg" id="photoimg" />
<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>"><br/><br/>
<input type="submit" name="submit" value="submit" id="submit">
</form>
</div>