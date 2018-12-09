	<div class='content'>
	<div class="indexform">
		<table width="100%">
		<tr>
			<td class='itabsmall' id='tabMovie'>Movies</td><td class='itabsmall' id='tabTheater'>Theater</td>
			<td style="background:transparent !important;" colspan="2">
				<div>
					<div id="movieform" style="margin-left:100px">
					<form method="post" action="../../bookshow.php" name="formone" onsubmit="return vaidateMovie()">
					<select style="float:left;width:150px;margin:0 5px;" name="location1" id="location1">
						<option value="">Select Location...</option>
						<?php                
							while($size>0)
							{
								if($array[$i]['id']==$_POST['location1'])
								{
						?>
						<option value="<?php echo $array[$i]['id'];?>" selected><?php echo $array[$i]['name'];?></option>
						<?php
					             }
					             else
					             {
					             	?>
					       <option value="<?php echo $array[$i]['id'];?>"><?php echo $array[$i]['name'];?></option>

					             	<?php
					             }
							$size--;
							$i++;

						}
						?>
					</select>
					<select style="float:left;width:150px;margin:0 5px;" name="selectmovies" id="selectmovies">
						<option value="">Select Movies...</option>
					</select>
					<select style="float:left;width:150px;margin:0 5px;" name="mdate" id="mdate">
						<option value="">Select Date...</option>
					   <!--<option value='<?php echo $today ?>'><?php echo $today; ?></option>
					   <option value='<?php echo $tomorrow ?>'><?php echo $tomorrow; ?></option>
					   <option value='<?php echo $dayAftT ?>'><?php echo $dayAftT; ?></option>-->
					</select>
					<input type="submit" id="submit" name='submitone' value="Search Theatres" style="float:left;">
					</form>
					</div>
					<div id="theaterform" style="margin-left:100px">
					<form method="post" action="../../bookshow.php" name='formtwo' onsubmit="return vaidateTheater()">
					<select style="float:left;width:150px;margin:0 5px;" name="locationtwo" id="locationtwo">
						<option value="">Select Location...</option>
						<?php
						$sql = "select * from location";
						$result = mysql_query($sql);
						while($row = mysql_fetch_array($result))
						{
							$id = $row['id'];
							$lname = $row['location'];
							echo"<option value='$id'>".$lname."</option>";
						}
						?>
					</select>
					<select style="float:left;width:150px;margin:0 5px;" name="selecttheatertwo" id="selecttheatertwo">
						<option value="">Select Theater...</option>
					</select>
					<select style="float:left;width:150px;margin:0 5px;" name="mdatetwo" id="mdatetwo">
						<option value="">Select Date...</option>
					   <!--<option value='<?php echo $today ?>'><?php echo $today; ?></option>
					   <option value='<?php echo $tomorrow ?>'><?php echo $tomorrow; ?></option>
					   <option value='<?php echo $dayAftT ?>'><?php echo $dayAftT; ?></option>-->
					</select>
					<input type="submit" id="submit" name='submittwo' value="Search Movies">
					</form>
					</div>
				</div>
			</td>
			</tr>
		</table>
	</div>
	</div>