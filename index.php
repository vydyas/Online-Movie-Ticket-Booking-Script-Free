<!DOCTYPE HTML>
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

/*
  $today = date('D-d-M,Y');
  $tomorrow = date('D-d-M,Y', time()+86400);
  $dayAftT = date('D-d-M,Y', time()+172800);*/

?>
<html>
    <head>

    <?php
    include('metatags/seo.php');
    ?>
    <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
    <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
    <link href="css/style1.css" rel="stylesheet"/>
    <link href="select2.css" rel="stylesheet"/>
    <link href="site.css" rel="stylesheet"/>
    <script src="jquery-1.8.0.min.js"></script>    
    <script src="http://malsup.github.io/jquery.blockUI.js"></script>
    <script src="select2.js"></script>
    <script src="menu.js"></script>
    <script>
        $(document).ready(function()
         {
            $("#location").select2();   
        });
    </script>

    </head>
    <body>
     <div class="bar">
     <nav class="menu">
     <ul class="active">
       <li><a href="index.php" class="active">&#x2302; Home</a></li>
       <li><a href="movies/tekkali" target="_blank">&#9738; Now Playing</a></li>
       <li><a href="#">&#8673; Upcoming</a></li>
       <li><a href="#">&#9835; Songs </a></li>
       <li><a href="#">&#9707; Reviews</a></li>
       <li><a href="#">&#9707; Trailers</a></li>
       <!--<li><a href="#">&#9655; More
       <ul>
          <li><a href="#">&#9655; Why CinemaChoodu?</a></li>
       <li><a href="#">&#9655; Careers</a></li>
       <li><a href="#">&#9655; Contact</a></li>
       </ul>
       </li>-->
       <li>
        
       </li>
      
     </ul>
      <!--<script>
  (function() {
    var cx = '006821288459539833635:vzl9gvmaomq';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>-->
      <a class="toggle-nav" href="#"><img src="menu.png" alt="menu cinemachoodu" Title="Menu"></a>
      <!-- <form class="search-form">
        <input type="text">
        <button>Search</button>-->
    </form>
     </nav>
     </div>
<CENTER><h1 style="color:#fff;font-size:35px">Discover Best Theaters to Watch Movies Around You</h1></CENTER>
     <center style="margin-top:17px;">
      <table>
        <tr>
          <td>
      <center>
  </center>   
      </div> 
          </td>
           <td style="background:transparent !important">
<div class="asdf">
      <center><img src="images/logo2.jpg" title="CinemaChoodu.com Online Movie ticket Booking" alt="CinemaChoodu.com Online Movie ticket Booking" width=286px height=100px></center>
          <div class='content'>
  <div class="indexform">
   <table>
   <!-- <tr>
      <td class='itab' id='tabMovie'>Movies</td><td class='itab' id='tabTheater'>Theater</td>
    </tr>-->
    <tr>
      <td style="background:transparent !important;" colspan="2">
        <div style="padding:15px;border:solid 1px #bdbdbd;margin-top:-4px">
          <div id="movieform">
          <form method="POST" action="bookshow.php" name="formone" onsubmit="return vaidateMovie()">
          <select style="width:100%;" name="location1" id="location1">
            <option value="">Select Location...</option>
            <?php                
              while($size>0)
              {
            ?>
            <option value="<?php echo $array[$i]['id'];?>"><?php echo $array[$i]['name'];?></option>
            <?php
              $size--;
              $i++;
            }
            ?>
          </select><br/><br/>
          <select style="width:100%" name="selectmovies" id="selectmovies">
            <option value="">Select Movies...</option>
          </select><br/><br/>
          <select style="width:100%" name="mdate" id="mdate">
            <option value="">Select Date...</option>
          </select><br/><br/>
          <input type="submit" id="submit" name='submitone' value="Proceed">
          </form>
      
          </div>

         <!-- <div id="theaterform">
          <form method="POST" action="bookshow.php" name='formtwo' onsubmit="return vaidateTheater()">
          <select style="width:300px;" name="locationtwo" id="locationtwo">
            <option value="">Select Location...</option>
            <?php
            $sql = "select * from location";
            $result = mysql_query($sql);
            while($row = mysql_fetch_array($result))
            {
              $id = $row['id'];
              $lname = $row['location'];
              echo"<option value='$id'>".$lname."</option>";
            }
            ?>
          </select><br/><br/>
          <select style="width:300px;" name="selecttheatertwo" id="selecttheatertwo">
            <option value="">Select Theater...</option>
          </select><br/><br/>
          <select style="width:300px;" name="mdatetwo" id="mdatetwo">
            <option value="">Select Date...</option>
          </select><br/><br/>
          <input type="submit" id="submit" name='submittwo' value="Proceed">
          </form>
          </div>-->


        </div>
      </td>
      </tr>
    </table>
  </div>
  </div>
  <center>
      <table><tr><td><input type='button' name='printtckt' id='printtckt' value='Print Your Ticket'>&nbsp;&nbsp;</td>
        <td><input type='button' name='sendid' id='sendid' value='SMS Your Ticket'></td>
      </tr></table>
    <div id='printform' style='display:none;'>
      <span id='close'>X</span>
      Print Ticket
      <form method='post' action='printyourticket'>
      <input type='text' name='mobile' id='mobile' placeholder='Enter Mobile No' /><br/>
      <input type='text' name='bookid' id='bookid' placeholder='Enter Booking ID' /><br/>
      <input type='submit' name='printsubmit' id='printsubmit' value='Submit' />
      </form>
  </center>   
      </div> <br/>
      <h2 style="display:none">Movie ShowTimes, Online Tickets, Movie Reviews, Songs and more...</h2>
      <h3 style="display:none">Movie ShowTimes, Online Tickets, Movie Reviews, Songs and more...</h3>
      <div id='printform1' style='display:none;'>
<!--      <span id='closes'>X</span>-->
      Coming Soon...
  </center>   
      </div> 
          </td>
</tr>
</table><br/>
</center>    
  <script src="script.js"></script>
  <script src="form.js"></script>
  
  <?php
      include('googleanalytics.php');
  ?>

    </body>
</html>