<?php
session_start();

include("conexao.php");

$cad_unico = $erro_pesquisa = "";
$result = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['cad_unico'])) {
        $cad_unico = $_POST['cad_unico'];

        $sql = "SELECT * FROM funcionarios WHERE cad_unico = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cad_unico);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $erro_pesquisa = "Funcionário não encontrado.";
        }
    } else {
        $erro_pesquisa = "Por favor, insira um CAD Único.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Pesquisar Funcionário</title>
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
        .error {
            color: red;
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
                margin-left: 3px; 
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
        <h1>Pesquisar Funcionário</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="cad_unico">CAD Único:</label>
            <input type="text" id="cad_unico" name="cad_unico" required>
            <button type="submit">Pesquisar</button>
        </form><br><br>
        <?php
        if (!empty($erro_pesquisa)) {
            echo "<p class='error'>$erro_pesquisa</p>";
        }
        ?>
        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <tr>
                    <th data-label="Nome">Nome</th>
                    <th data-label="Telefone">Telefone</th>
                    <th data-label="Email">Email</th>
                    <th data-label="CPF">CPF</th>
                    <th data-label="Cargo">Cargo</th>
                    <th data-label="CAD Único">CAD Único</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td data-label="Nome"><?php echo htmlspecialchars($row["nome"]); ?></td>
                        <td data-label="Telefone"><?php echo htmlspecialchars($row["tel"]); ?></td>
                        <td data-label="Email"><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td data-label="CPF"><?php echo htmlspecialchars($row["cpf"]); ?></td>
                        <td data-label="Cargo"><?php echo htmlspecialchars($row["cargo"]); ?></td>
                        <td data-label="CAD Único"><?php echo htmlspecialchars($row["cad_unico"]); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>
        <div class="buttons">
            <button onclick="window.location.href='/bowlpro/tela_adm/tela_adm.html'">Voltar</button>
        </div>
    </div>
</body>
</html>
