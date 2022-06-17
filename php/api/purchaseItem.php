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
    $user->get_cart();

    $numCart = count($user->cart);
    if ($numCart>0) $user->savePurchaseLog();

    //convert to JSON and output
    echo json_encode(array('number' => $numCart));
?>