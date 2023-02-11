<?php
    require_once("validation.php");
    require_once("config.php");
    require_once("sql.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/register.css">
</head>

<?php

    //if submit button is pressed
    //TODO: Move user to login page once the insert into is correct
    
    $errorCode = 0;
     //0 nothing is wrong
     //1 username taken
     //2 email taken
    $errorMessage = "";

    if (isset($_REQUEST["submit"]))
    {
        //getting the values from the form
        $username = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $firstname = $_REQUEST["firstname"];
        $surname = $_REQUEST["lastname"];
        $email = $_REQUEST["email"];

        //checking if any of the values are empty (elaborate on requirements later)
        if ($username == "" ||
        $password == "" ||
        $firstname == "" ||
        $surname == "") {   
            //missing fields    
            echo "<h1>Some fields are empty</h1>";  
        } else {

            // check that the usernames and emails are unique
            if (!isUsernameUnique($username)) {
                // error message is username already taken
                $errorCode = 1;
                $errorMessage = "<p>username is already taken</p>";

            } else if (!isEmailUnique($email, 'users')) {
                // error message is email already taken
                $errorCode = 2;
                $errorMessage = "<p> email is already taken</p>";
                
            } else {

                //connect to DB
                $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");
    
                
                //sql query using collected values
                $sql = "INSERT INTO Users (firstName, lastName, userName, password, userType, email)
                        VALUES ('$firstname', '$surname', '$username', '$password', 'user','$email')";
                // execute insert query
                mysqli_query($conn,$sql) or die(mysqli_error($conn));
    
                mysqli_close($conn);
            }

        }
        // header("Location: ./user/profile.php");
    }

        
?>

<body id="register-page">
    
    <header>
        <!-- empty placeholder -->
    </header>
    <main>

        <div class="register-display row-container">
        <!--  -->
            <div class="form-container">
                <!-- self referencing form -->
                <form class="update-form" id="register-form" action="register.php" method="POST">
                    <h1>addUser</h1>
                
                <table>
                    <tr> 
                        <td>
                            <label for="firstname"> Firstname
                        </td>
                        <td>
                            <input type="text" name="firstname" id="firstname" required placeholder="Name"
                            <?php
                                if (isset($_REQUEST["firstname"])) {
                                    echo 'value="'. $_REQUEST["firstname"]. '"';
                                }
                            ?>>
                        </td>   
                    </tr>
                    <tr>
                        <td>
                            <label for="lastname"> Lastname:
                            </label>
                        </td>
                        <td>
                            <input type="text" name="lastname" id="lastname" required placeholder="Surname"
                            <?php
                                if (isset($_REQUEST["lastname"])) {
                                    echo 'value="'. $_REQUEST["lastname"] . '"';
                                }
                            ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="username"> Username:
                            </label>
                        </td>
                        <td>
                            <input
                            <?php
                            if ($errorCode == 1) {
                                echo 'class="error"';
                            }
                            ?>
                             type="text" name="username" id="username" required placeholder="Username"
                            <?php
                                if (isset($_REQUEST["username"])) {
                                    echo 'value="'. $_REQUEST["username"]. '"';
                                }
                            ?>>
        
                            <?php
                                if ($errorCode == 1) {
                                    echo $errorMessage;
                                }
                            ?>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>
                            <label for="email">
                                Email:
                            </label>
                        </td>
                        <td>
                        <input
                            <?php
                            if ($errorCode == 2) {
                                echo 'class="error"';
                            }
                            ?> 
                            type="email" name="email" id="email" required placeholder="Email"
                            <?php
                                if (isset($_REQUEST["email"])) {
                                    echo 'value="'. $_REQUEST["email"]. '"';
                                }
                            ?>>

                    <!-- display error message -->
                            <?php
                            if ($errorCode == 2) {
                                    echo $errorMessage;
                                } 
                            ?>
                        </td>
                    </tr>
                    <!-- <tr height="1rem">

                    </tr> -->
                        
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="add new user" name="submit">
                        </td>
                    </tr>
                </table>
                
            </form>
            </div>
        </div>
        
    </main>
    <footer>
        <!-- empty placeholder -->
    </footer>
</body>
</html>

<script src="../js/register.js"></script>
<script src="../js/showOrHide.js"></script>