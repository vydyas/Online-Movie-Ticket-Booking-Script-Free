<?php
session_start();
include_once('chk_login.php');
?>
<?php
include('../db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();
$path = "../uploads/";
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");

if($_POST)
{

$movie_name=$_POST['movie_name'];
$cast=$_POST['movie_cast'];
$rating=$_POST['movie_rating'];
$desc=$_POST['movie_desc'];
$music=$_POST['music'];
$director=$_POST['director'];
$date=$_POST['datepicker'];
$name = $_FILES['photoimg']['name'];
$size = $_FILES['photoimg']['size'];

if($date=='')
{
	$date=date('D d M Y');
}


$query1=mysql_query("SELECT * FROM movies WHERE name='$movie_name' ");
if(mysql_num_rows($query1))
{
	echo "Already Location Existed";
}
else
{
	
	$query=mysql_query("INSERT INTO movies VALUES('','$movie_name','','$rating','$cast','$director','$music','$desc','','$date')");
	$id=mysql_insert_id();

if($query)
{
list($txt, $ext) = explode(".", $name);
if(in_array($ext,$valid_formats))
{
if($size<(1024*1024)) // Image size max 1 MB
{
$actual_image_name = $id.".".$ext;
$tmp = $_FILES['photoimg']['tmp_name'];
if(move_uploaded_file($tmp, $path.$actual_image_name))
{
$image_query=mysql_query("UPDATE movies SET image='$actual_image_name' WHERE id='$id'");

if($image_query)
{
	header('Location:movies.php');
}
else
{
	echo "Image Insertion Failed";
}
}
else
echo "failed";
}
else
echo "Image file size max 1 MB"; 
}
else
echo "Invalid file format.."; 

}
else
{
	echo "Movie Insertion Failed";
}
}
}
?>

