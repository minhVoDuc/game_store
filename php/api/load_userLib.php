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
    $user->get_gameLib();

    function limitString($Desp, $charLimit){ // Function: limit string $Desp by $charLimit characters
        $Desp = wordwrap($Desp, $charLimit);
        $Desp = explode("\n", $Desp);
        $Desp = $Desp[0] . '...';
        return $Desp;
    }

    //iterate all Product_id got above and get product info from database
    $userLib_arr = array();
    $userLib_arr['data'] = array();

    foreach ($user->gameLib as $id){
        $prod->Product_id = $id['Product_id'];
        $item = $prod->getSingle();
        $item['Description'] = limitString($item['Description'], 170); //Limit product's description by 130 characters
        array_push($userLib_arr['data'], $item);
    }

    //convert to JSON and output
    echo json_encode($userLib_arr);
?>