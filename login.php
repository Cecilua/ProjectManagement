<!DOCTYPE html>
    <html lang="en">
    <?php    
        /* connect to database */
        include 'connection.php';

        /* start a session */
        session_start();
    ?>
    <head>
        <title>CC's Cradle</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link rel = "icon" sizes = "32x32" href = "img/favicon-32x32.png"/>
    </head>
    <body>
        <div class="background">
            <div class="webcam"></div>
            <div class="screen">
                <div class="user-form">
                    <div class="profile-picture">
                        <img src = "img/pfp.png" alt = "CC's Cradle's silly cat mascot">
                    </div>
                    <h1>Login</h1>
                    <!-- display errors if there are any -->
                    <?php 
                        if(isset($_SESSION['login_error'])) {
                            echo "<p>".$_SESSION['login_error']."</p>";
                        }
                    ?>
                    <!-- Login Form -->
                    <form name="login_form" id="login_form" method="post" action="process_login.php">
                        <label for='username'>username: </label>
                        <input type="text" name="username" id="username" placeholder="username" maxlength="20" required><br>
                        <label for="password">password: </label>
                        <input type="password" name="password" id="password" placeholder="password" maxlength="256" required><br>
                        <input type="submit" name="submit" id="submit" value="Login">
                    </form>
                    <!-- link to sign up page -->
                    <p>don't have an account? <a href="sign_up.php">sign up here</a></p>
                    <!-- go back link -->
                    <a href="welcome.php">go back</a>
                </div>
            </div>
        </div>
    </body>
    </html>