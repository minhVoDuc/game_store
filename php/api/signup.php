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
    if (!isset($_POST['repass']) || $_POST['repass'] == "") echo json_encode(array('message' => 'Please re-enter password', 'status' => 'fail'));
    else{
        $auth->User_name = $_POST['username'];
        $auth->User_password = md5(sha1(md5($_POST['pass'])));
        $auth_repass = md5(sha1(md5($_POST['repass'])));
        if (!$auth->getByUser_name($auth->User_name)){
            if ($auth->User_password === $auth_repass){
                //create new user
                $userID_list = $user->readAllUserID();
                $id = 1;
                if ($result->rowCount()){
                    while($row = $userID_list->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        if($id != $User_id) break;
                        $id++;
                    }
                }
                $auth->User_id = $id;
                if ($auth->createUser()){
                    session_start();
                    $auth->getByUser_name($auth->User_name);
                    $_SESSION['User_id'] = $auth->User_id;
                    $_SESSION['User_name'] = $auth->User_name;
                    $_SESSION['isLogged'] = true;
                    $_SESSION['cartNum'] = 0;
                    echo json_encode(array('message' => 'Successfully sign up', 'status' => 'succ'));
                }
                else{
                    echo json_encode(array('message' => 'Cannot sign up', 'status' => 'fail'));
                }
            }
            else echo json_encode(array('message' => 'Password re-entered differently', 'status' => 'fail'));
        }
        else echo json_encode(array('message' => 'Username is already taken', 'status' => 'fail'));
    }    
?>