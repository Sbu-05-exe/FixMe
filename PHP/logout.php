<?php
    require_once("secure.php"); // this guy is responsible for keeping the session going
    
    if(isset($_SESSION['access'])) {
        $UserType = $_SESSION['type'];
        unset($_SESSION);
        session_destroy();
        session_write_close();

        if($UserType == "user"){
            header("Location:../php/login.php");
        }elseif($UserType == "technician"){
            header("Location:../php/login.php");
        }elseif ($UserType == "admin") {
            header("Location:../php/login.php");
        }
        die;
    }

 ?>