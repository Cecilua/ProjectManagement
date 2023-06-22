<?php
    /* start a new session */
    session_start();
    
    /* connect to database */
    include 'connection.php';
    
    /* check if the username and password are set and not empty */
    
    if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
        /* get the inputted username and password */
        $user = trim($_POST['username']);
        $pass = trim($_POST['password']);
		
		/* make the query */
    	$login_query = "SELECT password FROM User WHERE username='$user'";
        $login_result = mysqli_query($con, $login_query);

        /* check if the query was successful */
        if ($login_result) {
            /* check if any results were returned */
            if (mysqli_num_rows($login_result) > 0) {
                /* get the result */
                $login_record = mysqli_fetch_assoc($login_result);
                $hash = $login_record['password'];

                /* verify login information */
                $verify = password_verify($pass, $hash);
                if($verify){
                    echo "logged in successfully";
                    $_SESSION['logged_in'] = true;
                    header("Location: index.php");
                } else {
                    echo "incorrect username or password";
                }
            } else {
                echo "user not found";
                header("Location: login.php");
            }
        } else {
            echo "incorrect username or password";
        }
    } else {
        echo "please enter a username and password";
    }


    
?>
