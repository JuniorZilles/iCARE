<?php
require_once 'app/tools/utilities.php';

class CadastroController extends Controller
{
    public function index()
    {
        $this->carregarTemplate('erro');
    }

    public function pessoa($params)
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } elseif ($_SESSION['tipo'] != 'admin') {
                $_SESSION['erro'] = makeerrortoast('Usuário não permitido');
                header('Location: ../index.php?pag=Home');
            } else {
                if (count($params[0]) > 0) {
                    $_SESSION['opcao'] = $params[0];
                } else {
                    $_SESSION['opcao'] = 'paciente';
                }

                $this->carregarTemplate('cadastroPessoa');
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../index.php?pag=Home');
        }
    }

    public function getPessoa($params)
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } else {
                $cadModel = new CadastroModel();
                $_id = '';
                if (isset($params[0])) {
                    $_id = remove_inseguro($params[0]);
                } else {
                    $_id = $_SESSION['user'];
                }
                $r = $cadModel->getUser($_id);

                if (count($r) > 0) {
                    $_objeto = $cadModel->obterCadastroUsuario($r);
                    $this->carregarTemplate('cadastroPessoa', array($_objeto));
                } else {
                    $_SESSION['erroValidacao'] = makeerrortoast("Usuário não encontrado!");
                    header('Location: ../index.php?pag=Home');
                }
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../index.php?pag=Home');
        }
    }

    public function postPessoa()
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } else {
                $_email = $_senha = $_tipo =
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
                $_id = md5(uniqid(""));
                $cadModel = new CadastroModel();
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
                        $r = $cadModel->checkName($_nome);

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
                        $r = $cadModel->checkMail($_email);
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
                    $_objeto = new MedicoModel($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_especialidade, $_crm);
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
                    $_objeto = new PacienteModel($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_genero, $_datanascimento, $_cpf);
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
                    $_objeto = new LaboratorioModel($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_tipoexame, $_cnpj);
                }
                if (!empty($_erro)) {
                    $_SESSION['erroValidacao'] =  $_erro;
                    $_objeto->id = '';
                    $this->carregarTemplate('cadastroPessoa', array($_objeto));
                } else {
                    $array = (array) $_objeto;
                    $_termo = 'incluido';
                    if ($_edicao) {
                        $_termo = 'alterado';
                        $cadModel->updateUser($array, $_id);
                    } else {
                        $cadModel->insertUser($array);
                    }

                    $_SESSION['erro'] = makesuccesstoast('O usuário foi ' . $_termo . ' na base de dados');
                    header('Location: ../index.php?pag=Home');
                }
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../index.php?pag=Home');
        }
    }

    public function consulta()
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } elseif ($_SESSION['tipo'] != 'medico') {
                $_SESSION['erro'] = makeerrortoast('Usuário não permitido');
                header('Location: ../index.php?pag=Home');
            } else {
                $this->carregarTemplate('cadastroConsulta');
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            $this->carregarTemplate('cadastroConsulta');
        }
    }

    public function getConsulta($params)
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } elseif ($_SESSION['tipo'] != 'medico') {
                $_SESSION['erro'] = makeerrortoast('Usuário não permitido');
                header('Location: ../index.php?pag=Home');
            } else {
                $_id = '';
                if (isset($params[0])) {
                    $_id = remove_inseguro($params[0]);
                    $cadModel = new CadastroModel();
                    $r = $cadModel->getConsulta($_id);
                    if (count($r) > 0) {
                        $_objeto = $cadModel->obterCadastroConsulta($r);
                        $this->carregarTemplate('cadastroConsulta', array($_objeto));
                    } else {
                        $_SESSION['erro'] = makeerrortoast("Consulta não encontrada!");
                        header('Location: ../../index.php?pag=Historico/consulta');
                    }
                }
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../../index.php?pag=Historico/consulta');
        }
    }

    public function postConsulta($params)
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } elseif ($_SESSION['tipo'] != 'medico') {
                $_SESSION['erro'] = makeerrortoast('Usuário não permitido');
                header('Location: ../index.php?pag=Home');
            } else {
                $_id = $_idpaciente = $_sintomas_add =
                    $_observacoes =
                    $_data =
                    $_horario =
                    $_receita =
                    $_erro = '';
                $_sintomas = array();
                $_objeto = null;
                $_edicao = false;
                $_id = md5(uniqid(""));
                if (isset($_POST['identificador'])) {
                    if (!empty($_POST["identificador"])) {
                        $_id = remove_inseguro($_POST["identificador"]);
                        $_edicao = true;
                    }
                }
                if (isset($_POST['pacienteid'])) {
                    if (empty($_POST["pacienteid"])) {
                        $_erro .= 'Paciente não selecionado!<br>';
                    } else {
                        $_idpaciente = remove_inseguro($_POST["pacienteid"]);
                    }
                }
                if (isset($_POST['febre'])) {
                    array_push($_sintomas, remove_inseguro($_POST["febre"]));
                }
                if (isset($_POST['dorcabeca'])) {
                    array_push($_sintomas, remove_inseguro($_POST["dorcabeca"]));
                }
                if (isset($_POST['dorcorpo'])) {
                    array_push($_sintomas, remove_inseguro($_POST["dorcorpo"]));
                }
                if (isset($_POST['dorpeito'])) {
                    array_push($_sintomas, remove_inseguro($_POST["dorpeito"]));
                }
                if (isset($_POST['dorbarriga'])) {
                    array_push($_sintomas, remove_inseguro($_POST["dorbarriga"]));
                }
                if (isset($_POST['vomito'])) {
                    array_push($_sintomas, remove_inseguro($_POST["vomito"]));
                }
                if (isset($_POST['nausea'])) {
                    array_push($_sintomas, remove_inseguro($_POST["nausea"]));
                }
                if (isset($_POST['formigamento'])) {
                    array_push($_sintomas, remove_inseguro($_POST["formigamento"]));
                }
                if (isset($_POST['perdapeso'])) {
                    array_push($_sintomas, remove_inseguro($_POST["perdapeso"]));
                }
                if (isset($_POST['ganhopeso'])) {
                    array_push($_sintomas, remove_inseguro($_POST["ganhopeso"]));
                }
                if (isset($_POST['cansaco'])) {
                    array_push($_sintomas, remove_inseguro($_POST["cansaco"]));
                }
                if (isset($_POST['outro'])) {
                    array_push($_sintomas, remove_inseguro($_POST["outro"]));
                }
                if (isset($_POST['outrosintoma'])) {
                    $_sintomas_add = remove_inseguro($_POST["outrosintoma"]);
                }
                if (isset($_POST['dataconsulta'])) {
                    if (empty($_POST["dataconsulta"])) {
                        $_erro .= 'Data não informada!<br>';
                    } else {
                        $_data = remove_inseguro($_POST["dataconsulta"]);
                    }
                }
                if (isset($_POST['horarioconsulta'])) {
                    if (empty($_POST["horarioconsulta"])) {
                        $_erro .= 'Horário não informado!<br>';
                    } else {
                        $_horario = remove_inseguro($_POST["horarioconsulta"]);
                    }
                }
                if (isset($_POST['receita'])) {
                    if (empty($_POST["receita"])) {
                        $_erro .= 'Receita aplicada não informada!<br>';
                    } else {
                        $_receita = remove_inseguro($_POST["receita"]);
                    }
                }
                if (isset($_POST['observacoes'])) {
                    if (empty($_POST["observacoes"])) {
                        $_erro .= 'Observações da consulta não informadas!<br>';
                    } else {
                        $_observacoes = remove_inseguro($_POST["observacoes"]);
                    }
                }
                $_objeto = new ConsultaModel($_id, $_horario, $_data, $_idpaciente, $_observacoes, $_sintomas_add, $_SESSION['user'], $_sintomas, $_receita);
                if (!empty($_erro)) {
                    $_SESSION['erroValidacao'] =  $_erro;
                    $_objeto->id = '';
                    $this->carregarTemplate('cadastroConsulta', array($_objeto));
                } else {
                    $cadModel = new CadastroModel();
                    $array = (array) $_objeto;
                    $_termo = 'incluido';
                    if ($_edicao) {
                        $_termo = 'alterado';
                        $cadModel->updateConsulta($array, $_id);
                    } else {
                        $cadModel->insertConsulta($array);
                    }

                    $_SESSION['erro'] = makesuccesstoast('A consulta foi ' . $_termo . ' na base de dados');
                    header('Location: ../index.php?pag=Home');
                }
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../index.php?pag=Home');
        }
    }

    public function exame()
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } elseif ($_SESSION['tipo'] != 'laboratorio') {
                $_SESSION['erro'] = makeerrortoast('Usuário não permitido');
                header('Location: ../index.php?pag=Home');
            } else {
                $this->carregarTemplate('cadastroExame');
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../index.php?pag=Home');
        }
    }

    public function getExame($params)
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } elseif ($_SESSION['tipo'] != 'laboratorio') {
                $_SESSION['erro'] = makeerrortoast('Usuário não permitido');
                header('Location: ../index.php?pag=Home');
            } else {
                $_id = '';
                if (isset($params[0])) {
                    $_id = remove_inseguro($params[0]);
                    $cadModel = new CadastroModel();
                    $r = $cadModel->getExame($_id);
                    if (count($r) > 0) {
                        $_objeto = $cadModel->obterCadastroExame($r);
                        $this->carregarTemplate('cadastroExame', array($_objeto));
                    } else {
                        $_SESSION['erro'] = makeerrortoast("Exame não encontrado!");
                        header('Location: ../../index.php?pag=Historico/exame');
                    }
                }
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../index.php?pag=Login');
        }
    }

    public function postExame()
    {
        try {
            if (!isset($_SESSION['user'])) {
                $_SESSION['erro'] = makeerrortoast('Usuário não logado');
                header('Location: ../index.php?pag=Login');
            } elseif ($_SESSION['tipo'] != 'laboratorio') {
                $_SESSION['erro'] = makeerrortoast('Usuário não permitido');
                header('Location: ../index.php?pag=Home');
            } else {
                $_id = $_idpaciente =
                    $_idmedico = $_exames =
                    $_outroexame =
                    $_dataexame =
                    $_horarioexame =
                    $_resultadoexame =
                    $_resultado =
                    $_erro = '';
                $_objeto = null;
                $_edicao = false;
                $_id = md5(uniqid(""));
                if (isset($_POST['identificadorexame'])) {
                    if (!empty($_POST["identificadorexame"])) {
                        $_id = remove_inseguro($_POST["identificadorexame"]);
                        $_edicao = true;
                    }
                }
                if (isset($_POST['pacienteid'])) {
                    if (empty($_POST["pacienteid"])) {
                        $_erro .= 'Paciente não selecionado!<br>';
                    } else {
                        $_idpaciente = remove_inseguro($_POST["pacienteid"]);
                    }
                }
                if (isset($_POST['medicoid'])) {
                    if (empty($_POST["medicoid"])) {
                        $_erro .= 'Médico não informado!<br>';
                    } else {
                        $_idmedico = remove_inseguro($_POST["medicoid"]);
                    }
                }
                if (isset($_POST['exame'])) {
                    if (empty($_POST["exame"])) {
                        $_erro .= 'Nenhum exame foi selecionado!<br>';
                    } else {
                        $secured = remove_inseguro($_POST["exame"]);
                        $_exames = explode(",", $secured);
                    }
                }
                if (isset($_POST['dataexame'])) {
                    if (empty($_POST["dataexame"])) {
                        $_erro .= 'Data não informada!<br>';
                    } else {
                        $_dataexame = remove_inseguro($_POST["dataexame"]);
                    }
                }
                if (isset($_POST['horarioexame'])) {
                    if (empty($_POST["horarioexame"])) {
                        $_erro .= 'Horário não informado!<br>';
                    } else {
                        $_horarioexame = remove_inseguro($_POST["horarioexame"]);
                    }
                }
                if (isset($_POST['resultadoexame'])) {
                    if (empty($_POST["resultadoexame"])) {
                        $_erro .= 'Resultado do exame não informado!<br>';
                    } else {
                        $_resultadoexame = remove_inseguro($_POST["resultadoexame"]);
                    }
                }
                if (isset($_POST['resultado'])) {
                    if (empty($_POST["resultado"])) {
                        $_erro .= 'Descrição dos resulados não informado!<br>';
                    } else {
                        $_resultado = remove_inseguro($_POST["resultado"]);
                    }
                }
                if (isset($_POST['outro'])) {
                    $_outroexame = remove_inseguro($_POST["outro"]);
                }
                $_objeto = new ExameModel($_id, $_horarioexame, $_dataexame, $_idpaciente, $_resultado, $_outroexame, $_idmedico, $_exames, $_resultadoexame, $_SESSION['user']);
                if (!empty($_erro)) {
                    $_SESSION['erroValidacao'] =  $_erro;
                    $_objeto->id = '';
                    $this->carregarTemplate('cadastroExame', array($_objeto));
                } else {
                    $cadModel = new CadastroModel();
                    $array = (array) $_objeto;
                    $_termo = 'incluido';
                    if ($_edicao) {
                        $_termo = 'alterado';
                        $cadModel->updateExame($array, $_id);
                    } else {
                        $cadModel->insertExame($array);
                    }

                    $_SESSION['erro'] = makesuccesstoast('O exame foi ' . $_termo . ' na base de dados');
                    header('Location: ../index.php?pag=Home');
                }
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = makeerrortoast($e->getMessage());
            header('Location: ../index.php?pag=Home');
        }
    }
}
