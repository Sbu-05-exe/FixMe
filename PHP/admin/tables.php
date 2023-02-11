<?php
    require_once("../config.php");
    require_once("../secure.php");
    require_once("../sql.php");
    require_once("../validation.php");

    isUserTypeAdmin();


     if (isset($_REQUEST['submit'])) {
        $table = $_REQUEST['selection'];
     }
     if(isset($_REQUEST['button'])=='delete'){
        deleteRows ($_REQUEST['selection'],$_REQUEST['id']);
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/main.css" rel="stylesheet"/>
    <link href="../../css/dashboard.css" rel="stylesheet"/>
    <link href="../../css/register.css" rel="stylesheet"/>
    <link href="../../css/table.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>FixMe | Tables</title>
</head>
<body>
    <header></header>
    <main id="admin-dashboard">

        <nav class="menu">
                <a href="index.php"><i class="home icon big"></i></a><br>
                <a href="analytics.php"><i class="chart pie icon big"></i></a><br>
                <a href="tables.php"><i class="bullseye icon big"></i></a>

        </nav> 
        
        <div class="content-section column-container">
            <div class="top-banner">
                <h2>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']?> </h2>
                    <div class="spacer"></div>
                    <!--<input type="submit" name="logout" value="logout"  method="POST">-->
                    <a class="icon" href="../../php/logout.php"><i class="sign out alternate icon big"></i></i></a><br>
            </div>
            <div class="center-children row-container">
                <section class="user-tables">
                    <div class="row-container center-children">
                        <div class="form-container">

                            <form class="update-form" action="">
                                <table>
                                    <td>
                                        <select name="selection" id="selection">
                                            <option selected hidden>Select a table</option>
                                            <option value='user'>User</option>
                                            <option value='technician'>Technician</option>
                                            <option value='repairjob'>Repair Jobs</option>
                                            <option value='orders'>orders</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" value="go" name="submit">
                                    </td>
                                </table>
                            </form>
                        </div>
                        <!-- <h3>User Table</h3> -->
                    </div>
                    
                    <table
                    <?php
                    $class = "table-view hide";
                    if(isset($_REQUEST['submit'])){
                        if ($table =='user') {
                            $class = "table-view";
                        }
                    }
                    echo "class=\"$class\""
                    ?>>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name </th>
                                <th>Email</th>
                                <th></th>     
                            </tr>
                        </thead>
                        <tbody>
 
                        <?php
                        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
                        
                        $queryTechnicians = "SELECT users.userID, firstName, lastName, email FROM users 
                                             LEFT JOIN repairjobs ON users.userID = repairjobs.userID WHERE userType = 'user' group by users.userID Having COUNT(repairjobs.userID) = 0;";
                        
                        $result = mysqli_query($conn, $queryTechnicians) or die(mysqli_error($conn));
                        
                        while ($row = mysqli_fetch_row($result)) {

                            echo "<tr class=\"selectable\">";
                            
                            $id = $row[0];
                            foreach ($row as $data) {
                                echo "<td >$data</td>";
                            }
                            echo "<td><a href=\"tables.php?selection=user&submit=go&id=$id&button=delete\"><input type=\"button\" value=\"delete\"></a></td>";
                            echo "</tr>";

                        }
                        mysqli_close($conn);
                        ?>
                        </tbody>

                    </table>

                    
                    <table 
                    <?php
                    $class = "table-view hide";
                    if(isset($_REQUEST['submit'])){
                        if ($table=='technician') {
                            $class = "table-view";
                        }
                    }
                    echo "class=\"$class\""
                    ?>>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name </th>
                                <th>Email</th>
                                <th>Salary</th>
                                <th>Experience</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
                        
                        $queryUsers = "SELECT TechnicianID, firstname, lastname, email, CONCAT('R',salary), Experience FROM technician JOIN users ON technician.userID = users.userID;";
                        
                        $result = mysqli_query($conn, $queryUsers) or die(mysqli_error($conn));
                        
                        while ($row = mysqli_fetch_row($result)) {
                            
                            echo "<tr class=\"selectable\">";
                            
                            $id = $row[0];
                            foreach ($row as $data) {
                                echo "<td >$data</td>";
                            }
                            echo "</tr>";
                            
                        }
                        mysqli_close($conn);
                        ?>
                        </tbody>
                        
                    </table>

                    <table 
                    <?php
                    $class = "table-view hide";
                    if(isset($_REQUEST['submit'])){
                        if ($table=='repairjob') {
                            $class = "table-view";
                        }
                    }
                    echo "class=\"$class\""
                    ?>>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>user Id</th>
                                <th>Device Id</th>
                                <th>Description</th>
                                <th>Difficulty</th>
                                <th>Status</th>
                                <th>ETC</th>
                                <th>Inspection Fee</th>
                                <th>Repair Fee</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
        
                        <?php
                        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
                        
                        $queryRepairJobs = "SELECT repairJobID, userID, deviceID, description, difficulty, status, CONCAT(etc, ' days'), CONCAT('R',inspectionFee),CONCAT('R',repairFee)
                        FROM repairjobs;";
                        
                        $result = mysqli_query($conn, $queryRepairJobs) or die(mysqli_error($conn));
                        
                        while ($row = mysqli_fetch_row($result)) {
        
                            echo "<tr class=\"selectable\">";
                            
                            $id = $row[0];
                            foreach ($row as $data) {
                                echo "<td >$data</td>";
                            }
                            //echo "<td><a href=\"tables.php?selection=user&submit=go&id=$id&button=delete\"><input type=\"button\" value=\"delete\"></a></td>";
                            echo "</tr>";
        
                        }
                        mysqli_close($conn);
                        ?>
                        </tbody>
        
                    </table>

                    <table 
                    <?php
                    $class = "table-view hide";
                    if(isset($_REQUEST['submit'])){
                        if ($table=='orders') {
                            $class = "table-view";
                        }
                    }
                    echo "class=\"$class\""
                    ?>>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Price</th>
                                <th>Name</th>
                                <th>Repair Job Id</th>
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
        
                        <?php
                        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
                        
                        $queryParts = "SELECT PartID, CONCAT('R',Price), Name, repairJobID FROM parts;";
                        
                        $result = mysqli_query($conn, $queryParts) or die(mysqli_error($conn));
                        
                        while ($row = mysqli_fetch_row($result)) {
        
                            echo "<tr class=\"selectable\">";
                            
                            $id = $row[0];
                            foreach ($row as $data) {
                                echo "<td >$data</td>";
                            }
                            //echo "<td><a href=\"tables.php?selection=user&submit=go&id=$id&button=delete\"><input type=\"button\" value=\"delete\"></a></td>";
                            echo "</tr>";
        
                        }
                        mysqli_close($conn);
                        ?>
                        </tbody>
        
                    </table>
                </section>
            </div>
        </div>

    </main>
    <footer></footer>

    
</body>
</html>