<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    session_start();
    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true){
        echo json_encode(array('show' => ['.panel-user', '#sec_userLib header a'],
                               'hide' => ['.panel-guest', '#lib_asGuest']));
    }
    else{
        echo json_encode(array('show' => ['.panel-guest', '#lib_asGuest'],
                               'hide' => ['.panel-user', '#sec_userLib header a']));
    }
?>