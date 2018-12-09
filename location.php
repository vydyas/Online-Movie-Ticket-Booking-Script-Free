<?php
include('db/db.php');
include('frontend.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$frontend=new frontend();

//lcoation
$array=$frontend->getlocation();
  $size=sizeof($array);
  $t_size=$size;
  $i=0;
  $t=0;

if($_GET['url'])
{
$url=mysql_real_escape_string($_GET['url']);
$url=explode('/', $url);
$city=ucfirst($url[0]);
$locationquery=mysql_query("SELECT id FROM location where location='$city' ");
$location_row=mysql_fetch_array($locationquery);
$location_id=$location_row['id'];

$moviesquery=mysql_query("SELECT m.id,m.name,m.image,m.lang,ass.todate FROM assign_show ass LEFT JOIN movies m on m.id=ass.fk_movie_id WHERE ass.fk_location_id='$location_id' group by m.name order by ass.show_id desc");

}
else
{
echo '404 Not URL Available.';
}
?>

<!DOCTYPE HTML>
<html>
	<head>

		<title>Movie Tickets <?php echo $city; ?> Online Booking, Show Timings -CinemaChoodu</title>
		<meta property="og:title" content="Movie Tickets <?php echo $city; ?> Online Booking, Show Timings, Showtimes &amp; Prices-CinemaChoodu.com"/>
<meta property="og:description" content="Movie Tickets Online Booking , Movie Tickets Booking, <?php echo $city; ?> Movie Releases, Movies Schedule in <?php echo $city; ?>, <?php echo $city; ?> Movie Tickets rates, Theatre Hall, Movie Tickets Online at Cinemachoodu.com "/>
<meta name="keywords" content="Cinemachoodu,Movies Now Playing in <?php echo $city; ?>,book movie tickets online,how to buy movie tickets online,book movie tickets,online movie ticket booking,buy movie tickets online,buy movie tickets,buy tickets online,buy movies tickets,cinemas,movies in theaters,movie theaters,ticket booking,online ticket booking,Ticket Booking,Movie Reviews,Songs,Movie Tickets Online Booking , Movie Tickets Booking, <?php echo $city; ?> Movie Releases, Movies Schedule in <?php echo $city; ?>, <?php echo $city; ?> Movie Tickets rates, Theatre Hall, Movie Tickets Online at Cinemachoodu.com "/>
<meta property="og:site_name" content="CinemaChoodu.com"/>
<meta http-equiv="Pragma" Content="no-cache">
<meta http-equiv="Expires" Content="0">
<meta name="author" content="Cinema Choodu" />
<meta name="distribution" content="global" />
<meta name="robots" content="index, follow" />
<meta name="rating" content="general" />
<meta http-equiv="content-language" content="ll-cc">
		<meta name="description" content="Movie Tickets Online Booking ,Movies Now Playing in  <?php echo $city; ?>,<?php echo $city; ?> Movies,Theatres in srikakulam <?php echo $city; ?>, Movie Trailers,Movie Tickets Online at Cinemachoodu.com" />
		<link href="http://www.cinemachoodu.com/css/newui.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/png" href="http://www.cinemachoodu.com/favicon.ico"/>
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		</script>
		<!----webfonts---->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<!----//webfonts---->
		<!-- Global CSS for the page and tiles -->
  		<link rel="stylesheet" href="http://www.cinemachoodu.com/css/main.css">
		<script src="http://www.cinemachoodu.com/js/jquery.js"></script>
		<link href="http://www.cinemachoodu.com/select2.css" rel="stylesheet"/>
        <script src="http://www.cinemachoodu.com/select2.js"></script>
         <script>
        $(document).ready(function()
         {
		 $(".se-pre-con").fadeOut("slow");
            $("#location").select2();   
            $("#selectdate").select2();   
        });
    </script>

	</head>
	<body>
	<div class="se-pre-con"></div>
		<!---start-wrap---->
			<!---start-header---->
			<div class="header">
				<div class="wrap">
				<div class="logo">
					<a href="index.html"><img src="http://www.cinemachoodu.com/images/newui.png" title="Online Movie Ticket Booking" alt="Online Movie Ticket Booking" /></a>
				</div>
				<div class="nav-icon">
					<table>
						<tr>
							<td>
					<select style="width:150px" name="location" id="location">
                            <option value="">Select Location...</option>
                            <?php                
              while($size>0)
              {
            ?>
            <option value="<?php echo $array[$i]['id'];?>" <?php echo (($array[$i]['id']==$location_id)?"selected":""); ?>><?php echo $array[$i]['name'];?></option>
            <?php
              $size--;
              $i++;
            }
            ?>
                     </select>
							</td>
						</tr>
					</table>
					
                    
				</div>

				<div class="clear"> </div>
			</div>
		</div>
		<!---//End-header---->
		<!---start-content---->
		<div class="content">
			<div class="wrap">
			 <div id="main" role="main">
			 		<H1>Movies Now Playing in <?php echo $city; ?></h1><br/>
			      <ul id="tiles">
			        <!-- These are our grid blocks -->
			        <?php
			        $i=1;
			         while($row=mysql_fetch_array($moviesquery))
			        {

			        ?>
                    <li >
			        	<img src="http://cinemachoodu.com/uploads/<?php echo $row['image'];?>" alt=" <?php echo $row['name'];?> Movie Ticket Booking" title="<?php echo $row['name'];?> Online Movie Ticket Booking" id="movieimage<?php echo $i;?>" >
			        	<div class="post-info">
			        		<div class="post-basic-info">
			        		    <span id="movievalue<?php echo $i;?>" style="display:none"><?php echo $row['id']; ?></span>
				        		<h2><a href="#" id="movielink<?php echo $i;?>"><?php echo $row['name'];?></a></h2>
			        		</div>
			        	</div>
			        </li>
                     <?php
               echo "  <script>
               $(function()
               {

               	 $('#movieimage".$i."').click(function()
            {
            var mov_id=$('#movievalue".$i."').text();
            var loc=$('#location option:selected').text();
            var loc_id=$('#location').val();
            var link=$('#movielink".$i."').text();
            link=link.split(' ');
            link=link.join('-');
            self.location='http://cinemachoodu.com/'+loc+'/'+link+'/'+loc_id+'-'+mov_id+'.html';
            });

               });
                    
                    </script>";
                     $i++;

			         }
			        ?>
			        <li onclick="location.href='single-page.html';">
			        	<img src="http://cinemachoodu.com/images/songs.png"  title ="A to Z Movie Songs Download" alt ="A to Z Movie Songs Download" >
						<div class="post-info">
			        		<div class="post-basic-info">
				        		<h3><a href="#">Download Songs</a></h3>
			        		</div>
			        	</div>
					</li>
					<li onclick="location.href='single-page.html';">
			        	<img src="http://cinemachoodu.com/images/reviews.png"  alt ="Movie Reviews" title ="Movie Reviews" >
						<div class="post-info">
			        		<div class="post-basic-info">

				        		<h3><a href="#">Movie Reviews</a></h3>
			        		</div>
			        	</div>
					</li>


			        
			      </ul>
			    </div>
			</div>
		</div>
		<!---//End-content---->
		<!----wookmark-scripts---->
		  <script src="http://www.cinemachoodu.com/js/jquery.imagesloaded.js"></script>
		  <script src="http://www.cinemachoodu.com/js/jquery.wookmark.js"></script>
		  <script type="text/javascript">
		    (function ($){
		      var $tiles = $('#tiles'),
		          $handler = $('li', $tiles),
		          $main = $('#main'),
		          $window = $(window),
		          $document = $(document),
		          options = {
		            autoResize: true, // This will auto-update the layout when the browser window is resized.
		            container: $main, // Optional, used for some extra CSS styling
		            offset: 20, // Optional, the distance between grid items
		            itemWidth:280 // Optional, the width of a grid item
		          };
		      /**
		       * Reinitializes the wookmark handler after all images have loaded
		       */
		      function applyLayout() {
		        $tiles.imagesLoaded(function() {
		          // Destroy the old handler
		          if ($handler.wookmarkInstance) {
		            $handler.wookmarkInstance.clear();
		          }
		
		          // Create a new layout handler.
		          $handler = $('li', $tiles);
		          $handler.wookmark(options);
		        });
		      }
		      /**
		       * When scrolled all the way to the bottom, add more tiles
		       */
	
		      // Call the layout function for the first time
		      applyLayout();
		
		      // Capture scroll event.
		      $window.bind('scroll.wookmark', onScroll);
		    })(jQuery);
		  </script>
		<!----//wookmark-scripts---->
		<!----start-footer--->
		<div class="footer">
			<p>Design by <a href="http://facebook.com/siddhucse">Siddhu Vydyabhushana</a></p>
		</div>
		<!----//End-footer--->
		<!---//End-wrap---->
		<script type="text/javascript">
		$(function()
		{
            $('#location').change(function()
            {
                var loc_id=$('#location option:selected').text();
  

			self.location='http://cinemachoodu.com/movies/'+loc_id;

     
            });

		});
		</script>
		<?php
include('googleanalytics.php');
  ?>
	</body>
</html>