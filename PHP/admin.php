<?php 
    require_once("config.php");
    //connect to db
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("cannot connect- suck it!!!");

    //Execute queries
    $createUsertable = "CREATE TABLE User ( userID int NOT NULL, 
                                            firstName varchar(30), 
                                            lastName varchar(30),
                                            userName varchar(30) NOT NULL,
                                            password varchar(30) NOT NULL,
                                            userType varchar(30) NOT NULL,
                                            PRIMARY KEY (userID)
    );";

    $results = mysqli_query($conn,$createUsertable) or die(mysqli_error($conn));
    echo "We did a thing!!! yay";
    //close
    $close = mysqli_close($conn);

?>