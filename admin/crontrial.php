<?php
session_start();
?>
<!DOCTYPE HTML>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Add Movies by admin</title>
<?php
include('../db/db.php');
include("../db/admin.php");
include('../frontend.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();
include_once('chk_login.php');
$frontend=new frontend();

$from = 'aparnathule@gmail.com';
$to = 'aparnathule@gmail.com';
$message = "Hello";
$subject = "Cron Trial";

$headers = "From: " . strip_tags($from) . "\r\n";
$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to, $subject, $message, $headers);

?>