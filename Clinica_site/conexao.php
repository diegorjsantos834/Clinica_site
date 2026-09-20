<?php
// Configurações padrão do banco de dados. Se você mudar o nome do banco, usuário ou senha, altere aqui.
$host = 'localhost';
$dbname = 'clinica';   // nome do banco que vamos criar com o clinica.sql
$user = 'root';
$pass = '';

try {
    // PDO (PHP Data Objects) = a forma moderna do PHP de falar com o banco.
    // A string "mysql:host=...;dbname=...;charset=utf8" informa o tipo de banco, o endereço e o nome do banco.
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    // ATTR_ERRMODE = EXCEPTION: quando um SQL der erro, o PDO "joga" uma exceção que podemos capturar.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Se a conexão falhar, o catch captura o erro e interrompe o script com die().
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}
