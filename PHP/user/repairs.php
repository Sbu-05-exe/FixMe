<?php
require_once("../secure.php"); // this guy is responsible for keeping the session going
require_once("../sql.php");
require_once("../config.php");
require_once("../validation.php");

isUserTypeUser();
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");
$id = $_SESSION['userid'];
$getdevicequery ="SELECT name, repairJobID FROM repairjobs JOIN devices ON repairjobs.deviceID = devices.deviceID WHERE repairjobs.userID = $id;";
$result = mysqli_query($conn, $getdevicequery) or die(mysqli_error($conn));
mysqli_close($conn);

$repair_id = 0;

if (isset($_REQUEST['id'])) {
    $repair_id = $_REQUEST['id'];
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");
    $repairdatasql = "SELECT * FROM ctrls.repairjobs WHERE repairJobID = $repair_id;";

    $repairResult = mysqli_query($conn, $repairdatasql) or die(mysqli_error($conn));

    $data = mysqli_fetch_array($repairResult);

    $description = $data['description'];
    $etc = $data['etc'];
    $date = $data['date'];
    $status = $data['status'];
    $inspFee = $data['inspectionFee'];
    $repairFee =$data['repairFee'];
    $needsparts =$data['needsparts'];
    $totalcostquery ="";
    $partsquery ="";
    $price = 0;
    $name = "";
    $totalcost = 0;

        $getjobgroupquery = "SELECT TechnicianID FROM jobgroup WHERE repairJobID = $repair_id;";
        $getjobgroupResults = mysqli_query($conn, $getjobgroupquery) or die(mysqli_error($conn));
        $jobgroupdata = mysqli_fetch_array($getjobgroupResults);
        if($jobgroupdata != NULL){$jobgroupTechID = $jobgroupdata['TechnicianID'];}else{
            $jobgroupTechID = NULL;
        }
        

            //print_r($jobgroupdata);
        //$totalcost = $totalcostdata['Total_cost'];

        if($jobgroupTechID != NULL){
        if($needsparts == 0){
            $totalcostquery ="SELECT inspectionFee+repairFee as Total_cost FROM repairjobs WHERE repairJobID = $repair_id;";
            $totalcostResult = mysqli_query($conn, $totalcostquery) or die(mysqli_error($conn));
            
            $totalcostdata = mysqli_fetch_array($totalcostResult);
            $totalcost = $totalcostdata['Total_cost'];
        }
        else{
            $totalcostquery = "SELECT inspectionFee+repairFee+SUM(Price) as Total_cost 
            FROM repairjobs JOIN parts ON repairjobs.repairJobID = parts.repairJobID WHERE repairjobs.repairJobID = $repair_id GROUP BY repairjobs.repairJobID;";

            $totalcostResult = mysqli_query($conn, $totalcostquery) or die(mysqli_error($conn));
            
            $totalcostdata = mysqli_fetch_array($totalcostResult);
            $totalcost = $totalcostdata['Total_cost'];

            $partsquery = "SELECT SUM(Price) FROM parts WHERE repairJobID = $repair_id GROUP BY repairJobID = $repair_id;";
            $partsResult = mysqli_query($conn, $partsquery) or die(mysqli_error($conn));
            $partsdata = mysqli_fetch_array($partsResult);
           
            $price = $partsdata['SUM(Price)'];
    
        }

        $techidquery = "SELECT TechnicianID FROM jobgroup WHERE repairJobID = $repair_id; ";
        $techidResult = mysqli_query($conn, $techidquery) or die(mysqli_error($conn));
        $techiddata = mysqli_fetch_array($techidResult);
        $tech_id = $techiddata['TechnicianID'];

        $techinfoquery = "SELECT firstName, lastName, Email 
                        FROM users JOIN technician ON users.userID = technician.userID JOIN jobgroup ON jobgroup.TechnicianID = technician.TechnicianID 
                        WHERE technician.TechnicianID = $tech_id AND repairJobID = $repair_id;";
        $techinfoResult = mysqli_query($conn, $techinfoquery) or die(mysqli_error($conn));
        $techinfodata = mysqli_fetch_array($techinfoResult);

        $tname = $techinfodata['firstName']." ".$techinfodata['lastName'];
        $temail = $techinfodata['Email'];
    }
    mysqli_close($conn);
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
    <title>FixMe | Repairs</title>
</head>
<body id="repairs-page">

    <header></header>
    <main id="user-dashboard">        
        <nav class="menu">
                <a href="./"><i class="home icon big"></i></a><br>
                <a href="./profile.php"><i class="user circle icon big"></i></a><br>
                <a href="./devices.php"><i class="laptop icon big"></i></a><br>
                <a href="./repairs.php"><i class="wrench icon big"></i></i></a><br>
        </nav>
        <div class="column-container">
            <div class="top-banner">
                <h1>Your Repairs </h1>
                <div class="spacer"></div>
                    <!--<input type="submit" name="logout" value="logout"  method="POST">-->
                <a class="icon" href="../../php/logout.php"><i class="sign out alternate icon big"></i></i></a><br>
            </div>
            <div class="content-section row-container">
                <section class="repair-job-info-section">
                <form class="update-form" action="">                        
                    <h2>Repair Job Details</h2>
                        <table id="repair-job-details-table">
                            <tr>
                                    <td>    
                                        Device
                                    </td>
                                    <td>    
                                            <select id="select-device" name="device" id="">
                                            <option hidden>select a device</option>
                                                <?php  
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $selected = "selected";
                                                        if ($repair_id != $row['repairJobID']) {
                                                            $selected = "";
                                                        }
                                                        echo "<option $selected value = ".$row['repairJobID'].">".$row['name']."</option>";
                                                    }
                                                    
                                                ?>
                                            </select>
                                    </td>    
                            </tr>
                            <tr class="description">
                                <td>
                                    <label for="Description">Description: </label>

                                </td>
                                <td>
                                    <textarea name="description" disabled id=""><?php if(isset($_REQUEST['id'])) echo $description?></textarea>
                                    <!-- <p>{description}</p>  -->
                                </td>

                            </tr>
                           
                            <tr class="repair-time">
                                <td>
                                    <label for="">Repair Time (days): </label>
                                </td>
                                <td>
                                    <input disabled min="1" type="number" value=<?php if(isset($_REQUEST['id'])) echo $etc?>>
                                </td>
                            </tr>
                            <tr class="date-submitted">
                                <td>
                                    <label for="date">Date Submitted: </label>
                                </td>
                                <td>
                                    <input disabled type="date" value = <?php if(isset($_REQUEST['id'])) echo $date?> >
                                </td>
                            </tr>
                            
                        </table>
                    </form>
                </section>
                <section class="progress-section">
                    <h2>Progress    </h2>
                    <div class="column-container">
                            <div <?php 
                                $class = "status";
                                if(isset($_REQUEST['id'])){
                                    if($status == 'queued'||$status == 'assigned'|| $status == 'inspected'|| $status == 'repaired'|| $status == 'ordered part' || $status == 'paid'){
                                        $class = "status checked";
                                    }
                                }
                                echo "class=\"$class\""
                            ?>>  <h3> 1. Queued</h3> </div> 
                            <div <?php 
                                $class = "status";
                                if(isset($_REQUEST['id'])){
                                    if($status == 'assigned'|| $status == 'inspected'|| $status == 'repaired'|| $status == 'ordered part' || $status == 'paid'){
                                        $class = "status checked";
                                    }
                                }
                                echo "class=\"$class\""
                            ?>>  <h3> 2. Assigned</h3> </div> 
                            <div <?php 
                                $class = "status";
                                if(isset($_REQUEST['id'])){
                                    if($status == 'inspected'|| $status == 'repaired'|| $status == 'ordered part' || $status == 'paid'){
                                        $class = "status checked";
                                    }
                                }
                                echo "class=\"$class\""
                            ?>>  <h3> 3. Inspected</h3> </div> 
                            <div <?php 
                                $class = "status";
                                if(isset($_REQUEST['id'])){
                                    if($status == 'repaired'|| $status == 'ordered part' || $status == 'paid'){
                                        $class = "status checked";
                                    }
                                }
                                echo "class=\"$class\""
                            ?>>  <h3> 4. Ordering Part</h3> </div> 
                            <div <?php 
                                $class = "status";
                                if(isset($_REQUEST['id'])){
                                    if($status == 'repaired' || $status == 'paid'){
                                        $class = "status checked";
                                    }
                                }
                                echo "class=\"$class\""
                            ?>>  <h3> 5. Repaired</h3> </div> 
                            <div <?php 
                                $class = "status";
                                if(isset($_REQUEST['id'])){
                                    if( $status == 'paid'){
                                        $class = "status checked";
                                    }
                                }
                                echo "class=\"$class\""
                            ?>>  <h3> 6. Paid</h3> </div> 
                    </div>   
                </section>
                <section class="technical-info">    
                    <div class="technician-info">

                        <h2>
                            Technician Info
                        </h2>              

                        <div class="column-container">
                            <div class="img-container">
                                <img src="../../images/technicians/placeholder-person.png" alt="picture of technician" class="technician-profile-pic">
                            </div>
                            <div class="caption">
                                <p><?php if(isset($_REQUEST['id'])) {if($jobgroupTechID != NULL){echo $tname;}else{echo"No Technician Assigned Yet";}}?> </p>
                                <p><?php if(isset($_REQUEST['id'])) {if($jobgroupTechID != NULL)echo $temail;}?></p>
                            </div>
                        </div>
                            
                    </div>
                    <div>
                    <h2>Billing Info</h2>
                        <table class="view-table" id="billing-info-table">
                            <tr>
                                <td colspan="3">
                                    <strong>

                                        Fees
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td >
                                    Inspection Fee (R): 
                                </td>
                                <td>
                                    <?php if(isset($_REQUEST['id']))echo $inspFee?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td >
                                        Repair Fee (R):

                                </td>

                                <td>
                                <?php if(isset($_REQUEST['id']))echo $repairFee?>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <strong>
                                        Parts:
                                    </strong>
                                </td>
                            </tr>
                            <tr>    
                                <td>    
                                </td>
                                <td>Total (R):</td>
                                <td><?php if(isset($_REQUEST['id']))echo $price?></td>
                            </tr>
                            
                            <tr class="total">
                                <td colspan="2">
                                    <strong>
                                        Total (R):
                                    </strong>
                                </td>
                                <td>
                                    <strong>

                                       <?php if(isset($_REQUEST['id']))echo $totalcost?>
                                    </strong>
                                </td>
                            </tr>
                        </table>
                    </div>

                </section>
                <!-- <table>
                    <tr>
                        <th>DeviceID</th>
                        <th>Description</th>
                        <th>Difficulty</th>
                        <th>Status</th>
                        <th>ETC</th>
                        <th>Cost</th>
                    <tr>
                    
                        //connect to db
                        $conn = mysqli_connect(SERVERNAME,USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");
                        //query
                        $usersDeviceByIdSQL = "SELECT * FROM repairjobs WHERE userID = '" . $_SESSION['userid'] . "'";
                        //adds device 
                        $result = mysqli_query($conn, $usersDeviceByIdSQL) or die(mysqli_error($conn));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[3] . "</td>";
                            echo "<td>" . $row[4] . "</td>";
                            echo "<td>" . $row[5] . "</td>";
                            echo "<td>" . $row[6] . "</td>";
                            echo "<td>" . $row[7] . "</td>";
                            echo "</tr>";
                        }
                    
                </table> -->
            </div>
        </div>
    </main>
    <footer></footer>
    
</body>
</html>
<script src="../../js/repairs.js"></script>

<?php
    if(isset($_REQUEST["logout"])){
        require_once("../../php/logout.php");
    }
?>