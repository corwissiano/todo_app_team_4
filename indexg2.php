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
            const errorMessage = document.getElementById("error-message");
            errorMessage.textContent = ""; // Limpa mensagens anteriores

            if (taskInput.value === "") { 
                errorMessage.textContent = "Por favor, preencha o campo de tarefa.";
                event.preventDefault(); 
                return false;
            }

            if (taskInput.value.length > 100) { 
                errorMessage.textContent = "A tarefa não pode ter mais de 100 caracteres.";
                event.preventDefault(); 
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
            echo "<li>{$row['description']} - {$row['status']} 
                <a href='delete_task.php?id={$row['id']}'>Apagar</a> 
                | 
                <a href='update_task.php?id={$row['id']}'>Editar</a>
            </li>";
        }
        ?>
    </ul>

    <form id="task-form" action="add_task.php" method="POST">
        <div id="error-message" style="color: red; font-weight: bold; margin-bottom: 10px;"></div>
        <input id="task-input" type="text" name="task" pattern="[A-Za-z0-9\s]+" placeholder="Nova Tarefa" required maxlength="[100]">
        <button type="submit">Adicionar Tarefa</button>
    </form>
</body>
</html>
