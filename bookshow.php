<!DOCTYPE html>
    <head>
    <?php
    if(isset($_GET['location']))
    {
    ?>
        <link rel="shortcut icon" type="image/png" href="../../favicon.ico"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href="../../site1.css" rel="stylesheet"/>
		<link href="../../select2.css" rel="stylesheet"/>
		<meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" name="viewport" />
		<script src="../../jquery-1.8.0.min.js"></script>   
		<script src="../../select2.js"></script>
		<script src="../../form3.js"></script>
	<?php
    }
    else
    {
    ?>
     <title>Cinemachoodu - Book Show</title>
        <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href="site1.css" rel="stylesheet"/>
		<link href="select2.css" rel="stylesheet"/>
		<meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" name="viewport" />
		<script src="jquery-1.8.0.min.js"></script>   
		<script src="select2.js"></script>
		<script src="form.js"></script>

    <?php
    }
	?>
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
  <div class="header">
        <div class="wrap">
        <div class="logo">
          <a href="index.html"><img src="images/newui.png" title="Online Movie Ticket Booking" alt="Online Movie Ticket Booking"></a>
        </div>
        <div class="nav-icon">
                    <table>
            <tbody><tr>
              <td id="menu"><a href="theatres.php" >Theatres</a></td>
                <td id="menu"><a href="movies.php">Movies</a></td>
                <td id="menu"><a href="trailers.php">Trailers</a></td>
                <td id="menu"><a href="#events" class="popup" data-toggle="modal">Events</a></td>
                <td id="menu"><a href="#">Help</a></td>
                <td style="padding:5px;"><a href="#"><img src="images/addtheatre.png" width="" height="30px" title="Add Your Own Theatre" alt="Online Movie Ticket Booking"></a></td>
         
            </tr>
          </tbody></table>
        </div>

        <div class="clear"> </div>
      </div>
    </div>
  <?php
	include_once('smallform.php');
	?>
  <div class="container">
	<div class='content'>

  <?php

  if(@$_GET['location'])
{
$url=mysql_real_escape_string($_GET['location']);
$url=explode('/', $url);
$locationname=$url[0];
$moviename=$url[1];
$url=$url[2];
$url=explode('-', $url);

	$location_id = $url[0];
	$movie_id = $url[1];
    $movie_date = date('D j M Y');
	$mdate_code = base64_encode($movie_date);

	?>
<title><?php echo $moviename; ?> <?php echo $locationname; ?> Show Timings,Show Times,Tickets & Shows <?php echo $locationname; ?> Ticket Online Booking</title>
<meta property="og:title" content="<?php echo $moviename; ?> <?php echo $locationname; ?> Show Timings,Show Times,Tickets & Shows <?php echo $locationname; ?> Ticket Online Booking"/>
<meta property="og:description" content="<?php echo $moviename; ?> Movie <?php echo $locationname; ?> Show Timings, Showtimes, Tickets &amp; Film shows in <?php echo $locationname; ?>. <?php echo $moviename; ?> Movie Release date &amp; Online Ticket Booking. Cinema Halls &amp; Theatre Tickets Rates &amp; Price "/>
<meta name="keywords" content="Ticket Booking,Movie Reviews,Songs,Movie Tickets Online Booking , Movie Tickets Booking, <?php echo $city; ?> Movie Releases, Movies Schedule in <?php echo $city; ?>, <?php echo $city; ?> Movie Tickets rates, Theatre Hall, Movie Tickets Online at Cinemachoodu.com "/>
<meta property="og:site_name" content="CinemaChoodu.com"/>
<meta http-equiv="Pragma" Content="no-cache">
<meta http-equiv="Expires" Content="0">
<meta name="author" content="Siddhu Vydyabhushana" />
<meta name="distribution" content="global" />
<meta name="robots" content="index, follow" />
<meta name="rating" content="general" />
<meta name="description" content="<?php echo $moviename; ?> Movie <?php echo $locationname; ?> Show Timings, Showtimes, Tickets &amp; Film shows in <?php echo $locationname; ?>. <?php echo $moviename; ?> Movie Release date &amp; Online Ticket Booking. Cinema Halls &amp; Theatre Tickets Rates &amp; Price " />

	<?php
	$sql1 = "select theatres.status,theatres.name Name1,theatres.address,assign_show.show_id,assign_show.morning,assign_show.matney,assign_show.morning,assign_show.firstshow,assign_show.secondshow,location.location,movies.name Name2 from assign_show join location on assign_show.fk_location_id = location.id join movies on assign_show.fk_movie_id = movies.id join theatres on assign_show.fk_theater_id = theatres.id where assign_show.fk_location_id = '$location_id' and assign_show.fk_movie_id = '$movie_id' and assign_show.todate>=curdate()";

	if(!$result1 = mysql_query($sql1))
	{
		die("SQL ERROR :".mysql_error());
	}
	else
	{

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
		echo "<td style='text-align:center;'><img src='../../uploads/".$imagename."' width='120px' heigth='160px' style='border:solid 5px #eee;box-shadow:2px 2px 2px #333 '/></td>";
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
		if(mysql_num_rows($result1)>0)
		{
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
			$status=$row1['status'];

			echo"<tr style='border-bottom:solid 1px #3399ff'><td style='text-align:left;'>".$theater_name." Theatre</td>";
			
			 $today = date('D j M Y');
			 $current_time = date("H:i");
			if($status==1)
			{

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
					if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$morning."</a></td>";
		}
		else
		{
				echo"<td><a onlcick='document.forms[myform].submit()' href='../../showbookings.php?id=$id&time=$morning&mdate=$mdate_code'>".$morning."</a></td>";
			}

				}
			}
			else
			{
				if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$morning."</a></td>";
		}
		else
		{
				echo"<td><a onlcick='document.forms[myform].submit()' href='../../showbookings.php?id=$id&time=$morning&mdate=$mdate_code'>".$morning."</a></td>";
			}
	
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
					if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$matney."</a></td>";
		}
		else
		{
				echo"<td><a onlcick='document.forms[myform].submit()' href='../../showbookings.php?id=$id&time=$matney&mdate=$mdate_code'>".$matney."</a></td>";
			}

					
				}
			}
			else
			{
				if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$matney."</a></td>";
		}
		else
		{
				echo"<td><a onlcick='document.forms[myform].submit()' href='../../showbookings.php?id=$id&time=$matney&mdate=$mdate_code'>".$matney."</a></td>";
			}

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
					if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$firstshow."</a></td>";
		}
		else
		{
            echo"<td><a onlcick='document.forms[myform].submit()' href='../../showbookings.php?id=$id&time=$firstshow&mdate=$mdate_code'>".$firstshow."</a></td>";
			}
				}
			}
			else
			{
									if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$firstshow."</a></td>";
		}
		else
		{
            echo"<td><a onlcick='document.forms[myform].submit()' href='../../showbookings.php?id=$id&time=$firstshow&mdate=$mdate_code'>".$firstshow."</a></td>";
			}
			
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
		   echo"<td><a onlcick='document.forms[myform].submit()' href='../../showbookings.php?id=$id&time=$secondshow&mdate=$mdate_code'>".$secondshow."</a></td></tr>";
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
				echo"<td><a onlcick='document.forms[myform].submit()' href='../../showbookings.php?id=$id&time=$secondshow&mdate=$mdate_code'>".$secondshow."</a></td></tr>";
			}
		
			}
		}
		else
		{
			echo "<td style='color:red' colspan=4>Sorry ,Bookings Closed</td>";
		}
		}
	}
	else
	{
		echo "<script>self.location='../../404.php'</script>";
	}
		echo"</table>";
	}
	
	?>
	</div>
	</div>
	</div>
