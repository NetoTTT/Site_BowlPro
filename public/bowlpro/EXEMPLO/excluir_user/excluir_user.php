<?php

$id = $_POST['id'];
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "projeto";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname); 


	
	$result_usuario = "DELETE FROM `usuarios` WHERE id = '$id'";
	$resultado_usuario = mysqli_query($conn, $result_usuario);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5; " >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Alteração de Usuário</title>
</head>
<body>
    <h1>Usuário Excluído!</h1>
    <br>
    <h2>Você será redirecionado para a tela principal</h2>
</body>
</html>