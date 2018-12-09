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


if($_POST)
{

$theatre_name = $_POST['theatre_name'];
$addr = $_POST['theatre_addr'];
$location_id = $_POST['th_location'];
$email = $_POST['email'];
$mobile=$_POST['mobile'];
$message=$theatre_name ." Theatre is successfully added to Cinemachoodu.com";

$uname=$_POST['username'];
$psswd=rand(11111111,99999999);

$query1=mysql_query("SELECT * FROM theatres WHERE name='$theatre_name' ");
if(mysql_num_rows($query1))
{
	echo "Already Theatre Existed";
}
else
{
	$query = mysql_query("INSERT INTO theatres VALUES('','$theatre_name','$addr','$location_id','$email','$mobile','1','1','1')");
    $getId = mysql_insert_id();

if($query)
{
	$login_query = mysql_query("INSERT INTO theatre_login VALUES('','$uname','$psswd','$getId')");

   $username = "###";
    $password = "###";
    $sender = "####";
    $domain = "#####";
    $method = "POST";
    $mobile = $mobile;
    $username = urlencode($username);
    $password = urlencode($password);
    $sender = urlencode($sender);
    $message = urlencode($message);
    $parameters = "username=$username&password=$password&from=$sender&to=$mobile&msg=$message";
    $fp = fopen("http://$domain/API/sms.php?$parameters", "r");
    $response = stream_get_contents($fp);
    fpassthru($fp);
    fclose($fp); 

	if($login_query)
	{
     $message="Your Cinemachoodu.com Username:".$uname." password:".$psswd." ";


 $username = "dialdestiny";
    $password = "vizag@123";
    $sender = "DDSTNY";
    $domain = "login.smsmoon.com";
    $method = "POST";
    $mobile = $mobile;
    $username = urlencode($username);
    $password = urlencode($password);
    $sender = urlencode($sender);
    $message = urlencode($message);
    $parameters = "username=$username&password=$password&from=$sender&to=$mobile&msg=$message";
    $fp = fopen("http://$domain/API/sms.php?$parameters", "r");
    $response = stream_get_contents($fp);
    fpassthru($fp);
    fclose($fp); 

	}

    

	
	header('location:seat-arrangement.php?theater_id='.$getId.'&action=save');
}
else
echo "failed";
}
}

?>

