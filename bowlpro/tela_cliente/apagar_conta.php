<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: /index.html");
    exit();
}

include("conexao.php");

$email_cliente = $_SESSION['email'];

// Iniciar transação
$conn->begin_transaction();

try {
    $sql_delete_agendamentos = "DELETE FROM horarios WHERE email_cliente = ?";
    $stmt_delete_agendamentos = $conn->prepare($sql_delete_agendamentos);
    $stmt_delete_agendamentos->bind_param("s", $email_cliente);
    $stmt_delete_agendamentos->execute();

    $sql_delete_cliente = "DELETE FROM clientes WHERE email = ?";
    $stmt_delete_cliente = $conn->prepare($sql_delete_cliente);
    $stmt_delete_cliente->bind_param("s", $email_cliente);
    $stmt_delete_cliente->execute();

    if ($stmt_delete_cliente->affected_rows > 0) {
        $conn->commit();
        session_destroy();
        echo "<script>alert('Conta e agendamentos deletados com sucesso.'); window.location.href = '/index.html';</script>";
    } else {
        $conn->rollback();
        echo "<script>alert('Erro ao tentar deletar a conta.'); window.location.href = 'tela_cliente.php';</script>";
    }

    $stmt_delete_agendamentos->close();
    $stmt_delete_cliente->close();
} catch (Exception $e) {
    $conn->rollback();
    echo "<script>alert('Erro ao tentar deletar a conta.'); window.location.href = 'tela_cliente.php';</script>";
}

$conn->close();
?>
