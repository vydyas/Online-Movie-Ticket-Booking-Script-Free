<!DOCTYPE HTML>
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

//slider
$array1=$frontend->slider();
  $size1=sizeof($array1);
   
  $s=0;
  $j=1;

//carousel
$array2=$frontend->recent();
  $size2=sizeof($array2);
   
  $d=0;
  $k=1;
?>
<html>
    <head>
        <title>Searh Movie Theatres Online</title>
        <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
    <link href="css/style1.css" rel="stylesheet"/>
    <link href="select2.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
    <link rel="stylesheet" type="text/css" href="Elastislide/css/elastislide1.css" />
    <link rel="stylesheet" type="text/css" href="Elastislide/css/custom.css" />
    <link rel="stylesheet" href="modal.css">
    <script src="jquery-1.8.0.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="js/modernizr.custom.17475.js"></script>
    <script src="http://malsup.github.io/jquery.blockUI.js"></script>
    
    <script src="select2.js"></script>
    <script>
        $(document).ready(function()
         {
            $("#location").select2();   
          
            });
    </script>

    </head>
    <body>
        <div class="header">
        <div class="wrap">
        <div class="logo">
          <a href="index.html"><img src="images/newui.png" title="Online Movie Ticket Booking" alt="Online Movie Ticket Booking"></a>
        </div>
        <div class="nav-icon">
                    <table>
            <tbody><tr>
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
    <div class="clear"> </div>
    <br/>
     <center style="margin-top:-10px;">
      <table>
        <tr>
           <td style="background:transparent !important">
           <div style="padding:15px;margin-left:5px;width:300px">
<span style="color:red;font-size:20px">Search By</span>&nbsp;<span id="selection" style="font-size:20px"></span><br/><br/>
 <form method="POST" action="single-page.php" name="formone" onsubmit="return vaidateMovie()">
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
          </td>
          <td>

                  <!--<img src="images/aaa.png" height=245px width=610px>-->
                  <div id="wowslider-container1">
  <div class="ws_images">
<ul>
  <?php
   while($size1>0)
  {
  ?>
<li><img src="slider/<?php  echo $array1[$s]['image']; ?>" alt="213" title="213" id="wows1_0" width=612px height=248px/></li>
<?php
$size1--;
         $s++;
}

?>
</ul></div>
  </div>
              
          </td>
        </tr>
      </table>
    </center>
    <div class="footer">
  <div id="left">
   Trailers
    </div>
</div>
    
        <ul id="carousel" class="elastislide-list">
            <?php
      while($size2>0)
      {
        $id=$array2[$d]['id'];
        $query=mysql_query("SELECT youtube FROM trailers WHERE movie_id='$id'");
        $result=mysql_fetch_array($query);
      ?>

          <li><a href="#myModal" class="popup" id="<?php echo $result['youtube']; ?>" data-toggle="modal"><img src="uploads/<?php  echo $array2[$d]['image']; ?>" alt="image01" width=135px height=180px/></a></li>
      <?php
      $size2--;
   $d++;
      }
      ?>
        </ul>
<div class="footer">
  <div id="left">
    Copyrights @Your Company Name 2015
    </div>
  <div id="right">
    <input type="text" name="subscribeEmail" id="subscribeEmail" placeholder="Enter Email Id or Mobile No"/>
    <input type="button" name="subscribe" id="subscribe" value=">" >
  </div>
</div>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Movie Trailer</h4>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="events" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Events Online Booking</h4>
                </div>
                <div class="modal-bodys">
                    Coming Soon
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="myModals" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Movie Information</h4>
                </div>
                <div class="modal-bodys">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(function()
{
  $('#selection').html('<b>Location</b>');
  $('.popup').click(function()
  {
    var id=$(this).attr("id");
    var url="//www.youtube.com/embed/"+id;
    var iframe='<iframe width="560" height="315" src='+url+' frameborder="0" allowfullscreen></iframe>';
    $('.modal-body').html(iframe);

  });
  $('#movies_cinemachoodu').click(function()
  {
    $('#tt').hide();
    $('#mm').show();
    $('#selection').html('<b>Movies</b>');


  });
  $('#theatres_cinemachoodu').click(function()
  {
    $('#mm').hide();
    $('#tt').show();
    $('#selection').html('<b>Theatres</b>');


  });

  $('#submit').click(function()
  {
    var location=$('#location').val();
    var movies=$('#movies').val();

     if(location=='')
    {
      alert("Please Select Location...");
      return false;
    }
     if(movies=='')
    {
      alert("Select Movie...");
      return false;
    }
    if(location=='' && movies=='')
    {
      alert("Select Location & Movies...");
      return false;
    }

    $.post("load.php",
    {
      location:location,
      movies:movies
    },
    function(data,status)
    {
      $('.modal-bodys').html(data);
    });
   

  });
  
});
</script>
  <script src="script.js"></script>
  <script src="form.js"></script>

<script type="text/javascript" src="engine1/wowslider.js"></script>
  <script type="text/javascript" src="engine1/script.js"></script>
  <script type="text/javascript" src="js/jquery.elastislide.js"></script>
    <script type="text/javascript">
      
      $( '#carousel' ).elastislide();
      
    </script>

    </body>
</html>

