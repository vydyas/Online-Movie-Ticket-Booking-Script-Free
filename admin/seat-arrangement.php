<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin Ticket Booking</title>
<script type="text/javascript" src="../js/jquery.js"></script>
<style>
table {
	empty-cells: show;
	border-collapse: collapse;
	text-align:center;
	margin: 0 auto;
}
table tr td {
	width: 20px;
	height: 20px;
	border: 1px solid #000;
}
table tr{
	width: 5px;
	height: 5px;
	border: 1px solid #000;
}
</style>
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
<?php
	$theater_id = $_REQUEST['theater_id'];
	$action = $_REQUEST['action'];
	
	$sql = "select * from  theatres where id = '$theater_id'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$td_idArray = array('a');
	$seat_nameArray = array('a');
	
	
	if($action == 'edit')
	{
		$sql1 = "select * from seats where fk_theater_id = '$theater_id'";
		$result1 = mysql_query($sql1);
		$rescnt = mysql_num_rows($result1);
		if($rescnt > 0)
		{
			$sql3 = "select * from seats where fk_theater_id = '$theater_id'";
			$result3 = mysql_query($sql3);
			while($row3 = mysql_fetch_array($result3))
			{
				array_push($td_idArray,$row3['td_id']);
				array_push($seat_nameArray,$row3['seat_name']);
			}
		}
	}
