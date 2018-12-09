<?php
include('../db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();


if($_POST)
{

$location_id = $_POST['thlocation'];
$agent = $_POST['agent'];
$amount = $_POST['email'];

$message=$amount ."Rs successfully added to your Cinemachoodu.com Account";
$query1=mysql_query("SELECT * FROM agent WHERE username='$theatre_name' ");
$row=mysql_fetch_array($query1);

$mobile=$row['mobile'];
$email=$row['email'];

if(mysql_num_rows($query1))
{
	echo "Already Agent Existed";
}
else
{
	$query = mysql_query("INSERT INTO agent-recharge VALUES('','$amount','$agent')");

if($query)
{

    $subject = "CinemaChoodu Agent Recharge";
    $to = $email;
    $from = "vydyas@gmail.com";

    $message = $amount." Link is http://www.cinemachoodu.com/agent";

    $headers = "From: " . strip_tags($from) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    mail($to, $subject, $message, $headers);


    $username = "######";
    $password = "######";
    $sender = "#####";
    $domain = "######";
    $method = "POST";
    $mobile = $mobile;
    $username = urlencode($username);
    $password = urlencode($password);
    $sender = urlencode($sender);
    $message = urlencode($message);
    $parameters = "username=$username&password=$password&to=$mobile&from=$sender&message=$message";
    $fp = fopen("http://$domain/SendSms.aspx?$parameters", "r");
    $response = stream_get_contents($fp);
    fpassthru($fp);
    fclose($fp); 

	header('location:agent-recharge.php');
}
else
echo "failed";
}
}

?>

