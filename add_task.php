
<?php
$connection = mysqli_connect("localhost", "root", "", "todo_app");

if(!$connection){
    die("Erro de conexão:" .mysqli_connect_error());
}
$description = $_POST['task'];
$date_option = mysqli_real_escape_string($connection, $_POST['date_option']);
$specific_date = isset($_POST['specific_date']) ? mysqli_real_escape_string($connection, $_POST['specific_date']) : null;

if($date_option === 'specific' && !empty($specific_date)){
    $date_value = $specific_date;
}else{
    $date_value = $date_option;
}

$query = "INSERT INTO tasks (description, date_option, specific_date) VALUES ('$description', '$date_option', '$date_value')";
if(mysqli_query($connection,$query)){
    header("Location: index.php");
    exit;
}else{
    echo "Erro ao adicionar tarefa:" . mysqli_error($connection);
}

mysqli_query($connection, $query);

?>
