<?php

include("conexao.php");

// Verifica se os campos de login estão preenchidos
if(isset($_POST['senhaadm'])) {
    $senha = $_POST['senhaadm'];

    // Consulta SQL para verificar se as credenciais estão corretas
    $sql = "SELECT * FROM adm WHERE senha=$1";
    $stmt = pg_prepare($conn, "", $sql);
    $result = pg_execute($conn, "", array($senha));

    if ($result && pg_num_rows($result) > 0) {
        echo "<script>alert('Login Validado'); window.location.href = 'tela_adm/tela_adm.html';</script>";
        exit();
    } else {
        echo "<script>alert('Senha incorreta. Tente novamente.'); window.location.href = '/index.html';</script>";
        exit();  
    }
}

pg_close($conn);

?>
