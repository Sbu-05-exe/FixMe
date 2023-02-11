<?php
    require_once("../config.php");
    require_once("../secure.php");
    require_once("../sql.php");
    require_once("../validation.php");
    require_once("../data.php");

    isUserTypeAdmin();
?>

<!DOCTYPE html>
<html lang="en">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                <a href="index.php"><i class="home icon big"></i></a><br>
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
             <div class="row-container">
                <div id="myChart" style="max-width:600x; height:600px"></div>
                <div id="ourChart" style="max-width:800px; height:600px"></div>
                <div id="monthlyTurnOver" style="max-width:900px; height:500px">beep</div>
                <div id="ourChart" style="max-width:700px; height:400px"></div>
             </div> 
             
        </div> 
</main>
<footer></footer>
</body>
</html>