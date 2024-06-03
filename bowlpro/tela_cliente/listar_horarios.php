<?php

if (!isset($_SESSION['email'])) {
    header("Location: /index.html");
    exit();
}

include("conexao.php");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$email_cliente = $_SESSION['email'];

$sql = "SELECT id_horario, data_horario, horario FROM horarios WHERE email_cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email_cliente);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<form action="apagar_horario.php" method="POST">';
    while ($row = $result->fetch_assoc()) {
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

$stmt->close();
$conn->close();
?>
