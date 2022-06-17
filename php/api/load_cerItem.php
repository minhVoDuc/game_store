<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate prod
    $prod = new Product($db);

    $prod->Product_id = $_GET['Prod_id'];

    $prod_arr = array();
    $prod_arr['data'] = array();

    array_push($prod_arr['data'], $prod->getSingle());

    //convert to JSON and output
    echo json_encode($prod_arr);
?>