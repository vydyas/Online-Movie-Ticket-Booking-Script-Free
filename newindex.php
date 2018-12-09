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

?>
<html>
    <head>
        <title>Searh Movie Theatres Online</title>
        <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
    <link href="css/style.css" rel="stylesheet"/>
    <link href="select2.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
    <link rel="stylesheet" href="modal.css">

    </head>
    <body>
     <div class="bar">
     </div>
     <center style="margin-top:10px;">
      <table>
        <tr>
           <td style="background:transparent !important;">
       <div style="padding:15px;margin-top:-10px;width:300px;border:solid 1px #eee;">
        <img src="images/logo2.jpg" width=286px height=100px>
        <hr size=1 color="#eee"/>
        <span style="color:red;font-size:20px">Search By</span>&nbsp;<span id="selection" style="font-size:20px">Location</span><br/><br/>
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
        <a href="#"  id="submit">Search Movies</a>
        <br/><br/>
        <center><img src="ajax-loader.gif" alt="Loading..." id="ajax"></center>
      </div>
         
      </div>  
          </td>
          <td>

      <table>
              <tr>
                <td id="menu"><a href="theatres.php" >Theatres</a></td>
                <td id="menu"><a href="movies.php">Movies</a></td>
                <td id="menu"><a href="trailers.php">Trailers</a></td>
                <td id="menu"><a href="#">Mobile App</a></td>
                <td id="menu"><a href="contact.php">Contact</a></td>
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

        </tr>
      </table>
    </center>
    
<center>
  <h1 id="asdf">Please Select Loation</h1>
<div id="result">
</div>
</center>
 <script src="jquery-1.8.0.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <script src="select2.js"></script>
    <script>
        $(document).ready(function()
         {
            $("#location").select2();   
        });
    </script>
<script type="text/javascript">
$(function()
{


  $('#submit').click(function()
  {
    var location=$('#location').val();
    $('#asdf').hide();

     if(location=='')
    {
      alert("Please Select Location...");
      return false;
    }

    $('#ajax').show();

    $.post("load1.php",
    {
      location:location
    },
    function(data,status)
    {
      $('#result').html(data);
      $('#ajax').hide();
    });
   

  });



});
</script>
<script type="text/javascript" src="engine1/wowslider.js"></script>
  <script type="text/javascript" src="engine1/script.js"></script>
    </body>
</html>

