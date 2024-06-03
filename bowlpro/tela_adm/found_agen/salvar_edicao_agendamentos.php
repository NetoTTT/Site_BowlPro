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

        // Atualiza os agendamentos um por um
        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $data = $datas[$i];
            $horario = $horarios[$i];

            // Prepara e executa a consulta SQL para atualizar os agendamentos
            $sql = "UPDATE horarios SET data_horario = ?, horario = ? WHERE id_horario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $data, $horario, $id);

            if (!$stmt->execute()) {
                $_SESSION['edit_agendamentos_error'] = "Erro ao tentar salvar as alterações.";
                $stmt->close();
                $conn->close();
                header("Location: editar_agendamentos.php");
                exit();
            }
        }

        // Fechamos a conexão e redirecionamos com mensagem de sucesso
        $stmt->close();
        $conn->close();
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
