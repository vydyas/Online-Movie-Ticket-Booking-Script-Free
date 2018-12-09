<?php
include('db/db.php');
include('frontend.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$query="SELECT t.*,m.name as moviename,l.location as lname FROM theatres t left join location l on l.id=t.location_id left join movies m on m.id=t.movies_id 
        ORDER BY t.id DESC";

$result=mysql_query($query);



?>
<html>
    <head>
        <title>Searh Movie Theatres Online</title>
           <style type="text/css">
        body{font-family: calibri;}
 
        </style>
        <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="jquery-1.8.0.min.js"></script>
   
    </head>
    <body style="background:#eee">
    <?php
include('header.php');
?>
     <center><br/>
     <nav class="menu">
           <ul class="active">
            <li><a href="index.php">Home</a></li>
            <li><a href="movies.php">Movies</a></li>
            <li><a href="theatres.php">Theatres</a></li>
            <li><a href="trailers.php">Trailers</a></li>
            <li><a href="moibile-app.php">Mobile App</a></li>
            <li style="float:right;margin-right:10px;"><input type="text" style="padding:3px;width:250px;" placeholder="Movie/Location.." ><button style="padding:3px;background:#c00029;color:white;border:solid 2px #c00029;">Go</button></li>

           </ul>
           </nav>
          
          <table width="950px" style="border:solid 1px #bdbdbd;background:white">
            <?php
            while($row=mysql_fetch_array($result))
            {
            ?>
            <tr >
              <td style="padding:10px;border-bottom:solid 1px #bdbdbd" valign="top">
                
                <b>Theatre Name:</b>&nbsp;&nbsp;<?php echo $row['name'];?><br/><br/>
                <b>Address:</b>&nbsp;&nbsp;<?php echo $row['address'];?><br/><br/>
                <b>Location:</b>&nbsp;&nbsp;<?php echo $row['lname'];?><br/><br/>
                <b style="color:#3399ff"><?php echo $row['moviename'];?></b> Movie is Playing
              </div>

              </td>
            </tr>
            <?php
             }
            ?>
          </table>
    <br/>
    </center>

    </body>
</html>


