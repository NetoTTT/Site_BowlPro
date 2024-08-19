<?php
session_start();

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM clientes WHERE email=$1 AND senha=$2";
        $stmt = pg_prepare($conn, "", $sql);
        $result = pg_execute($conn, "", array($email, $senha));

        if ($result && pg_num_rows($result) > 0) {
            $_SESSION['email'] = $email;
            echo "<script>alert('Login Validado'); window.location.href = 'tela_cliente/tela_cliente.php';</script>";
            exit();
        } else {
            echo "<script>alert('Erro ao Logar, Usuario não encontrado'); window.location.href = '/index.html';</script>";
        }

    } else {
        echo "<script>alert('Preencha os campos'); window.location.href = '/index.html';</script>";
    }
}
?>
