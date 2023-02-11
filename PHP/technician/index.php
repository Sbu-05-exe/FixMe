<?php
    require_once("../secure.php");
    require_once("../config.php");
    require_once("../sql.php");
    require_once("../validation.php");

    isUserTypeTechnician();

    $username = "";
    $userid = 0;
    $deviceid = 0;
    $filter_device = false;
    if (isset($_REQUEST["username"])) {
        $filter_device = true;
        $username = $_REQUEST["username"];
    }
    
    if(isset($_REQUEST['submit'])){
        // print_r($_REQUEST);

        $name = $_REQUEST["devicename"];
        $userid = $_REQUEST['userid'];

        // echo print_r($_REQUEST);
        $deviceid = getDeviceID($userid, $name);
        $description = $_REQUEST['description'];
        $difficulty = $_REQUEST['difficulty'];
        $etc = $_REQUEST['etc'];
        $t=time();
        $timestamp = date("Y-m-d",$t) . " " . date("h:i:s");

        // CREATE the new repair job
        createRepairJob($userid,$deviceid,$description,$difficulty,$etc,$timestamp);

        // SELECT the most current repair job and get its id
        $jobId = getRepairJobFromTimeStamp($userid, $deviceid, $timestamp);

        // Use that ID to INSERT a notification

        // echo $jobId;
        insertNewNotification($jobId, 'queued');

        header("Location: assignment.php?id=$deviceid");
    }

    if(isset($_REQUEST["logout"])){
        require_once("../../php/logout.php");
        //var_dump($_GET, $_REQUEST);
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <link href="../../css/main.css" rel="stylesheet"/>
    <link href="../../css/register.css" rel="stylesheet"/>
    <link href="../../css/dashboard.css" rel="stylesheet"/>
    <link href="../../css/technician.css" rel="stylesheet"/>
    <link href="../../css/table.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>FixMe | Technician Home</title>
</head>
<body>
<header></header>
    <main id="technician-dashboard" >          
        <nav class="menu">
            <a href="index.php"><i class="home icon big"></i></a><br>
            <a href="profile.php"><i class="user circle icon big"></i></a><br>
            <a href="tasks.php"><i class="tasks icon big"></i></a><br>
            <a href="assignment.php"><i class="clipboard outline icon big"></i></a>
        </nav>
        <div class="content-section column-container">
            <div class="top-banner">
                <h2>Welcome <?php
                         echo $_SESSION['firstname'] . " " . $_SESSION['lastname']  ?>
                         </h2>
                    <div class="spacer"></div>

                        <div class="options">
                        <h3>Technician</h3>
                        <a href="user"></a>
                        </div>
                        &nbsp;
                    <!--<input type="submit" name="logout" value="logout"  method="POST">-->
                    <a class="icon" href="../../php/logout.php"><i class="sign out alternate icon big"></i></i></a><br>
            </div>
            <div class="row-container">
                <section class="select-user">
                    <h2>Select User</h2>
                    <div class="table-container">

                        <table id="user-table" class="view-table">
                            <!-- <thead> -->
                            <tr>
                                <th>Name</th>
                                <th>Surname </th>
                                <th>Username </th>
                            </tr>
                            <!-- <thead> -->
                                
                            <!-- </thead> -->
                            <tbody>
                                <!-- <tr>
                                    <td>blank</td>
                                </tr> -->
                                <?php
                                $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
                                
                                // $queryUsers = "SELECT * FROM users WHERE userType = 'user'";
                                // $queryUserWhoHaveDevice = "SELECT * FROM users AS U 
                                // INNER JOIN devices AS D ON U.userID = D.userID
                                // LEFT JOIN repairJobs AS R on R.deviceID = D.deviceID 
                                // WHERE userType = 'user'  
                                // GROUP BY U.userID";

                                $queryUsersWhoHaveDevices =
                                                       "SELECT * 
                                                        FROM Devices as D
                                                        INNER JOIN users as U ON U.userID = D.userID 
                                                        -- INNER JOIN devices AS D ON U.userID = D.userID
                                                        LEFT JOIN repairJobs AS R ON R.DeviceID = D.deviceID
                                                        WHERE deleted = 'no' AND (isnull(status) OR status = 'done') AND userType = 'user'
                                                        GROUP BY U.UserID" ;

                                $result = mysqli_query($conn, $queryUsersWhoHaveDevices) or die(mysqli_error($conn));
                                
                                $save_row = [];
                                while ($row = mysqli_fetch_array($result)) {
                                    
                                    // echo print_r($row);
                                    $row_of_class = "selectable";
                                    if ($username === $row["userName"]) {    
                                        $userid = $row[1];
                                        $save_row = $row;
                                        $row_of_class .= " selected";
                                    }
                                    echo "<tr class=\" " . $row_of_class. "\">";

                                    echo "<td>" . $row["firstName"] . "</td>";
                                    echo "<td>" . $row["lastName"] . "</td>";
                                    echo "<td>" . $row["userName"] . "</td>";
                                    echo "</tr class=\"selectable\">";
                                }
                                mysqli_close($conn);
                                ?>
                                <tr>
                                    
                                    <?php
                                    // echo "what";
                                    // echo print_r($save_row);
                                    // echo print_r($queryUsersWhoHaveDevices);
                                    ?>
                                    
                                </tr>
                            </tbody>
                </table>
            </div>
            <button class="hide">create new user</button>
    
            </section>
                <section 
                <?php
                    if (!$filter_device) {
                        echo "class=\"hide\" select-device" ;
                    } else {
                        echo "select-device";
                    }
                ?>
                >

                    <h2>Select device</h2>
                    <div class="table-container">
                        <table id="device-table" class="view-table">
                            <tr>
                                <th>Name</th>
                                <th>Brand </th>
                                <th>Category </th>
                            </tr>
                            <!-- <div> -->
                                <?php
                                $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
        
                                $queryDevices = "SELECT * 
                                                FROM Devices as D
                                                INNER JOIN users as U ON U.userID = D.userID 
                                                LEFT JOIN repairJobs AS R ON R.DeviceID = D.deviceID
                                                WHERE deleted = 'no' AND (isnull(status) OR status='paid') AND U.userName = '" . $username . "'";

                                // $queryDevices = "SELECT * FROM devices AS D, users AS U WHERE U.userID = D.userID AND U.username = '". $username . "'";
        
                                $result = mysqli_query($conn, $queryDevices) or die(mysqli_error($conn));
        
                                while ($row = mysqli_fetch_array($result)) {
                                        // echo print_r($row);
                                        echo "<tr class=\"selectable\">";

                                        $deviceid = $row['deviceID'];
                                        echo "<td>" . $row["name"] . "</td>";
                                        echo "<td>" . $row["brand"] . "</td>    ";
                                        echo "<td>" . $row["category"] . "</td>";
                                        echo "</tr class=\"selectable\">";
                                        }
                                    mysqli_close($conn);
                                    ?>
                            <!-- </div> -->

                </table>
            </div>
                <button class="hide"> create new device</button>
                </section>

                <section 
                <?php 
                $hidden_class = "";
                if (!$filter_device) {
                    $hidden_class = "hide";
                } 
                echo "class=\"add-repair-job-section $hidden_class\""
                ?>
                 
                >
                <div class="form-container">
                        <h1>Add Repair Job</h1>
                        <form class="column-container update-form" class="create-form" action="">
                            <table>
                                <tr>
                                    <td>
                                        <label for="username">Username:</label>
                                        <!-- username option -->
                                    </td>
                                    <td>
                                        <input id="username" name="username" type="text" readonly <?php echo "value=$username"?>>
                                        <!-- <select id="username" autocomplete name="username">
                                            <option selected hidden>Select a Username</option>
                                            <?php 
                                            // $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
                                            
                                            // $queryUsersWhoHaveDevices =
                                            // "SELECT * 
                                            //  FROM Devices as D
                                            //  INNER JOIN users as U ON U.userID = D.userID 
                                            //  -- INNER JOIN devices AS D ON U.userID = D.userID
                                            //  LEFT JOIN repairJobs AS R ON R.DeviceID = D.deviceID
                                            //  WHERE deleted = 'no' AND (isnull(status) OR status = 'done')
                                            //  GROUP BY u.UserID" ;
                                            
                                            // $result = mysqli_query($conn, $queryUsersWhoHaveDevices) or die(mysqli_error($conn));
                                            
                                            // while ($row = mysqli_fetch_array($result)) {

                                            //     $selected = "";
                                                
                                            //     if ($username == $row["userName"]) {
                                                    
                                            //         $userid =$row[1];
                                            //         // echo "<script>alert('userid: " . $userid . "')  </script>";
                                            //         $selected = "selected";
                                            //         // $userid = $row["userid"];
                                            //         // $userid = 0;
                                            //     }

                                                
                                            //     echo "<option $selected value=\"" . $row["userName"] . "\">" . $row["userName"] . "</option>";
                                            // }
                                            // mysqli_close($conn);
                                            ?> 
                                            -->
                                        </select>
                                    </td> 
                            </tr>

                            <tr
                            <?php
                                if (!$filter_device) {
                                    echo "class=\"hide\" " ;
                                } 
                            ?>
                            >           
                                <td>
                                    <!-- device name -->
                                        <label for="devicename">
                                            Device name:
                                        </label>
                                    </td>
                                    <td>

                                        <input id="devicename" name="devicename" readonly type="text" >
                                        <!-- <select  name="devicename" id="devicename"> -->
                                            <!-- <option selected hidden>Select a Device</option> -->

                                            <!-- device name options -->
                                            <?php
                                            //     $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
                                                
                                                
                                            //     $queryDevices = "SELECT * 
                                            //     FROM Devices as D
                                            //     INNER JOIN users as U ON U.userID = D.userID 
                                            //     LEFT JOIN repairJobs AS R ON R.DeviceID = D.deviceID
                                            //     WHERE deleted = 'no' AND (isnull(status) OR status='done') AND U.userName = '" . $username . "'";
                                               

                                            //     $result = mysqli_query($conn, $queryDevices) or die(mysqli_error($conn));

                                            //     while ($row = mysqli_fetch_array($result)) {

                                            //         // echo $row["name"];
                                            //         echo "<option value=\"". $row["name"]."\">" . $row["name"] . "</option>";
                                            //     }
                                            //     mysqli_close($conn);
                                            ?>

                                        <!-- </select> -->
                                        <!-- what happens now -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="difficulty">
                                        Difficulty: <?php ?></label>
                                    </td>                                
                                        <td>
                                            <select id="difficulty" name="difficulty">
                                                <option value="easy">easy</option>
                                                <option value="medium">medium</option>
                                                <option value="hard">hard</option>
                                            </select>
                                        </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="etc">Repair Time (in days): </label>
                                    </td>
                                    <td>

                                        <input required id="etc" type="number" value="1" min="1" max="100" name="etc">
                                    </td>
                                </tr>
                                    <tr>
                                        <td>
                                            <label for="description">
                                                Description
                                            </label>
                                        </td>
                                        <td>
                                            <!-- what is this code doing? -->
                                            <textarea
                                            <?php
                                            echo "value='$userid $deviceid'" 
                                            ?>
                                            placeholder="A meaningul description... " 
                                            required id="description" name="description" id="" cols="38" rows="3"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                        <input
                                    <?php if (!$filter_device) {
                                            echo "disabled";
                                        }
                                    ?> 
                                    id="submit"
                                    type="submit" name="submit" style="width:100%" value="create">
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden"
                                    name="userid"
                                    <?php 
                                            echo "value=\"$userid\"";
                                    ?>
                                    >
                        </form>
                        </div>
                        </section>

                          
            </div>
        </div>
    </main>
</body>
</html>

<script src="../../js/add-repair.js"></script>

