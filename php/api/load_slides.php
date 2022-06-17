<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate car
    $prod = new Product($db);

    //get first three product
    $raw_list = $prod->getSome(3);

    $slide_arr = array();
    $slide_arr['data'] = array();

    while($row = $raw_list->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $item = array(
            'Product_id' => $Product_id,
            'Name' => $Name,
            'Description' => $Description,
            'Type' => $Type,
            'Produce_studio' => $Produce_studio,
            'Price' => $Price,
            'Background_image' => $Background_image,
            'Square_image' => $Square_image,
            'Small_image1' => $Small_image1,
            'Small_image2' => $Small_image2,
            'Small_image3' => $Small_image3
        );
        array_push($slide_arr['data'], $item);
    }

    //convert to JSON and output
    echo json_encode($slide_arr);
?>