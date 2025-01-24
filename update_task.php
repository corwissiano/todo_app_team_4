
<?php
$connection = mysqli_connect("localhost", "root", "", "todo_app");
$id = $_GET['id'];
$query = "UPDATE tasks SET status = 'completed' WHERE id = $id";
mysqli_query($connection, $query);
header("Location: index.php");
?>