?>
<div class="leftmenu">
</div>
<div class="rightcontent" style="width: 100%;">
<table cellpadding="5" style="float:left;margin:20px;">
	<tr>
		<td style='width:100px;'>Row from</td>
		<td>
			<select id='row_from' name='row_from'>
				<option value=''></option>
				<?php
					for($i = 1;$i<41;$i++)
					{
						echo"<option>$i</option>";
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td style='width:100px;'>Row To</td><td>
		<select id='row_to' name='row_to'>
			<option value=''></option>
			<?php
				for($j = 1;$j<41;$j++)
				{
					echo"<option>$j</option>";
				}
			?>
		</select>
		</td>	
	</tr>	
	<tr>
		<td style='width:100px;'>Column from</td>
		<td>
		<select id='col_from' name='col_from'>
			<option value=''></option>
			<?php
				for($i = 1;$i<41;$i++)
				{
					echo"<option>$i</option>";
				}
			?>
		</select>
		</td>	
	</tr>
	<tr>
		<td style='width:100px;'>Column To</td>
		<td>
		<select id='col_to' name='col_to'>
			<option value=''></option>
			<?php
				for($j = 1;$j<41;$j++)
				{
					echo"<option>$j</option>";
				}
			?>
		</select>
		</td>
	</tr>
	<tr>
		<td>Start seat no</td>
		<td>
		<select id='seat_no' name='seat_no'>
			<option value=''></option>
				<?php
				for($i = 0;$i<41;$i++)
				{
					echo"<option value='$i'>$i</option>";
				}
				?>
		</select>	
		</td>
	</tr>
	<tr>
		<td>Seat no order</td>
		<td>
			<select id='seatNOrder' name='seatNOrder'>
				<option value=''></option>
				<option value='i'>Increase</option>
				<option value='d'>Decrease</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Start Seat name</td>
		<td>
		<select id='seat_name' name='seat_name'>
		<option value=''></option>
			<?php
			$namearray = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$stcnt = count($namearray);
			for($i = 0;$i<$stcnt;$i++)
			{
				echo"<option value='$namearray[$i]'>$namearray[$i]</option>";
			}
			?>
		</select>
		</td>
	</tr>
	<tr>
		<td>Seat name order</td>
		<td>
			<select id='seatNmOrder' name='seatNmOrder'>
				<option value=''></option>
				<option value='i'>Increase</option>
				<option value='d'>Decrease</option>
			</select>
		</td>
	</tr>
<!--	<tr>
		<td colspan='2'><input type='text' name='charges' id='charges' placeholder='Enter Charges' title='Please enter charges' /></td>
	</tr>
	-->
	<tr>
		<td colspan='2'>
			<input type='button' name='btn' id='btn' value='Save' class='btn' onclick="make_arrangement()" />
		</td>
	</tr>
	<tr>
		<td colspan='2'><input type='button' value='Submit Arrangement' onclick="save_arrangement()" /></td>
	</tr>
</table>
<?php
echo"<table border='1' id='adminSeatArrange' style='float:left;margin:20px;'>";
for($i = 0; $i<41; $i++)
{
	echo"<tr>";
	for($j = 0; $j<41; $j++)
	{
		if($i == 0 || $j == 0)
		{
			if($i ==0 && $j == 0)
			{
				echo"<td style='border:1px solid #666;'>0</td>";
			}
			else if($i == 0)
			{
				echo"<td style='border:1px solid #666;'>$j</td>";
			}
			else if($j == 0)
			{
				echo"<td style='border:1px solid #666;'>$i</td>";
			}
			
		}
		else
		{
			$matchId = $i.'.'.$j;
			$flag = false;
			for($m=0; $m<count($td_idArray); $m++)
			{
				if($matchId === $td_idArray[$m])
				{
					$seatname = $seat_nameArray[$m];
					echo"<td id='$matchId' title='$seatname'><img src='../images/unavailable.png' class='$seatname' /></td>";
					$flag = true;
				}
			}
			if(!$flag)
			{
				echo"<td id='$matchId'></td>";
			}
		}
	}
	echo"</tr>";	
}
echo"</table>";
?>
<div class='take_arrangement' id='take_arrangement' style='display:hidden;'>
</div>
<script>
function make_arrangement()
{
		var flag = true;
		var row_from = $('#row_from').val();
		var row_to = $('#row_to').val();
		var col_from = $('#col_from').val();
		var col_to = $('#col_to').val();
		//var charges = $('#charges').val();
		var seat_no = $('#seat_no').val();
		var seat_name = $('#seat_name').val();
		var noOrder = $('#seatNOrder').val();
		var nameOrder = $('#seatNmOrder').val();



		if(row_from == '')
		{
			alert('Please select row from');
			return false;
		}
		if(row_to == '')
		{
			alert('Please select row to');
			return false;
		}
		if(col_from == '')
		{
			alert('Please select column from');
			return false;
		}
		if(col_to == '')
		{
			alert('Please select column to');
			return false;
		}
		/*if(charges == '')
		{
			alert('Please enter charges');
			return false;
		}*/
		/*if((rseatno_from == '' && rseatno_to == '') && (rseatname_from == '' && rseatname_to == ''))
		{
			alert('Please select Seat name/Seat number');
				return false;
		}
		if((rseatno_from =='' && rseatno_to !='') || (rseatno_from !='' && rseatno_to ==''))
		{
			alert('Please select both seat no from and to');
			return false;
		}
		if((rseatname_from =='' && rseatname_to !='') || (rseatname_to))
		{
			alert('Please select both seat name from and to');
			return false;
		}*/
		else
		{
			// for loop for rows
			for(var i = row_from;i<=row_to;i++)
			{
				// for loop for columns
				var seat_no = $('#seat_no').val();
				if(seat_no == '')
				{
					seat_no = '';
				}
				if(seat_name != '')
				{
					seatarray = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
					seatcnt = seatarray.length;
					getIndex = seatarray.indexOf(seat_name);
				}
				else
				{
					seat_name = '';
				}
				
				alert(col_from + col_to);

				for(var j = col_from; j<=col_to; j++)
				{	
					if(flag)
					{
						alert("You have selected Row-"+row_from+"-"+row_to+"& Column-"+col_from+"-"+col_to);
					}
					flag = false;
					var tdid = i+'.'+j;

					//var charges = $('#charges').val();
					
					//to save value of charges in class attr
					//$('#'+tdid).attr('class',charges);
					
					getSeatName =  seat_name +""+seat_no;
					
					//alert(getSeatName);
					
					document.getElementById(tdid).innerHTML = "<img title='"+getSeatName+"' src='../images/unavailable.png' class='"+getSeatName+"' />";
					
					
					var tdtitle = getSeatName;
					$('#'+tdid).attr('title',tdtitle);
					
					if(noOrder == 'i')
					{
						if(seat_no != '')
						{
							seat_no++;
						}
						else
						{
							seat_no = '';
						}
					}
					else if(noOrder == 'd')
					{
						if(seat_no != '')
						{
							seat_no--;
						}
						else
						{
							seat_no = '';
						}
					}		
				}
				if(nameOrder == 'i')
					{
						if(seat_name != '')
						{
							getIndex++;
							seat_name = seatarray[getIndex];
						}
						else
						{
							seat_name = '';
						}
					}
					else if(nameOrder == 'd')
					{
						if(seat_name != '')
						{
							getIndex--;
							seat_name = seatarray[getIndex];
						}
						else
						{
							seat_name = '';
						}
					}	
			}
		}
	}
</script>
<script>
function save_arrangement(){
	td_element = $('#adminSeatArrange td img');
	var td_cnt = $('#adminSeatArrange td img').length;
	var myForm = "<form name='arrangement_form' id='arrangement_form' method='post' action='process/save_arrangement.php'>";
	for(i = 0; i<td_cnt; i++)
	{
		getTdId = $('#adminSeatArrange td img:eq('+i+')').closest('td').attr('id');

		//getCharges = $('#adminSeatArrange td img:eq('+i+')').closest('td').attr('class');
		getSeatname = $('#adminSeatArrange td img:eq('+i+')').attr('class');
		myForm = myForm + "<input type='hidden' name='tdId[]' value='"+getTdId+"'>";
		//myForm = myForm + "<input type='hidden' name='charges[]' value='"+getCharges+"'>";
		myForm = myForm + "<input type='hidden' name='seatName[]' value='"+getSeatname+"'>";
		
	}
	myForm = myForm + "<input type='hidden' name='theater_id' value='<?php echo $theater_id?>'>";
	myForm = myForm + "<input type='hidden' name='action' value='<?php echo $action?>'>";
	myForm = myForm + "<input type='submit' name='submit_arrangement' id='submit_arrangement' value='submit_arrangement'>";
	myForm = myForm + "</form>";
	
	document.getElementById('take_arrangement').innerHTML = myForm;
	//alert(myForm);
	document.forms['arrangement_form'].submit();
}
</script>