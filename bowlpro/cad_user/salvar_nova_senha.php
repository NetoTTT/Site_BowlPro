<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if ($nova_senha !== $confirmar_senha) {
        echo "<script>alert('As senhas não coincidem. Tente novamente.');</script>";
        echo "<script>window.location.href = 'cad_nova_senha.php';</script>";
        exit();
    }

    // Verificar o token
    $sql = "SELECT * FROM password_resets WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        $sql = "UPDATE clientes SET senha = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nova_senha, $email);

        if ($stmt->execute()) {
            $sql = "DELETE FROM password_resets WHERE token = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $token);
            $stmt->execute();

            echo "<script>alert('Senha redefinida com sucesso. Redirecionando para a página inicial...');</script>";
            echo "<script>window.location.href = '/index.html';</script>";
            exit();
        } else {
            echo "<script>alert('Erro ao redefinir a senha. Tente novamente.');</script>";
            echo "<script>window.location.href = 'cad_nova_senha.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Token inválido ou expirado. Tente novamente.');</script>";
        echo "<script>window.location.href = 'cad_nova_senha.php';</script>";
        exit();
    }
}
?>
