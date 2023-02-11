<?php
require_once("../secure.php"); // this guy is responsible for keeping the session going
require_once("../sql.php");
require_once("../config.php");
require_once("../validation.php");

isUserTypeUser();
?>

<?php 
    if (isset($_REQUEST['submit'])) {
        // echo "saving";
        // echo "<h2>update user</h2>";
        updateUser($_SESSION['userid'], $_REQUEST['firstname'], $_REQUEST['lastname'] , $_REQUEST['email']);

        unset($_SESSION['firsttime']);
        unset($_REQUEST);
        header("Location: ./profile.php");
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
<body>
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

                <section class="update-details-section">
                    <div class="form-container">
                        <form id="profile-form" class="update-form" action="" method="POST">
                            <h3>Personal Details</h3>

                            <table>
                                <tr>
                                    <td>
                                        <label for="username">
                                            Username:
                                        </label>
                                    </td>
                                    <td>
                                        <input disabled type="text" name="username" value=<?php echo $_SESSION['username'] ?>>
                                    </td>
                                </tr>
                                    <td>
                                        <label for="firstname">Firstname:
                                        
                                        </label>
                                    </td>
                                    <td>
                                        <input id="firstname" type="text" name="firstname" value=<?php echo $_SESSION['firstname'] ?>>
                                    </td>
                                <tr>
                                
                                </tr>

                                <tr>
                                    <td>
                                        <label for="lastname">
                                            Lastname:
                                        </label>
                                    </td>
                                    <td>                                        
                                        <input id="lastname" type="text" name="lastname" value=<?php echo $_SESSION['lastname'] ?>>                      
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                    <label for="email">Email:
                                    </label>
                                    <td>
                                        <input id="email" type="email" name="email" value=<?php echo $_SESSION['email'] ?>>
                                    </td>
                                        
                                    </td>
                                    <tr>
                                        <td colspan="2" >
                                            <input id="save-profile"style="width:100%" disabled type="submit" value="save" name="submit">
                                        </td>
                                    </tr>
                                </tr>
                            </table>
         
                    </form>
        
                    <div class="hide"> 
                        <!-- supposed to have class of container -->
                        <form id="change-password" class="update-form" action="" method="POST">
                            <h3>Change Password</h3>
                            <table>
                               
                            <tr>
                                <td>
                                    <label for="currentpassword">
                                     Enter your current password
                                    </label>
                                </td>
                                <td>
                                    <input type="password" name="currentpassword" placeholder="Current Password">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="newpassword">New Password</label>
                                </td>
                                <td>
                                    <input type="password" name="newpassword" placeholder="New Password">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="confirm">Confirm New Password</label>
                                </td>
                                <td>
                                    <input type="password" name="confirm" placeholder="Confirm New Password"> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="width:100%"  type="submit" value="Change Password" name="ChangePassword">
                                </td>
                            </tr>
                            </table>
                            
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <footer></footer>
</body>
</html>

<script src="../../js/profile.js"></script>

<?php
    if(isset($_REQUEST["ChangePassword"])){
        $oldpass = $_REQUEST['currentpassword'];
        $newpass = $_REQUEST['newpassword'];
        $conf = $_REQUEST['confirm'];

        if($newpass == $conf){
            require_once("../config.php");
            $PassQuery = "UPDATE Users SET password = '" . $newpass . "'" . 
            " WHERE userID = '" . $_SESSION['userid'] . "'" . " AND password = '". $oldpass . "'";
            $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");

            //run the username query
            mysqli_query($conn, $PassQuery);
            echo "<h1> Password Changed </h1>";
        } else {
            echo "<h1> Invalid Password Change </h1>";
        }
    }
?>


<?php
    if(isset($_REQUEST["logout"])){
        require_once("../../php/logout.php");

    }
?>
?>