<?php
}
if(isset($_POST['submitone']))
{
	$location_id = $_POST['location1'];
	$movie_id = $_POST['selectmovies'];
    $movie_date = $_POST['mdate'];
	$mdate_code = base64_encode($movie_date);
	
	$sql1 = "select theatres.status,theatres.name Name1,theatres.address,assign_show.show_id,assign_show.morning,assign_show.matney,assign_show.morning,assign_show.firstshow,assign_show.secondshow,location.location,movies.name Name2 from assign_show join location on assign_show.fk_location_id = location.id join movies on assign_show.fk_movie_id = movies.id join theatres on assign_show.fk_theater_id = theatres.id where assign_show.fk_location_id = '$location_id' and assign_show.fk_movie_id = '$movie_id' and assign_show.todate>=curdate()";


if(!$result1 = mysql_query($sql1))
	{
		die("SQL ERROR :".mysql_error());
	}
	else
	{

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

		if(mysql_num_rows($result1)>0)
		{
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
			$status=$row1['status'];

			echo"<tr><td style='text-align:left;'>".$theater_name."</td>";
			
			 $today = date('D j M Y');
			 $current_time = date("H:i");
			if($status==1)
			{
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
					if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$morning."</a></td>";
		}
		else
		{
			echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$morning&mdate=$mdate_code'>".$morning."</a></td>";
		}
				}
			}
			else
			{
				if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$morning."</a></td>";
		}
		else
		{
			echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$morning&mdate=$mdate_code'>".$morning."</a></td>";
		}
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
					if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$matney."</a></td>";
		}
		else
		{
			echo "<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$matney&mdate=$mdate_code'>".$matney."</a></td>";
		}
				
				}
			}
			else
			{
				if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$matney."</a></td>";
		}
		else
		{
			echo "<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$matney&mdate=$mdate_code'>".$matney."</a></td>";
		}
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
					if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$firstshow."</a></td>";
		}
		else
		{
			echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$firstshow&mdate=$mdate_code'>".$firstshow."</a></td>";
		}
					
				}
			}
			else
			{
				if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$firstshow."</a></td>";
		}
		else
		{
			echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$firstshow&mdate=$mdate_code'>".$firstshow."</a>";
		}
					
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
             echo "<td><a href='".$link."' target='_blank'>".$secondshow."</a></td>";
		}
		else
		{
		   echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$secondshow&mdate=$mdate_code'>".$secondshow."</a></td>";
		}
				}
			}
			else
			{
				if($type==2)
		{
             echo "<td><a href='".$link."' target='_blank'>".$secondshow."</a></td>";
		}
		else
		{
				echo"<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$secondshow&mdate=$mdate_code'>".$secondshow."</a></td>";
			}
		
			}
		}
		else
		{
			echo "<td style='color:red'>Sorry ,Bookings Closed</td>";
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
?>

</div>
<?php
include('googleanalytics.php');
  ?>
</body>
</html>
