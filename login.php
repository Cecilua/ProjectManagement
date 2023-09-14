<DOCTYPE html>
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
    </head>
    <body>
        <div class="background">
            <div class="webcam"></div>
            <div class="screen">
                <!-- Login Form -->
                <div class="user-form">
                    <div class="profile-picture"></div>
                    <h1>Login</h1>
                    <!-- display errors if there are any -->
                    <?php 
                        if(isset($_SESSION['login_error'])) {
                            echo "<p>".$_SESSION['login_error']."</p>";
                        }
                    ?>
                    <form name="login_form" id="login_form" method="post" action="process_login.php">
                        <!-- do i need labels? -->
                        <label for='username'>username: </label>
                        <input type="text" name="username" placeholder="username" maxlength="20" required><br>
                    
                        <label for="password">password: </label>
                        <input type="password" name="password" placeholder="password" maxlength="256" required><br>
                    
                        <input type="submit" name="submit" id="submit" value="Login">
                    </form>
                    <p>don't have an account? <a href="sign_up.php">sign up here</a></p>
                    <!-- go back button -->
                    <a href="welcome.php">go back</a>
                </div>
            </div>
        </div>
    </body>
    </html>