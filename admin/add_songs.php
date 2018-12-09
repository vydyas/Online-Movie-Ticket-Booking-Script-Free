<?php
session_start();
include_once('chk_login.php');
?>
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
<!DOCTYPE HTML>
<link href="select2.css" rel="stylesheet"/> 
<script src="jquery.js"></script>
<script src="select2.js"></script>

<script>
	$(function()
	{
		$('#th_location').select2();
	});
</script>

<title>Add Songs by admin</title>
<?php
include('../db/db.php');
include("../db/admin.php");
include('../frontend.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();
$frontend=new frontend();

$array=$frontend->getlocation();
$size=sizeof($array);
$size1=$size;
$i=0;

$admin=new admin();

$array1=$admin->movies();
$size1=sizeof($array1);
$s=0;
$j=1;

echo $admin->menu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
<div id="content">
	<table cellspacing="18" style="  font-family: verdana;font-size: 13px;">
	<tr><td>Select Location</td><td>
	<select id='th_location' name='th_location'>
		<option>Select Movie</option>
		<?php
		$sql = "select * from movies";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result))
		{
			$location_id = $row['id'];
			$loc_name = $row['name'];
			echo"<option value='$location_id'>".$loc_name."</option>";
		}
		?>
		</select>
	</td></tr>
		<tr>
			<td>Song Name</td>
			<td><input type="text" name="song_name" id="song_name" required></td>
		</tr>
		<tr>
			<td>Song Link</td>
			<td><input type="text" name="link" id="link" required></td>
		</tr>
        <tr>
		<td><input type="submit" name="submit" value="submit" id="submit"></td><td><span id="flash">Processing...</span></td>
		</tr>
		</table>

</div>
<script>
$(function()
{

	$('#submit').click(function(){

		    $('#flash').show();
			var movies_id = $('#th_location').val();
	        var name = $('#song_name').val();
	        var link=$('#link').val();

			var params = "movie_id="+movies_id+"&link="+link+"&name="+name;
            alert(params);
			var url = "songs_process.php";
			$.ajax({
				type: 'POST',
				url: url,
				dataType: 'html',
				data: params,
						
				success: function(data) {
					$('#flash').hide();
					alert('Link Submitted');
				}
				});
	});

});
</script>