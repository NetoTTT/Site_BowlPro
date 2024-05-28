<?php
session_start();

include("conexao.php");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM horarios";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Ver Todos os Agendamentos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Lista de Agendamentos</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Email do Cliente</th>
                <th>Data</th>
                <th>Horário</th>
            </tr>
            <?php
            // Verificar se há resultados e exibir os dados em uma tabela
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id_horario"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email_cliente"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["data_horario"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["horario"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum agendamento encontrado.</td></tr>";
            }

            $conn->close();
            ?>
        </table>
        <div class="buttons">
            <button onclick="window.location.href='/bowlpro/tela_adm/tela_adm.html'">Voltar</button>
        </div>
    </div>
</body>
</html>
