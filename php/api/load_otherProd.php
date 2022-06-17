<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate prod
    $prod = new Product($db);
    $prod->Product_id = $_GET['Prod_id'];

    //get all current products and sort them from latest to oldest (through Product_id)
    $raw_list = $prod->getAll()->fetchAll(PDO::FETCH_ASSOC);

    $otherProd_arr = array();
    $otherProd_arr['data'] = array();

    function limitString($Desp, $charLimit){ // Function: limit string $Desp by $charLimit characters
        $Desp = wordwrap($Desp, $charLimit);
        $Desp = explode("\n", $Desp);
        $Desp = $Desp[0] . '...';
        return $Desp;
    }

    //get 4 latest products
    $targNum = min(4, count($raw_list)-1);
    $mark = array_fill(0, count($raw_list), 0);
    for ($i = 0; $i < $targNum; $i++){
        do{
            $index = rand(0, count($raw_list)-1);
        }while($mark[$index] || $index+1 == $prod->Product_id);
        $mark[$index]=1;
        $item = $raw_list[$index];
        $item['Description'] = limitString($item['Description'], 130); //Limit product's description by 130 characters
        array_push($otherProd_arr['data'], $item);
    }

    //convert to JSON and output
    echo json_encode($otherProd_arr);
?>