<?php
session_start();

require_once '_utilities.php';
try {

    $_email = $_senha = $_id = $_tipo = '';
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

            $xml = simplexml_load_file('dados.xml');

            $users = $xml->users->children();

            foreach ($users as $child) {
                if ($child->email == $_email && $child->senha == $_senha) {
                    $_id = (string)$child['id'];
                    $_tipo = (string)$child['tipo'];
                }
            }
            if (!empty($_id)) {
                $_SESSION['user'] = $_id;
                $_SESSION['tipo'] = $_tipo;
                $_SESSION['isadmin'] = false;
                if ($_tipo == 'admin') {
                    $_SESSION['isadmin'] = true;
                }
                if (isset($_POST['lembrar'])) {
                    $_SESSION['cookieuser'] = $_id;
                }
                header("Location: home.php");
            } else {
                $_SESSION['erro'] = maketoast('Entrada Inválida', 'Os dados de e-mail e senha não existem na base de dados!');
                header("Location: index.php");
            }
        } else {
            $_SESSION['erro'] = maketoast('Entrada Inválida', 'Os dados de e-mail e senha não foram recebidos!');
            header("Location: index.php");
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $xmlStr = file_get_contents('dados.xml');
        $xml = new SimpleXMLElement($xmlStr);
        $users = $xml->users->children();

        foreach ($users as $child) {
            if ($child['id'] == $_SESSION['cookieuser']) {
                $_id = (string)$child['id'];
                $_tipo = (string)$child['tipo'];
            }
        }
        if (!empty($_id)) {
            $_SESSION['user'] = $_id;
            $_SESSION['tipo'] = $_tipo;
            $_SESSION['isadmin'] = false;
            if ($_tipo == 'admin') {
                $_SESSION['isadmin'] = true;
            }
            if (isset($_POST['lembrar'])) {
                $_SESSION['cookieuser'] = $_id;
            }
            header("Location: home.php");
        } else {
            $_SESSION['erro'] = maketoast('Entrada Inválida', 'Os dados de e-mail e senha não existem na base de dados!');
            header("Location: index.php");
        }
    } else {
        $_SESSION['erro'] = maketoast('Erro de execução', 'Método de requisição inválido: ' . $_SERVER['REQUEST_METHOD']);
        header("Location: index.php");
    }
} catch (Throwable $e) {
    $_SESSION['erro'] = maketoast('Erro de execução', $e->getMessage() . PHP_EOL);
    header("Location: index.php");
} catch (Exception $e) {
    $_SESSION['erro'] = maketoast('Erro de execução', $e->getMessage() . PHP_EOL);
    header("Location: index.php");
}

?>