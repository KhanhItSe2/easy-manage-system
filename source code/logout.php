<?php
include_once('Data/db.php');
session_start();
if(session_destroy())
{
header("Location: index.php");
}
?>