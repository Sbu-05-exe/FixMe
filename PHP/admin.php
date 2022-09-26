<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>  
    <form action="admin.php" >
        <h1>Drop Table</h1>
        <input type="text" name="tablename" placeholder="tablename">
        <input type="submit" name="submit" value="delete">

        <h2>Create Table</h2>
        <input type="text" name="tablename"  placeholder="tablename" col="100"> <br/>
        <textarea type="textarea" name="sql"> </textarea>
        <input type="submit" name="submit" value="create">
    </form>

</body>
</html>

<?php 

    require_once("config.php");
    //connect to db
    

    //CREATE QUERIES
    $createUsertable = "CREATE TABLE Users ( userID INT NOT NULL, 
                                            firstName varchar(30), 
                                            lastName varchar(30),
                                            userName varchar(30) NOT NULL,
                                            password varchar(30) NOT NULL,
                                            userType ENUM('user', 'technician', 'admin') NOT NULL,
                                            PRIMARY KEY (userID))";

    // this sql query has been tested and works
    $createDeviceTable = "CREATE TABLE Devices (deviceID INT NOT NULL,
                                            userID INT,
                                            category ENUM('desktop', 'laptop', 'tablet') NOT NULL,
                                            name varchar(30) NOT NULL,
                                            FOREIGN KEY (userID) REFERENCES Users(userID))
                                            PRIMARY KEY(deviceID)";
    // this sql query has been tested and works

    
    $createRepairJobTable = "CREATE TABLE RepairJobs (repairJobID INT NOT NULL,
                                            userID INT NOT NULL,
                                            deviceID INT NOT NULL,
                                            description VARCHAR(255),
                                            difficulty ENUM('easy', 'medium', 'hard') DEFAULT 'easy' NOT NULL,
                                            status ENUM('queued', 'inspection', 'repairing', 'ordering part', 'done', 'paid') NOT NULL,
                                            etc INT NOT NULL, 
                                            cost DECIMAL(10,2) NOT NULL ) ";

    //is the Estimated number of Days until Completion
    // this sql query has been tested and works

    $createPartsTable = "CREATE TABLE parts (PartID INT NOT NULL PRIMARY KEY, 
                                                Price DECIMAL (10,2), 
                                                Name VARCHAR (30), 
                                                repairJobID INT, 
                                                FOREIGN KEY (repairJobID) REFERENCES RepairJobs(repairJobID) )";

    $createTechnicianTable = "CREATE TABLE technician (TechnicianID INT NOT NULL PRIMARY KEY,
                                                        Salary DECIMAL(10, 2), 
                                                        Experience VARCHAR (30), 
                                                        Picture VARCHAR (30) );";

    $createJobGroupTable = "CREATE TABLE jobGroup (repairJobID INT NOT NULL, 
                                                    TechnicianID INT NOT NULL, 
                                                    FOREIGN KEY (repairJobID) REFERENCES RepairJobs(repairJobID)
                                                    FOREIGN KEY (TechnicianID) REFERENCES technician(TechnicianID) )";

    function showTables() {
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");
        $result = mysqli_query($conn, "SHOW TABLES");
        echo "<h3>Current tables</h3>";
        echo "<ol>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<li> {$row['Tables_in_ctrls']}</li>";
        }
        echo "</ol>";
        mysqli_close($conn);
    }
    
    function createTable($sql, $tablename) {
        // connect
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");
        // instruct
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        // close
        mysqli_close($conn);
        echo "<p style=\"color:green;\">Successfully created table:  $tablename </p>";

    }

    function destroyTable($tablename) {
        // connect
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");
        // instruct
        $sql = "DROP TABLE $tablename";
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        // close
        mysqli_close($conn);
        echo "<p style=\"color:green;\">Successfully dropped table:  $tablename </p>";

    } // destroy table

    if (isset($_REQUEST["submit"])) {
        if ($_REQUEST["submit"] == "delete") {
            $tablename = $_REQUEST["tablename"];
            destroyTable($tablename);
        } elseif($_REQUEST["submit"] == "create") {

            $tablename = $_REQUEST["tablename"];
            $sql = $_REQUEST["sql"];
            createTable($sql, $tablename);
        }


    } // 

    showTables();

?>