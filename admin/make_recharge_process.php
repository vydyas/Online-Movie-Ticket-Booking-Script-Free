<?php
include('../db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();


if(isset($_POST))
{

$location_id = $_POST['thlocation'];
$agent = $_POST['agent'];
$amount = $_POST['amount'];

$emailquery=mysql_query("SELECT email,mobile FROM agent WHERE id='$agent'");
$row=mysql_fetch_array($emailquery);
$email=$row['email'];
$mobile=$row['mobile'];

$message=$amount ."Rs successfully added to your Cinemachoodu.com Account";

$checkquery=mysql_query("SELECT * from `agent-recharge` WHERE fk_agent_id='$agent'");
if(mysql_num_rows($checkquery)>0)
{
$query=mysql_query("UPDATE `agent-recharge` SET amount=amount+$amount WHERE fk_agent_id='$agent' ");
}
else
{
$query=mysql_query("INSERT INTO `agent-recharge` VALUES('','$amount','$agent')");    
}

if($query>0)
{

    $subject = "CinemaChoodu Agent Recharge";
    $to = $email;
    $from = "vydyas@gmail.com";
    $headers = "From: " . strip_tags($from) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    mail($to, $subject, $message, $headers);


    $username = "####";
    $password = "####";
    $sender = "###";
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
    
}

?>

