<?php

include("conexao.php");


// Verifica se os campos de login estão preenchidos
if(isset($_POST['senhaadm'])) {
    $senha = $_POST['senhaadm'];

    // Consulta SQL para verificar se as credenciais estão corretas
    $sql = "SELECT * FROM adm WHERE senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Login Validado'); window.location.href = 'tela_adm/tela_adm.html';</script>";
        exit();
    } else {
        echo "<script>alert('senha incorreta. Tente novamente.'); window.location.href = '/index.html';</script>";
        exit();
        
    }
  
}

$conn->close();

?>
