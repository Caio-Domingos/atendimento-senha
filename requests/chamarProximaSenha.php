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

$select = $pdo->query("SELECT codAtende, senhaAtende FROM atende WHERE statusAtende = 'AGUARDANDO ATENDIMENTO' AND dataAtende = '$date'  ORDER BY codAtende ASC LIMIT 1");

$id = '';
$senha;
while ($linha = $select->fetch(PDO::FETCH_ASSOC)) {
    $id = $linha['codAtende'];
    $senha = $linha['senhaAtende'];
}

if ($id != '') {
    $alter = $pdo->query("UPDATE atende SET statusAtende = 'EM ATENDIMENTO' WHERE codAtende = '$id'");
    echo $senha;
} else {
    echo 'n_senhas';
}

