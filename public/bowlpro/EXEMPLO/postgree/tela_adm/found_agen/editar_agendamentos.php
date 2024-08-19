<?php
session_start();

if (!isset($_SESSION['agendamentos_para_editar'])) {
    header("Location: ver_todos_agendamentos.php");
    exit();
}

include("conexao.php");

$ids = $_SESSION['agendamentos_para_editar'];

$id_placeholders = implode(',', array_fill(0, count($ids), '$1'));
$sql = "SELECT * FROM horarios WHERE id_horario IN ($id_placeholders)";
$stmt = pg_prepare($conn, "", $sql);
$stmt_params = array_merge(array(str_repeat('i', count($ids))), $ids);
$result = pg_execute($conn, "", $stmt_params);
$agendamentos = pg_fetch_all($result);

pg_free_result($result);
pg_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Agendamentos</title>
    <style>
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
        <h1>Editar Agendamentos</h1>
        <form method="post" action="salvar_edicao_agendamentos.php">
            <?php foreach ($agendamentos as $agendamento): ?>
                <input type="hidden" name="id_horario[]" value="<?php echo htmlspecialchars($agendamento['id_horario']); ?>">
                <label for="data_<?php echo $agendamento['id_horario']; ?>">Data:</label>
                <input type="date" id="data_<?php echo $agendamento['id_horario']; ?>" name="data_horario[]" value="<?php echo htmlspecialchars($agendamento['data_horario']); ?>" required>
                <label for="horario_<?php echo $agendamento['id_horario']; ?>">Horário:</label>
                <input type="time" id="horario_<?php echo $agendamento['id_horario']; ?>" name="horario[]" value="<?php echo htmlspecialchars($agendamento['horario']); ?>" required>
            <?php endforeach; ?>
            <button type="submit" nome="editar" value="editar">Salvar</button>
        </form>
        <div class="buttons">
            <button onclick="window.location.href='ver_todos_agendamentos.php'">Cancelar</button>
        </div>
    </div>
</body>
</html>
