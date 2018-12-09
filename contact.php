<?php
include('db/db.php');
include('frontend.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

?>
<html>
    <head>
        <title>Searh Movie Trailers Online</title>
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
     <div class="bar">
     </div>
<?php
include('header.php');
?>
     <center style="margin-top:-10px">
          <nav class="menu">
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

           </nav>
           <br/><br/>
           <div style="text-align:left;margin-left:200px">
<b>ADDRESS:</b><br/><br/>
S/O Vinayakarao 12-4-107<br/>
New Colony Palasa ,Palasa<br/>
KasiBugga Srikakulam<br/>
Andhra Pradesh,532222<br/>
</div>
    </center>



    </body>
</html>


