<?php
session_start();
include_once('chk_login.php');
?><!--
<link rel="stylesheet" type="text/css" href="style.css">-->
<link href="select2.css" rel="stylesheet"/> 
<script src="jquery.js"></script>
<script src="select2.js"></script>
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

<script>
	$(function()
	{
		$('#th_location').select2();
	});
</script>

<title>Add Theatres by admin</title>
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

if($_REQUEST['id'])
{
echo $admin->menu();
$id=$_REQUEST['id'];
$query=mysql_fetch_array(mysql_query("SELECT * FROM theatres WHERE id='$id'"));
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>
<div id="content">
<form action="process/edit_theater.php" method="POST">
	<table cellspacing="18" style="  font-family: verdana;font-size: 13px;">
	<tr><td>Select Location</td><td>
	<select id='th_location' name='th_location'>
		<option>Select Location</option>
		<?php
		$sql = "select * from location";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result))
		{
			$location_id = $row['id'];
			$loc_name = $row['location'];
			if($location_id == $query['fk_location_id'])
			{
				echo"<option value='$location_id' selected>".$loc_name."</option>";
			}
			else
			{
				echo"<option value='$location_id'>".$loc_name."</option>";
			}
		}
		?>
		</select>
	</td></tr>
		<tr>
			<td>Theatre Name</td>
			<td><input type="text" name="theatre_name" id="theatre_name" value="<?php echo $query['name'];?>"></td>
		</tr>
		<tr>
			<td>Theatre Addr</td>
			<td><textarea name="theatre_addr" id="theatre_addr"><?php echo $query['address'];?></textarea></td>
		</tr>
		<tr>
			<td>Status</td>
			<td>
				<?php
					$status_query=mysql_query("SELECT status,type,notifications from theatres WHERE id='$id'");
					$status_row=mysql_fetch_array($status_query);
					$status=$status_row['status'];
					$type=$status_row['type'];
					$notifications=$status_row['notifications'];
					?>
				<select id="status" name="status">
					<?php
					if($status=='1')
					{
						?>
                            <option value="1" selected>Active</option>
						<?php
					}
					else
					{
						?>
					           	<option value="1" >Active</option>
						<?php
					}
					?>
					<?php
					if($status=='2')
					{
						?>
                            <option value="2" selected>InActive</option>
						<?php
					}
					else
					{
						?>
					           	<option value="2" >InActive</option>
						<?php
					}
					?>
				
				</select>
			</td>
		</tr>
		<tr>
			<td>Type</td>
			<td>
				<select id="type" name="type">
					<?php
					if($type=='1')
					{
						?>
                            <option value="1" selected>Online</option>
						<?php
					}
					else
					{
						?>
					           	<option value="1" >Online</option>
						<?php
					}
					?>
					<?php
					if($type=='2')
					{
						?>
                            <option value="2" selected>Offline</option>
						<?php
					}
					else
					{
						?>
					           	<option value="2" >Offline</option>
						<?php
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Notifications</td>
			<td>
				<select id="notifications" name="notifications">
					<?php
					if($notifications=='1')
					{
						?>
                            <option value="1" selected>Active</option>
						<?php
					}
					else
					{
						?>
					           	<option value="1" >Active</option>
						<?php
					}
					?>
					<?php
					if($notifications=='0')
					{
						?>
                            <option value="0" selected>Inactive</option>
						<?php
					}
					else
					{
						?>
					           	<option value="0" >Inactive</option>
						<?php
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
		<input type='hidden' name='theater_id' id='theater_id' value='<?php echo $id;?>'>
        <tr>

		<td><input type="submit" name="submit" value="submit" id="submit"></td>
		<td><a href="theatre.php">Cancel Edit</a></td>
		</tr>
		</table>

</form>
</div>
<?php
}

?>


