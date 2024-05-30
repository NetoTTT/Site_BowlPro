<?php

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: /index.html");
    exit();
}

include("conexao.php")

if (!$conn) {
    die("Erro de conexão: " . pg_last_error());
}

$email_cliente = $_SESSION['email'];

$sql = "SELECT id_horario, data_horario, horario FROM horarios WHERE email_cliente = $1";
$stmt = pg_prepare($conn, "", $sql);
$result = pg_execute($conn, "", array($email_cliente));

if ($result && pg_num_rows($result) > 0) {
    echo '<form action="apagar_horario.php" method="POST">';
    while ($row = pg_fetch_assoc($result)) {
        echo '<li>';
        echo '<input type="radio" name="id_horario" value="' . $row["id_horario"] . '">';
        echo ' ID: ' . htmlspecialchars($row["id_horario"]) . ' - ' . htmlspecialchars($row["data_horario"]) . ' - ' . htmlspecialchars($row["horario"]);
        echo ' <a href="editar_agendamento.php?id=' . $row["id_horario"] . '">Editar</a>';
        echo '</li>';
    }
    echo '<button type="submit">Cancelar Horário</button>';
    echo '</form>';
} else {
    echo "<li>Nenhum horário agendado para este cliente.</li>";
}

// Fechar a conexão
pg_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Agendamento</title>
    <style>
        body{
            background-color: #4f6077;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-container form label,
        .form-container form input,
        .form-container form button {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Editar Agendamento</h1>
        <form method="post" action="editar_agendamento.php">
            <input type="hidden" name="id_horario" value="<?php echo htmlspecialchars($agendamento['id_horario']); ?>">
            <label for="data_horario">Data:</label>
            <input type="date" id="data_horario" name="data_horario" value="<?php echo htmlspecialchars($agendamento['data_horario']); ?>" required>
            <label for="horario">Horário:</label>
            <input type="time" id="horario" name="horario" value="<?php echo htmlspecialchars($agendamento['horario']); ?>" required>
            <button type="submit" class="buttons">Salvar</button>
        </form>
    </div>
</body>
</html>
