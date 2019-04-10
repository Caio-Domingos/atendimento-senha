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

$select = $pdo->query("SELECT senhaAtende FROM atende WHERE statusAtende = 'EM ATENDIMENTO' AND dataAtende = '$date' ORDER BY codAtende ASC LIMIT 1");

$valor = '-';
while ($linha = $select->fetch(PDO::FETCH_ASSOC)) {
    $valor =  $linha['senhaAtende'];
}

echo $valor;
