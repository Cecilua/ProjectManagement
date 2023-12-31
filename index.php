<!DOCTYPE html>
<html lang='en'>
    <?php       
        /* start a session */
        session_start(); 

        /* get session user_id */
        $user_id = $_SESSION['user_id'];

        /* if user is not logged in send to welcome page */
        if(!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] != true){
            header('Location: welcome.php');
        } 
       
        /* connect to the database */
        include 'connection.php';

        /* -------------------------------------------------------------------------------------
            learnt how top use prepared statements here: 
            https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php 
        ------------------------------------------------------------------------------------- */
        
        /* all projects query */ 
        $all_projects_query = "SELECT Project.* FROM Project WHERE Project.user_id = ?";

        $all_projects = $con->prepare($all_projects_query); // prepare query statement
        $all_projects->bind_param('i', $user_id); // bind user_id to prepared statement
        $all_projects->execute(); // execute query
        $all_projects_result = $all_projects->get_result(); // get result
        $project = mysqli_fetch_assoc($all_projects_result); // return results as associative array

        /* all tasks query */ 
        $all_tasks_query = "SELECT Task.*, Status.* FROM Task JOIN Status ON Status.status_id = Task.status_id WHERE Task.project_id = ? ORDER BY Task.status_id DESC";

        $all_tasks = $con->prepare($all_tasks_query); // prepare query statement
        $all_tasks->bind_param('i', $project['project_id']); // bind project_id to prepared statement
        $all_tasks->execute(); // execute query
        $all_tasks_result = $all_tasks->get_result(); // get result

        /* query all statuses */
        $all_status_query = "SELECT Status.* From Status";
        $all_status_result = mysqli_query($con, $all_status_query);
    ?>
    <head>
        <title>CC's Project Management Tool!!</title>
        <link href = "style.css" rel = "stylesheet" type = "text/css"/>
        <!-- favicom created with https://favicon.io/favicon-converter/ -->
        <link rel = "icon" sizes = "32x32" href = "img/favicon-32x32.png"/>
        
        <!-- import font awesome -->
        <!-- source: https://fontawesome.com/v4/icons/ -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">

        <!-- import Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="utils.js"></script>
        <script>
            /* function when checkbox is clicked */
            function handleOnClick(cb) {
                /* if checkbox was checked --> checkded = 1; if checkbox was unchecked --> checkded = 0; */
                if (cb.checked == true) {
                    checked = 1; 
                } else {
                    checked = 0;
                }
                
                /* learnt about Jquery post method here: https://www.w3schools.com/jquery/jquery_ajax_get_post.asp */
                /* post to update_checkbox.php */
                $.post("update_checkbox.php", {is_done: checked, task_id: cb.id}, function(){
                    console.log("success");
                    window.location.reload(); // refresh the page
                });
            }

            /* function when select menu is changed */
            function handleOnChange(sel) {
                console.log(sel.id); // id of the select element == item_id
                console.log(sel.value); // value of the option element == status_id
                
				/* post to update_status.php */
                $.post("update_status.php", {status_id: sel.value, task_id: sel.id}, function(){
                    console.log("success");
					window.location.reload(); // refresh the page
                }); 
            }
        </script>
    </head>
    <body>
    <div class='main-background'>
        <!-- navbar -->
        <div class = "navbar">
            <img src = 'img/logo.png' alt = "CC's Cradle's silly cat mascot" onclick="message()"> 
            <div class = "project-name">
                <?php 
                    /* print project name */
                    echo "<h1>" . $project['name'] . "</h1>";
                ?>
            </div>
            <a href='process_logout.php'>log out</a>
        </div>
         <!-- add task form -->
            <div class = 'add-form-center'>
                <form method="POST" action="insert_task.php" class="add-task-form">
                    <div class="form-element"><label for='task'>add task:</label></div>
                    <!-- learnt automatic HTML form validation  here: https://www.w3schools.com/js/js_validation.asp -->
                    <input type="text" name="task" maxlength="30" required>
                    <?php 
                        echo  "<input type='hidden' name='project_id' value=".$project['project_id'].">"; 
                    ?>
                    <div class="form-element"><button type="submit"><i class="fa fa-arrow-right" style="color: #201740;"></i></button></div>
                </form>
            </div>
        <!-- open table -->
        <div class = "table-container">
            <?php 
                /* ---------------------
                    print all items
                ---------------------*/
                /* loop through tasks */
                while ($task = mysqli_fetch_assoc($all_tasks_result)) {
                    $task_id = $task['task_id']; // get the item id
                    $task_name = $task['task']; // get the task name 
                    
                    $task_status_id = $task['status_id']; // get the status id
                    $task_status = $task['status']; // get the status name 
                    
                    $is_done = $task['is_done']; // get the checkbox status
                    
                    /* change the css based on status */
                    $status_color = "#fff"; // default status color
                    /* based on status id, change to different colors */ 
                    if ($task_status_id == 0){
                        $status_color = '#35C8B7';
                    } else if ($task_status_id == 1){
                        $status_color = '#6B8FFE';
                    } else if ($task_status_id == 2){
                        $status_color = '#E05FCD';
                    }
                    
                    /* if item is done --> check the checkbox */
                    $checked = ($is_done == 1) ? 'checked' : '';

                    /* Print each row of the table */
                    /* -----------------------------------------------------------------------------------------------
                        learnt about onchange and onclick events from roapp on stackoverflow: 
                        https://stackoverflow.com/questions/7231157/how-to-submit-form-on-change-of-dropdown-list
                    ----------------------------------------------------------------------------------------------- */ 
                    echo "<div class='table-row'>";
                    echo "<div class='row-item'><input type='checkbox' id='".$task_id."' $checked onclick='handleOnClick(this)'></div>"; // checkbox
                    echo "<div class='row-item task'><p>".$task_name."</p></div>"; // task

                    /* ---------------------
                        status dropdown
                    ---------------------*/
                    
                    echo "<div class = 'row-item'>";
                    /* make a select list within the table */
                    echo "<select id='$task_id' onchange='handleOnChange(this)' style='background-color: ".$status_color."'>"; // on change --> run handleOnChange function
                    
                    /* the tasks status is the default/top option */
                    echo "<option value=''>".$task_status."</option>";

                    /* loop through the statuses */
                    while ($status = mysqli_fetch_array($all_status_result)) {
                        $status_id = $status['status_id']; // get the status id
                        $status_name = $status['status']; // get the status name 

                        /* --------------------------------------------------
                            if the status is not the current tasks status 
                            --> display the status as an option in dropdown
                        -------------------------------------------------- */
                        if($task_status_id != $status_id) {
                            echo "<option value='$status_id'>$status_name</option>";
                        }
                    }
                    
                    /* -------------------------------------------------------------------------------------------------------------
                        reset the result pointer to allow the loop to run more than once 
                        learnt this from Quentin on StackOverflow: 
                        https://stackoverflow.com/questions/47435708/why-i-cant-display-same-result-twice-using-mysqli-fetch-assoc
                    ------------------------------------------------------------------------------------------------------------- */
                    $status = mysqli_data_seek($all_status_result, 0);
                    
                    /* close the dropdown */
                    echo "</select></div>";

                    /* delete task button */
                    echo "<div class = 'row-item'><a href='delete_task.php?del_task=".$task_id."'><i class='fa fa-times' style='color: #C9D3F2;'></i></a></div>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
    </body>
</html>