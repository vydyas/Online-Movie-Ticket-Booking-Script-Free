<?php 
date_default_timezone_set("Asia/Calcutta");
class db
{
	public function db_connect()
	{

    $hostname="localhost";
	$username="cinema_choodu";
	$password="cinema123";

    $con=mysql_connect($hostname,$username,$password) or die("SQL ERROR1 : ".mysql_error());

    return $con;

    }

    public function db_select()
    {

    $database="cinema_choodu";

    $con1=mysql_select_db('cinema_choodu') or die("SQL ERROR2 : ".mysql_error());

    return $con1;

    }

    public function db_close()
    {

    mysql_close();

    }
}

?>