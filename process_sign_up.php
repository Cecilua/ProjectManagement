<?php
    /* --------------------------------
        insert new user into database 
    -------------------------------- */

    /* connect to the database */
    include 'connection.php';

    /* start a session */
    session_start();
    
    /* check for duplicate username */
    function is_duplicate_username($username) {
        /* connect to the database */
    	include 'connection.php';

		/* username query */ 
        $username_query = "SELECT * FROM User WHERE username = ?";

        $username_test = $con->prepare($username_query); // prepare query statement
        $username_test->bind_param('s', $username); // bind username to prepared statement
        $username_test->execute(); // execute query
        $username_result = $username_test->get_result(); // get result

        if (mysqli_num_rows($username_result) > 0) {
            /* if the username already exists, return true */
            return true;
        }
        
        /* if the username is unique, return false */
        return false; 
    }
    
    /* check if the username and password are not empty */
    if(isset($_POST['username']) && isset($_POST['password'])) {
        /* get the username and password */
        $user = trim($_POST['username']);
        $pass = trim($_POST['password']);

        /* if username is unique --> add to database */
        if(!is_duplicate_username($user)) {
            /* encrypt the password */
            $encrypted_pass = password_hash($pass, PASSWORD_BCRYPT);
            
            /* username query */ 
            $add_user_query = "INSERT INTO User (username, password) VALUES (?, ?)";

            $add_user = $con->prepare($add_user_query); // prepare query statement
            $add_user->bind_param('ss', $user, $encrypted_pass); // bind user and encrypted password to prepared statement
            $add_user->execute(); // execute query
            $add_user_result = $add_user->get_result(); // get result

            /* -------------------------------------------
                Create a default project for each user 
            ------------------------------------------- */ 
            /* search for added user */ 
            $get_user_query = "SELECT * FROM User WHERE User.username = ?";

            $get_user = $con->prepare($get_user_query); // prepare query statement
            $get_user->bind_param('s', $user); // bing username to prepared statement
            $get_user->execute(); // execute query
            $get_user_result = $get_user->get_result(); // get result
            $get_user_record = mysqli_fetch_assoc($get_user_result); // return result as associative array 

            $project_name = $get_user_record['username']."'s Project"; // default project name 
            
            /* add project query */
            $add_project_query = "INSERT INTO Project (user_id, name) VALUES (?, ?)";

            $add_project = $con->prepare($add_project_query); // prepare query statement
            $add_project->bind_param('is', $get_user_record['user_id'], $project_name); // bind user_id and project_name to prepared statement
            $add_project->execute(); // execute query
            $add_project_result = $add_project->get_result(); // get result
            
			/* clear errors */ 
			$_SESSION['sign_up_error'] = '';
			$_SESSION['login_error'] = '';
            
			/* send to login page */
			header('Location: login.php');
            exit;

        } else { // if the username already exists 
            $_SESSION['sign_up_error'] = 'username already exists. please choose another one';
            header("Location: sign_up.php");
        }
    }
?>
