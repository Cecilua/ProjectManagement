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
        <h2>Sign up Page</h2>
        <a href="index.php">home</a><br><br>
        <!-- sign up form -->

        <h2>Sign up: </h2>
        <form method="POST" action="process_sign_up.php">
            <input type="text" name="username" placeholder="username:">
            <input type="text" name="password" placeholder="password:">
            
            <button type="submit">sign up</button>
        </form>







        

    </body>
</html>