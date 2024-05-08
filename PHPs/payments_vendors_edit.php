<?php
//http://www.mysohoplace.com/php_hdb/php_GL/payments_vendors_edit.php

// Create connection
include('connection_header.php');

if ($_GET) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $name = mysqli_real_escape_string($con, $_GET['name']);
    $isForPayment = mysqli_real_escape_string($con, $_GET['ispayment']);
    $isEdit = mysqli_real_escape_string($con, $_GET['edit']);
    
    //-- save changes
    $name = str_replace("+", " ", $name);
    $name = str_replace("*plus*", "+", $name);
    $name = str_replace("*and*", "&", $name);
    
    $insertSql = "INSERT INTO `MyExp_Venders` (`vendor`) VALUES ('$name');";
    $updateSql = "UPDATE `MyExp_Venders` SET `vendor`='$name' WHERE `id`=$id;";
    $deleteSql = "DELETE FROM `MyExp_Venders` WHERE `id`=$id;";
    
    if ($isForPayment == '1') {
        $insertSql = "INSERT INTO `MyExp_Payments` (`payment`) VALUES ('$name');";
        $updateSql = "UPDATE `MyExp_Payments` SET `payment`='$name' WHERE `id`=$id;";
        $deleteSql = "DELETE FROM `MyExp_Payments` WHERE `id`=$id;";
    }
    
    if ($id == '-1') {
        $result2 = mysqli_query($con, $insertSql);
    }
    else {
        if ($isEdit == '0') {
            $result3 = mysqli_query($con, $deleteSql);
        }
        else {
            $result4 = mysqli_query($con, $updateSql);
        }
    }
}
else {
  echo "not GET method";
}


//-- query latest data
$now = new \DateTime('now');
$month = $now->format('m');
$year = $now->format('Y');
$day = $now->format('d');
$currentDate = $year . "-" . $month . "-" . $day;

include 'data_loading.php';


mysqli_close($con);
?>
