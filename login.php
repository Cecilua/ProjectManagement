<DOCTYPE html>
    <html lang="en">
    <?php    
        /* connect to database */
        include 'connection.php';
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
                    <form name="login_form" id="login_form" method="post" action="process_login.php">
                        <!-- do i need labels? -->
                        <label for='username'>username: </label>
                        <input type="text" name="username" placeholder="username"><br>
                    
                        <label for="password">password: </label>
                        <input type="password" name="password" placeholder="password"><br>
                    
                        <input type="submit" name="submit" id="submit" value="Login">
                    </form>
                    <p>don't have an account? <a href="signup.php">sign up here</a></p>
                    <!-- add go back button in future? -->
                    <a href="welcome.php">go back</a>
                </div>
            </div>
        </div>
    </body>
    </html>