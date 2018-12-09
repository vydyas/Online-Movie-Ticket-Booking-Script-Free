<table border=1 cellpadding=2>
<?php

$tr=2;
$td=10;

for ($i=1; $i<=$tr; $i++) { 
	
	?>
	<tr>
		<?php
		for($j=1;$j<=$td;$j++)
		{
?>
<td>
	<?php
	if($i==1 && $j==5)
	{
		echo "<img src='images/available.png'/>";
	}
	else
	{
	echo "&nbsp;&nbsp;&nbsp;&nbsp";	
	}

	?>
		
</td>
<?php
	     }
	     ?>
	
	</tr>
	<?php
}
?>	
</table>
<?php

echo $today = date('h:i A')."<br/>";

echo $time=strtotime('10:44 PM')."<br/>";

echo $today=strtotime(date('h:i A'))."<br/>";

echo $time-$today;


?>