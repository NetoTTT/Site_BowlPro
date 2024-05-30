<?php
session_start();

include("conexao.php");

if (!$conn) {
    die("Erro de conexão: " . pg_last_error());
}

$sql = "SELECT * FROM funcionarios";
$result = pg_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Ver Todos os Funcionários</title>
    <style>
        .admin-container {
            padding: 20px;
        }
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
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .buttons button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 819px) {
            table, th, td {
                display: block;
                width: 100%;
                border: none;
            }
            tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                padding: 10px;
                width: calc(230% - 0px); 
            }
            th {
                display: none;
            }
            td {
                text-align: right;
                position: relative;
                padding-left: 50%;
                white-space: normal;
                text-overflow: ellipsis;
                overflow: hidden;
                width: 100%; 
                box-sizing: border-box; 
            }
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: calc(50% - 20px);
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
                text-overflow: ellipsis;
                overflow: hidden;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Lista de Funcionários</h1>
        <table>
            <tr>
                <th data-label="Nome">Nome</th>
                <th data-label="Telefone">Telefone</th>
                <th data-label="Email">Email</th>
                <th data-label="CPF">CPF</th>
                <th data-label="Cargo">Cargo</th>
                <th data-label="CAD Único">CAD Único</th>
            </tr>
            <?php
                if (pg_num_rows($result) > 0) {
                    while($row = pg_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td data-label='Nome'>" . htmlspecialchars($row["nome"]) . "</td>";
                        echo "<td data-label='Telefone'>" . htmlspecialchars($row["tel"]) . "</td>";
                        echo "<td data-label='Email'>" . htmlspecialchars($row["email"]) . "</td>";
                        echo "<td data-label='CPF'>" . htmlspecialchars($row["cpf"]) . "</td>";
                        echo "<td data-label='Cargo'>" . htmlspecialchars($row["cargo"]) . "</td>";
                        echo "<td data-label='CAD Único'>" . htmlspecialchars($row["cad_unico"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum funcionário encontrado.</td></tr>";
                }

                pg_close($conn);
            ?>
        </table>
        <div class="buttons">
            <button onclick="window.location.href='/bowlpro/tela_adm/tela_adm.html'">Voltar</button>
        </div>
    </div>
</body>
</html>
