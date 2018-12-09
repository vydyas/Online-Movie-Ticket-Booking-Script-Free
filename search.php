<?php
include('db/db.php');

$db=new db();
$db->db_connect();
$db->db_select();

if($_POST)
{
$q=$_POST['location'];


$sql_res=mysql_query("select * from location where location like '%$q%' order by id LIMIT 10 ");

while($row=mysql_fetch_array($sql_res))
{
$location=$row['location'];

?>
<div class="display_box" align="left">
<a href="#" id="search_result"  ><?php echo $location; ?></a>
</div>
<?php
}
}
else
{

}
?>