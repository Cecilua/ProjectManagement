<?php
    session_start(); // start session
    session_destroy(); // destroy session
    header("Location: index.php"); // refresh the page
?> 