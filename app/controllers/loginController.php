<?php
require_once 'app/tools/utilities.php';

class LoginController extends Controller
{
    public function index()
    {
        try {
            if (isset($_SESSION['user'])) {
                $model = new LoginModel();
                $r = $model->getUserById($_SESSION['user']);
                if (count($r) > 0) {
                    $_id = (string)$r['_id'];
                    $_tipo = (string)$r['tipo'];
                }

                if (empty($_id)) {
                    $this->carregarTemplate('login');
                } else {
                    $_SESSION['user'] = $_id;
                    $_SESSION['tipo'] = $_tipo;

                    header('Location: ../index.php?pag=Home');
                }
            } else {
                $this->carregarTemplate('login');
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            $this->carregarTemplate('login');
        }
    }

    public function postLogin()
    {
        try {
            if ((isset($_POST['email'])) && (isset($_POST['password']))) {

                if (empty($_POST["email"])) {
                    $_SESSION['erro'] = makeerrortoast('Email não pode ser em formato vazio!');
                    $this->carregarTemplate('login');
                } else {
                    $_email = remove_inseguro($_POST["email"]);
                    if (!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['erro'] = makeerrortoast('O e-mail de entrada não é um e-mail válido!');
                        $this->carregarTemplate('login');
                    }
                }

                if (empty($_POST["password"])) {
                    $_SESSION['erro'] = makeerrortoast('Senha não pode ser em formato vazio!');
                    $this->carregarTemplate('login');
                } else {
                    $_senha = remove_inseguro($_POST["password"]);
                }

                $model = new LoginModel();
                $r = $model->getUser($_email, $_senha);

                if (count($r) > 0) {
                    $_id = (string)$r['_id'];
                    $_tipo = (string)$r['tipo'];
                }

                if (!empty($_id)) {
                    $_SESSION['user'] = $_id;
                    $_SESSION['tipo'] = $_tipo;
                    if (isset($_POST['lembrar'])) {
                        $expira = time() + 60 * 60 * 24 * 30;
                        setcookie("user", base64_encode($_SESSION['cookieuser']), time() + $expira, "/");
                    }
                    header('Location: ../index.php?pag=Home');
                } else {
                    $_SESSION['erro'] = makeerrortoast('Os dados de e-mail e senha não existem na base de dados!');
                    $this->carregarTemplate('login');
                }
            } else {
                $_SESSION['erro'] = makeerrortoast('Os dados de e-mail e senha não foram recebidos!');
                $this->carregarTemplate('login');
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            $this->carregarTemplate('login');
        }
    }
}
