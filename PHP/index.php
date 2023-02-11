 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <title>Fix Me </title>
</head>
<body>
    <header id="index-page">
        <div class="row-container"> 
            <a href="index.php"><img class="logo" src="../images/logo.png" alt="logo"></a> 
            <div class="space"></div>
            <div class="user-login-container row-container">
                <button class="index-buttons" onclick="location.href='login.php';">Login</button>
                <button class="index-buttons" onclick="location.href='register.php';">Register</button>
            </div>
        </div>
    </header>
    <main>
        <!-- column layout -->
        <div class="form-container">
        <!-- <button class="book-me">Book Repair</button> -->

            <!-- page -->
            <!-- <p class="OR">OR</p>
            <form id="index-form" action="">
                <input 
                    size="25" 
                    placeholder="Enter job tracking number" 
                    id="job-tracking-number" 
                    type="text">
                <i class="search large f icon"></i>
            </form> -->   
        </div>
<!-- 
        <div id="about-us">
                <h3>About Us</h3>
            </div> -->
        <div class="listing-container">
            <!-- row layout -->
            <div class="listing">
                <h3>Oh no! Your device is broken...</h3>
                <img id="story-img" src="../images/undraw_feeling_blue_4b7q.png">
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, quas?</p> -->
            </div>
            <div class="listing">
                <h3>We will diagnose the issue...</h3>
                <img id="story-img" src="../images/undraw_Teaching_re_g7e3.png">
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, quas?</p> -->
            </div>

            <div class="listing">
                <h3>Patch it back up...</h3>
                <img id="story-img" src="../images/bugfixing.png">
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, quas?
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, mollitia. Cum quaerat labore doloribus odio.    
                </p> -->
            </div>
            <div class="listing">
                <h3>And hand it back to you in perfect condition!</h3>
                <img id="story-img" src="../images/undraw_Celebration_re_kc9k.png">
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, quas?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum necessitatibus eum, quibusdam nobis accusantium quis? Ut placeat fugit iure vel!
                </p> -->
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>


        <div class="faqs">
            <h3>Frequently asked questions</h3>
            
            <details class="first"><p class="answer">No, repeatedly charging a lithium battery to 100% wears out the capacity and will decrease functioning over time. A good rule of thumb is to charge the battery once it drops below 30% and unplug it around 80%. You might want to reconsider leaving your phone plugged in overnight. </p>
                <summary class="question">
                Should I charge my device to 100% ?
                </summary>
            </details>
            <details ><p class="answer">Not in all cases. Adding more RAM will allow you to keep more programs open simultaneously, but won't necessarily improve overall performance. Upgrading to a faster RAM type such as DD3 or DD4 will offer a faster processing speed and allow processes to run faster.</p>
                <summary class="question">
                Can I speed up my slow device by adding additional RAM slots?
                </summary>
            </details>
            <details ><p class="answer">The keys are only clipped on, with a knife or a thin object carefully pop off the keys. This will allow you to clean under the keys as well as the keys themselves (Just remember where they went). </p>
                <summary class="question">
                How can I clean my keyboard?
                </summary>
            </details>

        </div>
        
    </main>
    <footer>
        <div class="contact">
            <!-- row layout -->
            <div class="contact-details">
                <ul>
                    <li>fixme@woodstreet.co.za</li>
                    <li>021 420 1337</li>
                </ul>
            </div>

            <div class="icon-container">
                <!-- row layout -->
                <i class="facebook large f icon" id="icons"></i>
                <i class="whatsapp large f icon" id="icons"></i>
                <i class="instagram large f icon" id="icons"></i>
                <i class="youtube large f icon" id="icons"></i>
                <i class="twitter large f icon" id="icons"></i>
            </div>
        </div>
    </footer>
</body>
</html>