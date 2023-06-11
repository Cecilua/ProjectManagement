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

?>
<head>
    <title>CC's Project Management Tool!!</title>
</head>
<body>
    <h1>CC's Project Management Tool!!</h1>

    <?php
    $item = mysqli_fetch_assoc($all_item_result);
    echo "<h2>" . $item['name'] . "</h2>";

    // print all items
    echo $item['name'];
    echo "<br><ul>";
    while ($item) {
        $task = $item['task'];
        $task_status = $item['status'];
        $is_done = $item['is_done'];

        // if item is done --> check the checkbox
        $checked = ($is_done == 1) ? 'checked' : '';

        // Print the list with the checkbox
        echo "<li><label><input type='checkbox' $checked> Task: " . $task . " Status: " . $task_status . "</label></li>";

        $item = mysqli_fetch_assoc($all_item_result);
    }
    echo "</ul>";
    ?>
</body>
</html>
