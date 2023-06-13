<!DOCTYPE html>
<html lang='en'>
    <?php
        /* connect to the database */
        include 'connection.php';


        /* add task to the database */
        if (isset($_POST['task'])) {
            $task = $_POST['task'];
			echo"===>> $task";
			
            $add_query = "INSERT INTO Item (task, project_id) VALUES ('$task', 1)";
            $add_result = mysqli_query($con, $add_query);
			echo $add_result;

            /* refresh the page */
            header("Location: index.php");
        }

        /* delete task from the database */
        if (isset($_GET['del_task'])) {
            echo"yo";
			$item_id = $_GET['del_task'];
            echo"===>> $item_id";
            
            $delete_query = "DELETE FROM Item WHERE item_id=$item_id";
            $delete_result = mysqli_query($con, $delete_query);
            echo $delete_result;

            /* refresh the page */
            header("Location: index.php");
        }




        /* query all items */
        $all_item_query = "SELECT Item.*, Status.*, Project.* FROM Item
            JOIN Project ON Item.project_id = Project.project_id 
            LEFT JOIN Status ON Item.status_id = Status.status_id OR (Item.status_id IS NULL AND Status.status_id IS NULL)
            WHERE Item.project_id = 1";
        $all_item_result = mysqli_query($con, $all_item_query);


        /* query all statuses */
        $all_status_query = "SELECT Status.* From Status";
        $all_status_result = mysqli_query($con, $all_status_query);


    ?>
    <head>
        <title>CC's Project Management Tool!!</title>
        
        <!-- Place holder css -->
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }

            
            /* test */  
            table p {
                color: red; 
            }
        </style>

        <!-- import Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        
        
        
        
        
        <script>
            // function when checkbox is clicked
            function handleOnClick(cb) {
                //console.log(cb.id);
                //console.log(cb.checked);

                if (cb.checked == true) {
                    checked = 1; 
                } else {
                    checked = 0;
                }

                // make a query
                query = "UPDATE Item SET is_done= " + checked + " WHERE item_id=" + cb.id;

                // post the query to update_item.php
                $.ajax({
                    type: "POST",
                    url: "update_item.php",
                    data: query,
                    success: function (data) {
                        console.log(data);
                    }
                });
            }

            function handleOnChange(sel) {
                console.log(sel.id);
                console.log(sel.value);
                

                // make a query
                query = "UPDATE Item SET status_id=" + sel.value + " WHERE item_id=" + sel.id;

                // post the query to update_item.php
                $.ajax({
                    type: "POST",
                    url: "update_item.php",
                    data: query,
                    success: function (data) {
                        console.log(data);
                    }
                });
            }


        </script>
    </head>
    <body>
        <h1>CC's Project Management Tool!!</h1>

        <!-- add a task -->
        <form method="POST" action="index.php">
            <input type="text" name="task">
            <button type="submit">add</button>
        </form>

        <?php
            $item = mysqli_fetch_assoc($all_item_result);
            echo "<h2>" . $item['name'] . "</h2>";

            // print all items
            // open the table
            echo "<br><table>";

            // table headings 
            echo "<tr>";
            echo "<th>checkbox</th>";
            echo "<th>task</th>";
            echo "<th>status</th>";
            echo "<th>delete</th>";
            echo"</tr>";

            while ($item) {
                // later should add consistency to these variables...
                $item_id = $item['item_id'];
                $task = $item['task'];
                $task_status = $item['status'];
                $task_status_id = $item['status_id'];
                $is_done = $item['is_done'];

                // if item is done --> check the checkbox
                $checked = ($is_done == 1) ? 'checked' : '';

                // Print each row of the table
                echo "<tr>";
                echo "<td><input type='checkbox' id='".$item_id."' $checked onclick='handleOnClick(this)'></td>";
                echo "<td>".$task."</td>";
                
                

                // print the status
                echo "<td>";
                // make a select form --> on change run the javascript function
                echo "<select id='$item_id' onchange='handleOnChange(this)'>";
                
                
                // the tasks status is the default/top option 
                echo "<option value=''>".$task_status."</option>";

                // loop through the statuses
                
                while ($status = mysqli_fetch_array($all_status_result)) {
                    $status_id = $status['status_id'];
                    $status_name = $status['status'];

                    // if the status is not the current tasks status
                    if($task_status_id != $status_id) {
                       // display the status as an option in dropdown
                        echo "<option value='$status_id'>$status_name</option>";
                    }
                }
                
                // reset the result pointer to allow the loop to run again
                $status = mysqli_data_seek($all_status_result, 0);
                    
                // close the dropdown
                echo "</select></td>";
                
                // delete task button
                echo "<td><a href='index.php?del_task=".$item_id."'>delete</a></td>";
                echo "</tr>";

                
                

                
                // avoid infinite loop
                $item = mysqli_fetch_assoc($all_item_result);
                

            }
            echo "</table>";
        ?>
    </body>
</html>