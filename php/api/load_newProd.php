<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate prod
    $prod = new Product($db);

    //get all current products and sort them from latest to oldest (through Product_id)
    $raw_list = $prod->getAll()->fetchAll(PDO::FETCH_ASSOC);
    usort($raw_list, function($a, $b){
        return $a['Product_id'] < $b['Product_id'];
    });

    $newProd_arr = array();
    $newProd_arr['data'] = array();

    function limitString($Desp, $charLimit){ // Function: limit string $Desp by $charLimit characters
        $Desp = wordwrap($Desp, $charLimit);
        $Desp = explode("\n", $Desp);
        $Desp = $Desp[0] . '...';
        return $Desp;
    }

    //get 4 latest products
    for ($i = 0; $i < 4; $i++){
        $item = $raw_list[$i];
        $item['Description'] = limitString($item['Description'], 130); //Limit product's description by 130 characters
        array_push($newProd_arr['data'], $item);
    }

    //convert to JSON and output
    echo json_encode($newProd_arr);
?>