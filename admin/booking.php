<?php
session_start();
if(isset($_SESSION['id']) || isset($_SESSION['agent_id']))
{

?>
<!--<link rel="stylesheet" type="text/css" href="style.css"> -->
<style type="text/css">
ul > li {
    position:relative;
    font-size:19px;
}
 
ul > li > a {
    text-shadow:0px 1px 0px rgba(0,0,0,0.4);
}

li:hover .sub-menu {
    z-index:1;
    opacity:1;
}
 
.sub-menu {
    width:160%;
    padding:5px 0px;
    position:absolute;
    top:100%;
    left:0px;
    z-index:-1;
    opacity:0;
    transition:opacity linear 0.15s;
    box-shadow:0px 2px 3px rgba(0,0,0,0.2);
    background:#2e2728;
}
 
.sub-menu li {
    display:block;
}
 
.sub-menu li a {
    display:block;
}
#flash
{
	display: none;
}
</style>
<link href="select2.css" rel="stylesheet"/> 
<link href="../site.css" rel="stylesheet"/>
<script src="jquery.js"></script>
<script src="select2.js"></script>
<script src="form.js"></script>
<script src="base.js"></script>
<title>Movies</title>
<?php
include('../db/db.php');
include("../db/admin.php");
include("../frontend.php");

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

$admin=new admin();
$id=$_SESSION['id'];
if(isset($_SESSION['id']))
{
echo $admin->menu();
}
else
{
$agent_id=$_SESSION['agent_id'];
echo $admin->agentmenu();
}
@$amount=mysql_query("SELECT * FROM `agent-recharge` WHERE fk_agent_id='$agent_id'");
$row=mysql_fetch_array($amount);


?>
	<li style="float:right;"><?php echo $row['amount'];?>&nbsp;Rs.</li>
<li style="float:right;"><a href="logout.php">Logout</a></li>
</ul>
</header>
	<div id="content" style="float: left; margin: 20px; width: 29%;">

		  <div class="indexform">
   <table>
    <tr>
      <td class='itab' id='tabMovie'>Movies</td><td ></td>
    </tr>
    <tr>
      <td style="background:transparent !important;" colspan="2">
        <div style="padding:15px;border:solid 1px #bdbdbd">
          <div id="movieform">
          <form method="post" action="bookshow.php" name="formone" onsubmit="return vaidateMovie()">
          <select style="width:300px;" name="location1" id="location1">
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
          <select style="width:300px;" name="selectmovies" id="selectmovies">
            <option value="">Select Movies...</option>
          </select><br/><br/>
          <select style="width:300px;" name="selecttheater" id="selecttheater">
            <option value="">Select Theater...</option>
          </select><br/><br/>
          <select style="width:300px;" name="mdate" id="mdate">
            <option value="">Select Date...</option>
             <!--<option value='<?php echo $today ?>'><?php echo $today; ?></option>
             <option value='<?php echo $tomorrow ?>'><?php echo $tomorrow; ?></option>
             <option value='<?php echo $dayAftT ?>'><?php echo $dayAftT; ?></option>-->
          </select><br/><br/>
          <select style="width:300px;" name="show_time" id="show_time" onchange="get_seats()">
            <option value="">Select Show...</option>
            
          </select><br/><br/>
          <input type="submit" id="submit" name='submitone' value="Proceed">
          </form>
      
          </div>

        </div>
      </td>
      </tr>
    </table>
  </div>
	
	</div>
	<div id="showbooking"></div>
	<div id="result"></div>
<?php
}
else
{
	header('Location:index.php');
}
?>
<script>
function get_seats()
{

	var location_id = $('#location1').val();
	var movie_id = $('#selectmovies').val();
    var movie_date = $('#mdate').val();
    var show_time = $('#show_time').val();
    var the_id = $('#selecttheater').val();
    var bse64=$.base64.encode(movie_date);

	if(location_id!='' && movie_id!='' && movie_date!='' && show_time!='')
	{

		var params ="id="+movie_id+"&mdate="+bse64+"&time="+show_time+"&fk_theater_id="+the_id;

		var url ="get_seats.php?"+params;

		$(location).attr('href',url);


	}
}
</script>
<script>
$('#showbooking').css('display','none');
</script>
<script type="text/javascript">
$(function()
{

	$('#selecttheater').select2();
	$('#show_time').select2();

	$('#selecttheater').prop('disabled', 'disabled');
	$('#show_time').prop('disabled', 'disabled');

	$("#selectmovies").change(function(){
		mov_id= $("#selectmovies").val();
		loc_id= $("#location1").val();

		var params = "mov_id="+mov_id+"&loc_id="+loc_id;
		var url = "get_theater_booking.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#selecttheater').html(data);

				if($('#selecttheater').html(data))
				{
					$('#selecttheater').removeAttr('disabled');
				}
				else
				{
					$('#selecttheater').prop('disabled', 'disabled');
					return false;
				}
			}
			});
		});


	$("#selectmovies").change(function(){
		mov_id= $("#selectmovies").val();
		loc_id= $("#location1").val();
		var params = "mov_id="+mov_id+"&loc_id="+loc_id;
		var url = "get_date.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#mdate').html(data);
				if($('#mdate').html(data))
				{
					$('#mdate').removeAttr('disabled');
				}
				else
				{
					$('#mdate').prop('disabled', 'disabled');
					return false;
				}
			}
			});
		});



	$("#mdate").change(function(){

		the_id= $("#selecttheater").val();
		mdate= $("#mdate").val();

		var params = "the_id="+the_id+"&mdate="+mdate;
		var url = "get_show.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#show_time').html(data);

				if($('#show_time').html(data))
				{
					$('#show_time').removeAttr('disabled');
				}
				else
				{
					$('#show_time').prop('disabled', 'disabled');
					return false;
				}
			}
			});
		});



});
</script>
