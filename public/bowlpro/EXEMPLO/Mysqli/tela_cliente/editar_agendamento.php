<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_horario = $_GET['id'];

    // Buscar o agendamento específico
    $sql = "SELECT * FROM horarios WHERE id_horario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_horario);
    $stmt->execute();
    $result = $stmt->get_result();
    $agendamento = $result->fetch_assoc();

    if (!$agendamento) {
        die("Agendamento não encontrado.");
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_horario'])) {
    $id_horario = $_POST['id_horario'];
    $nova_data = $_POST['data_horario'];
    $novo_horario = $_POST['horario'];

    // Atualizar o agendamento
    $sql = "UPDATE horarios SET data_horario = ?, horario = ? WHERE id_horario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nova_data, $novo_horario, $id_horario);

    if ($stmt->execute()) {
        echo "<script>alert('Agendamento atualizado com sucesso.'); window.location.href = 'tela_cliente.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar o agendamento.'); window.location.href = 'editar_agendamento.php?id=$id_horario';</script>";
    }

    $stmt->close();
    $conn->close();
    exit();
}
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
