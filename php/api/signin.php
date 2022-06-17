<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate car
    $auth = new Authentication($db);

    //get raw data
    $User_name = $_POST['username'];
    $User_password = md5(sha1(md5($_POST['pass'])));

    if (!$auth->getByUser_name($User_name)) echo json_encode(array('message' => 'Username does not exist', 'status' => 'fail'));
    else{
        if ($User_password != $auth->User_password) echo json_encode(array('message' => 'Wrong password', 'status' => 'fail'));
        else{
            session_start();
            $user = new User($db);
            $user->User_id = $auth->User_id;
            $user->get_cart();
            $_SESSION['User_id'] = $auth->User_id;
            $_SESSION['User_name'] = $auth->User_name;
            $_SESSION['isLogged'] = true;
            $_SESSION['cartNum'] = count($user->cart);
            if ($auth->is_Admin == 1) echo json_encode(array('message' => 'Welcome admin '.$User_name.'!', 'status' => 'succ_admin'));
            else echo json_encode(array('message' => 'Welcome back '.$User_name.'!', 'status' => 'succ_user'));
        }
    }
?>