<?php 
session_start();

require_once 'utilities.php';

setcookie("user", "", time() - 3600, "/");

$_SESSION['erro'] = maketoast('Sessão Encerrada', 'Você saiu, para obter acesso faça login novamente!');
header("Location: index.php");
?>