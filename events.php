<?php
include('db/db.php');
include('frontend.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$query="SELECT * FROM movies ORDER BY id DESC";
$result=mysql_query($query);

$frontend=new frontend();

$array2=$frontend->recent();
  $size2=sizeof($array2);
   
  $d=0;
  $k=1;

?>
<html>
    <head>
        <title>Searh Events Online</title>
        <link rel="stylesheet" href="modal.css">
        <script src="js/jquery.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <style type="text/css">
        body{font-family: calibri;}
 
        </style>
        <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="jquery-1.8.0.min.js"></script>
   
    </head>
    <body style="background:#eee">
<div class="header">
        <div class="wrap">
        <div class="logo">
          <a href="index.html"><img src="images/newui.png" title="Online Movie Ticket Booking" alt="Online Movie Ticket Booking"></a>
        </div>
        <div class="nav-icon">
                    <table>
            <tbody><tr>
               <td id="menu"><a href="index3.php">trailers</a></td>
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
     <center>
     <br/>
     <!--<nav class="menu">
           <ul class="active">
            <li><a href="index.php">Home</a></li>
            <li><a href="movies.php">Movies</a></li>
            <li><a href="theatres.php">Theatres</a></li>
            <li><a href="trailers.php">Trailers</a></li>
            <li><a href="moibile-app.php">Mobile App</a></li>
            <li style="float:right;margin-right:10px;"><input type="text" class="filterinput" style="padding:3px;width:250px;" placeholder="Search Movies.." ></li>

           </ul>
          </nav>-->
          
          <div>
          
             <?php
             $m=0;
      while($size2>0)
      {
        $m++;
        $id=$array2[$d]['id'];
        $query=mysql_query("SELECT youtube FROM trailers WHERE movie_id='$id'");
        $result=mysql_fetch_array($query);
      ?>
          <a href="#myModal" class="popup" id="<?php echo $result['youtube']; ?>" data-toggle="modal"><img src="uploads/<?php  echo $array2[$d]['image']; ?>" alt="image01" width=135px height=180px/></a>&nbsp;
      <?php
      $size2--;
   $d++;
   if($m%8==0)
      {
        ?>
        <br/><br/>
        <?php
      }
      }
      
      ?>
    <br/>
    </div>
    </center>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Movie Trailer</h4>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(function()
{
  $('.popup').click(function()
  {
    var id=$(this).attr("id");
    var url="//www.youtube.com/embed/"+id;
    var iframe='<iframe width="560" height="315" src='+url+' frameborder="0" allowfullscreen></iframe>';
    $('.modal-body').html(iframe);

  });
});
</script>
    </body>
</html>


