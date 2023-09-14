<?php
    /* insert new user into database */

    /* connect to the database */
    include 'connection.php';

    /* start a session */
    session_start();
    
    /* check for duplicate username */
    function is_duplicate_username($username) {
        // query users with the same username
        $username_result = mysqli_query($con, $username_query);

        /* username query */ 
        $username_query = "SELECT * FROM User WHERE username = ?";

        $username = $con->prepare($username_query);
        $username->bind_param('i', $user_id);
        $username->execute();
        $username_result = $username->get_result();

        if (mysqli_num_rows($username_result) > 0) {
            // If the username already exists, return true
            return true;
        }

        return false; 
    }
    
    /* check if the username and password are not empty */
    if(isset($_POST['username']) && isset($_POST['password'])) {
        // get the username and password
        $user = trim($_POST['username']);
        $pass = trim($_POST['password']);

        // if username is unique --> add to database
        if(!is_duplicate_username($user)) {
            /* encrypt the password */
            $encrypted_pass = password_hash($pass, PASSWORD_BCRYPT);
            
            
            /* username query */ 
            $add_user_query = "INSERT INTO User (username, password) VALUES (?, ?)";


            $add_user = $con->prepare($add_user_query);
            $add_user->bind_param('ss', $user, $encrypted_pass);
            $add_user->execute();
            $add_user_result = $add_user->get_result();


            /* simple error checking */
            if (!mysqli_query($con, $add_user_query)) {
                    echo "error...";
                } else {
                    echo "<script>alert('successfully signed up!!');</script>";
                }

            /* send to login page */
            header('Location: login.php');
            exit;

        } else {
            $_SESSION['sign_up_error'] = 'username already exists. please choose another one';
        }
?>
