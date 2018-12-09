<?php
$page = $_SERVER['PHP_SELF'];
$sec = "5";

function is_connected()
{
    $connected = @fsockopen("www.cinemachoodu.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}

if(is_connected())
{
	echo "Internet Connected";
}
else
{
	echo "Sorry ,No Internet Connection";
}
?>
<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
</html>