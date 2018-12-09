<?php
session_start();
include_once('chk_login.php');

include('../../db/db.php');
include("../../db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$sbmid = $_REQUEST['sbmid'];
$showid = $_REQUEST['showid'];
$charges = $_REQUEST['charges'];

$rowidArray = explode('sbmt',$sbmid);
$rowid = $rowidArray[1];

$sql = "select * from charges where fk_show_id = '$showid'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$charge_id = $row['charge_id'];
	$td_id = $row['td_id'];
	$gettdsplit = explode('.',$td_id);
	$gettd = $gettdsplit[0];
	if(($rowid == $gettd) && (strlen($rowid) == strlen($gettd)))
	{
		$sql1 = "update charges set charges='$charges' where charge_id='$charge_id'";
		$result1 = mysql_query($sql1);
	}
}
echo $charges;
?>