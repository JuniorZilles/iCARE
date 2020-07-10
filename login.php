<?php
session_start();

require_once 'utilities.php';
try {
   
    $_email = $_senha = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ((isset($_POST['email'])) && (isset($_POST['password']))) {

            if (empty($_POST["email"])) {
                $_SESSION['erro'] = maketoast('Entrada Inválida', 'Email não pode ser em formato vazio!');
                header("Location: index.php");
            } else {
                $_email = remove_inseguro($_POST["email"]);
                if (!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['erro'] = maketoast('Entrada Inválida', 'O e-mail de entrada não é um e-mail válido!');
                    header("Location: index.php");
                }
            }

            if (empty($_POST["password"])) {
                $_SESSION['erro'] = maketoast('Entrada Inválida', 'Senha não pode ser em formato vazio!');
                header("Location: index.php");
            } else {
                $_senha = remove_inseguro($_POST["password"]);
            }


            //$xml = simplexml_load_file('dados.xml', 'r');
            //$user = $xml->xpath('/users/user[email="' . $_email . '" && senha="' . $_senha . '"]');
            //if ($user != null){
            //$_SESSION['mensagem'] = $user;
            header("Location: home.php");
            //}
        } else {
            $_SESSION['erro'] = maketoast('Entrada Inválida', 'Os dados de e-mail e senha não foram recebidos!');
            header("Location: index.php");
        }
    }else{
        $_SESSION['erro'] = maketoast('Erro de execução', 'Método de requisição inválido: '.$_SERVER['REQUEST_METHOD']);
        header("Location: index.php");
    }
} catch (Exception $e) {
    $_SESSION['erro'] = maketoast('Erro de execução', $e->getMessage());
    header("Location: index.php");
}
