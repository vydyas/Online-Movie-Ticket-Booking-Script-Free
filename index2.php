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
    
    <script src="select2.js"></script>
    <script>
        $(document).ready(function()
         {
            $("#location").select2();   
            $("#location1").select2();   
            $("#movies").select2();
            $("#theatres").select2();
            $('#movies').prop('disabled', 'disabled');
            $('#theatres').prop('disabled', 'disabled');

            var location=$("#location").val();

            var location1=$("#location1").val();


            $('#location').change(function()
            {

              var id=$(this).val();
              $('.modal-bodys').html(" ");
              var dataString = 'id='+ id;
              $('#movies').val('');
              $.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$("#movies").html(html);
if($("#movies").val())
{

$('#movies').removeAttr('disabled');
}
else
{
 $('#movies').prop('disabled', 'disabled'); 
 return false;
}
}

});

            });

            $('#location1').change(function()
            {
              var id=$(this).val();


              var dataString = 'id='+ id;
              $.ajax
({
type: "POST",
url: "ajax_theatre.php",
data: dataString,
cache: false,
success: function(html)
{
$("#theatres").html(html);
if($("#theatres").val())
{
$('#theatres').removeAttr('disabled');
}
else
{
 $('#theatres').prop('disabled', 'disabled'); 
 return false;
}
}

});

            });
        });
    </script>

    </head>
    <body>
         <center>
      <img src="images/logo1.jpg" width=286px height=100px id="logo"><img src="images/contact.png" style="margin-left:100px;">

     </center>
     <center style="margin-top:10px;">
      <table>
        <tr>
           <td style="background:transparent !important">
       <div style="padding:15px;margin-left:5px;width:300px;border:solid 1px #eee">
        <button id="movies_cinemachoodu">Movies</button>&nbsp;<button id="theatres_cinemachoodu">Theatres</button><br/>
        <hr size=1 color="#eee"/>
        <br/>
        <span style="color:red;font-size:20px">Search By</span>&nbsp;<span id="selection" style="font-size:20px"></span><br/><br/>
      <div id="mm">
        <select style="width:300px;" name="location" id="location">

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
        <select style="width:300px;" name="movies" id="movies">
          <option value="">Select Movies...</option>
        </select><br/><br/>
        <a href="#myModals" class="popup" id="submit" data-toggle="modal">Search Theatres</a>
        <br/><br/>
      </div>
          <form action="movies-search.php" method="post" id="tt">
        <select style="width:300px;" name="location1" id="location1">

                   <option value="">Select Location...</option>
   <?php                
    while($t_size>0)
  {
    ?>
         <option value="<?php echo $array[$t]['id'];?>"><?php echo $array[$t]['name'];?></option>
<?php
         
   $t_size--;
   $t++;
  }

  ?>

        </select><br/><br/>
        <select style="width:300px;" name="theatres" id="theatres">
          <option  value="">Select Theatres...</option>

        </select><br/><br/>
        <button id="submit_theatre">Search Movies</button><br/><br/>
        </form>
      </div>  
          </td>
          <td>

      <table>
              <tr>
                <td id="menu"><a href="theatres.php" >Theatres</a></td>
                <td id="menu"><a href="movies.php">Movies</a></td>
                <td id="menu"><a href="trailers.php">Trailers</a></td>
                <td id="menu"><a href="#">Mobile App</a></td>
                <td id="menu"><a href="#">Help</a></td>
              </tr>
              <tr>
                <td colspan=5>
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
              
          </td>
          <td style="background:transparent !important">
            <div id="fb">
     <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FCinemachoodu%2F349493561842438&amp;width&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=true&amp;appId=673893932704718" scrolling="no" frameborder="0" style="border:none; overflow:hidden;width:326px; height:290px;" allowTransparency="true"></iframe>
          </div>
          </td>

        </tr>
      </table>
    </center>
    
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
<script type="text/javascript" src="engine1/wowslider.js"></script>
  <script type="text/javascript" src="engine1/script.js"></script>
  <script type="text/javascript" src="js/jquery.elastislide.js"></script>
    <script type="text/javascript">
      
      $( '#carousel' ).elastislide();
      
    </script>

    </body>
</html>

