<?php
session_start();
?>
<?php
include('../db/db.php');
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$the_id = $_REQUEST['the_id'];
$mdate = $_REQUEST['mdate'];

$today = date('D j M Y');

$sql = mysql_query("SELECT * from assign_show WHERE fk_theater_id='$the_id'");
$sql_row=mysql_fetch_array($sql);

$now=strtotime($time=date('h:i A'))."<br/>";

$morning=$sql_row['morning'];
$matney=$sql_row['matney'];
$firstshow=$sql_row['firstshow'];
$secondshow=$sql_row['secondshow'];

$morningclose=strtotime("-120 minutes", strtotime($morning));
$matneyclose=strtotime("-120 minutes", strtotime($matney));
$firstclose=strtotime("-120 minutes", strtotime($firstshow));
$secondclose=strtotime("-120 minutes", strtotime($secondshow));


$a="<option value=''>Select Show</option>";

if($now<$morningclose && $today=$mdate)
{
        $a.="<option value='$morning'>".$morning."</option>";
}
else if($today!=$mdate)
{
	$a.="<option value='$morning'>".$morning."</option>";
}
if($now<$matneyclose && $today=$mdate)
{
        $a.="<option value='$matney'>".$matney."</option>";
}
else if($today!=$mdate)
{
	$a.="<option value='$matney'>".$matney."</option>";
}
if($now<$firstclose && $today=$mdate)
{
        $a.="<option value='$firstshow'>".$firstshow."</option>";
}
else if($today!=$mdate)
{
	$a.="<option value='$firstshow'>".$firstshow."</option>";
}
if($now<$secondclose && $today=$mdate)
{
        $a.="<option value='$secondshow'>".$secondshow."</option>";
}
else if($today!=$mdate)
{
	$a.="<option value='$secondshow'>".$secondshow."</option>";

}

echo $a;
?>