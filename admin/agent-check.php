<?php
session_start();
if(isset($_SESSION['agent_id']))
{
?>
<!DOCTYPE HTML>
<title>Admin Location Adding</title>
<link href="select2.css" rel="stylesheet"/> 
<script src="jquery.js"></script>

<!-- end of data tables -->
<style>
.list-customer { 
	width: 95%; 
	float: left;
	margin: 20px;
}

.select2-container .select2-choice > .select2-chosen { font-size: 13px; }


.select2-container, .select2-drop, .select2-search, .select2-search input {
    width: 188px;
}

#s2id_autogen5_search,
#s2id_autogen6_search,
#s2id_autogen7_search { width: 110px; }

#result > table {
    border-collapse: collapse;
    margin: 25px 0 0;
    width: 100%;
}

#ui-datepicker-div { font-size: 13px; }

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
if($_SESSION['id'])
{
echo $admin->menu();
}
else
{
$agent_id=$_SESSION['agent_id'];
echo $admin->agentmenu();	
}
$amount=mysql_query("SELECT * FROM `agent-recharge` WHERE fk_agent_id='$agent_id'");
$row=mysql_fetch_array($amount);
?>
<li style="float:right;"><?php echo $row['amount'];?>&nbsp;Rs.</li>
<li style="float:right;"><a href="logout.php">Logout</a></li>
</ul>
</header>
<div class="list-customer">
<table>
<tr>
	<td>
		<input type='text' name='ticketid' id='ticketid' placeholder="Enter Ticket Id" class='ticketid' style='height:22px;' />
	</td>
	<td>
		<input type='button' name='submit' id='submit' value='Submit' style="height:29px;cursor:pointer;" />
	</td>
	</tr>
</table>
<div id='result'>

</div>
</div>
<?php
}
else
{
header('Location:../404.php');
}
?>
<script>
<script>
$(document).ready(function(){
	$('#submit').click(function(){
		
		var ticketid = $('#ticketid').val();

		alert(ticketid);

		if(ticketid== '')
		{
			alert('Please Enter Ticket Id');
		}
		else
		{
			var params = "ticketid="+ticketid;
			var url = "get_ticket.php";
			$.ajax({
			type: 'POST',
			url: url,
			dataType: 'html',
			data: params,
			
			success: function(data) {
					if(data == 0)
					{
						$('#result').html('');
						alert('Fake Ticket ID');
					}
					else
					{
						$('#result').html(data);
					}
				}
			});
		}
	});
});
</script>
<script type="text/javascript">
$(function()
{
$('#submit').click(function()
{
	var ticketid=$('#ticketid').val();
	
		if(ticketid== '')
		{
			alert('Please Enter Ticket Id');
		}
		else
		{
			var params = "ticketid="+ticketid;
			var url = "get_ticket.php";
			$.ajax({
			type: 'POST',
			url: url,
			dataType: 'html',
			data: params,
			
			success: function(data) {
					if(data == 0)
					{
						$('#result').html('');
						alert('Fake Ticket ID');
					}
					else
					{
						$('#result').html(data);
					}
				}
			});
		}

});
});
</script>
</table>