<?php 
date_default_timezone_set("Asia/Calcutta");
class db
{
	public function db_connect()
	{

    $hostname="localhost";
	$username="root";
	$password="";

    $con=mysql_connect($hostname,$username,$password) or die(mysql_errno());

    return $con;

    }

    public function db_select()
    {

    $database="cinema_choodu";

    $con1=mysql_select_db($database) or die(mysql_errno());

    return $con1;

    }

    public function db_close()
    {

    mysql_close();

    }
}

?>