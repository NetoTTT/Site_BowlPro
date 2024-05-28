<?php
session_start();

include("conexao.php");

$cad_unico = $erro_apagar = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['cad_unico'])) {
        $cad_unico = $_POST['cad_unico'];

        $sql = "DELETE FROM funcionarios WHERE cad_unico = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cad_unico);

        if ($stmt->execute()) {
            header("Location: sucesso_apagar.php");
            exit();
        } else {
            $erro_apagar = "Erro ao apagar o funcionário.";
        }
    } else {
        $erro_apagar = "Por favor, insira um CAD Único.";
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
    <title>Apagar Funcionário</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Apagar Funcionário</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="cad_unico">CAD Único do Funcionário:</label>
            <input type="text" id="cad_unico" name="cad_unico" required>
            <button type="submit">Apagar</button>
        </form>
        <?php
        if (!empty($erro_apagar)) {
            echo "<p class='error'>$erro_apagar</p>";
        }
        ?>
        <div class="buttons">
            <button onclick="window.location.href='/bowlpro/tela_adm/tela_adm.html'">Voltar</button>
        </div>
    </div>
</body>
</html>
