<?php
session_start();

include("conexao.php");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_horario'])) {
    $id_horario = $_POST['id_horario'];
    $sql = "DELETE FROM horarios WHERE id_horario = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_horario);

    if ($stmt->execute()) {
        echo "<script>alert('Horário cancelado com sucesso.'); window.location.href = 'tela_cliente.php';</script>";
    } else {
        echo "<script>alert('Erro ao cancelar horário.'); window.location.href = 'tela_cliente.php';</script>";
    }

    $stmt->close();
} else{ 
    echo "<script>alert('Nenhum horário foi selecionado.'); window.location.href = 'tela_cliente.php';</script>";
}

$conn->close();
?>
