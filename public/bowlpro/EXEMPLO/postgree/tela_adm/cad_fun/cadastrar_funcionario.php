<?php
session_start();

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $cad_unico = $_POST['cad_unico'];

    $sql = "INSERT INTO funcionarios (nome, tel, email, cpf, cargo, cad_unico) VALUES ($1, $2, $3, $4, $5, $6)";

    $stmt = pg_prepare($conn, "", $sql);
    $result = pg_execute($conn, "", array($nome, $tel, $email, $cpf, $cargo, $cad_unico));

    if ($result) {
        echo "<script>alert('Funcionário cadastrado com sucesso.'); window.location.href = '/bowlpro/tela_adm/tela_adm.html';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar funcionário.'); window.location.href = 'cadastrar_funcionario.php';</script>";
    }

    pg_free_result($result);
}

pg_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastrar Funcionário</title>
</head>
<body>
    <div class="admin-container">
        <h1>Cadastrar Funcionário</h1>
        <form method="POST" action="cadastrar_funcionario.php">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br><br>
            <label for="tel">Telefone:</label>
            <input type="text" id="tel" name="tel" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required><br><br>
            <label for="cargo">Cargo:</label>
            <input type="text" id="cargo" name="cargo" required><br><br>
            <label for="cad_unico">CAD Único:</label>
            <input type="text" id="cad_unico" name="cad_unico" required><br><br>
            <button type="submit">Cadastrar</button>
        </form>
        <div class="buttons">
            <button onclick="window.location.href='/bowlpro/tela_adm/tela_adm.html'">Voltar</button>
        </div>
    </div>
</body>
</html>
