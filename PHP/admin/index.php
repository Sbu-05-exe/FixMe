<?php
    require_once("../config.php");
    require_once("../secure.php");
    require_once("../sql.php");
    require_once("../validation.php");

    isUserTypeAdmin();
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
    <title>Admin Home</title>
</head>
<body>
    <header></header>
<main id="admin-dashboard">          
        <nav class="menu">
                <a href="./"><i class="home icon big"></i></a><br>
                <a href="analytics.php"><i class="chart pie icon big"></i></a><br>
                <a href="tables.php"><i class="bullseye icon big"></i></a>

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
                    <form action="index.php" method="post" class="update-form">
        <h3>New Technician</h3>
        <table>
            <tr>
                <td>
                    <label for="firstname">Firstname</label>
                </td>
                <td class="firstname">
                    <input id="firstname" type="text" name="firstname" placeholder="Name"><br>
                </td>                
             </tr>
                <tr>
                    <td>
                        <label for="lastname">Lastname</label>
                    </td>
                    <td class="lastname">
                        <input id="lastname" type="text" name="lastname" placeholder="Surname"><br>
                    </td>                    
                </tr>
                <tr>
                    <td>
                        <label for="username">Username</label>
                    </td>
                    <td class="username">
                        <input id="username" type="text" name="username" placeholder="Username"><br>

                    </td>                    
                </tr>
                <tr>
                    <td>
                        <label for="email">Email:</label>
                    </td>
                    <td class="email">
                        <input id="email" type="email" name="email" placeholder="Email"><br>
                    </td>                    
                </tr>
                <tr>
                    <td>
                        <label for="password">Password:</label>
                    </td>
                    <td class="password">
                        <input id="password" type="password" name="password" placeholder="Password"><br>
                    </td>                   
                </tr>
                <tr>
                    <td>
                    <label for="password">Confirm:</label>

                    </td>
                    <td class="confirm">
                        <input id="confirm" type="password" name="confirm" placeholder="Confirm Password"><br>
                    </td>                    
                </tr>
                <tr>
                    <td>
                    <label  for="password">Salary(R):</label>
                    </td>
                    <td class="salary">
                        <input id="salary" type="number" min="3000" max="100000" name="salary" ><br>
                    </td>               
                </tr>
                <tr>
                    <td>
                    <label for="password">Experience:</label>

                    </td>
                    <td class="experience">
                        <select name="experience" id="experience">
                            <option value="selected hidden"> Choose Level of Experience</option>
                            <option value="junior"> Junior</option>
                            <option value="intermediate"> Intermediate </option>
                            <option value="senior"> Senior </option>
                        </select>
                    </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <input style="width: 100%"type="submit" value="submit" name="submit">
                </td>
            </tr>
        </table>
    </form>
                </section>
            </div>
        </div>
</main>
<footer></footer>
    <?php
       //if submit button is pressed
       //TODO: Move user to login page once the insert into is correct
       if (isset($_REQUEST["submit"]))
       {    
           
           //getting the values from the form
           $username = $_REQUEST["username"];
           $password = $_REQUEST["password"];
           $firstname = $_REQUEST["firstname"];
           $lastname = $_REQUEST["lastname"];
           $email = $_REQUEST["email"];
           $salary = $_REQUEST["salary"];
           $experience = $_REQUEST["experience"];

           createTechnician ( $username, $password, $firstname,$lastname,$email,$salary,$experience);

           }
       
    ?>
</body>
</html>

<script src="../../js/add-technician.js"></script>