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
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Pesquisar Cliente</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="pesquisa">Nome ou Email:</label>
            <input type="text" id="pesquisa" name="pesquisa" required>
            <button type="submit">Pesquisar</button>
        </form>
        <?php
        if (!empty($erro_pesquisa)) {
            echo "<p class='error'>$erro_pesquisa</p>";
        }
        ?>
        <?php if (!empty($resultados)): ?>
        <table>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
            </tr>
            <?php foreach ($resultados as $cliente): ?>
            <tr>
                <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                <td><?php echo htmlspecialchars($cliente['tel']); ?></td>
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
