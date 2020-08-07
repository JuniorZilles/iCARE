<?php
session_start();

require_once '_utilities.php';
require_once '_menu.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['erro'] = maketoast('Usuário não logado', 'Necessário realizar login para utilizar os recursos!');
    header("Location: index.php");
}
if ($_SESSION['tipo'] == 'paciente') {
    $_SESSION['erro'] = maketoast('Usuário não permitido', 'O recurso não está disponível para esse usuário');
    header("Location: home.php");
}
$_user = null;
if (isset($_SESSION['registro'])) {
    $_user = unserialize($_SESSION['registro']);
    unset($_SESSION['registro']);
}

$_check = '';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_user->tipo)) {
    $_check = isset($_GET['opcao']) ? remove_inseguro($_GET['opcao']) : '';
} else if (isset($_user->tipo)) {
    $_check = $_user->tipo;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="sortcut icon" href="favicon.ico" type="image/x-icon" />
    <title>iCARE - Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="cadastro.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script src="cadastro_pessoa.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">iCARE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <?php
                    if ($_SESSION['tipo'] == 'admin') {
                        echo makemenuadmin();
                    } else if ($_SESSION['tipo'] == 'laboratorio') {
                        echo makemenulaboratorio();
                    } else if ($_SESSION['tipo'] == 'medico') {
                        echo makemenumedico();
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="_logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php
                                                                                if ($_SESSION['tipo'] == 'admin') {
                                                                                    echo 'Cadastro de Usuário';
                                                                                } else {
                                                                                    echo 'Editar Perfil';
                                                                                }
                                                                                ?></li>
                    </ol>
                </nav>
                <h5 class="card-title text-center"><?php
                                                    if ($_SESSION['tipo'] == 'admin') {
                                                        echo 'Cadastro de Usuário';
                                                    } else {
                                                        echo 'Editar Perfil';
                                                    }
                                                    ?></h5>
                <form action="_cadastro.php" id="cadastroform" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <?php
                            if (isset($_SESSION['erro'])) {
                                echo '<div class="invalid-feedback" style="display:block;">' . $_SESSION['erro'] . '</div>';
                                unset($_SESSION['erro']);
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if ($_SESSION['tipo'] == 'admin' &&  !isset($_user->id)) {
                        echo '<div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Tipo de Usuário</label><br>'
                            . makeradioadmin($_check) .
                            '</div>
                                </div>';
                    } else {
                        echo '<input type="hidden" id="identificador" name="identificador" value="' . $_user->id . '">';
                        echo '<input type="hidden" id="tipouser" name="tipouser" value="' . $_user->tipo . '">';
                    }
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome" value="<?php if (isset($_user->nome)) echo $_user->nome; ?>">
                            <div class="invalid-feedback" id="invalidnome"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" pattern="\([0-9]{2}\)[\s][0-9]{4,5}-[0-9]{4}" placeholder="Seu telefone" value="<?php if (isset($_user->telefone)) echo $_user->telefone; ?>">
                            <div class="invalid-feedback" id="invalidtelefone"> </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="rua">Endereço</label>
                            <input type="text" class="form-control" id="rua" name="rua" placeholder="Nome da rua/avenida" value="<?php if (isset($_user->rua)) echo $_user->rua; ?>">
                            <div class="invalid-feedback" id="invalidendereco"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="numero">Número</label>
                            <input type="text" class="form-control" id="numero" name="numero" maxlength="5" placeholder="Número da casa/condomínio" value="<?php if (isset($_user->numero)) echo $_user->numero; ?>">
                            <div class="invalid-feedback" id="invalidnumero"> </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Nome do bairro" value="<?php if (isset($_user->bairro)) echo $_user->bairro; ?>">
                            <div class="invalid-feedback" id="invalidbairro"> </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento bloco/apartamento/fundos" value="<?php if (isset($_user->complemento)) echo $_user->complemento; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Nome da cidade" value="<?php if (isset($_user->cidade)) echo $_user->cidade; ?>">
                            <div class="invalid-feedback" id="invalidcidade"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" class="form-control">
                            </select>
                            <input type="hidden" id="selectedestado" name="selectedestado" value="<?php if (isset($_user->estado)) echo $_user->estado; ?>">
                            <div class="invalid-feedback" id="invalidestado"> </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control" pattern="[0-9]{2}.[0-9]{3}-[0-9]{3}" id="cep" name="cep" value="<?php if (isset($_user->cep)) echo $_user->cep; ?>">
                            <div class="invalid-feedback" id="invalidcep"> </div>
                        </div>
                    </div>
                    <div id="paciente" class="form-row">
                        <div class="form-group col-md-4">
                            <label for="genero">Gênero</label>
                            <select id="genero" name="genero" class="form-control">
                                <option <?php if (!isset($_user->genero)) echo 'selected' ?>>Escolher...</option>
                                <option value="feminino" <?php if (isset($_user->genero)) if ($_user->genero == 'feminino') echo 'selected'; ?>>Feminino</option>
                                <option value="masculino" <?php if (isset($_user->genero)) if ($_user->genero == 'masculino') echo 'selected'; ?>>Masculino</option>
                                <option value="outro" <?php if (isset($_user->genero)) if ($_user->genero == 'outro') echo 'selected'; ?>>Outro</option>
                            </select>
                            <div class="invalid-feedback" id="invalidgenero"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="datanascimento">Data de Nascimento</label>
                            <input type="date" class="form-control" maxlength="10" id="datanascimento" name="datanascimento" placeholder="Data de Nascimento" value="<?php if (isset($_user->datanascimento)) echo $_user->datanascimento; ?>">
                            <div class="invalid-feedback" id="invaliddate"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" maxlength="" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" id="cpf" name="cpf" placeholder="Seu CPF" value="<?php if (isset($_user->cpf)) echo $_user->cpf; ?>">
                            <div class="invalid-feedback" id="invalidcpf"> </div>
                        </div>
                    </div>
                    <div id="laboratorio" class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tipoexameauto">Tipo de Exames</label>
                            <input type="text" class="form-control" id="tipoexameauto" placeholder="Busque o tipo de exame">
                            <div class="invalid-feedback" id="invalidtipoexame"> </div>
                            <input type="hidden" name="tipoexame" id="tipoexame" value="<?php if (isset($_user->tipoexame)) echo $_user->tipoexame; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" name="cnpj" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}" placeholder="Seu CNPJ" value="<?php if (isset($_user->cnpj)) echo $_user->cnpj; ?>">
                            <div class="invalid-feedback" id="invalidcnpj"> </div>
                        </div>
                    </div>
                    <div id="laboratoriobtn" class="form-row">
                        <div id="tipoexamebtns">
                        </div>
                    </div>
                    <div id="medico" class="form-row">
                        <div class="form-group col-md-6">
                            <label for="especialidade">Especialidade</label>
                            <input type="text" class="form-control" id="especialidade" name="especialidade" placeholder="Busque pela especialidade" value="<?php if (isset($_user->especialidade)) echo $_user->especialidade; ?>">
                            <div class="invalid-feedback" id="invalidespecialidade"> </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="crm">CRM</label>
                            <input type="text" class="form-control" id="crm" name="crm" placeholder="Seu CRM" value="<?php if (isset($_user->crm)) echo $_user->crm; ?>">
                            <div class="invalid-feedback" id="invalidcrm"> </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Endereço de email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Seu email" value="<?php if (isset($_user->email)) echo $_user->email; ?>">
                            <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
                            <div class="invalid-feedback" id="invalidemail"> </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Crie uma senha de acesso" value="<?php if (isset($_user->senha)) echo $_user->senha; ?>">
                            <div class="invalid-feedback" id="invalidsenha"> </div>
                        </div>
                    </div>
                    <div class=text-right>
                        <button type="reset" class="btn btn-outline-danger">Limpar</button>
                        <button type="submit" id="btnregister" class="btn btn-outline-primary" disabled>Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>