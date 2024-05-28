<?php
session_start();

include("conexao.php");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM funcionarios";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Ver Todos os Funcionários</title>
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
        <h1>Lista de Funcionários</h1>
        <table>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>CPF</th>
                <th>CARGO</th>
                <th>CAD Único</th>
            </tr>
            <?php
            // Verificar se há resultados e exibir os dados em uma tabela
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["tel"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["cpf"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["cargo"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["cad_unico"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum funcionário encontrado.</td></tr>";
            }

            // Fechar a conexão com o banco de dados
            $conn->close();
            ?>
        </table>
        <div class="buttons">
            <button onclick="window.location.href='/bowlpro/tela_adm/tela_adm.html'">Voltar</button>
        </div>
    </div>
</body>
</html>
