<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate prod
    $lib = new userLib($db);
    $user = new Authentication($db);

    //get info
    $lib->productID = $_GET['Prod_id'];
    $res = $lib->getInfo();
    $num = $res->rowCount();

    if ($num > 0){
        $userPur_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $user->User_id = $User_id;
            $name = $user->getName();
            $User_name = $name->fetch(PDO::FETCH_ASSOC);
            extract($User_name);
            $library = array(
                'libID' => $Product_id,
                'userID' => $User_id,
                'productID' => $Product_id,
                'userName' => $User_name
            );
            // creating new table row per record
            array_push($userPur_arr, $library);
        }
        echo json_encode(array('status' => 'notempty', 'data' => $userPur_arr));
    }
    else echo json_encode(array('status' => 'empty'));
?>