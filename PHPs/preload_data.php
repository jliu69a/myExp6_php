<?php
// http://www.mysohoplace.com/php_hdb/php_GL/preload_data.php

// Create connection
include('connection_header.php');

$now = new \DateTime('now');
$month = $now->format('m');
$year = $now->format('Y');
$day = $now->format('d');
$currentDate = $year . "-" . $month . "-" . $day;

if ($_GET) {
  $currentDate = mysqli_real_escape_string($con, $_GET['date']);  
}

include 'data_loading.php';

mysqli_close($con);
?>
