<?php
session_start();

include("conexao.php");

if ($conn->connect_error) {
    die("Erro de conexão: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_horario'])) {
    $id_horario = $_POST['id_horario'];
    $sql = "DELETE FROM horarios WHERE id_horario = $1";
    
    $stmt = pg_prepare($conn, "", $sql);
    $result = pg_execute($conn, "", array($id_horario));

    if ($result) {
        echo "<script>alert('Horário cancelado com sucesso.'); window.location.href = 'tela_cliente.php';</script>";
    } else {
        echo "<script>alert('Erro ao cancelar horário.'); window.location.href = 'tela_cliente.php';</script>";
    }

    pg_free_result($result);
    pg_close($conn);
} else { 
    echo "<script>alert('Nenhum horário foi selecionado.'); window.location.href = 'tela_cliente.php';</script>";
}
?>
