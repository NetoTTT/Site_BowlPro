<?php // Abertura do PHP

$host = "dpg-cpbmnn4f7o1s73839h50-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "bowlpro";
$user = "bowlpro_user";
$password = "uhqtYKnatqwdyhZaVVQtVu7RJnGKbbyF";

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conn = pg_connect($conn_string);

if (!$conn) {
    echo "Erro: Não foi possível conectar ao banco de dados.";
    exit;
}

?>