<?php
session_start();
include('../db/db.php');
if(session_destroy())
{
header('Location:index.php');
}
?>