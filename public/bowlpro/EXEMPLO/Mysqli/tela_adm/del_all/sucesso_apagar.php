<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Funcionário Apagado com Sucesso</title>
    <style>
        .success-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
            background-color: #f0f0f0;
        }
        .success-container h1 {
            color: green;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>Funcionário Apagado com Sucesso</h1>
        <p>O funcionário foi removido do sistema.</p>
        <div class="buttons">
            <button onclick="window.location.href='/bowlpro/tela_adm/tela_adm.html'">Voltar ao Painel do Administrador</button>
        </div>
    </div>
</body>
</html>
