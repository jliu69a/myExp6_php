<?php
// http://www.mysohoplace.com/php_hdb/php_GL/payments_vendors_lookup.php

// Create connection
include('connection_header.php');

if ($_GET) {
    $year = mysqli_real_escape_string($con, $_GET['year']);
    $PAndVId = mysqli_real_escape_string($con, $_GET['pandvid']);
    $isForPayment = mysqli_real_escape_string($con, $_GET['isforpayment']);
    
    if (is_null($paymentId)) {
        $paymentId = "0";
    }
    
    if (is_null($year)) {
        $year = date("Y");
    }
    
    $queryTerms = "";
    if ($isForPayment == "1") {
        $queryTerms = "AND `payment_id` = $PAndVId ";
    }
    else {
        $queryTerms = "AND `vendor_id` = $PAndVId ";
    }
    
    $sql = "SELECT a.id, a.date, a.time, a.vendor_id, b.vendor, a.payment_id, c.payment, a.amount, a.note FROM MyExp_Data a, MyExp_Venders b, MyExp_Payments c WHERE a.vendor_id = b.id AND a.payment_id = c.id AND a.date LIKE '$year-%' $queryTerms ORDER BY a.date DESC, a.time DESC;";
  
    if ($result = mysqli_query($con, $sql)) {
        $tempArray = array();
        $resultArray = array();
        
        while($row = $result->fetch_object()) {
            $tempArray = $row;
            array_push($resultArray, $tempArray);
        }
    }
    
    header('Content-Type: application/json');
    $data = array(array('expense' => $resultArray));
    
    echo json_encode($data);
}
else {
    echo "not POST method";
}

mysqli_close($con);
?>
