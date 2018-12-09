<?php
session_start();
include_once('chk_login.php');
?>
<?php
include('../db/db.php');
include("../db/admin.php");

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$location_id = $_POST['location1'];
$movie_id = $_POST['selectmovies'];
$movie_date = $_POST['mdate'];

$sql = "select * from seats where fk_theater_id = '$theater_id'";

if(!$result = mysql_query($sql)){
	die('SQL ERROR : '.mysql_error());
}
else
{
	$cnt = mysql_num_rows($result);

	if($cnt > 0)
	{
		$sql = "select * from assign_show where fk_theater_id='$theater_id' and fk_location_id = '$location_id'";
		$result = mysql_query($sql);
		$rescnt = mysql_num_rows($result);
		if($rescnt == 0)
		{
			echo "2";
		}
		else
		{
			$row = mysql_fetch_array($result);
			$showid = $row['show_id'];
			$tdIdArray = array('');
			$chargesArray = array('');
			$seatNameArray = array('');
			$rowArray = array('');
			$colArray = array('');
			
			$sql1 = "select * from charges where fk_show_id = '$showid'";
			$result1 = mysql_query($sql1);
			
			while($row = mysql_fetch_array($result1))
			{
				array_push($tdIdArray,$row['td_id']);
				array_push($chargesArray,$row['charges']);
				array_push($seatNameArray,$row['seat_name']);
				$explodeId = array();
				$explodeId = explode('.',$row['td_id']);
				array_push($rowArray,$explodeId[0]);
				array_push($colArray,$explodeId[1]);
			}
			
			$maxrow = max($rowArray);
			$maxCol = max($colArray);
			
			echo"<table cellpadding='1'>";
			for($i=1; $i<=$maxrow;$i++)
			{
				echo"<tr>";
				$changeCharges = '';
				for($j=1; $j<=$maxCol; $j++)
				{
					$tdid = $i.".".$j;
					$flag1 = false;
					for($m=0; $m<count($tdIdArray); $m++)
					{
						if($tdid === $tdIdArray[$m])
						{
							$flag1 = true;
							$seatnm = $seatNameArray[$m];
							$charges = $chargesArray[$m];
							if($charges != '' && $charges != '0')
							{
								$changeCharges = $charges;
							}
							$sql2 = "select * from admin_booking where fk_show_id = '$showid' and seat_id='$tdid'";
							$result2 = mysql_query($sql2);
							$res2cnt = mysql_num_rows($result2);
							if($res2cnt > 0)
							{
								echo"<td id='$tdid' class='seat'><br/><img src='../images/unavailable.png' class='$charges' title='".$charges."Rs-$seatnm' /></td>";
							}
							else
							{
								echo"<td id='$tdid' class='seat'><br/><img src='../images/available.png' class='$charges' title='".$charges."Rs-$seatnm' /></td>";
							}
						}
					}
					if(!$flag1)
					{
						echo"<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/></td>";
					}
				}
			
				if(strlen($changeCharges) > 0)
				{
					echo"<td><input style='width:40px;margin: 0 5px;' type='text' name='chngcharges' id='chngcharges$i' value='".$changeCharges."'><input style='margin: 0 5px;' type='button' name='sbmt' id='sbmt$i' value='Submit' onclick='changeCharges(\"sbmt$i\",\"$showid\",\"chngcharges$i\")'></td>";
				}
				echo"</tr>";
			}
			echo"<input type='hidden' name='showid' id='showid' value='$showid' />";
			echo"<input type='hidden' name='movie_id' id='movie_id' value='$movie_id' />";
			echo"<tr><td colspan='$maxCol' style='padding:10px 0;'><input type='button' name='btn' id='btn' value='Book Seats'></td></tr>";
			echo"</table>";
			?>
			<script>
			$('td img').click(function(){
				/* disable seats */
				var imgPath = $(this).attr('src');
				if(imgPath == '../images/unavailable.png')
				{
					$(this).attr('src','../images/sold.png');
				}
				else
				{
					$(this).attr('src','../images/unavailable.png');
				}
				
				/* enable seats */
				if(imgPath == '../images/available.png'){
					$(this).attr('src','../images/selected.png');
				}
				else if(imgPath == '../images/selected.png'){
					$(this).attr('src','../images/available.png');
				}
			});
			$('#btn').click(function(){
				var getImages = $('img');
				getcount = $('img').length;
				var myform = "<form method='post' action='process/save_bookings.php' name='bookform' id='bookform'>";
				myform = myform + "<input type='hidden' name='tdid[]' value=''>";
				myform = myform + "<input type='hidden' name='charges[]' value=''>";
				for(var m=0; m<getcount; m++)
				{
					if($('img').eq(m).attr('src') == '../images/selected.png' || $('img').eq(m).attr('src') == '../images/unavailable.png')
					{
						//flag = true;
						charges = $('img').eq(m).attr('class');
						getTdid = $('img').eq(m).closest('td').attr('id');
						myform = myform + "<input type='hidden' name='tdid[]' value="+getTdid+">";
						myform = myform + "<input type='hidden' name='charges[]' value="+charges+">";
					}
				}
				movie_id = document.getElementById('movie_id').value;
				myform = myform + "<input type='hidden' name='showid' value='<?php echo $showid?>'>";
				myform = myform + "<input type='hidden' name='movie_id' value='"+movie_id+"'>";
				myform = myform + '</form>';
				
				
					document.getElementById('result').innerHTML = myform;
					document.forms['bookform'].submit();
				
				});
			</script>
			<script>
			function changeCharges(id,showid,chargid){
				var charges = document.getElementById(chargid).value;
				var params = "sbmid="+id+"&showid="+showid+"&charges="+charges;
				var url = "process/updatecharges.php";
				$.ajax({
					type: 'POST',
					url: url,
					dataType: 'html',
					data: params,
							
					success: function(data) {
						alert('Charges updated successfully');
						document.getElementById(chargid).value = data;
					}
					});
			}
			</script>
			<?php
		}
	}else
	{
		echo "0";
	}
}

?>