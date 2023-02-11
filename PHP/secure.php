<?php
require_once("config.php");
session_start();

if (!isset($_SESSION['access'])){
    //user does has not logged in, take them to login page (or should we take them to the landing page?) 
    header("Location:../login.php");
    // header("Location:../");

} else {

    if(!isset($_SESSION['firsttime'])) {
        $Query = "SELECT * FROM Users WHERE userName = '" . $_SESSION['username'] . "'";
        //connect to the database
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");
        //run the username query
        $result = mysqli_query($conn, $Query);
        //get the query result


        $row = mysqli_fetch_array($result);

        // echo print_r($row); // debug statement
        $_SESSION['userid'] = $row["userID"];
        $_SESSION['firstname'] = $row["firstName"];
        $_SESSION['lastname'] = $row["lastName"];
        $_SESSION['username'] = $row["userName"];
        $_SESSION['email'] = $row["email"];
        //not saving password
        $_SESSION['usertype'] = $row["userType"];
        $_SESSION['firsttime'] = "yes";
    }
}

?>