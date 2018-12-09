<?php
include('db/db.php');
include('frontend.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$frontend=new frontend();

//loation
$array=$frontend->getlocation();
  $size=sizeof($array);
  $t_size=$size;
  $i=0;
  $t=0;

  $today = date('D-d-M');
  $tomorrow = date('D-d-M', time()+86400);
  $dayAftT = date('D-d-M', time()+172800);
?>
<!DOCTYPE html>
    <head>
    
	 <title>Cinemachoodu - Book Show</title>
        <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href="http://localhost/moviesearch/site1.css" rel="stylesheet"/>
		<link href="http://localhost/moviesearch/select2.css" rel="stylesheet"/>
		<meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" name="viewport" />
		<script src="http://localhost/moviesearch/jquery-1.8.0.min.js"></script>   
		<script src="http://localhost/moviesearch/select2.js"></script>
		<script src="http://localhost/moviesearch/form.js"></script>

		<style type="text/css">
		.listmovies tr td a
		{
			padding: 5px;
border-radius: 3px;
border:solid 1px green;
color:green;
float: left;
font-weight: bold;
text-decoration: none;

		}
		.listmovies tr td a:hover
		{
		padding: 5px;
border-radius: 3px;
border:solid 1px green;
color:#fff;
background: green;
float: left;
transition: 1s;
font-weight: bold;
		}
		</style>
    </head>
<body>
<div class="container">
	<?php
	include_once('header.php');
	include_once('smallform.php');
	?>
	<div class='content'>
	
<?php
if(isset($_POST['submitone']))
{
	$location_id = $_POST['location1'];
	$movie_id = $_POST['selectmovies'];
    $movie_date = $_POST['mdate'];
	$mdate_code = base64_encode($movie_date);
	
	$sql1 = "select theatres.name Name1,theatres.address,assign_show.show_id,assign_show.morning,assign_show.matney,assign_show.morning,assign_show.firstshow,assign_show.secondshow,location.location,movies.name Name2 from assign_show join location on assign_show.fk_location_id = location.id join movies on assign_show.fk_movie_id = movies.id join theatres on assign_show.fk_theater_id = theatres.id where assign_show.fk_location_id = '$location_id' and assign_show.fk_movie_id = '$movie_id'";

	$sql2="SELECT fk_theater_id FROM assign_show WHERE fk_movie_id='$movie_id' AND fk_location_id='$location_id' ";
    $result=mysql_query($sql2);
	while($row=mysql_fetch_array($result))
	{
		$theater_id=$row['fk_theater_id'];
		$typesql="SELECT t.type,l.link FROM theatres t LEFT JOIN links l on l.fk_theater_id=t.id WHERE t.id='$theater_id'";
		$typesqlresult=mysql_query($typesql);
		$typerow=mysql_fetch_array($typesqlresult);

        $type=$typerow['type'];
		$link=$typerow['link'];
	}


	if(!$result1 = mysql_query($sql1))
	{
		die("SQL ERROR :".mysql_error());
	}
	else
	{
	?>
	<form method='post' name='myform' id='myform'>
	<input type='hidden' name='location' value='<?php echo $location_id?>'>
	<input type='hidden' name='selectmovies' value='<?php echo $movie_id?>'>
	<input type='hidden' name='mdate' value='<?php echo $movie_date?>'>
	</form>
	<div class='content-wrapper'>
	<div class="left-content">
	<?php
	$sql = "select * from movies where id = '$movie_id'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$name = $row['name'];
	$imagename = $row['image'];
	$cast = $row['cast'];
	$director = $row['director'];
	$music = $row['music'];
	$desc = $row['desc'];
	echo"<table  cellpadding='5' style='text-align:center;'>";
	echo"<tr>";
	if($imagename != '')
	{
		echo "<td style='text-align:center;'><img src='uploads/".$imagename."' width='120px' heigth='160px' style='border:solid 5px #eee;box-shadow:2px 2px 2px #333 '/></td>";
	}
	else{
	echo "<td style='text-align:center;'>".$movie_date."</td></tr>"; }
	echo"<tr><td></td></tr>";
	if($cast != '')
	{
		echo"<tr><td></td></tr>";
	}
	echo"</td></tr>";
	echo"</table>";
	?>
	</div>
	<div class="right-content">
		<h2><?php echo $name. "&nbsp;(U/A) - ". $movie_date; ?></h2>
	<div class='listmovie-wrapper'>
	<?php
		echo"<table class='listmovies' cellspacing='5' cellpadding='8'>";
		
		while($row1 = mysql_fetch_array($result1))
		{
			$id = $row1['show_id'];
			$theater_name = $row1['Name1'];
			$location_name = $row1['location'];
			$movie_name = $row1['Name2'];
			$address = $row1['address'];
			$morning = $row1['morning'];
			$matney = $row1['matney'];
			$firstshow = $row1['firstshow'];
			$secondshow = $row1['secondshow'];
			echo"<tr><td style='text-align:left;'>".$theater_name."</td><td>".$address."</td>";
			
			 $today = date('D j M Y');
			 $current_time = date("H:i");
			
			if($today == $movie_date)
			{
			    $movietime = date("H:i", strtotime($morning));
				
				$time_diff = $movietime - $current_time;
				
				if($time_diff <= 2)
				{
					echo"<td style='color:red;'>".$morning."</td>";
				}
				else
				{
					echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$morning&mdate=$mdate_code'>".$morning."</a></td>";
				}
			}
			else
			{
				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$morning&mdate=$mdate_code'>".$morning."</a></td>";
			}
			
			if($today == $movie_date)
			{
				$movietime = date("H:i", strtotime($matney));
				
				$time_diff = $movietime - $current_time;
				
				if($time_diff <= 2)
				{
					echo"<td style='color:red;'>".$matney."</td>";
				}
				else
				{
					echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$matney&mdate=$mdate_code'>".$matney."</a></td>";
				}
			}
			else
			{
				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$matney&mdate=$mdate_code'>".$matney."</a></td>";
			}
			
			if($today == $movie_date)
			{
				$movietime = date("H:i", strtotime($firstshow));
				
				$time_diff = $movietime - $current_time;
				
				if($time_diff <= 2)
				{
					echo"<td style='color:red;'>".$firstshow."</td>";
				}
				else
				{
					echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$firstshow&mdate=$mdate_code'>".$firstshow."</a></td>";
				}
			}
			else
			{
				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$firstshow&mdate=$mdate_code'>".$firstshow."</a></td>";
			}
			
			if($today == $movie_date)
			{
				$movietime = date("H:i", strtotime($secondshow));
				
				$time_diff = $movietime - $current_time;
				
				if($time_diff <= 2)
				{
					echo"<td style='color:red;'>".$secondshow."</td>";
				}
				else
				{

		if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$secondshow."</a></td></tr>";
		}
		else
		{
		   echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$secondshow&mdate=$mdate_code'>".$secondshow."</a></td></tr>";
		}
				}
			}
			else
			{
				if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$secondshow."</a></td></tr>";
		}
		else
		{
				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$secondshow&mdate=$mdate_code'>".$secondshow."</a></td></tr>";
			}
		
			}
		}
		echo"</table>";
	}
	?>
	</div>
	</div>
	</div>
