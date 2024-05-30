<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "SELECT * FROM clientes WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(16)); // Gera um token aleatório
        $expira = date("Y-m-d H:i:s", strtotime('+30 seconds')); // Token expira em 30 segundos

        $sql = "INSERT INTO password_resets (email, token, expira) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $token, $expira);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        echo "<div class='form-container'>";
        echo "<h1>Token Gerado</h1>";
        echo "<p>Seu token é: <span id='token'>$token</span></p>";
        echo "<button onclick='copyToken()'>Copiar Token</button>";
        echo "</div>";
        echo "<script>
            function copyToken() {
                var token = document.getElementById('token').innerText;
                navigator.clipboard.writeText(token).then(function() {
                    alert('Token copiado para a área de transferência');
                    window.location.href = 'cad_nova_senha.php';
                }, function(err) {
                    alert('Erro ao copiar o token');
                });
            }
        </script>";
    } else {
        echo "Email não encontrado.";
    }
}
?>
