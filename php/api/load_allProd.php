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

    $allProd_arr = array();
    $allProd_arr['data'] = array();

    function limitString($Desp, $charLimit){ // Function: limit string $Desp by $charLimit characters
        $Desp = wordwrap($Desp, $charLimit);
        $Desp = explode("\n", $Desp);
        $Desp = $Desp[0] . '...';
        return $Desp;
    }

    //get 4 latest products
    foreach ($raw_list as $item){
        if ($_GET['type']=='shorten') $item['Description'] = limitString($item['Description'], 130); //Limit product's description by 130 characters
        array_push($allProd_arr['data'], $item);
    }

    //convert to JSON and output
    echo json_encode($allProd_arr);
?>