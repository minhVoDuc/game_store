<?php
    session_start();
    session_destroy();
    sleep(0.1);
    header("Location: ../../index.php");
    die();
?>