
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
        $username = sanitize($_REQUEST["username"]);//remove backslashes, white space & anglebrackets
        $password = sanitize($_REQUEST["password"]);
        $firstname = sanitize($_REQUEST["firstname"]);
        $surname = sanitize($_REQUEST["lastname"]);
        $email = sanitize($_REQUEST["email"]);

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

            } else if(!isName($firstname)) {
                //error message invalid characters in first or last name
                $errorCode = 3;
                $errorMessage = "<p> Invalid first name</p>";
            
            } else if (!isName($surname)){
                //error message invalid characters in first or last name
                $errorCode = 4;
                $errorMessage = "<p> Invalid last name</p>";

            } else if (!isStrongPassword($password)){
                //error message weak password
                $errorCode = 5;

                $errorMessage = "<p> Weak password </p>";

            } else {
                // your data is good 

                //connect to DB
                $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");
    
                
                //sql query using collected values
                $sql = "INSERT INTO Users (firstName, lastName, userName, password, userType, email)
                        VALUES ('$firstname', '$surname','$username', '" . SHA1('$password') . "', 'user','$email')";
                // execute insert query
                mysqli_query($conn,$sql) or die(mysqli_error($conn));
    
                mysqli_close($conn);

                header("Location: ./user/profile.php");
            }

        }
    }

        
?>

<body id="register-page">
    
    <header>
        <!-- empty placeholder -->
    </header>
    <main>

        <div class="register-display row-container">
        <!--  -->
            <div class="background">
                <img src="../images/undraw_Hello_re_3evm.png" alt="">
            </div>
            <div class="form-container">
                <!-- self referencing form -->
                <form class="create-form" id="register-form" action="register.php" method="POST">
                    <h1>Register</h1>
                
                
                <label for="firstname">
                    <input
                    <?php
                        if ($errorCode == 3) {
                            echo 'class="error"';
                        }
                    ?>
                    type="text" name="firstname" id="firstname" required placeholder="Name"
                    <?php
                        if (isset($_REQUEST["firstname"])) {
                            echo 'value="'. $_REQUEST["firstname"]. '"';
                        }
                    ?>>
                    <?php
                        if ($errorCode == 3){
                            echo $errorMessage;
                        }
                    ?>
                </label>
                <label for="lastname">
                    <input
                    <?php
                        if($errorCode == 4){
                            echo 'class="error"';
                        } 
                    ?>
                    type="text" name="lastname" id="lastname" required placeholder="Surname"
                    <?php
                        if (isset($_REQUEST["lastname"])) {
                            echo 'value="'. $_REQUEST["lastname"]. '"';
                        }
                    ?>>
                    <?php
                       if($errorCode==4){
                        echo $errorMessage;
                       }
                    ?>
                </label>
                <label for="username">
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
                </label>
                <label for="email">
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
                    <?php
                    if ($errorCode == 2) {
                        echo $errorMessage;
                    } 
                    ?>
                </label>

                <label for="password">
                    <input
                    <?php
                        if ($errorCode == 5) {
                            echo 'class="error"';
                        }
                    ?>  
                    type="password" name="password" id="password" required placeholder="Password"
                    <?php
                        if (isset($_REQUEST["password"])) {
                            echo 'value="'. $_REQUEST["password"]. '"';
                        }
                    ?>>
                    <i id="show-hide-icon" class="eye icon"></i>
                    <?php
                        if ($errorCode == 5) {
                            echo $errorMessage;
                        } 
                    ?>
                </label>
                <label for="confirm">
                    <input type="password" name="confirm" id="confirm" required placeholder="Confirm Password"
                    <?php
                        if (isset($_REQUEST["confirm"])) {
                            echo 'value="'. $_REQUEST["confirm"]. '"';
                        }
                    ?>>  
                </label>
                <a href="login.php">already have an account?</a>
                <input type="submit" value="register" name="submit">
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


