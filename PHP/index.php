<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <title>Fix Me</title>
</head>
<body>
    <header id="index-page">
        <div class="row-container"> 
            <img class="logo" src="../images/logo.png" alt="logo">
            <div class="space"></div>
            <div class="user-login-container row-container">
                <button><a href="login.php"> Login </a></button>
                <button><a href="register.php"> Register </a></button>
            </div>
        </div>
    </header>
    <main>
        <!-- column layout -->
        <div class="form-container">
            <button class="book-me">Book Repair</button>

            <!-- page -->
            <p class="OR">OR</p>
            <form id="index-form" action="">
                <input 
                    size="25" 
                    placeholder="Enter job tracking number" 
                    id="job-tracking-number" 
                    type="text">
                <i class="search large f icon"></i>
            </form>

            
            
        </div>
        <div class="listing-container">
            <!-- row layout -->
            <div class="listing">
                <h3>Tablet</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, quas?</p>
            </div>

            <div class="listing">
                <h3>Laptop</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, quas?
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, mollitia. Cum quaerat labore doloribus odio.    
                </p>
            </div>
            <div class="listing">
                <h3>PC</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, quas?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum necessitatibus eum, quibusdam nobis accusantium quis? Ut placeat fugit iure vel!
                </p>
            </div>
        </div>

        <div class="faqs">
            <h3>Frequently asked questions</h3>
            
            <details class="first"><p class="answer">Answer</p>
                <summary class="question">
                Question
                </summary>
            </details>
            <details ><p class="answer">Answer</p>
                <summary class="question">
                Question
                </summary>
            </details>
            <details ><p class="answer">Answer</p>
                <summary class="question">
                Question
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