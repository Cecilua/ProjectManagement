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
                <!-- Sign-Up Form -->
                <div class="user-form">
                    <div class="profile-picture"></div>
                    <h1>Sign Up</h1>
                    <form name="sign_up_form" id="sign_up_form" method="post" action="process_sign_up.php">
                        <!-- do i need labels? -->
                        <label for='username'>username: </label>
                        <input type="text" name="username" placeholder="username"><br>
                    
                        <label for="password">password: </label>
                        <input type="password" name="password" placeholder="password"><br>
                    
                        <input type="submit" name="submit" id="submit" value="Login">
                    </form>
                    <p>have an account? <a href="login.php">login here</a></p>
                    <!-- add go back button in future? -->
                    <a href="welcome.php">go back</a>
                </div>
            </div>
        </div>
    </body>
    </html>