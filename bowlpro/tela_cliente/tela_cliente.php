<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Perfil do Cliente</title>
</head>
<body>
    <div class="profile-container">
        <div class="profile-pic">P</div>
       <div><H2> <?php include("nome_cliente.php"); ?> </H2></div>
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
    </div>
</body>
</html>
