<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate prod
    $user = new Authentication($db);

    if ($_GET['action']=='get'){
        $result = $user->getAdmin();

        $allAdmin_arr = array();
        $allAdmin_arr['data'] = $result->fetchAll(PDO::FETCH_ASSOC);

        //convert to JSON and output
        echo json_encode($allAdmin_arr);
    }
    else if ($_GET['action']=='add'){
        function checkLen($pass, $len){
            return (bool)(strlen($pass) >= $len);
        }
    
        function validate($pass){
            $ref = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{6,})$/";
            return preg_match($ref, $pass);
        }

        if (!checkLen($_GET['User_name'], 5)) echo json_encode(array('status'=>'fail', 'message' => 'Username must be at least 5 characters'));
        else if (!checkLen($_GET['User_pass'], 6)) echo json_encode(array('status'=>'fail', 'message' => 'Password must be at least 6 characters'));
        else if (!validate($_GET['User_pass']))  echo json_encode(array('status'=>'fail', 'message' => 'Password must contain at least characters of a-z, A-Z and 0-9'));
        else{
            $nameList = $user->readAllUserName();
            $checker = '';
            while($row = $nameList->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                if($_GET['User_name'] == $User_name){
                    $checker = 'fail';
                    break;
                }
            }
            if ($checker=='fail') echo json_encode(array('status'=>'fail', 'message' => 'This username is already taken'));
            else{
                $result = $user->readAllUserID();
                $id = 1;
                if ($result->rowCount()){
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        if($id != $User_id) break;
                        $id++;
                    }
                }
                $user->User_id = $id;
                $user->User_name = $_GET['User_name'];
                $user->User_password = md5(sha1(md5($_GET['User_pass'])));
                if ($user->createAdmin()) echo json_encode(array('status'=>'succ'));
                else echo json_encode(array('status'=>'fail', 'message' => 'Cannot create admin'));
            }
        }
    }
    else {//action: delete
        $user->User_id = $_GET['User_id'];
        if($user->delete()) echo json_encode(array('status'=>'succ'));
        else  echo json_encode(array('status'=>'fail', 'message' => 'Cannot delete admin'));
    }
?>