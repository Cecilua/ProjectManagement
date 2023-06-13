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
        </style>

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
                $item_id = $item['item_id'];
                $task = $item['task'];
                $task_status = $item['status'];
                $is_done = $item['is_done'];

                // if item is done --> check the checkbox
                $checked = ($is_done == 1) ? 'checked' : '';

                // Print each row of the table
                echo "<tr>";
                echo "<td><input type='checkbox' id='".$item_id."' $checked onclick='handleOnClick(this)'></td>";
                echo "<td>".$task."</td>";
                echo "<td>".$task_status."</td>";
                echo "<td><a href='index.php?del_task=".$item_id."'>delete</a></td>";
                echo "</tr>";

                $item = mysqli_fetch_assoc($all_item_result);
            }
            echo "</table>";
        ?>
    </body>
</html>