<?php
}
if(isset($_POST['submittwo']))
{
	$location_id = $_POST['locationtwo'];
	$theater_id = $_POST['selecttheatertwo'];
	$movie_date = $_POST['mdatetwo'];
	$mdate_code = $movie_date;
	
    $sql1 = "select theatres.name Name1,theatres.address,assign_show.show_id,assign_show.morning,assign_show.matney,assign_show.morning,assign_show.firstshow,assign_show.secondshow,location.location,movies.id movie_id,movies.image,movies.cast,movies.name Name2 from assign_show join location on assign_show.fk_location_id = location.id join movies on assign_show.fk_movie_id = movies.id join theatres on assign_show.fk_theater_id = theatres.id where assign_show.fk_location_id = '$location_id' and assign_show.fk_theater_id = '$theater_id' order by show_id desc";
		
	if(!$result1 = mysql_query($sql1))
	{
		die("SQL ERROR :".mysql_error());
	}
	else
	{
	$row1 = mysql_fetch_array($result1);
	$id = $row1['show_id'];
	$theater_name = $row1['Name1'];
	$location_name = $row1['location'];
	$movie_name = $row1['Name2'];
	$address = $row1['address'];
	$morning = $row1['morning'];
	$matney = $row1['matney'];
	$firstshow = $row1['firstshow'];
	$secondshow = $row1['secondshow'];
	$movie_id = $row1['movie_id'];
	$imagename = $row1['image'];
	$cast = $row['cast'];
	?>
	<div class='content-wrapper'>
	<div class="left-content">
	<?php
	echo"<table  cellpadding='5'>";
	echo"<tr>";
	if($imagename != '')
	{
		echo "<td style='text-align:center;'>".$movie_date."<br/><br/><img src='uploads/".$imagename."' style='border:solid 5px #eee;box-shadow:2px 2px 2px #333 '/></td>";
	}
	else{ echo "<td style='text-align:center;'></td>"; }
	echo"<td>";
	if($cast != '')
	{
		echo"<br/><br/>".$cast;
	}
	echo"</td></tr>";
	echo"</table>";
	?>
	</div>
	<div class="right-content">
		<h2><?php echo $movie_name. "&nbsp;(U/A) - ". $movie_date; ?></h2>
	<div class="listmovie-wrapper">
	<?php
		echo"<table class='listmovies' cellspacing='5' cellpadding='8'>";
		echo"<tr>";
		echo"<th>Movie Name</th>";
		echo"<th>Address</th>";
		echo"<th>Morning</th>";
		echo"<th>Matney</th>";
		echo"<th>First Show</th>";
		echo"<th>Second Show</th>";
		echo"</tr>";
	?>
	<form method='post' name='myform' id='myform'>
	<input type='hidden' name='location' value='<?php echo $location_id?>'>
	<input type='hidden' name='selectmovies' value='<?php echo $movie_id?>'>
	<input type='hidden' name='mdate' value='<?php echo $movie_date?>'>
	</form>
	<?php
		echo"<tr><td>".$movie_name."</td><td>".$address."</td>";
		
		 $today = date('D j M Y');
	     $current_time = date("H:i");

	     $today_time=strtotime($today);
	     $movie_date_time=strtotime($movie_date);

		if($today == $movie_date)
		{

			 $movietime = date("H:i", strtotime($morning));
				
			 $time_diff = $movietime - $current_time;
				
			if($time_diff <= 2)
			{
				echo"<td style='color:red;'>".$morning."</td>";
			}
			else
			{
				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$morning&mdate=$mdate_code'>".$morning."</a></td>";
			}
		}
		else
			{
				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$morning&mdate=$mdate_code'>".$morning."</a></td>";
			}
		
		if($today == $movie_date )
		{
			$movietime = date("H:i", strtotime($matney));
				
			$time_diff = $movietime - $current_time;
				
			if($time_diff <= 2)
			{
				echo"<td style='color:red;'>".$matney."</td>";
			}
			else
			{

				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$matney&mdate=$mdate_code'>".$matney."</a></td>";
			   
			}
		}
		else
			{
	
				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$matney&mdate=$mdate_code'>".$matney."</a></td>";
			  
			}
		
		if($today == $movie_date )
		{
			$movietime = date("H:i", strtotime($firstshow));
				
			$time_diff = $movietime - $current_time;
				
			if($time_diff <= 2)
			{
				echo"<td style='color:red;'>".$firstshow."</td>";
			}
			else
			{

				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$firstshow&mdate=$mdate_code'>".$firstshow."</a></td>";

			}
		}
		else
			{

				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$firstshow&mdate=$mdate_code'>".$firstshow."</a></td>";
               
			}
		
		if($today == $movie_date)
		{
			$movietime = date("H:i", strtotime($secondshow));
				
			$time_diff = $movietime - $current_time;
				
			if($time_diff <= 2)
			{
				echo"<td style='color:red;'>".$secondshow."</td>";
			}
			else
			{

				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$secondshow&mdate=$mdate_code'>".$secondshow."</a></td>";
               
			}
		}
		else
			{
				
				
				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$secondshow&mdate=$mdate_code'>".$secondshow."</a></td>";
               			
			}
		
		echo"</table>";
	}
	?>
	</div>
	</div>
<?php
}
?>
</div>
</body>
</html>