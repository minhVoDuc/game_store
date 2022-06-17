<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate prod
    $user = new User($db);
    $prod = new Product($db);

    $user->User_id = $_POST['User_id'];
    if ($user->add_cartItem($_POST['Product_id'])) echo json_encode(array('status' => 'succ'));
    else echo json_encode(array('status' => 'fail'));
?>