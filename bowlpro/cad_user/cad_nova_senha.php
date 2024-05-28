<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação de Redefinição de Senha</title>
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
        <h1>Solicitar Redefinição de Senha</h1>
        <form method="post" action="processar_redefinicao.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Solicitar Redefinição</button>
        </form>
        <h2>Digite o Token Recebido</h2>
        <form method="get" action="redefinir_senha.php">
            <label for="token">Token:</label>
            <input type="text" id="token" name="token" required>
            <button type="submit">Validar Token</button>
            <button onclick="window.location.href='/index.html'">Voltar</button>
        </form>
    </div>
</body>
</html>
