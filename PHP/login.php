<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body>
    <header>

    </header>
    <main>

        <form action="login.php" method="POST">
            <a href="register.php">Don't have an account?</a>
            <table>
                <table>
                    <tr>
                        <td>Username: </td>  
                        <td>
                            <label for="username">
                                <input id="username" type="text" name = "username">
                            </label>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label for="password">
                                Password: 
                            </label>
                        </td>
                        <td>
                            <input id="password" type="text" name="password"><br>
                        </td>
                    </tr>
                </table>
            </table>   
            
            <input type = "submit" value = "test login creds" name = login>
            <input type = "submit" value = "create new account" name = create>
        </form>
    </main>

    <footer>

    </footer>
    </body>
    
<?php
    require_once("config.php");

    if (isset($_REQUEST["login"])){
        $username = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        echo "<h1> $username $password </h1>";
        
        $UsernameQuery = "SELECT userName FROM Users WHERE userName = \"$username\"";

        $rows = array();
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");
        $result = mysqli_query($conn, $UsernameQuery);

        while($row = mysqli_fetch_array($result)) {
            array_push($rows,$row);
        }

        if(count($rows)==1){
            //checkpass
            echo "<h1> Loguin successful </h1>";
        }else{
            //either UN doesnt exist or there were multiple users with the same UN(issue)
            echo "<h1> Login Failed </h1>";
        }
    }

?>