<?php
session_start();

require_once  '../tools/utilities.php';
require_once  '../database/db_instance.php';
try {

    $_email = $_senha = $_id = $_tipo = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ((isset($_POST['email'])) && (isset($_POST['password']))) {

            if (empty($_POST["email"])) {
                $_SESSION['erro'] = maketoast('Entrada Inválida', 'Email não pode ser em formato vazio!');
                header("Location: ../index.php");
            } else {
                $_email = remove_inseguro($_POST["email"]);
                if (!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['erro'] = maketoast('Entrada Inválida', 'O e-mail de entrada não é um e-mail válido!');
                    header("Location: ../index.php");
                }
            }

            if (empty($_POST["password"])) {
                $_SESSION['erro'] = maketoast('Entrada Inválida', 'Senha não pode ser em formato vazio!');
                header("Location: ../index.php");
            } else {
                $_senha = remove_inseguro($_POST["password"]);
            }

            $db = connectDB();

            $collection = $db->users;

            $query = array('$and' => array(array('email' => $_email), array('senha' => $_senha)));

            $selec = array("_id", "tipo");

            $r = $collection->findOne($query, $selec);

            if (count($r) > 0) {
                $_id = (string)$r['_id'];
                $_tipo = (string)$r['tipo'];
            }

            if (!empty($_id)) {
                $_SESSION['user'] = $_id;
                $_SESSION['tipo'] = $_tipo;
                if (isset($_POST['lembrar'])) {
                    $_SESSION['cookieuser'] = $_id;
                }
                header("Location: ../home/index.php");
            } else {
                $_SESSION['erro'] = maketoast('Entrada Inválida', 'Os dados de e-mail e senha não existem na base de dados!');
                header("Location: ../index.php");
            }
        } else {
            $_SESSION['erro'] = maketoast('Entrada Inválida', 'Os dados de e-mail e senha não foram recebidos!');
            header("Location: ../index.php");
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $db = connectDB();

        $collection = $db->users;

        $query = array('$and' => array(array('email' => $_email), array('senha' => $_senha)));

        $selec = array("_id", "tipo");

        $r = $collection->findOne($query, $selec);

        if (count($r) > 0) {
            $_id = (string)$r['_id'];
            $_tipo = (string)$r['tipo'];
        }

        if (!empty($_id)) {
            $_SESSION['user'] = $_id;
            $_SESSION['tipo'] = $_tipo;
            header("Location: ../home/index.php");
        } else {
            setcookie("user", "", time() - 3600, "/");
            $_SESSION['erro'] = maketoast('Entrada Inválida', 'Os dados de e-mail e senha não existem na base de dados!');
            header("Location: ../index.php");
        }
    } else {
        $_SESSION['erro'] = maketoast('Erro de execução', 'Método de requisição inválido: ' . $_SERVER['REQUEST_METHOD']);
        header("Location: ../index.php");
    }
} catch (Throwable $e) {
    $_SESSION['erro'] = maketoast('Erro de execução', $e->getMessage() . PHP_EOL);
    header("Location: ../index.php");
} catch (Exception $e) {
    $_SESSION['erro'] = maketoast('Erro de execução', $e->getMessage() . PHP_EOL);
    header("Location: ../index.php");
} catch (MongoConnectionException $e) {
    $_SESSION['erro'] = maketoast('Erro de execução', $e->getMessage() . PHP_EOL);
    header("Location: ../index.php");
}
