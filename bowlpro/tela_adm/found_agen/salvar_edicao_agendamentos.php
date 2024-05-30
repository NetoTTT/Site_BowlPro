<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os dados de edição foram enviados
    if (isset($_POST['id_horario'], $_POST['data_horario'], $_POST['horario'])) {
        include("conexao.php");
        
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        // Obtém os dados de edição do formulário
        $ids = $_POST['id_horario'];
        $datas = $_POST['data_horario'];
        $horarios = $_POST['horario'];

        // Inicia a transação
        pg_query($conn, "BEGIN");

        // Atualiza os agendamentos um por um
        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $data = $datas[$i];
            $horario = $horarios[$i];

            // Prepara e executa a consulta SQL para atualizar os agendamentos
            $sql = "UPDATE horarios SET data_horario = $1, horario = $2 WHERE id_horario = $3";
            $stmt = pg_prepare($conn, "", $sql);
            $result = pg_execute($conn, "", array($data, $horario, $id));

            if (!$result) {
                pg_query($conn, "ROLLBACK");
                $_SESSION['edit_agendamentos_error'] = "Erro ao tentar salvar as alterações.";
                pg_close($conn);
                header("Location: editar_agendamentos.php");
                exit();
            }
        }

        // Commit da transação e redirecionamento com mensagem de sucesso
        pg_query($conn, "COMMIT");
        pg_close($conn);
        $_SESSION['edit_agendamentos_success'] = "Alterações salvas com sucesso.";
        header("Location: ver_todos_agendamentos.php");
        exit();
    } else {
        // Se os dados de edição não estiverem completos, redireciona com mensagem de erro
        $_SESSION['edit_agendamentos_error'] = "Dados incompletos para salvar a edição.";
        header("Location: editar_agendamentos.php");
        exit();
    }
} else {
    // Se não for uma solicitação POST, redireciona para a página de origem
    header("Location: ver_todos_agendamentos.php");
    exit();
}
?>

