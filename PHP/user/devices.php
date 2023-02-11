<?php
    require_once("../secure.php"); // this guy is responsible for keeping the session going
    require_once("../sql.php");
    require_once("../config.php");

    //checks that user is on thr gith page
    require_once("../validation.php");
    isUserTypeUser();

    $userid = $_SESSION["userid"];

    //create new device
    if (isset($_REQUEST["add"])) {
        // do some form handling
        $name = $_REQUEST["name"];
        $brand = $_REQUEST["brand"];
        $category = $_REQUEST["category"];
        $model = $_REQUEST["model"];
        

        //Upload Image Functionality
        $destination = ""; 
        if (!empty($_FILES['device-image']['name'])) {

            $tmp = explode(".",$_FILES['device-image']['name']);
            $extention = end($tmp);

            $supported_image = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
            );

            if(!(in_array($extention,$supported_image))){ //if the image is not a support file format
                echo "<script> alert(\"Please use gif, jpg, jpeg, or png\"); </script>";
            }
            else{
                $picture = basename($_FILES['device-image']['name']);
                $destination =  "../../images/devices/". $picture. time() . "." . $extention;
                move_uploaded_file($_FILES['device-image']['tmp_name'], $destination);
                insertNewDevice($userid, $name, $brand, $category,$destination, $model);
            }
        } else {
            $destination = $_REQUEST['img'];
            insertNewDevice($userid, $name, $brand, $category,$destination, $model);
        }
    }

    //update existing device
    if(isset($_REQUEST["save"])){
        //variables
        $deviceId = $_REQUEST['id'];
        $deviceName = $_REQUEST['name'];
        $deviceBrand = $_REQUEST['brand'];
        $deviceCategory = $_REQUEST['category'];
        $model = $_REQUEST["model"];

    
        $destination = ""; 
        if (!empty($_FILES['device-image']['name'])) {
            $tmp = explode(".",$_FILES['device-image']['name']);
            $extention = end($tmp);
            $supported_image = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
            );

            $fileSize = $_FILES['device-image']['size'];
            if($fileSize>15728640){ //If filesize is greater than 15MB
                echo "<script> Alert(\"File Size is too large\"); </script>";
            }
            elseif(!(in_array($extention,$supported_image))){ //if the image is not a support file format
                echo "<script> Alert(\"File is not in the correct format \n Please use gif, jpg, jpeg, or png\"); </script>";
            }
            else{
                $picture = basename($_FILES['device-image']['name']);
                $destination =  "../../images/devices/". $picture. time() . "." . $extention;
                move_uploaded_file($_FILES['device-image']['tmp_name'], $destination);
                updateDevice($deviceId, $deviceName, $deviceBrand,$deviceCategory,$destination, $model);
            }
        } else {
            $destination = $_REQUEST['img'];
            updateDevice($deviceId, $deviceName, $deviceBrand,$deviceCategory,$destination, $model);
        }


        

        // header('Location: ./devices.php');

    }elseif(isset($_REQUEST['delete'])){
        $deviceId = $_REQUEST['id'];
        deleteDevice($deviceId);
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>FixMe | Profile </title>
</head>
<body id="device-body">

    <header></header>
    <main id="user-dashboard">
        <nav class="menu">
                <a href="./"><i class="home icon big"></i></a><br>
                <a href="./profile.php"><i class="user circle icon big"></i></a><br>
                <a href="./devices.php"><i class="laptop icon big"></i></a><br>
                <a href="./repairs.php"><i class="wrench icon big"></i></i></a><br>
        </nav>
        <div class="content-section column-container">
            <div class="top-banner">
                <h2>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']?> </h2>
                    <div class="spacer"></div>
                    <!--<input type="submit" name="logout" value="logout"  method="POST">-->
                    <a class="icon" href="../../php/logout.php"><i class="sign out alternate icon big"></i></i></a><br>
            </div>
            <div class="center-children row-container">
                <section class="devices-section">
                    <h3>Your Devices</h3>
                    <div class="row-container">
                        <?php

                            //connect to db
                            $conn = mysqli_connect(SERVERNAME,USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");
                            //query
                            $usersDeviceByIdSQL = "SELECT * FROM devices WHERE userID = '$userid' AND deleted = 'no'";
                            //adds device 
                            $result = mysqli_query($conn, $usersDeviceByIdSQL) or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($result)) {

                                echo "<div class=\"device\">
                                        <img class=\"click-through\" id=\"device-img\" src=\"../../images/devices/".$row["image"]."\" alt=\"user device image\" >
                                        <div class=\"caption\"> 
                                            <h4 class=\"click-through captionText\">" . $row["name"] . "</h4>
                                            <p class=\"click-through\">" . $row["brand"] . "</p>
                                            <p class=\"click-through\">" . $row["category"] . " </p>
                                            <p class=\"hidden\" > " . $row["deviceID"] . " </p>
                                            <p class=\"hidden\" > " . $row["image"] . " </p>
                                            <p class=\"hidden\">" . $row["model"] . " </p>
                                        </div>
                                    </div>
                                    ";
                            }
                            mysqli_close($conn);
                        ?>
                        <div id="add-device">
                            <i class="f plus huge icon"></i>
                            <div class="caption ">
                                <h4>
                                    Add New Device
                                </h4>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="device-details">
                    <div class="form-container column-container">
                        
                        <!-- self referencing form -->
                        <form id="device-details-form" class="update-form column-container" action="devices.php" method="POST" enctype="multipart/form-data">
                            <h3 id="device-details-form-title">Update Device Details</h3>
                            <table>

                        
                                <tr>
                                    <td>
                                        <label for="name">Name:</label>
                                    </td>
                                    <td>
                                        <input id="name" type="text" name="name" placeholder="My Macbook">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="brand">Brand:</label>
                                    </td>
                                    <td>
                                        <input id="brand" type="text" name="brand" placeholder="Apple">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="model">Model: </label>
                                    </td>
                                    <td>
                                        <input id="model" type="text" name="model" placeholder="M2 Macbook Air">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="category">Category:</label>
                                    </td>
                                    <td>
                                        <select id="category" name="category">
                                            <option value="laptop">Laptop</option>
                                            <option value="tablet">Tablet</option>
                                            <option value="desktop">Desktop</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="device-image">Upload Image</label>
                                    </td>
                                    <td>
                                        <input type="file" id="device-image" name="device-image">
                                    </td> 
                                    <tr>
                                        <td  colspan="2">
                                            <input style="width: 100%" id="device-details-submit" type="submit" name="add" value="add device">                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input style="width: 100%" id="delete-device" class="delete" disabled type="submit" name="delete" value="delete" onclick="return confirm('Are you sure you want to delete this device?')">                            
                                        </td>
                                    </tr>
                                </tr>
                          
                            </table>
                            <div class=>

                            </div>
                            <input id="img" type="hidden" name="img" value="loebster.jpg">
                            <input id="device-id" type="hidden" name="id">
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <footer></footer>
</body>
</html>

<script src="../../js/devices.js"></script>


<?php
    if(isset($_REQUEST["logout"])){
        require_once("../../php/logout.php");

    }
?>

