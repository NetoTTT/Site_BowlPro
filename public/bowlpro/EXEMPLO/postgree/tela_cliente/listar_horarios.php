<?php

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
