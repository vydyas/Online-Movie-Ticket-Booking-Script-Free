<?php
include('db/db.php');
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$loc_id = $_REQUEST['loc_id'];

$sql = "SELECT movies.name,movies.id,todate FROM assign_show join movies on assign_show.fk_movie_id = movies.id where assign_show.fk_location_id='$loc_id' order by movies.id desc";
$result = mysql_query($sql);

$date=date('Y-m-d');

$moviearray=array();

$a="<option value=''>Select Movie</option>";

$j=0;

$moviesarray=array();
$moviesid=array();

while($row = mysql_fetch_array($result))
{
	$movie_name = $row['name'];
	$mid = $row['id'];
	$todate=$row['todate'];

    array_push($moviesarray, $movie_name);
	array_push($moviesid, $mid);

    if(strtotime($todate)>strtotime($date))
	{
		$moviesarray=array_unique($moviesarray);
		$moviesid=array_unique($moviesid);
		if($moviesarray[$j]!='')
		{
	     $a.="<option value='$moviesid[$j]'>".$moviesarray[$j]."</option>";	
		}
	}

	$j++;
}

echo $a;
?>
