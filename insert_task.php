<?php
    /* insert item into database */

    /* connect to the database */
    include 'connection.php';

    /* get the task name */
    $task = $_POST['task'];
    
    /* make the query (project_id is hardcoded for now) */
    $insert_query = "INSERT INTO Task (task, project_id) VALUES ('$task', 1)";

    /* simple error checking */
    if (!mysqli_query($con, $insert_query)) {

            echo "error...";
        } else {
            echo "inserted";
        }

    /* refresh the page */
    header('Location: index.php');
?>
