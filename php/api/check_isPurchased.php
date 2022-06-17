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
    $user->User_id = $_POST['User_id'];
    $checker = 'is-free';

    //echo $_POST['Product_id']."+".$user->check_itemInCart($_POST['Product_id'])."+".$user->check_itemInLib($_POST['Product_id']);

    if ($user->check_itemInCart($_POST['Product_id']) == true) $checker = 'in-cart';
    else if ($user->check_itemInLib($_POST['Product_id']) == true) $checker = 'owned';

    echo json_encode(array('checker' => $checker));
?>