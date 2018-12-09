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


if($_POST['id'])
{
$id=$_POST['id'];
$sql=mysql_query("select m.* from theatres t left join movies m on m.id=t.movies_id Left join location l on l.id=t.location_id where l.id='$id'");
while($row=mysql_fetch_array($sql))
{
$id=$row['id'];
$data=$row['name'];
echo '<option value="'.$id.'"><b>'.$data.'</b></option><br/>';
}
}
?>