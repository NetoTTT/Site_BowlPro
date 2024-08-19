<?php

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (!empty($_POST['email']) && !empty($_POST['data']) && !empty($_POST['horario'])) {

        $email = $_POST['email'];
        $data = $_POST['data'];
        $horario = $_POST['horario'];

  
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        $sql = "INSERT INTO horarios (horario,data_horario,email_cliente) VALUES ('$horario','$data','$email')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Horario agendado com sucesso'); window.location.href = '/bowlpro/tela_cliente/tela_cliente.php';</script>";
        } else {
            echo "<script>alert('Erro ao agendar horario'); window.location.href = 'agendar_horario.php';</script>";
        }

        $conn->close();
    } else {
        echo "<script>alert('Prencha todos os campos'); window.location.href = 'agendar_horario.php';</script>";
    }
} else {
    echo "<script>alert('Erro ao processar o formulario'); window.location.href = 'agendar_horario.php';</script>";
}
?>
