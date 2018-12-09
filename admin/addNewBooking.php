<?php
session_start();
include_once('chk_login.php');
?>
<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
<title>Admin Location Adding</title>
<link href="select2.css" rel="stylesheet"/> 
<link href="admin.css" rel="stylesheet"/> 
<script src="jquery.js"></script>
<script src="select2.js"></script>
<script src="validation.js"></script>
<style>
#mv1 { width: 300px;}
#loc1 { width: 300px;}
</style>

<?php
include('../db/db.php');
include("../db/admin.php");
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();



$admin=new admin();
$id=$_SESSION['id'];
echo $admin->menu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>

<div class="leftmenu">
	<?php include_once('leftmenu.php'); ?>
</div>
<div class="rightcontent">
	<div class="selectmovie" id="content1">
	<h3>Select Theater to add new booking</h3>
	<form method="post" action="seat-arrangement.php" onsubmit="return validate_movie_select()">
		<table>
			<tbody>
				<tr>
					<td>Select Location</td>
					<td>
						<select name="loc1" id="loc1">
								<?php
								$sql = "select * from location";
								$result = mysql_query($sql);
								echo"<option value=''>Select Location</option>";
								while($row = mysql_fetch_array($result))
								{
									$id = $row['id'];
									$location = $row['location'];
									echo"<option value='$id'>".$location."</option>";
								}
								?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Select Movie</td>
					<td>
						<select id="mv1" name="mv1">
						<option value="">Select Movie</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Select Theater</td>
					<td>
					<select id="th1" name="th1">
						<option value="">Select Theater</option>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<input type="submit" name="submit" value="Submit" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	</div>
	
</div>
<script src="select2.js"></script>
 <script>
 $(document).ready(function()
		{
            $("#loc1").select2();
			$('#mv1').select2();
			$('#th1').select2();
			$("#loc1").change(function(){
				loc_id= $("#loc1").val();
				var params = "loc_id="+loc_id;
				var url = "get_movie.php";
				$.ajax({
				type: 'POST',
				url: url,
				dataType: 'html',
				data: params,
				
				success: function(data) {
					$('#mv1').html(data);
				}
				});
			});
			
			$("#mv1").change(function(){
				loc_id= $("#loc1").val();
				mv_id = $("#mv1").val();
				var params = "loc_id="+loc_id+"&mv_id="+mv_id;
				var url = "get_theater.php";
				$.ajax({
				type: 'POST',
				url: url,
				dataType: 'html',
				data: params,
				
				success: function(data) {
					$('#th1').html(data);
				}
				});
			});
		});
</script>