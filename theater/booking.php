<?php
session_start();
include('chk_login.php');
?>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="select2.css">
<script type="text/javascript" src="jquery-1.8.0.min.js" ></script>    
<script type="text/javascript" src="select2.js" ></script>   
<script type="text/javascript">
   $(document).ready(function()
         {
            $("#movies").select2();   
            $('#movies').change(function()
        {
            var mov_id= $("#movies").val();
            alert(mov_id);
        });
        });
</script>

<?php
include('../db/db.php');
include("../db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$admin=new admin();

$id=$_SESSION['theater_id'];

$array=$admin->getmovies($id);
$size=sizeof($array);
$i=0;

echo $admin->theatermenu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
<div class="panelwrapper">
<center><h1>Book Tickets!!</h1>	</center>

<select name="movies" id="movies">
    <option value="">Select Movie...</option>
    <?php
    while($size>0)
    {
        $location=$array[$i]['id'];
        echo "<option value=".$array[$i]['id'].">".$array[$i]['name']."</option>";
        $i++;
        $size--;
    }
    ?>
</select>
 <select name="date" id="date">
            <option value="">Select Date...</option>
  </select>
</div>
