<?php
include("conexao.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM password_resets WHERE token = ? AND expira > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
    } else {
        echo "<script>alert('Token inválido ou expirado.');</script>";
        echo "<script>window.location.href = 'cad_nova_senha.php';</script>";
        exit(); 
    }
} else {
    echo "<script>alert('Token não fornecido.');</script>";
    echo "<script>window.location.href = 'cad_nova_senha.php';</script>";
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Redefinir Senha</title>
    <style>
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-container form label,
        .form-container form input,
        .form-container form button {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Redefinir Senha</h1>
        <form method="post" action="salvar_nova_senha.php">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <label for="nova_senha">Nova Senha:</label>
            <input type="password" id="nova_senha" name="nova_senha" required>
            <label for="confirmar_senha">Confirmar Senha:</label>
            <input type="password" id="confirmar_senha" name="confirmar_senha" required>
            <button type="submit">Redefinir Senha</button>
        </form>
    </div>
</body>
</html>
