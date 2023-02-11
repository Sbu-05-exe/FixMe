<?php
    require_once("config.php");
    require_once("validation.php");
    //check if the login button has been pressed
    $ErrorMessage = "";
    $username = "";
    $password = "";

    if (isset($_REQUEST["submit"])){
        //getting the data form the form
        $username = sanitize($_REQUEST["username"]);
        $password = sanitize($_REQUEST["password"]);
        
        //query used to check if the supplied username matches with any users in the database
        $UsernameQuery = "SELECT userName, userType FROM Users WHERE userName = \"$username\"";
        //query used to check if the supplied password matches the password for the user in the database
        $PasswordQuery = "SELECT COUNT(userName) FROM Users WHERE userName = \"$username\" AND password = \"" . SHA1('$password') . "\"";
        //echo "<script> alert(\"". SHA1('$password') . "\"); </script>";                                                                   <------DEBUG

        //connect to the database
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");

        //run the username query
        $result = mysqli_query($conn, $UsernameQuery) or die(mysqli_error($conn));
        //get the query result
        $row = mysqli_fetch_array($result);

        if ($row == NULL) {
            //if there is not matching username
            $ErrorMessage = "Login credentials are invalid";
        }
        else
        {   
            //checking if the username matches
            if($row[0] == $username){
                //now that the there is a username match, check if the password matches
                $UserType = $row[1];
                //query to check the password match
                $result = mysqli_query($conn, $PasswordQuery);
                //get the result
                $row = mysqli_fetch_array($result);

                //checking
                if($row[0] == 1 ){
                    //if cookie set
                    if(isset($_POST['rememberMe'])){
                        $cookie_name = "username";
                        $cookie_value = $username;
                        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day * 30
                        $cookie_name = "password";
                        $cookie_value = $password;
                        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                    }else{ //Rememberbe unchecked
                        if(isset($_COOKIE['username'])){
                            setcookie("username", "", time() - (86400 * 30), "/");
                            setcookie("password", "", time() - (86400 * 30), "/");
                        }
                    }
                    //password succesful
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['access'] = "yes";
                    
                    $_SESSION['type'] = $UserType;

                    if($UserType == "user"){
                        header("Location:user/index.php");
                    }elseif($UserType == "technician"){
                        header("Location:technician/index.php");
                    }elseif($UserType == "admin"){
                        header("Location:admin/index.php");
                    }
                    
                    $ErrorMessage = "";
                    

                } else {
                    $_REQUEST["error"] = 0;
                    $ErrorMessage = "Login credentials are invalid";
                }
                
            } else {
                //username does not match 
                $ErrorMessage = "Login credentials are invalid";
                $_REQUEST["error"] = 0;
            }
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
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/register.css">
</head>

<body id="login-page">
    <header>
        <!-- placeholder (empty header) -->
    </header>
    <main>

        <div class="login-display row-container">

        <!--  -->
            <div class="background">
                <img src="../images/login.png" alt="">
            </div>
            <div class="form-container">
                <form id="login-form" class="create-form" action="" method="post">
                    <h1>Login</h1>
                <label for="username">
                    <input id="username" type="text" name="username" 
                    <?php
                        if(isset($_COOKIE['username'])){
                            echo " value=" . $_COOKIE['username'];
                        }else{
                            echo "value=\"$username\"";
                            echo " placeholder=\"username\"";
                        }
                    ?>>
                </label>
                <label for="password">
                    <input id="password" type="password" name="password" 
                    <?php
                        if(isset($_COOKIE['username'])){
                            echo " value=" . $_COOKIE['password'];
                        }else{
                            echo " placeholder=\"password\"";
                        }
                    ?>
                    <?php
                        if (isset($_REQUEST["password"])) {
                            echo 'value="'. $_REQUEST["password"]. '"';
                        }
                    ?>>
                    <i id="show-hide-icon" class="eye icon"></i>
                </label>
                 <p class="error"><?php echo $ErrorMessage; ?> </p>
                <div class="checkbox-container">
                    <input type="checkbox" id="rememberMe" name="rememberMe"
                    <?php
                        if(isset($_COOKIE['username'])){
                            echo "checked =\"checked\"";
                        }
                    ?>>
                    <label for="rememberMe"> &nbsp Remember Me</label>
                </div>
                <a href="register.php">don't have an account?</a><br>
                <input type="submit" value="login" name="submit">
            </form>
            </div>
        </div>

    </main>

    <footer>
        <!-- placeholder (empty footer-->
    </footer>
</body>
<script src="../js/showOrHide.js"></script>



