<?php 

require_once("../secure.php");
require_once("../config.php");
require_once("../sql.php");
require_once("../validation.php");

    isUserTypeTechnician();
    $id = $_SESSION['userid'];
    $status = "";

    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database"); 
    $getTechquery = "SELECT TechnicianID FROM technician WHERE userID = $id";
    //run the userID query
    $technicianIDresult = mysqli_query($conn, $getTechquery) or die(mysqli_error($conn));
    //get the query result
    $row = mysqli_fetch_array($technicianIDresult);

    $jobid = 0;
    $techid = $row['TechnicianID'];
    if(isset($_REQUEST['id'])){
        $jobid = $_REQUEST['id'];
        //sql queries
        $getdeviceinfoquery = "SELECT firstName, lastName, category, brand, model 
        FROM users JOIN devices ON users.userID = devices.userID JOIN repairjobs ON repairjobs.deviceID = devices.deviceID WHERE repairJobID = $jobid;";
        $getrepairjobinfoquery = "SELECT status, description, etc, date,inspectionFee, repairFee FROM repairjobs WHERE repairJobID = $jobid;";
        //execute queries
        $deviceresults = mysqli_query($conn, $getdeviceinfoquery) or die(mysqli_error($conn));
        $repairjobresults = mysqli_query($conn, $getrepairjobinfoquery) or die(mysqli_error($conn));
        //results
        $row = mysqli_fetch_array($deviceresults);
        $repairjobrow = mysqli_fetch_array($repairjobresults);
        //variables
        $name = $row['firstName']." ".$row['lastName'];
        $category = $row['category'];
        $brand = $row['brand'];
        $model = $row['model'];
    
        $status =  $repairjobrow ['status'];
        $description =  $repairjobrow ['description'];
        $etc =  $repairjobrow ['etc'];
        $date =  $repairjobrow ['date'];
        $inspectionFee =  $repairjobrow ['inspectionFee'];
        $repairFee =  $repairjobrow ['repairFee'];
        //close connection

    }
    mysqli_close($conn);


    if(isset($_REQUEST['submit'])){

        if ($_REQUEST['statuschanged'] === 'true') {
            insertNewNotification($jobid, $_REQUEST['status']);
        }

        updaterepairjob ($jobid,$_REQUEST['status'],$_REQUEST['etc'], $_REQUEST['repairFee']);
        if ($_REQUEST['status'] !== 'paid') {
            header("Location:./tasks.php?id=$jobid");
        } else {
            header("Location: ./tasks.php");
        }
    }

    if(isset($_REQUEST['order'])){
        addparts ($_REQUEST['price'], $_REQUEST['partName'], $jobid,$_REQUEST['partType']);
        //header("Location:./tasks.php?id=$jobid");
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

    <title>FixMe | Technician tasks</title>
</head>
<header>
    <div class="hidden" id="close-icon-container">
        <i id="close-icon" class="close icon huge"></i>
    </div>
</header>
    <main id="technician-dashboard">          
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
                <section class="your jobs">
                    <h3>Select a Task</h3>
                    
                    <table id="repair-job-table" class="view-table">
                            <tr>
                                <th>Job Number</th>
                                <th>Difficulty</th>
                                <th>Status</th>
                            </tr>

                            <?php
                                $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
                        
                                $queryrepairjobs = "SELECT repairjobs.repairJobID, difficulty,status 
                                                    FROM repairjobs INNER JOIN jobgroup ON repairjobs.repairJobID = jobgroup.repairJobID WHERE TechnicianID = $techid AND NOT (status = 'paid') ;";
                                
                                $result = mysqli_query($conn, $queryrepairjobs) or die(mysqli_error($conn));
                                
                                while ($row = mysqli_fetch_row($result)) {
                                    echo "<tr class=\"selectable\">";
                                    
                                    $id = $row[0];
                                    $selected = "";

                                    if ($id == $jobid) {
                                        $status = $row['2'];
                                        $selected = "selected";
                                    }
                                    foreach ($row as $data) {
                                        echo "<td class=\"$selected\">$data</td>";
                                    }
                                    echo "</tr>";
        
                                }
                                mysqli_close($conn);
                            ?>
                            <!-- <tr></tr> -->

                    </table>

                </section>
                
                <section <?php
                $hide = "";
                if ($jobid == 0) {
                    $hide = "hide";
                }
                echo "class=\"device=info column-container $hide\"";
                ?> >
                    <!-- display device info -->
                    <form class="update-form" action="">
                        
                    <div class="device-info column-container">
                        <h3>Device Info</h3>
                        <table>
                            <tr>
                                <td>
                                    <label for="">Owner: </label>
                                </td>
                                <td>
                                    <input disabled type="text" value=<?php if(isset($_REQUEST['id'])) echo $name ?> >
                                </td>
                            </tr>
                        
                            <tr>
                                <td>
                                    <label for="category">Category: </label>
                                </td>
                                <td>
                                    <input disabled type="text" value=<?php if(isset($_REQUEST['id'])) echo $category ?> >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="Brand">Brand:  </label>
                                </td>
                                <td>
                                    <input disabled type="text" value=<?php if(isset($_REQUEST['id'])) echo $brand ?>>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="Model">Model:  </label>
                                </td>
                                <td>
                                    <input disabled type="text" value=<?php if(isset($_REQUEST['id'])) echo $model ?>>
                                </td>
                            </tr>
                        </table>
                        
                    </form>
                        
                    </div>
                    

                </section>
                <section 
                <?php   
                    $hide = "";
                    if ($jobid == 0) {
                        $hide = "hide";
                    } 
                    echo "class=\"$hide\"";
                ?>>
                <div class="repair-info">
                        <form class="update-form" action="">                        
                            <h3>Repair Job Details</h3>
                        <table>
                            <tr>
                                <td>
                                    <label for="status">Status:  </label>
                                </td>
                                <td>
                                    <select name="status" id="status">
                                        <option <?php if ($status==="assigned") {
                                            echo " selected ";
                                            }?> value="assigned">assigned</option>                                        
                                        <option
                                        <?php if ($status==="inspected") {
                                            echo " selected ";
                                            }?> value="inspected">inspected</option>
                                        <option
                                        <?php if ($status==="ordered part") {
                                            echo " selected ";
                                            }?> value="ordered part">order</option>
                                        <option
                                        <?php if ($status==="repaired") {
                                            echo " selected ";
                                            }?> value="repaired">repaired</option>
                                        <option
                                        <?php if ($status==="done") {
                                            echo " selected ";
                                            }?> value="done">done</option>
                                        <option
                                        <?php if ($status==="paid") {
                                            echo " selected ";
                                            }?> value="paid">paid</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="Description">Description: </label>
                                </td>
                                <td>
                                    <textarea name="description" disabled id="" cols="38" rows="3"><?php if(isset($_REQUEST['id'])) echo $description ?></textarea>
                                    <!-- <p>{description}</p>  -->
                                </td>

                            </tr>
                           
                            <tr>
                                <td>
                                    <label for="">Repair Time (days): </label>
                                </td>
                                <td>
                                    <input min="1" type="number" value=<?php if(isset($_REQUEST['id'])) echo $etc ?> name="etc">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="date">Date Submitted: </label>
                                </td>
                                <td>
                                    <input disabled type="date" value=<?php if(isset($_REQUEST['id'])) echo $date ?>>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="inspection-fee">Inspection Fee(R): </label>
                                </td>
                                <td>
                                    <input disabled type="number" value="100.00">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="repair-fee">
                                        Repair Fee (R):
                                    </label>
                                </td>
                                <td>
                                    <input min="0" max="20000" value=<?php if(isset($_REQUEST['id'])) echo $repairFee?> id="repair-fee" type="number" name="repairFee">
                                </td>
                                
                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" value = <?php if(isset($_REQUEST['id'])) echo $jobid?> name="id">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Order Part</label>
                                </td>
                                <td>
                                    <button id="order-button" style="width: 100%" type="button" >Order</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="width: 100%" value="Save" type="submit" name="submit">
                                </td>
                            </tr>
                                <input id="status-changed" type="hidden" name="statuschanged" value="false">

                            
                        </table>
                    </form>
                    </div>

                    <form id="order-part" class="hide update-form" method="POST" action="">
                        <h3>
                            Order Part
                        </h3>
                        <table>
                            <tr>
                                <td>
                                    <label for="part-name">Name: </label>
                                </td>
                                <td>
                                    <input id="part-name" type="text" placeholder="part name" name="partName">
                                </td>                                
                            </tr>
                            <tr>
                                <td>
                                    <label for="part-type">
                                        Type:
                                    </label>
                                </td>
                                <td>
                                    <select name="partType" id="part-type">
                                        <option hidden selected>Part Type</option>
                                        <option value="Adhesive pads">Adhesive pads</option>
                                        <option value="Adhesive">Adhesive</option>
                                        <option value="Battery">Battery</option>
                                        <option value="Button">Button</option>
                                        <option value="Cable">Cable</option>
                                        <option value="Case Component">Case Component</option>
                                        <option value="Display Component">Display Component</option>
                                        <option value="Fan">Fan</option>
                                        <option value="Graphic card">Graphic card</option>
                                        <option value="Hard Drive">Hard Drive</option>
                                        <option value="Headphone Jack">Headphone Jack</option>
                                        <option value="Lamp">Lamp</option>
                                        <option value="LCD Board">LCD Board</option>
                                        <option value="Magsafe Board">Magsafe Board</option>
                                        <option value="Microphone">Microphone</option>
                                        <option value="Motherboard">Motherboard</option>
                                        <option value="Port">Port</option>
                                        <option value="Power Adapter">Power Adapter</option>
                                        <option value="Power Supply">Power Supply</option>
                                        <option value="RAM">RAM</option>
                                        <option value="Screen">Screen</option>
                                        <option value="Screen Protector">Screen Protector</option>
                                        <option value="Screw">Screw</option>
                                        <option value="Sensor">Sensor</option>
                                        <option value="Speaker">Speaker</option>
                                        <option value="Trackpad">Trackpad</option>
                                        <option value="Wireless Board">Wireless Board</option>
                                    </select>
                                     
                                </td>

                            </tr>
                            <td>
                                <label for="price">Price</label>
                            </td>
                            <td>
                                <input id="part-price" type="number" name="price">
                            </td>
                            <tr>                                
                                <td colspan="2">
                                    <input style="width:100%" id="add-order" type="submit" value="Add Order" name="order">
                                </td>
                            </tr>
                        </table>
                    </form>
                </section>
            </div>
        </div>
    </main>
</body>
</html>

<script src="../../js/tasks.js"></script>

