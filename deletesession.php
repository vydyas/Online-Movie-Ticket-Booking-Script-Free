<?php
include('db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$ip=$_POST['ip'];


$check=mysql_query("delete from seatsession WHERE ip='$ip' ");
?>