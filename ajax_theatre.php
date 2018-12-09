<?php
include('db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();


if($_POST['id'])
{
$id=$_POST['id'];
$sql=mysql_query("select t.* from theatres t left join location l on l.id=t.location_id WHERE t.location_id='$id' ");
while($row=mysql_fetch_array($sql))
{
$id=$row['id'];
$data=$row['name'];
echo '<option style="background:red" value="'.$id.'">'.$data.'</option><br/>';
}
}
?>