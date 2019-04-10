<?php
// Listar erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Includes

include_once './lib/conexao.php';
include_once './models/atendimento.php';

$pdo = conexaoBanco();

$date = $_POST['date'];

$select = $pdo->query("SELECT count(codAtende) as nLinhas FROM atende WHERE dataAtende = '$date'");

$senha;
while ($linha = $select->fetch(PDO::FETCH_ASSOC)) {
    $senha = intval($linha['nLinhas']) + 1;
}
$insert = $pdo->query("INSERT INTO atende (dataAtende, senhaAtende) VALUES('$date', '$senha')");

echo $senha;