<?php
    //header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //initializing 
    include_once('../core/initialize.php');

    //instantiate prod
    $user = new User($db);
    $auth = new Authentication($db);

    //set User_id and get all Product_id in this user library
    $user->User_id = $_POST['User_id'];

    function checkLen($pass, $len){
        return (bool)(strlen($pass) >= $len);
    }

    function validate($pass){
        $ref = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{6,})$/";
        return preg_match($ref, $pass);
    }
    
    if ($_POST['type']=='changeName'){
        $nameList = $user->readAllUserName();
        $checker = '';
        while($row = $nameList->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            if($_POST['New_name'] == $User_name){
                $checker = 'fail';
                break;
            }
        }
        if ($checker=='fail') echo json_encode(array('status'=>'fail', 'message' => 'New username is already taken'));
        else{
            if ($user->changeName($_POST['New_name'])){
                session_start();
                $auth->getByUser_id($user->User_id);
                $_SESSION['User_name'] = $auth->User_name;
                echo json_encode(array('status'=>'succ'));
            } 
            else echo json_encode(array('status'=>'fail'));
        }
    }
    else if ($_POST['type']=='changePass'){        
        $auth->getByUser_id($user->User_id);
        if (!isset($_POST['Old_pass']) || $_POST['Old_pass']=="") echo json_encode(array('status'=>'fail', 'message' => 'Please enter current password'));
        else if (!isset($_POST['New_pass']) || $_POST['New_pass']=="") echo json_encode(array('status'=>'fail', 'message' => 'Please enter new password'));
        else if (!isset($_POST['Renew_pass']) || $_POST['Renew_pass']=="") echo json_encode(array('status'=>'fail', 'message' => 'Please re-enter new password'));
        else{
            $oldPass = md5(sha1(md5($_POST['Old_pass'])));
            $newPass = $_POST['New_pass'];
            $reNewPass = $_POST['Renew_pass'];
            if ($auth->User_password != $oldPass) echo json_encode(array('status'=>'fail', 'message' => 'Wrong current password'));
            else if (!checkLen($newPass, 6)) echo json_encode(array('status'=>'fail', 'message' => 'New password must be at least 6 characters'));
            else if (!validate($newPass)) echo json_encode(array('status'=>'fail', 'message' => 'New password must contain at least characters of a-z, A-Z and 0-9'));
            else if ($newPass != $reNewPass) echo json_encode(array('status'=>'fail', 'message' => 'New password re-entered differently'));
            else{
                if ($user->changePass(md5(sha1(md5($newPass))))) echo json_encode(array('status'=>'succ'));
                else echo json_encode(array('status'=>'fail', 'message' => 'Cannot change password'));
            }
        }
    }
?>