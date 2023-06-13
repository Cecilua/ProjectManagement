<!DOCTYPE html>
<html lang='en'>
    <?php
        /* connect to the database */
        include 'connection.php';

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
        <link href = "style.css" rel = "stylesheet" type = "text/css"/>

        <!-- import Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        
        <script>
            // take a query -- and post it to update_item.php
            function postUpdate(qry){
                $.post("update_item.php", query, function(data) {
                    console.log(data);
                });
            }
            
            // function when checkbox is clicked
            async function handleOnClick(cb) {
                console.log(cb.id); // checkbox id == item_id
                console.log(cb.checked); // if checkbox is checked

                // if checkbox was checked --> checkded = 1; if checkbox was unchecked --> checkded = 0; 
                if (cb.checked == true) {
                    checked = 1; 
                } else {
                    checked = 0;
                }

                // make a query
                query = "UPDATE Item SET is_done= " + checked + " WHERE item_id=" + cb.id;

                // post the query to update_item.php
                await postUpdate(query);

                // refresh the page
                await window.location.reload();
            }

            async function handleOnChange(sel) {
                console.log(sel.id); // id of the select element == item_id
                console.log(sel.value); // value of the option element == status_id
                
                // make a query
                query = "UPDATE Item SET status_id=" + sel.value + " WHERE item_id=" + sel.id;

                // post the query to update_item.php
                await postUpdate(query);

                // refresh the page
                await window.location.reload();
            }
        </script>
    </head>
    <body>
        <h1>CC's Project Management Tool!!</h1>

        <!-- add a task form -->
        <h2>Add a Task: </h2>
        <form method="POST" action="insert_item.php">
            <input type="text" name="task">
            <button type="submit">add task</button>
        </form>

        <?php
            $item = mysqli_fetch_assoc($all_item_result);
            /* print project name */
            echo "<h2>" . $item['name'] . "</h2>";

            /* ---------------------
               print all items
            ---------------------*/
            
            /* open table */
            echo "<br><table>";

            /* table headings */
            echo "<tr>";
            echo "<th>checkbox</th>";
            echo "<th>task</th>";
            echo "<th>status</th>";
            echo "<th>delete</th>";
            echo"</tr>";

            /* loop through items */
            while ($item) {
                $item_id = $item['item_id']; // get the item id
                $task = $item['task']; // get the task name 
                
                $item_status_id = $item['status_id']; // get the status id
                $item_status = $item['status']; // get the status name 
                
                $is_done = $item['is_done']; // get the checkbox status
                
                
                /* test changing css based on status */
                $style_test = "";
                /* if the status is ongoing --> change cell color */ 
                if ($item_status_id == 0){
                    $style_test = "bgcolor='#a5d7e8'";
                }
                
                
                /* if item is done --> check the checkbox */
                $checked = ($is_done == 1) ? 'checked' : '';

                /* Print each row of the table */
                echo "<tr>";
                echo "<td><input type='checkbox' id='".$item_id."' $checked onclick='handleOnClick(this)'></td>"; // checkbox
                echo "<td ".$style_test.">".$task."</td>"; // task
                


                /* ---------------------
                   status dropdown
                ---------------------*/
                
                echo "<td>";
                /* make a select list within the table */
                echo "<select id='$item_id' onchange='handleOnChange(this)'>"; // on change --> run handleOnChange function
                
                /* the tasks status is the default/top option */
                echo "<option value=''>".$item_status."</option>";

                /* loop through the statuses */
                while ($status = mysqli_fetch_array($all_status_result)) {
                    $status_id = $status['status_id']; // get the status id
                    $status_name = $status['status']; // get the status name 

                    /* if the status is not the current tasks status 
                     * --> display the status as an option in dropdown
                     */
                    if($item_status_id != $status_id) {
                        echo "<option value='$status_id'>$status_name</option>";
                    }
                }
                
                /* reset the result pointer to allow the loop to run more than once */
                $status = mysqli_data_seek($all_status_result, 0);
                    
                /* close the dropdown */
                echo "</select></td>";
                
                /* delete task button */
                echo "<td><a href='delete_item.php?del_task=".$item_id."'>delete</a></td>";
                echo "</tr>";

                /* avoid infinite loop */
                $item = mysqli_fetch_assoc($all_item_result);

            }
            /* close table */
            echo "</table>";
        ?>
    </body>
</html>