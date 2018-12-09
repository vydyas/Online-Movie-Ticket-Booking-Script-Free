<?php
session_start();
include_once('chk_login.php');
?>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin Ticket Booking</title>
<script type="text/javascript" src="../js/jquery.js"></script>
<?php
include('../db/db.php');
include("../db/admin.php");


//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();
include_once('chk_login.php');
$admin=new admin();

$id=$_SESSION['id'];
echo $admin->menu();
?>
<li style="float:right;"><a href="logout.php">Logout</a></li></ul></header>

<div class="leftmenu">
	<?php include_once('leftmenu.php'); ?>
</div>
<div class="rightcontent" style="position: relative;">
<form method='post' action=''>
<table>
	<tr><td>Enter Movie Name</td><td><input type='text' name='movie' class='movie' id='movie' onkeyup="showhint(this.value,'movie')" /></td></tr>
	<tr><td>Enter Location Name</td><td><input type='text' name='tlocation' id='tlocation' onkeyup="showhint(this.value,'tlocation')" /></td></tr>
	<tr><td>Enter Theater Name</td><td>
	<input type='text' name='th1' id='th1' onkeyup="showhint(this.value,'th1')" />
	</td></tr>
	<tr>
	<td>Select show time</td>
		<td>
		<select>
			<option value='morning'>Morning</option>
			<option value='matney'>Matney</option>
			<option value='fs'>First Show</option>
			<option value='ss'>Second Show</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>Select Date</td><td>
			<select id='date'>
				<?php
				for($i = 1; $i<32;$i++)
				{
					echo"<option value='$i'>".$i."</option>";
				}
				?>
			</select>
			<select>
				<?php
				$monArray = array('Jan','Feb','Mar','April','May','June','July','Aug','Sept','Oct','Nov','Dec');
				$mcnt = count($monArray);
				
				for($i = 0;$i<$mcnt; $i++)
				{
					echo"<option value='$monArray[$i]'>".$monArray[$i]."</option>";
				}
				?>
			</select>
		</td>
	</tr>
	<tr><td colspan='2'><input type='submit' name='submit' value='Submit'></td></tr>
</table>
</form>
<div id='livesearch'></div>
</div>
<script>
function showhint(str,getid)
{
	if (str.length==0)
	{
		document.getElementById("livesearch").innerHTML="";
		document.getElementById("livesearch").style.border="0px";
		return;
	}
	if (window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} 
	else 
	{  // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) 
	{
		//alert(xmlhttp.responseText);
		document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
		document.getElementById("livesearch").style.visibility = "visible";
		if(getid == 'movie')
		{
			document.getElementById("livesearch").style.left = "133px";
			document.getElementById("livesearch").style.top = "34px";
		}
		if(getid == 'tlocation')
		{
			document.getElementById("livesearch").style.left = "133px";
			document.getElementById("livesearch").style.top = "79px";
		}
		if(getid == 'th1')
		{
			document.getElementById("livesearch").style.left = "133px";
			document.getElementById("livesearch").style.top = "123px";
		}
		
		document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","get_suggetion.php?q="+str+"&getid="+getid,true);
  xmlhttp.send();
}
</script>
<script>
function addData(mid,category)
{
	putData = document.getElementById(mid).innerHTML;
	alert(mid + '' +category + '' + putData);
	document.getElementById(category).value = putData;
	document.getElementById("livesearch").style.visibility = "hidden";
}
</script>
</html>
</body>