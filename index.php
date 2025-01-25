
<?php
$connection = mysqli_connect("localhost", "root", "", "todo_app");
$query = "SELECT * FROM tasks";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Lista de Tarefas</title>
    <style>
        .form-container{
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .error-message{
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
    <script>
        function validateForm(event) {
            const taskInput = document.getElementById("task-input");
            const errorMessage = document.getElementById("error-message");
            if (taskInput.value.length > 100) { 
                errorMessage.textContent ="A tarefa não pode ter mais de 100 caracteres.";
                errorMessage.style.display = "block";
                event.preventDefault();
                return false;
            }
            else{
                errorMessage.style.display ="none";
            }
            return true;
        }
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("task-form");
            const taskInput = document.getElementById("task-input");
            const errorMessage = document.getElementById("error-message");
            form.addEventListener("submit", validateForm);
            taskInput.addEventListener("input", function () {
                if(taskInput.value.length>100){
                    errorMessage.style.display = "block";
                }
                else{
                    errorMessage.style.display = "none";
                }
                })
            const dateSelector = document.getElementById("date-selector");
            const specificDateInput = document.getElementById("specific-date");

            dateSelector.addEventListener("change", function () {
                if (dateSelector.value === "specific") {
                    specificDateInput.style.display = "block";
                } else {
                    specificDateInput.style.display = "none";
                }
            });
        });

        function formatString($input) {
        $trimmed = trim($input); 
        return preg_replace('/\s+/', ' ', $trimmed);
    }
    </script>
</head>
<body>
    <h1>Lista de Tarefas</h1>
    <ul>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $dateInfo = $row['date_option'] == 'specific' ? $row['specific_date'] : ucfirst($row['date_option']);
            echo "<li>{$row['description']} - {$row['status']} <a href='delete_task.php?id={$row['id']}'>Apagar</a></li>";
        }
        ?>
    </ul>
    <form id="task-form" action="add_task.php" method="POST">
        <div class="form-container">
            <input id="task-input" type="text" name="task" pattern="[A-Za-z0-9\s]+" title="Apenas letras e números são permitidos" placeholder="Nova Tarefa" required>
            
            <!-- Opções de data -->
            <select id="date-selector" name="date_option" required>
                <option value="none">Sem dia</option>
                <option value="everyday">Todos os dias</option>
                <option value="specific">Dia específico</option>
            </select>

            <!-- Campo de data específica (oculto inicialmente) -->
            <input id="specific-date" type="date" name="specific_date" style="display: none;">
            
            
            <button type="submit">Adicionar Tarefa</button>
        </div>
        <span id="error-message" class="error-message"></span>
    </form>
</body>
</html>
