<?php
    /* start a new session */
    session_start();
    
    /* connect to database */
    include 'connection.php';
    
    /* check if the username and password are set and not empty */
    if(isset($_POST['username']) && isset($_POST['password'])){
        /* get the inputted username and password */
        $user = trim($_POST['username']);
        $pass = trim($_POST['password']);

        /* login query */ 
        $login_query = "SELECT * FROM User WHERE username=?";

        $login = $con->prepare($login_query); // prepare the query statement
        $login->bind_param('s', $user); // bind username to prepared statement
        $login->execute(); // execute query
        $login_result = $login->get_result(); // get result

        /* check if the query was successful */
        if ($login_result) {
            /* check if any results were returned */
            if (mysqli_num_rows($login_result) > 0) {
                /* get the result */
                $login_record = mysqli_fetch_assoc($login_result); 
                $hash = $login_record['password'];

                /* verify login information */
                $verify = password_verify($pass, $hash);
                if($verify){ // if login successful
                    echo "logged in successfully";
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $login_record['user_id'];
                    echo $login_record['user_id'];
                    
                    /* clean up errors */
                    $_SESSION['login_error'] = '';
                    
                    /* send to index */ 
                    header("Location: index.php");
    
                } else { // if user exists, but login unsuccessful
                    $_SESSION['login_error'] = 'incorrect username or password';
                    header("Location: login.php");
                }
            } else { // if user does not exist
                /* set errors */
                $_SESSION['login_error'] = 'user not found';
                header("Location: login.php");
            }
        } else { // if query failed
            /* set errors */
            $_SESSION['login_error'] = 'error...';
            header("Location: login.php");
        }
    } 
?>
