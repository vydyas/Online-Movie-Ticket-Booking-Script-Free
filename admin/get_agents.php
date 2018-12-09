<?php
session_start();
?>
<?php
include('../db/db.php');
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$loc_id = $_REQUEST['loc_id'];
$today = date('Y-m-d');
$sql = "SELECT * FROM agent where fk_location_id=$loc_id ";
$result = mysql_query($sql);

$a="<option value=''>Select Agent</option>";
while($row = mysql_fetch_array($result))
{
	$theatre_name = $row['username'];
	$id = $row['id'];
	$a.="<option value='$id'>".$theatre_name."</option>";
}

echo $a;
?>