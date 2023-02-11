<?php
require_once("../../php/secure.php");
require_once("../../php/validation.php");

function makeNotificationCaption($device_name, $status) {

    if ($status == "queued") {
        return "Your device [$device_name] has been <strong>queued</strong> and will be assigned";
    } elseif ($status == "order part") {
        return "Currently awaiting <strong>ordered part</strong> to be delivered to continue repair on your device [$device_name]";

    } elseif ($status == "done" || $status == "repaired") {
        return "Your device [$device_name] has been successfully <strong>repaired</strong> and is ready for collection. ";

    } elseif($status == "paid") {
        return "Payment has been confirmed and your device has been collected. Thank you for using our service";

    } elseif($status == "assigned") {
        return "Your device [$device_name] has been <strong> assigned</strong> to a technician and awaits inspection";

    } elseif($status == "inspected") {
        return "Your device [$device_name] has been <strong>inspected</strong>. See billing info <a href=\"./repairs.php\">here</a> for repair fees";
    } 
}

isUserTypeUser();

$username = $_SESSION["username"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix Me | Home</title>
    
    <link href="../../css/main.css" rel="stylesheet"/>
    <link href="../../css/dashboard.css" rel="stylesheet"/>
    <link href="../../css/register.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header></header>
    <main id="user-dashboard">          
        <nav class="menu">
                <a href="index.php"><i class="home icon big"></i></a><br>
                <a href="profile.php"><i class="user circle icon big"></i></a><br>
                <a href="devices.php"><i class="laptop icon big"></i></a><br>
                <a href="repairs.php"><i class="wrench icon big"></i></i></a><br>
        </nav>
        <div class="content-section column-container">
            <div class="top-banner">
                <h2>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?> </h2>
                <div class="spacer"></div>
                    <!--<input type="submit" name="logout" value="logout"  method="POST">-->
                    <a class="icon" href="../../php/logout.php"><i class="sign out alternate icon big"></i></i></a><br>
                </div>
            <section class="row-container">
            <section class="updates">
                <h2>Notifications</h2>
                <?php

                 $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE);

                 $getNotificationsFromLastMonth = "SELECT firstname, lastname, userName, notificationdate, N.status, R.deviceID, D.name 
                            FROM notifications AS N
                            JOIN repairJobs AS R ON R.RepairJobID = N.repairJobID
                            JOIN Users AS U ON U.UserID = R.UserID
                            JOIN Devices AS D on D.deviceID = R.deviceID 
                            WHERE date BETWEEN date_add(now(), INTERVAL -1 MONTH) AND now() 
                            AND userName = '$username'
                            ORDER BY notificationdate DESC";  

                $result = mysqli_query($conn, $getNotificationsFromLastMonth) or die(mysqli_error($conn));

                $no_notifications = true;
                while ($row = mysqli_fetch_array($result)) {
                    // echo print_r($row['status']);
                    // echo $row['status'];
                    // echo $row['name'];

                    echo "<div class=\"notification-container\">
                        <h4 class=\"notification-heading\"> ". $row["status"]."</h4>
                        <p> " . makeNotificationCaption($row["name"], $row["status"]) ." </p>
                        <p class=\"date\"> <em> ". $row["notificationdate"] . "</em> </p>
                    </div>";
                    $no_notifications = false;
                    // echo "<p>";
                    // echo print_r($row);
                    // echo "</p>";
                }

                mysqli_close($conn);

                if ($no_notifications) {
                    echo "<img class=\"no-notifications-pic\" src=\"../../images/no-notification-illustration.png\" alt=\"no_notifications_illustration\">";
                    echo "<p class=\"caption\">You currently have no notifications</p>";
                }
                ?>


            </section>
            <section class="contact-section">
                <div class="contact-details">
                    <h3>Contact Us</h3>
                    <div>
                        <i class="envelope large icon"></i>support@wefix.com
                    </div>
                    <div>
                        <i class="phone large icon"></i> 066 032 4350
                    </div>
                </div>

                <div class="operating-hours">
                    <h3>Operating hours</h3>

                    <table class="view-table">
                        <tr>
                            <th>Day</th>
                            <th>Time</th>
                        </tr>
                        <tr>
                            <td>Mon-Fri</td>
                            <td>08h00-17h00</td>
                        </tr>
                        <tr>
                            <td>Sat-Sun</td>
                            <td>10h00-14h00</td>
                        </tr>
                        <tr>
                            <td>Public holidays</td>
                            <td>closed</td>
                        </tr>
                    </table>
                </div>
            </section>
            </section>
        </div>
    </main>
    <footer></footer>
</body>
</html>

<?php
    if(isset($_REQUEST["logout"])){
        require_once("../../php/logout.php");
    }
?>