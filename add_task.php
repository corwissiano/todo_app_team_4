
<?php
$connection = mysqli_connect("localhost", "root", "", "todo_app");
$description = $_POST['task'];
$query = "INSERT INTO tasks (description) VALUES ('$description')";
mysqli_query($connection, $query);
header("Location: index.php");
?>
