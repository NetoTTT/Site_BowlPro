<?php
session_start();

if(isset($_SESSION['email'])) {

    $email_cliente = $_SESSION['email'];

    include("conexao.php");

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $sql = "SELECT nome FROM clientes WHERE email='$email_cliente'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_cliente = $row['nome'];

        echo $nome_cliente;
    } else {
        echo "Nome do Cliente";
    }

    $conn->close();
} else {
    echo "Nome do Cliente";
}
?>
<!-- asdasdasdasd-->