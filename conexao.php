<?php


$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);

$server = $dbparts['host'];
$user = $dbparts['user'];
$password = $dbparts['pass'];
$banco = ltrim($dbparts['path'],'/');

//criar uma conexão
$conexao = new mysqli($server, $user, $password, $banco);

// Testar a conexão
if($conexao -> connect_error)
	echo "A conexão falhou: ".$conexao -> connect_error;

?>
