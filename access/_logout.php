<?php
session_start();

require_once '../tools/utilities.php';

setcookie("user", "", time() - 3600, "/");
unset($_SESSION['tipo']);
unset($_SESSION['user']);

$_SESSION['erro'] = maketoast('Sessão Encerrada', 'Você saiu, para obter acesso faça login novamente!');
header("Location: ../index.php");
