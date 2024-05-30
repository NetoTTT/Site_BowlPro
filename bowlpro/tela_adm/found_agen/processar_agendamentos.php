<?php
session_start();

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agendamentos_selecionados']) && isset($_POST['action'])) {
        $ids = $_POST['agendamentos_selecionados'];
        $action = $_POST['action'];

        if ($action == "delete") {
            // Apagar agendamentos selecionados
            $id_placeholders = implode(',', array_fill(0, count($ids), '$1'));
            $sql = "DELETE FROM horarios WHERE id_horario IN ($id_placeholders)";
            $stmt = pg_prepare($conn, "", $sql);

            $result = pg_execute($conn, "", $ids);

            if ($result) {
                $message = "Agendamentos apagados com sucesso.";
            } else {
                $message = "Erro ao tentar apagar os agendamentos.";
            }

            pg_free_result($result);
        } elseif ($action == "edit") {
            // Redirecionar para o formulário de edição com os IDs selecionados
            $_SESSION['agendamentos_para_editar'] = $ids;
            header("Location: editar_agendamentos.php");
            exit();
        } else {
            $message = "Ação inválida.";
        }
    } else {
        $message = "Nenhum agendamento selecionado ou ação inválida.";
    }
} else {
    $message = "Método de requisição inválido.";
}

pg_close($conn);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Processar Agendamentos</title>
    <style>
        .message {
            text-align: center;
            margin-top: 20px;
        }
        .buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .buttons button {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="message">
        <h1><?php echo $message; ?></h1>
        <div class="buttons">
            <button onclick="window.location.href='ver_todos_agendamentos.php'">Voltar para Agendamentos</button>
            <button onclick="window.location.href='/bowlpro/tela_adm/tela_adm.html'">Voltar para Painel Administrativo</button>
        </div>
    </div>
</body>
</html>
