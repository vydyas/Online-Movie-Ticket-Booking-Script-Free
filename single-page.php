<!DOCTYPE HTML>
<html>
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
    <title>CinemaChoodu | Online movie ticket booking</title>
		<link href="newui/web/css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/png" href="favicon.ico"/>
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		</script>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<script src="newui/web/js/jquery.min.js"></script>
		<script src="http://malsup.github.io/jquery.blockUI.js"></script>
       	<link href="select2.css" rel="stylesheet"/>
        <script src="select2.js"></script>
        <script src="form.js"></script>
         <script>
        $(document).ready(function()
         {
         	$("#location1").select2();   
            $("#selectmovies").select2();   
            $("#mdate").select2(); 
        });
    </script>
    <?php
    }
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
  ?>
		
	</head>
	<body>
			<div class="header">
				<div class="wrap">
				<div class="logo">
					<a href="index.php"><img src="newui/web/images/logo.png" title="Online Movie Ticket Booking"  /></a>
				</div>
				<div class="nav-icon">
				<form method="post" action="single-page.php" name="formone" onsubmit="return vaidateMovie()">
					<select style="float:left;width:150px;margin:0 5px;" name="location1" id="location1">
						<option value="">Select Location...</option>
						<?php                
							while($size>0)
							{
								if($array[$i]['id']==$_POST['location1'])
								{
						?>
						<option value="<?php echo $array[$i]['id'];?>" selected><?php echo $array[$i]['name'];?></option>
						<?php
					             }
					             else
					             {
					             	?>
					       <option value="<?php echo $array[$i]['id'];?>"><?php echo $array[$i]['name'];?></option>

					             	<?php
					             }
							$size--;
							$i++;

						}
						?>
					</select>
					<select style="float:left;width:150px;margin:0 5px;" name="selectmovies" id="selectmovies">
						<option value="">Select Movies...</option>
					</select>
					<select style="float:left;width:150px;margin:0 5px;" name="mdate" id="mdate">
						<option value="">Select Date...</option>
					   <!--<option value='<?php echo $today ?>'><?php echo $today; ?></option>
					   <option value='<?php echo $tomorrow ?>'><?php echo $tomorrow; ?></option>
					   <option value='<?php echo $dayAftT ?>'><?php echo $dayAftT; ?></option>-->
					</select>
					<input type="submit" id="submit" name='submitone' value="Search Theatres" style="float:left;">
					</form>
				</div>       	  

				<div class="userinfo">
					<div class="user">
						<ul>
						  <li>
						  </li>
						</ul>
					</div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		<!---//End-header---->
		<!---start-content---->
<?php
if(isset($_POST['submitone']))
{
		$location_id = $_POST['location1'];
	$movie_id = $_POST['selectmovies'];
    $movie_date = $_POST['mdate'];
   $movie_date = date("D j M Y", strtotime($movie_date));
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
		$typesql="SELECT t.type,l.link FROM theatres t LEFT JOIN links l on l.fk_theater_id=t.id WHERE t.id='$theater_id' order by l.id desc";
		$typesqlresult=mysql_query($typesql);
		$typerow=mysql_fetch_array($typesqlresult);

        $type=$typerow['type'];
		$link=$typerow['link'];

	}
	
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
	?>
		<div class="content">
			<div class="wrap">
			<div class="single-page">
							<div class="single-page-artical">
								<div class="artical-content">
									<div id="articleinfo">
									<?php
									if($imagename != '')
	{
		echo "<img src='uploads/".$imagename."' /><br/><br/>";
	}
										//	echo "Telugu - Dec 05 2014 - U/A<br/><br/>";
										//	echo "<b>Cast:</b>&nbsp;Avika Gor,Naga Shourya<br/><br/>";
										//	echo "<b>Genre:</b>&nbsp;Romance";
									?>
										</div>
                                     <div id="cinematiming">
									<h1 style="font-size:25px"><?php echo strtoupper($name); ?></h1><br/>

                            		<table class="timeselect">
	
<?php
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

			echo"<tr><td style='text-align:left;' colspan=4>".strtoupper($theater_name)." THEATRE &nbsp;-&nbsp;".$movie_date."</td></tr>";
			echo "<tr>";
			
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
					echo"<td style='color:red;padding:3px;'>".$morning."</td>";
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
			echo "<td><a onlcick='document.forms[myform].submit()' href='showbookings.php?id=$id&time=$morning&mdate=$mdate_code'>".$morning."</a></td>";
		}
			}
			
			if($today == $movie_date)
			{
				$movietime = date("H:i", strtotime($matney));
				
				$time_diff = $movietime - $current_time;
				
				if($time_diff <= 2)
				{
					echo"<td style='color:red;padding:3px;'>".$matney."</td>";
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
					echo"<td style='color:red;padding:3px;'>".$firstshow."</td>";
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
					echo"<td style='color:red;padding:3px;'>".$secondshow."</td>";
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
			echo "<td style='color:red'>Sorry , No Tickets Available</td>";
		}
		}
		echo "</tr>";
	}
  ?>                          
								</table>

                        
                           

									</div>
								 </div>
								        <div id="cinematiming">
									<h3 style="color:#3399ff;font-size:20px">Songs</h3><br/>

                            <div>

                            </div>
                            <div>
                            <table class="timeselect1">
<?php
$songsquery=mysql_query("SELECT * FROM songs WHERE fk_movieid='$movie_id'");
while($songsrow=mysql_fetch_array($songsquery))
{
?>
									<tr>
										<td valign="top">
												<?php echo $songsrow['name']?>..&nbsp;&nbsp;
										</td>
										<td>
												<a href="<?php echo $songsrow['downloadlink'];?>" target="_blank">Download</a>&nbsp;&nbsp;
										</td>
									</tr>
<?php
}
?>
								</table>

                            </div><br/>

									</div>
								 </div>
		  						 <div class="clear">
		  						 	
		  						 </div>
							</div>
							<!---start-comments-section
							<div class="comment-section">
				<div class="grids_of_2">
					<h2>User Review</h2>
					<div class="grid1_of_2">
						<div class="grid_img">
							<a href=""><img src="images/pic10.jpg" alt=""></a>
						</div>
						<div class="grid_text">
							<h4 class="style1 list"><a href="#">Uku Mason</a></h4>
							<h3 class="style">march 2, 2013 - 12.50 AM</h3>
							<p class="para top"> All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
						</div>
						<div class="clear"></div>
					</div>
					<div class="grid1_of_2">
						<div class="grid_img">
							<a href=""><img src="images/pic12.jpg" alt=""></a>
						</div>
						<div class="grid_text">
							<h4 class="style1 list"><a href="#">Ro Kanth</a></h4>
							<h3 class="style">march 2, 2013 - 12.50 AM</h3>
							<p class="para top"> All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
						</div>
						<div class="clear"></div>
					</div>								
						<div class="artical-commentbox">
						 	<h2>Leave a Comment</h2>
				  			<div class="table-form">
								<form action="#" method="post" name="post_comment">
									<div>
										<label>Name<span>*</span></label>
										<input type="text" value=" ">
									</div>
									<div>
										<label>Email<span>*</span></label>
										<input type="text" value=" ">
									</div>
									<div>
										<label>Your Comment<span>*</span></label>
										<textarea> </textarea>	
									</div>
								</form>
								<input type="submit" value="submit">
									
							</div>
							<div class="clear"> </div>
				  		</div>			
					</div>
			</div>
							<!---//End-comments-section--->
						</div>-->
						 </div>
		</div>
<?php
}
?>
		<div class="footer">
		</div>

	</body>
</html>