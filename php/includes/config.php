<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $hostname = "localhost"; 
    $dbname = "hcmg";
    $username = "root";
    $password = "";
    
    //connection to the database
    $db = new PDO('mysql:host='.$hostname.'; dbname='.$dbname.'; charset=utf8',$username, $password);

    //set some db attributes
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    defined('APP_NAME') ? null : define('APP_NAME', 'WEB PROGRAMMING ASSIGNMENT');
?>