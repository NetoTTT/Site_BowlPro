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
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Pesquisar Funcionário</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="cad_unico">CAD Único:</label>
            <input type="text" id="cad_unico" name="cad_unico" required>
            <button type="submit">Pesquisar</button>
        </form>
        <?php
        if (!empty($erro_pesquisa)) {
            echo "<p class='error'>$erro_pesquisa</p>";
        }
        ?>
        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>CARGO</th>
                    <th>CAD Único</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["nome"]); ?></td>
                        <td><?php echo htmlspecialchars($row["tel"]); ?></td>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><?php echo htmlspecialchars($row["cpf"]); ?></td>
                        <td><?php echo htmlspecialchars($row["cargo"]); ?></td>
                        <td><?php echo htmlspecialchars($row["cad_unico"]); ?></td>
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
