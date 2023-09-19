<!DOCTYPE html>
<html lang = 'en'>
    <?php    
        /* connect to database */
        include 'connection.php';
    ?>
    <head>
        <title>CC's Cradle</title>
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <link rel = "icon" sizes = "32x32" href = "img/favicon-32x32.png"/>
    </head>
    <body>
        <div class="background">
            <div class="webcam"></div>
            <div class="screen">
                <h1>Welcome!!</h1>
                <h1> To CC's Cradle (v1.0)</h1>
                <div class="welcome-menu">
                    <a href="login.php">login</a>
                    <a href="sign_up.php">sign up</a>
                </div>
            </div>
        </div>
    </body>
</html>
