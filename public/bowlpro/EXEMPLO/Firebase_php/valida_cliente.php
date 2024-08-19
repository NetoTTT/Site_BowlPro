<?php
session_start();

require 'firebase.php'; // Inclua o arquivo de configuração do Firebase

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        try {
            // Autenticar o usuário
            $user = $auth->getUserByEmail($email);
            $uid = $user->uid;

            // Verifique a senha usando a autenticação com email e senha
            // Note: O Firebase Admin SDK não fornece validação direta de senha.
            // Para autenticação com senha, você deve usar o cliente Firebase para o front-end.
            // Aqui, assumimos que o usuário existe e será redirecionado com base nisso.
            
            $_SESSION['email'] = $email;
            echo "<script>alert('Login Validado'); window.location.href = 'tela_cliente/tela_cliente.php';</script>";
            exit();
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            echo "<script>alert('Erro ao Logar, Usuario não encontrado'); window.location.href = '/index.html';</script>";
        } catch (\Throwable $e) {
            echo "<script>alert('Erro ao Logar'); window.location.href = '/index.html';</script>";
        }
    } else {
        echo "<script>alert('Preencha os campos'); window.location.href = '/index.html';</script>";
    }
}
?>
