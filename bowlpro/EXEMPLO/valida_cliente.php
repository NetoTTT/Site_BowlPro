<?php
session_start();

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM clientes WHERE email='$email' AND senha='$senha'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['email'] = $email;
            echo "<script>alert('Login Validado'); window.location.href = 'tela_cliente/tela_cliente.php';</script>";
            exit();
        } else {
            echo "<script>alert('Erro ao Logar, Usuario não encontrado'); window.location.href = '/index.html';</script>";
        }

        $conn->close();
    } else {
        echo "<script>alert('Preencha os campos'); window.location.href = '/index.html';</script>";
    }
}
?>