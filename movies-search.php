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

if($_POST)
{
$location_id=$_POST['location1'];
$theatre_id=$_POST['theatres'];


$query="SELECT t.*,m.name as moviename,m.rating,m.image,m.cast,l.location FROM theatres t
 LEFT JOIN movies m on m.id=t.movies_id 
 LEFT JOIN location l on l.id=t.location_id WHERE  t.id=$theatre_id AND t.location_id=$location_id";
 

 $result=mysql_query($query);
 $row=mysql_fetch_array($result);

?>
<html>
    <head>
        <title>Searh Movie Theatres Online</title>
        <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
    <link href="css/style.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="select2.css" rel="stylesheet"/>
    <script src="jquery-1.8.0.min.js"></script>
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
              var dataString = 'id='+ id;
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
    <body style="background:white">
     <div class="bar">
     </div>
     <center>
      <br/>
           <ul id="ul">
            <li><a href="index.php">Home</a></li>
            <li><a href="movies.php">Movies</a></li>
            <li><a href="theatres.php">Theatres</a></li>
            <li><a href="trailers.php">Trailers</a></li>
            <li><a href="moibile-app.php">Mobile App</a></li>
            <li style="float:right;margin-right:10px;"><input type="text" style="padding:3px;width:250px;" placeholder="Movie/Location.." ><button style="padding:3px;background:#c00029;color:white;border:solid 2px #c00029;">Go</button></li>

           </ul>
          <br/>
          <table width="950px" style="background:white">
            <tr style="background:#3399ff;color:white">
              <td colspan=2>&nbsp;&nbsp;Movie In <b><?php echo $row['location'];?></b></td>
            </tr>
            <tr>
              <td width=10% style="padding:5px" valign="top">
                <table>
                  <tr>
                    <td>
                      <img src="uploads/<?php echo $row['image'];?>" height="270px"/>
                    </td>
                    <td valign="top">
                       <br/>
                    </td>
                  </tr>
                </table>
                
              </td>
              <td valign="top" width="60%">
                
                <h2><?php echo $row['moviename']; ?></h2>
                
                <b>Theatre:</b>&nbsp;<pstyle="color:f71d57"><?php echo $row['name']; ?></p>
                <p><b>Addr:</b>&nbsp;<?php echo $row['address']; ?></p>

                <span style="color:#444444"><b>Timings:</b>&nbsp;11:00 am &nbsp;2:30 pm &nbsp; 6:15pm &nbsp;9:30pm</span><br/><br/>
                <b>Rating:</b>&nbsp;<?php echo $row['rating'];?>/5<br/><br/>
                <b>Cast:</b>&nbsp;<?php echo $row['cast'];?><br/>
               
              </td>
              <td valign="top">
                
               <div style="margin-top:-25px;background:white;border:solid 1px pink;padding:15px;margin-left:5px;width:305px;box-shadow:0px 0px 7px 0px rgba(50, 50, 50, 1);">
        <button id="movies_cinemachoodu">Movies</button>&nbsp;<button id="theatres_cinemachoodu">Theatres</button><br/><br/><br/>
        <span style="color:red;font-size:20px">Search By</span>&nbsp;<span id="selection" style="font-size:20px"></span><br/><br/>
      <form action="theatres-search.php" method="post" id="mm">
        <select style="width:300px;" name="location" id="location" required>

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
        <select style="width:300px;" name="movies" id="movies" required>
          <option  value="">Select Movies...</option>

        </select><br/><br/>
        <button id="submit">Search Theatres</button><br/><br/>
        </form>
          <form action="theatres-search1.php" method="post" id="tt">
        <select style="width:300px;" name="location1" id="location1" required>

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
        <select style="width:300px;" name="theatres" id="theatres" required>
          <option  value="">Select Theatres...</option>

        </select><br/><br/>
        <button id="submit">Search Movies</button><br/><br/>
        </form>
      </div>
               
              </td>
            </tr>
          </table>
    <br/>
    </center>

<center><b style="color:red">Ticket Booking Coming soon !!!!</b></center><br/>
<center><img src="images/logo1.jpg" width=286px height=100px></center>
<script type="text/javascript">
$(function()
{
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
});
</script>
    </body>
</html>
<?php
}
else
header('Location:index.php');
?>

