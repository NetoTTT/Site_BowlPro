<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agendamento de Horário</title>
</head>
<body>
    <div class="profile-container">
        <div class="profile-pic">Agendar</div>
        <form action="salvar_agendamento.php" method="POST">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="data">Data:</label><br>
            <input type="date" id="data" name="data" required><br><br>
            
            <label for="horario">Horário:</label><br>
            <select id="horario" name="horario" required>
                <option value="">Selecione um horário</option>
                <?php
                // Gerar as opções de horários disponíveis
                $horarios_disponiveis = array(
                    "08:00", "09:00", "10:00", "11:00", "14:00", "15:00", "16:00", "17:00"
                );
                foreach ($horarios_disponiveis as $horario) {
                    echo "<option value='$horario'>$horario</option>";
                }
                ?>
            </select><br><br>
            
            <button type="submit">Agendar</button>
        </form><br>
        
        <div class="buttons">
            <a href="/bowlpro/tela_cliente/tela_cliente.php">Sair</a>
        </div>
    </div>
</body>
</html>
