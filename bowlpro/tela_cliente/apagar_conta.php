<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: /index.html");
    exit();
}

include("conexao.php");

$email_cliente = $_SESSION['email'];

// Iniciar transação
pg_query($conn, "BEGIN");

try {
    $sql_delete_agendamentos = "DELETE FROM horarios WHERE email_cliente = $1";
    $stmt_delete_agendamentos = pg_prepare($conn, "", $sql_delete_agendamentos);
    $result_delete_agendamentos = pg_execute($conn, "", array($email_cliente));

    $sql_delete_cliente = "DELETE FROM clientes WHERE email = $1";
    $stmt_delete_cliente = pg_prepare($conn, "", $sql_delete_cliente);
    $result_delete_cliente = pg_execute($conn, "", array($email_cliente));

    if (pg_affected_rows($result_delete_cliente) > 0) {
        pg_query($conn, "COMMIT");
        session_destroy();
        echo "<script>alert('Conta e agendamentos deletados com sucesso.'); window.location.href = '/index.html';</script>";
    } else {
        pg_query($conn, "ROLLBACK");
        echo "<script>alert('Erro ao tentar deletar a conta.'); window.location.href = 'tela_cliente.php';</script>";
    }

    pg_free_result($result_delete_agendamentos);
    pg_free_result($result_delete_cliente);
} catch (Exception $e) {
    pg_query($conn, "ROLLBACK");
    echo "<script>alert('Erro ao tentar deletar a conta.'); window.location.href = 'tela_cliente.php';</script>";
}

// Fechar conexão
pg_close($conn);
?>

