<?php
//This is your Database connection file. You may use this file or create your own.
//Never code your normal user name and password into your database connection file.
//Keep the password contained in this file private.

try {
	$conn = new PDO('mysql:host=localhost;dbname=kuntzece_project_management', '_kuntzece', '7XYmhmo889pOrjZe');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //This line helps you find your SQL syntax errors. You can remove it if you want to.
}catch(PDOException $e){
	echo 'Error: ' . $e->getMessage();
	die("Error Connecting to Database: kuntzece_project_management");
}
?>