<?php
    require_once("../secure.php");
    require_once("../config.php");
    require_once("../sql.php");
    require_once("../validation.php");

    if(isset($_REQUEST["logout"])){
        require_once("../logout.php");
    }

    isUserTypeTechnician();

    $userid = $_SESSION['userid'];
    // echo $userid;
    if (isset($_REQUEST['submit'])) {   

        // $userid = $_REQUEST['userid'];
        $firstname = filter_var($_REQUEST['firstname'],FILTER_SANITIZE_STRING);
        $lastname = filter_var($_REQUEST['lastname'],FILTER_SANITIZE_STRING);
        $email= filter_var($_REQUEST['email'],FILTER_SANITIZE_STRING);
        
        updateUser($userid, $firstname, $lastname, $email);
        // echo "update user";

        unset($_SESSION['firsttime']);
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
    <link href="../../css/technician.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>FixMe | Technician Profile</title>
</head>
<body>
    <header></header>
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
            <div class="content-section center-children row-container">

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
                                    </div>
                </section>
            </div>
        </div>
        </main>
        <footer>

        </footer>
</body>
</html>
<script src="../../js/profile.js"></script>
