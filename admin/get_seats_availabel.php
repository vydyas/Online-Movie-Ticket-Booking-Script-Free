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

$theatre_id = $_REQUEST['theatre_id'];
$sql1 = "select type from theatres where id = '$theatre_id'";
$result1 = mysql_query($sql1);
$row=mysql_fetch_array($result1);
$cnt = $row['type'];
if($cnt ==1)
{
	echo "1";
}
else
{
	echo "0";
}
?>