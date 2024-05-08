<?php
// http://www.mysohoplace.com/php_hdb/php_GL/expenses_change.php

//ini_set('display_errors', 1);
//error_reporting(E_ALL|E_STRICT);

// Create connection
include('connection_header.php');

$id = "0";
$expDate = "";
$expTime = "";
$vendorId = "0";
$paymentId = "0";
$amount = "0";
$note = "";
$isEdit = "";

if ($_GET) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $expDate = mysqli_real_escape_string($con, $_GET['date']);
    $expTime = mysqli_real_escape_string($con, $_GET['time']);
    $vendorId = mysqli_real_escape_string($con, $_GET['vendorid']);
    $paymentId = mysqli_real_escape_string($con, $_GET['paymentid']);
    $amount = mysqli_real_escape_string($con, $_GET['amount']);
    $note = mysqli_real_escape_string($con, $_GET['note']);
    $isEdit = mysqli_real_escape_string($con, $_GET['isedit']);

    $note = str_replace("+", " ", $note);
    $note = str_replace("*plus*", "+", $note);
    $note = str_replace("*and*", "&", $note);
    
    //-- $id == -1 : insert
    //-- $id >= 0, $isEdit == 0 : delete
    //-- $id >= 0, $isEdit == 1 : update
    
    $insertSql = "INSERT INTO `MyExp_Data` (`date`, `time`, `vendor_id`, `payment_id`, `amount`, `note`, `is_active`, `update_date`) VALUES ('$expDate', '$expTime', $vendorId, $paymentId, '$amount', '$note', '1', now());";
    
    $updateSql = "UPDATE `MyExp_Data` SET `date`='$expDate', `time`='$expTime', `vendor_id`=$vendorId, `payment_id`=$paymentId, `amount`='$amount', `note`='$note', `update_date`=now() WHERE `id` = $id and `is_active` = '1';";
    
    $deleteSql = "DELETE FROM `MyExp_Data` WHERE `id` = $id and `is_active` = '1';";
    
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

$currentDate = $expDate;
include 'data_loading.php';

mysqli_close($con);
?>
