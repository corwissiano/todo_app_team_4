
<?php
$connection = mysqli_connect("localhost", "root", "", "todo_app");
$query = "SELECT * FROM tasks";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Lista de Tarefas</title>
    <script>
        function validateForm(event) {
            const taskInput = document.getElementById("task-input");
            if (taskInput.value === "") { 
                alert("Por favor, preencha o campo de tarefa.");
                event.preventDefault();
                return false;
            }
            if (taskInput.value.length > 100) { 
                alert("A tarefa não pode ter mais de 100 caracteres.");
                return false;
            }
            return true;
        }
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("task-form");
            form.addEventListener("submit", validateForm);
        });
    </script>
</head>
<body>
    <h1>Lista de Tarefas</h1>
    <ul>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>{$row['description']} - {$row['status']} <a href='delete_task.php?id={$row['id']}'>Apagar</a></li>";
        }
        ?>
    </ul>
    <form id="task-form" action="add_task.php" method="POST">
        <input id="task-input" type="text" name="task" placeholder="Nova Tarefa">
        <button type="submit">Adicionar Tarefa</button>
    </form>
</body>
</html>
