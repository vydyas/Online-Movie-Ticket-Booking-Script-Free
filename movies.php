<?php
include('db/db.php');
include('frontend.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$query="SELECT * FROM movies ORDER BY id DESC";
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
           <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
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
                <td id="menu"><a href="index3.php">Home</a></td>
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
     <center><br/>
          <!-- <nav class="menu">
           <ul class="active">
            <li><a href="index.php">Home</a></li>
            <li><a href="movies.php">Movies</a></li>
            <li><a href="theatres.php">Theatres</a></li>
            <li><a href="trailers.php">Trailers</a></li>
            <li><a href="moibile-app.php">Mobile App</a></li>
            <li style="float:right;margin-right:10px;">
            
            <a class="toggle-nav" href="#">&#9776;</a>

            <input type="text" id="filter" style="padding:3px;width:250px;" placeholder="Search Movies.." ></li>
           </ul>

           </nav>-->
          
          <table class="data">
            <?php
            while($row=mysql_fetch_array($result))
            {
            ?>
            <tr >
              <td id="leftcontents">
                <img src="uploads/<?php echo $row['image'];?>" width=100px>
              </td>
              <td id="rightcontents" valign="top">
                <div id="contents">
                <b>Movie Name:</b>&nbsp;&nbsp;<a><?php echo $row['name'];?></a><br/>
                <b>Cast:</b>&nbsp;&nbsp;<?php echo $row['cast'];?><br/>
                <b>Direction:</b>&nbsp;&nbsp;<?php echo $row['director'];?><br/>
                <b>Music:</b>&nbsp;&nbsp;<?php echo $row['music'];?><br/>
                <b>Description:</b>&nbsp;&nbsp;<?php echo $row['desc'];?><br/>
              </div>

              </td>
            </tr>
            <?php
             }
            ?>
          </table>
    <br/>
    </center>
    <div id="events" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Events Online</h4>
                </div>
                <div class="modal-bodys">
                    oming Soon
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
	$(document).ready(function(){
    $("#filter").keyup(function(){
 
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val();
 
        // Loop through the comment list
        $("table tr").each(function(){
 
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
                count++;
            }
        });
 
    });
});
</script>
    </body>
</html>