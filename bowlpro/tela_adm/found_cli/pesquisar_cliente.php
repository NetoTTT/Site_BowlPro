<?php
session_start();

include("conexao.php");

$pesquisa = "";
$resultados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['pesquisa'])) {
        $pesquisa = $_POST['pesquisa'];

        $sql = "SELECT * FROM clientes WHERE nome LIKE ? OR email LIKE ?";
        $stmt = $conn->prepare($sql);
        $pesquisa_param = "%$pesquisa%";
        $stmt->bind_param("ss", $pesquisa_param, $pesquisa_param);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $resultados[] = $row;
            }
        } else {
            $erro_pesquisa = "Erro ao realizar a pesquisa.";
        }

        $stmt->close();
    } else {
        $erro_pesquisa = "Por favor, insira um nome ou email para pesquisar.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Pesquisar Cliente</title>
    <style>
        .error {
            color: red;
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
                margin-left: -9px; 
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
        <h1>Pesquisar Cliente</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="pesquisa">Nome ou Email:</label>
            <input type="text" id="pesquisa" name="pesquisa" required>
            <button type="submit">Pesquisar</button>
        </form><br>
        <?php
        if (!empty($erro_pesquisa)) {
            echo "<p class='error'>$erro_pesquisa</p>";
        }
        ?>
        <?php if (!empty($resultados)): ?>
        <table>
            <tr>
                <th data-label="Nome">Nome</th>
                <th data-label="Email">Email</th>
                <th data-label="Telefone">Telefone</th>
            </tr>
            <?php foreach ($resultados as $cliente): ?>
            <tr>
                <td data-label="Nome"><?php echo htmlspecialchars($cliente['nome']); ?></td>
                <td data-label="Email"><?php echo htmlspecialchars($cliente['email']); ?></td>
                <td data-label="Telefone"><?php echo htmlspecialchars($cliente['tel']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        <div class="buttons">
            <button onclick="window.location.href='/bowlpro/tela_adm/tela_adm.html'">Voltar</button>
        </div>
    </div>
</body>
</html>
