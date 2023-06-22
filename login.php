<!DOCTYPE html>
<html lang = 'en'>
    <?php    
        /* connect to database */
        include 'connection.php';
    ?>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <title>CC's Project Management Tool!!</title>
    </head>
    <body>
        <h2>Login Page</h2>
        <a href="index.php">home</a><br><br>
        <!-- Login Form -->
        <form name="login_form" id="login_form" method="post" action="process_login.php">
            <label for='username'>username: </label>
            <input type="text" name="username" placeholder="username"><br>

            <label for="password">password: </label>
            <input type="password" name="password" placeholder="password"><br>

            <input type="submit" name="submit" id="submit" value="Login">
        </form>

    </body>
</html>