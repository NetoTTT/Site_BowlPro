<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Perfil do Cliente</title>
    <style>
        body{   
            background-color: #4f6077;
        }

        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            background-color: gray;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 2rem;
            margin: 20px 0;
        }
        .buttons a,
        .buttons button {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .buttons a:hover,
        .buttons button:hover {
            background-color: #0056b3;
        }
        .appointments ul {
            list-style: none;
            padding: 0;
        }
        .appointments ul li {
            margin: 5px 0;
            padding: 10px;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-pic">P</div>
        <div><h2><?php include("nome_cliente.php"); ?></h2></div>
        <div class="buttons">
            <a href="agendar_horario/agendar_horario.php">Agendar um horário</a>
        </div>
        <div class="appointments">
            <h3>Horários Agendados:</h3>
            <ul>
                <?php include 'listar_horarios.php'; ?>
            </ul>
        </div>
        <div class="buttons">
            <a href="/index.html">Sair</a>
        </div>
        <div class="buttons">
            <form id="delete-account-form" method="post" action="apagar_conta.php" onsubmit="return confirmDelete();">
                <button type="submit">Deletar Conta</button>
            </form>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Tem certeza que deseja deletar sua conta? Esta ação não pode ser desfeita.");
        }
    </script>
</body>
</html>
