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

$sql = "SELECT id_horario, data_horario, horario FROM horarios WHERE email_cliente = '$email_cliente'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<form action="apagar_horario.php" method="POST">';
    while ($row = $result->fetch_assoc()) {
        echo '<li><input type="radio" name="id_horario" value="' . $row["id_horario"] . '"> ID: ' . $row["id_horario"] . ' - ' . $row["data_horario"] . ' - ' . $row["horario"] . '</li>';
    }
    echo '<button type="submit">Cancelar Horário</button>';
    echo '</form>';
} else {
    echo "<li>Nenhum horário agendado para este cliente.</li>";
}

$conn->close();
?>
