<?php
include('../db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();
$path = "../slider/";
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");

if($_POST)
{
$id=$_POST['id'];
$name = $_FILES['photoimg']['name'];
$size = $_FILES['photoimg']['size'];

list($txt, $ext) = explode(".", $name);
if(in_array($ext,$valid_formats))
{
if($size<(1024*1024)) // Image size max 1 MB
{
$actual_image_name = $id.".".$ext;
$tmp = $_FILES['photoimg']['tmp_name'];
if(move_uploaded_file($tmp, $path.$actual_image_name))
{
$image_query=mysql_query("UPDATE slider SET image='$actual_image_name' WHERE id='$id'");

if($image_query)
{
	header('Location:slider.php');
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
?>

