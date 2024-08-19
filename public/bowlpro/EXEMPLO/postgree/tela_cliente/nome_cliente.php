<?php
session_start();

if(isset($_SESSION['email'])) {

    $email_cliente = $_SESSION['email'];

    include("conexao.php");
    
    if (!$conn) {
        die("Erro de conexão: " . pg_last_error());
    }

    // Utilizando prepared statements para evitar SQL Injection
    $result = pg_prepare($conn, "get_nome", 'SELECT nome FROM clientes WHERE email = $1');
    $result = pg_execute($conn, "get_nome", array($email_cliente));

    if ($result) {
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_assoc($result);
            $nome_cliente = $row['nome'];

            echo $nome_cliente;
        } else {
            echo "Nome do Cliente";
        }
    } else {
        echo "Erro na consulta: " . pg_last_error($conn);
    }

    // Fechar a conexão
    pg_close($conn);
} else {
    echo "Nome do Cliente";
}
?>

<!-- asdasdasdasd-->