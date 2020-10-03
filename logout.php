<?php
    session_start();
    session_unset();
    session_destroy();
    $_SESSION = array();
    $_SESSION['logged_in'] = "";
    $_SESSION['access_token']="";
    header("Location:login.php");
?>  