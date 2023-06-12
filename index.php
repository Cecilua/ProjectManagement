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
        }




        /* query all items */
        $all_item_query = "SELECT Item.*, Status.*, Project.* FROM Item
            JOIN Project ON Item.project_id = Project.project_id 
            LEFT JOIN Status ON Item.status_id = Status.status_id OR (Item.status_id IS NULL AND Status.status_id IS NULL)
            WHERE Item.project_id = 1";
        $all_item_result = mysqli_query($con, $all_item_query);
    ?>
    <head>
        <title>CC's Project Management Tool!!</title>

        <script>
            function handleOnClick(cb) {
                console.log(cb.id);
                console.log(cb.checked);
            }
        </script>
    </head>
    <body>
        <h1>CC's Project Management Tool!!</h1>

        <form method="POST" action="index.php">
            <input type="text" name="task">
            <button type="submit">add</button>
        </form>

        <?php
            $item = mysqli_fetch_assoc($all_item_result);
            echo "<h2>" . $item['name'] . "</h2>";

            // print all items
            echo "<br><ul>";
            while ($item) {
                $item_id = $item['item_id'];
                $task = $item['task'];
                $task_status = $item['status'];
                $is_done = $item['is_done'];

                // if item is done --> check the checkbox
                $checked = ($is_done == 1) ? 'checked' : '';

                // Print the list with the checkbox
                echo "<li><label><input type='checkbox' id='".$item_id."' $checked onclick='handleOnClick(this)' >Task: " . $task . " Status: " . $task_status . "</label></li>";

                $item = mysqli_fetch_assoc($all_item_result);
            }
            echo "</ul>";
        ?>
    </body>
</html>