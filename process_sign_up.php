<?php
    /* insert new user into database */

    /* connect to the database */
    include 'connection.php';
    
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
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        // get the username and password
        $user = $_POST['username'];
        $pass = $_POST['password'];

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
            echo "<script>alert('username already exists');</script>";
        }

    } else {
        echo "<script>alert('please enter a username and password');</script>";
    }
?>
