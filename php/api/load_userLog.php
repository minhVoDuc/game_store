<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate prod
    $user = new User($db);

    //set User_id and get all Product_id in this user library
    $user->User_id = $_GET['User_id'];
    $user->get_purchaseLog();

    //iterate all Product_id got above and get product info from database
    $userLog_arr = array();
    $userLog_arr['log'] = $user->purchaseLog;

    //convert to JSON and output
    echo json_encode($userLog_arr);
?>