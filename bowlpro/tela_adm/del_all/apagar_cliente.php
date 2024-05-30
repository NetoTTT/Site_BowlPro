<?php
session_start();

include("conexao.php");

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];

        pg_query($conn, "BEGIN");

        try {
            $sql_delete_agendamentos = "DELETE FROM horarios WHERE email_cliente = $1";
            $stmt_delete_agendamentos = pg_prepare($conn, "", $sql_delete_agendamentos);
            $result_delete_agendamentos = pg_execute($conn, "", array($email));

            $sql_delete_cliente = "DELETE FROM clientes WHERE email = $1";
            $stmt_delete_cliente = pg_prepare($conn, "", $sql_delete_cliente);
            $result_delete_cliente = pg_execute($conn, "", array($email));

            if (pg_affected_rows($result_delete_cliente) > 0) {
                pg_query($conn, "COMMIT");
                $mensagem = "Cliente apagado com sucesso.";
            } else {
                pg_query($conn, "ROLLBACK");
                $mensagem = "Nenhum cliente encontrado com esse email.";
            }

            pg_free_result($result_delete_agendamentos);
            pg_free_result($result_delete_cliente);
        } catch (Exception $e) {
            pg_query($conn, "ROLLBACK");
            $mensagem = "Erro ao tentar apagar o cliente.";
        }
    } else {
        $mensagem = "Por favor, insira um email.";
    }

    pg_close($conn);
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
