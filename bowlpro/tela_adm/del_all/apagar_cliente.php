<?php
session_start();

include("conexao.php");

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];

        $conn->begin_transaction();

        try {
            $sql_delete_agendamentos = "DELETE FROM horarios WHERE email_cliente = ?";
            $stmt_delete_agendamentos = $conn->prepare($sql_delete_agendamentos);
            $stmt_delete_agendamentos->bind_param("s", $email);
            $stmt_delete_agendamentos->execute();

            $sql_delete_cliente = "DELETE FROM clientes WHERE email = ?";
            $stmt_delete_cliente = $conn->prepare($sql_delete_cliente);
            $stmt_delete_cliente->bind_param("s", $email);
            $stmt_delete_cliente->execute();

            if ($stmt_delete_cliente->affected_rows > 0) {
                $conn->commit();
                $mensagem = "Cliente apagado com sucesso.";
            } else {
                $conn->rollback();
                $mensagem = "Nenhum cliente encontrado com esse email.";
            }

            $stmt_delete_agendamentos->close();
            $stmt_delete_cliente->close();
        } catch (Exception $e) {
            $conn->rollback();
            $mensagem = "Erro ao tentar apagar o cliente.";
        }
    } else {
        $mensagem = "Por favor, insira um email.";
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
    <title>Apagar Cliente</title>
    <style>
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-container form label,
        .form-container form input,
        .form-container form button {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Apagar Cliente</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">Email do Cliente:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Apagar</button>
        </form>
        <?php
        if (!empty($mensagem)) {
            $class = (strpos($mensagem, 'sucesso') !== false) ? 'success' : 'error';
            echo "<p class='$class'>$mensagem</p>";
        }
        ?>
        <div class="buttons">
            <button onclick="window.location.href='/bowlpro/tela_adm/tela_adm.html'">Voltar</button>
        </div>
    </div>
</body>
</html>
