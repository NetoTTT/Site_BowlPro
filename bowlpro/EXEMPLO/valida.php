<?php

include("conexao.php");


// Verifica se os campos de login estão preenchidos
if(isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar se as credenciais estão corretas
    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Login Validado');</script>";
    } else {
        echo "<script>alert('Usuário ou senha incorretos. Tente novamente.');</script>";
        header("Location: ");
        
    }
  
}

$conn->close();

?>
