<?php
include('../db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();


if($_POST)
{

$theatre_name = $_POST['theatre_name'];
$location_id = $_POST['th_location'];
$email = $_POST['email'];
$mobile=$_POST['mobile'];

$message=$theatre_name ." Agent is successfully added to Cinemachoodu.com";

$uname=$theatre_name;
$psswd=rand(11111111,99999999);

$query1=mysql_query("SELECT * FROM agent WHERE username='$theatre_name' ");

if(mysql_num_rows($query1))
{
	echo "Already Agent Existed";
}
else
{
	$query = mysql_query("INSERT INTO agent VALUES('','$theatre_name','$psswd','$location_id','$email','$mobile')");

if($query)
{

    $subject = "Agent Credential Deatails -CinemaChoodu.Com";
    $to = $email;
    $from = "vydyas@gmail.com";

    $message = "Your UserName:".$uname." and password :".$psswd." Link is http://www.cinemachoodu.com/admin/agent-login.php";




    $headers = "From: " . strip_tags($from) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    mail($to, $subject, $message, $headers);


    $username = "###";
    $password = "####";
    $sender = "####";
    $domain = "###";
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

	header('location:agent.php');
}
else
echo "failed";
}
}

?>

