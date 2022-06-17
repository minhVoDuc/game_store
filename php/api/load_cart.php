<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate prod
    $user = new User($db);
    $prod = new Product($db);

    //set User_id and get all Product_id in this user library
    $user->User_id = $_GET['User_id'];
    $user->get_cart();

    //iterate all Product_id got above and get product info from database
    $cart_arr = array();
    $cart_arr['data'] = array();

    foreach ($user->cart as $id){
        $prod->Product_id = $id['Product_id'];
        $item = $prod->getSingle();
        array_push($cart_arr['data'], $item);
    }

    //convert to JSON and output
    echo json_encode($cart_arr);
?>