<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate prod
    $user = new User($db);

    //set User_id and get all Product_id in this user library
    $user->User_id = $_POST['User_id'];
    if ($user->remove_cartItem($_POST['Product_id'])){
        session_start();
        $user->get_cart();        
        $_SESSION['cartNum'] = count($user->cart);
        echo json_encode(array('checker' => true));
    }
    else echo json_encode(array('checker' => false));
?>