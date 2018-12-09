<?php
if(!(isset($_SESSION['theater_id'])))
{
	header('location:../theater/index.php');
}
?>