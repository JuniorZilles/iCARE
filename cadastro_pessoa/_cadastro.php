<?php
session_start();

require_once '../tools/utilities.php';
require_once '../models/pessoa_model.php';
require_once '../database/db_instance.php';

try {

    $_email = $_senha = $_id = $_tipo =
        $_nome =
        $_telefone =
        $_rua =
        $_numero =
        $_bairro =
        $_complemento =
        $_cidade =
        $_estado =
        $_cep =
        $_genero =
        $_datanascimento =
        $_cpf =
        $_tipoexame =
        $_cnpj =
        $_especialidade =
        $_crm = $_erro = '';
    $_objeto = null;
    $_edicao = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = connectDB();
        $coll = $db->users;

        $_id = md5(uniqid(""));
        if (isset($_POST['identificador'])) {
            if (!empty($_POST["identificador"])) {
                $_id = remove_inseguro($_POST["identificador"]);
                $_edicao = true;
            }
        }
        if (isset($_POST['tipouser'])) {
            if (empty($_POST["tipouser"])) {
                $_erro .= 'Tipo de usuário não informado!<br>';
            } else {
                $_tipo = remove_inseguro($_POST["tipouser"]);
            }
        }
        if (isset($_POST['nome'])) {
            if (empty($_POST["nome"])) {
                $_erro .= 'Nome não informado!<br>';
            } else {
                $_nome = remove_inseguro($_POST["nome"]);
                $query = array("nome" => new MongoRegex('/' . $_nome . '/i'));
                $r = $coll->findOne($query);
                if (count($r) > 0 && !$_edicao) {
                    $_erro .= 'Pessoa já existe na base de dados!<br>';
                }
            }
        }
        if (isset($_POST['telefone'])) {
            if (empty($_POST["telefone"])) {
                $_erro .= 'Telefone não informado!<br>';
            } else {
                $_telefone = remove_inseguro($_POST["telefone"]);
            }
        }
        if (isset($_POST['rua'])) {
            if (empty($_POST["rua"])) {
                $_erro .= 'Nome da rua não informado!<br>';
            } else {
                $_rua = remove_inseguro($_POST["rua"]);
            }
        }
        if (isset($_POST['numero'])) {
            if (empty($_POST["numero"])) {
                $_erro .= 'Número da casa não informado!<br>';
            } else {
                $_numero = remove_inseguro($_POST["numero"]);
            }
        }
        if (isset($_POST['bairro'])) {
            if (empty($_POST["bairro"])) {
                $_erro .= 'Bairro não informado!<br>';
            } else {
                $_bairro = remove_inseguro($_POST["bairro"]);
            }
        }
        if (isset($_POST['cidade'])) {
            if (empty($_POST["cidade"])) {
                $_erro .= 'Cidade não informada!<br>';
            } else {
                $_cidade = remove_inseguro($_POST["cidade"]);
            }
        }
        if (isset($_POST['estado'])) {
            if (empty($_POST["estado"])) {
                $_erro .= 'Estado não informado!<br>';
            } else {
                $_estado = remove_inseguro($_POST["estado"]);
            }
        }
        if (isset($_POST['cep'])) {
            if (empty($_POST["cep"])) {
                $_erro .= 'CEP não informado!<br>';
            } else {
                $_cep = remove_inseguro($_POST["cep"]);
            }
        }
        if (isset($_POST['email'])) {
            if (empty($_POST["email"])) {
                $_erro .= 'Email não pode ser em formato vazio!<br>';
            } else {
                $_email = remove_inseguro($_POST["email"]);
                if (!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_erro .= 'O e-mail de entrada não é um e-mail válido!<br>';
                }
                $query = array("email" => new MongoRegex('/' . $_email . '/i'));
                $r = $coll->findOne($query);
                if (count($r) > 0  && !$_edicao) {
                    $_erro .= 'Email já existe na base de dados!<br>';
                }
            }
        }
        if (isset($_POST['senha'])) {
            if (empty($_POST["senha"])) {
                $_erro .= 'Senha não pode ser em formato vazio!<br>';
            } else {
                $_senha = remove_inseguro($_POST["senha"]);
                if ((int)strlen($_senha) < 6) {
                    $_erro += 'Senha não pode ser em formato vazio!<br>';
                }
            }
        }
        if (isset($_POST['complemento'])) {
            $_complemento = remove_inseguro($_POST["complemento"]);
        }
        if ($_tipo == 'medico') {
            if (isset($_POST['especialidade'])) {
                if (empty($_POST["especialidade"])) {
                    $_erro .= 'Especialidade não informada!<br>';
                } else {
                    $_especialidade = remove_inseguro($_POST["especialidade"]);
                }
            }
            if (isset($_POST['crm'])) {
                if (empty($_POST["crm"])) {
                    $_erro .= 'CRM não informado!<br>';
                } else {
                    $_crm = remove_inseguro($_POST["crm"]);
                }
            }
            $_objeto = new Medico($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_especialidade, $_crm);
        } else if ($_tipo == 'paciente') {
            if (isset($_POST['datanascimento'])) {
                if (empty($_POST["datanascimento"])) {
                    $_erro .= 'Data de Nascimento não informada!<br>';
                } else {
                    $_datanascimento = remove_inseguro($_POST["datanascimento"]);
                }
            }
            if (isset($_POST['genero'])) {
                if (empty($_POST["genero"])) {
                    $_erro .= 'Gênero não informado!<br>';
                } else {
                    $_genero = remove_inseguro($_POST["genero"]);
                }
            }
            if (isset($_POST['cpf'])) {
                if (empty($_POST["cpf"])) {
                    $_erro .= 'CPF não informado!<br>';
                } else {
                    $_cpf = remove_inseguro($_POST["cpf"]);
                }
            }
            $_objeto = new Paciente($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_genero, $_datanascimento, $_cpf);
        } else if ($_tipo == 'laboratorio') {
            if (isset($_POST['tipoexame'])) {
                if (empty($_POST["tipoexame"])) {
                    $_erro .= 'Necessário informar ao menos um tipo de exame!<br>';
                } else {
                    $secured = remove_inseguro($_POST["tipoexame"]);
                    $_tipoexame = explode(",", $secured);
                }
            }
            if (isset($_POST['cnpj'])) {
                if (empty($_POST["cnpj"])) {
                    $_erro .= 'CNPJ não informado!<br>';
                } else {
                    $_cnpj = remove_inseguro($_POST["cnpj"]);
                }
            }
            $_objeto = new Laboratorio($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_tipoexame, $_cnpj);
        }
        if (!empty($_erro)) {
            $_SESSION['erro'] =  $_erro;
            $_objeto->id = '';
            $_SESSION['registro'] = serialize($_objeto);
            header("Location: index.php");
        } else {
            $array = (array) $_objeto;
            $_termo = 'incluido';
            if ($_edicao) {
                $_termo = 'alterado';

                $query = array("_id" => $_id);
                $coll->update($query, $array);
            } else {
                $coll->insert($array);
            }

            $_SESSION['success'] = 'O usuário foi ' . $_termo . ' na base de dados';
            header("Location: ../home/index.php");
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $db = connectDB();
        $coll = $db->users;
        if (isset($_GET['id'])) {
            $_id = remove_inseguro($_GET['id']);
        } else {
            $_id = $_SESSION['user'];
        }
        $query = array("_id" => $_id);
        $coll = $db->users;

        $r = $coll->findOne($query);

        if (count($r) > 0) {
            $_objeto = obter_usuario($r);
        }
        $_SESSION['registro'] = serialize($_objeto);
        header("Location: index.php");
    }
} catch (Throwable $e) {
    $_SESSION['erro'] = makeerrortoast($e->getMessage() . PHP_EOL);
    header("Location: ../home/index.php");
} catch (Exception $e) {
    $_SESSION['erro'] = makeerrortoast($e->getMessage() . PHP_EOL);
    header("Location: ../home/index.php");
} catch (MongoConnectionException $e) {
    $_SESSION['erro'] = makeerrortoast($e->getMessage() . PHP_EOL);
    header("Location: ../home/index.php");
}
