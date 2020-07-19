<?php
session_start();
//laboratorio
//Nome, Endereço, Telefone, E-mail, Tipos de Exame, CNPJ, …
//validar entradas
//não pode ter com mesmo nome
//criar e alterar laboratório
//apenas o usuario admin pode cadastrar, mas o laboratório e o admin pode alterar seus dados
//paciente
//Nome, Endereço, Telefone, E-mail, Gênero, Idade, CPF, ...
//validar entradas
//não pode ter com mesmo nome
//criar e alterar paciente
//apenas o usuario admin pode cadastrar e alterar
//medico
//nome, endereço, telefone, email, especialidade, CRM,...
//validar entradas
//não pode ter com mesmo nome
//criar e alterar médicos
//apenas o usuario admin pode cadastrar, mas o médico e o admin pode alterar seus dados

require_once '_utilities.php';
require_once '_menu.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['erro'] = maketoast('Usuário não logado', 'Necessário realizar login para utilizar os recursos!');
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap -->
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="cadastro_pessoa.css">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script src="cadastro_pessoa.js"></script>
    <?php
    if (isset($_SESSION['erro'])) {
        echo $_SESSION['erro'];
        unset($_SESSION['erro']);
    }
    ?>
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
                    } else if ($_SESSION['tipo'] == 'paciente') {
                        echo makemenupaciente();
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
                <h5 class="card-title text-center"><?php
                                                    if ($_SESSION['tipo'] == 'admin') {
                                                        echo 'Cadastro de Usuário';
                                                    } else {
                                                        echo 'Editar Perfil';
                                                    }
                                                    ?></h5>
                <form action="_cadastro.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Tipo de Usuário</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipouser" id="tipouser1" value="paciente" checked>
                                <label class="form-check-label" for="tipouser1">Paciente</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipouser" id="tipouser2" value="medico">
                                <label class="form-check-label" for="tipouser2">Médico</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipouser" id="tipouser3" value="laboratorio">
                                <label class="form-check-label" for="tipouser3">Laboratório</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control is-valid" id="nome" placeholder="Seu nome">
                            <div class="invalid-feedback" id="invalidnome"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" id="telefone" pattern="\([0-9]{2}\)[\s][0-9]{4,5}-[0-9]{4}" placeholder="Seu telefone">
                            <div class="invalid-feedback" id="invalidtelefone"> </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="rua">Endereço</label>
                            <input type="text" class="form-control is-invalid" id="rua" placeholder="Nome da rua/avenida">
                            <div class="invalid-feedback" id="invalidendereco"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="numero">Número</label>
                            <input type="text" class="form-control" id="numero" maxlength="5" placeholder="Número da casa/condomínio">
                            <div class="invalid-feedback" id="invalidnumero"> </div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" id="bairro" placeholder="Nome do bairro">
                            <div class="invalid-feedback" id="invalidbairro"> </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="form-control" id="complemento" placeholder="Complemento bloco/apartamento/fundos">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" id="cidade" placeholder="Nome da cidade">
                            <div class="invalid-feedback" id="invalidcidade"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="estado">Estado</label>
                            <select id="estado" class="form-control">
                                <option selected>Escolher...</option>
                            </select>
                            <div class="invalid-feedback" id="invalidestado"> </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control" pattern="[0-9]{2}.[0-9]{3}-[0-9]{3}" id="cep">
                            <div class="invalid-feedback" id="invalidcep"> </div>
                        </div>
                    </div>
                    <div id="paciente" class="form-row">
                        <div class="form-group col-md-4">
                            <label for="genero">Gênero</label>
                            <select id="genero" class="form-control">
                                <option selected>Escolher...</option>
                                <option value="feminino">Feminino</option>
                                <option value="masculino">Masculino</option>
                                <option value="outro">Outro</option>
                            </select>
                            <div class="invalid-feedback" id="invalidgenero"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="datanascimento">Data de Nascimento</label>
                            <input type="date" class="form-control" maxlength="10" id="datanascimento" placeholder="Data de Nascimento">
                            <div class="invalid-feedback" id="invaliddate"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" maxlength="" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" id="cpf" placeholder="Seu CPF">
                            <div class="invalid-feedback" id="invalidcpf"> </div>
                        </div>
                    </div>
                    <div id="laboratorio" class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tipoexame">Tipo de Exames</label>
                            <input type="text" class="form-control" id="tipoexame" placeholder="Busque o tipo de exame">
                            <div class="invalid-feedback" id="invalidtipoexame"> </div>
                            <div id="tiposexamesselecionados" > </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}" placeholder="Seu CNPJ">
                            <div class="invalid-feedback" id="invalidcnpj"> </div>
                        </div>
                    </div>
                    <div id="medico" class="form-row">
                        <div class="form-group col-md-6">
                            <label for="especialidade">Especialidade</label>
                            <input type="text" class="form-control" id="especialidade" placeholder="Busque pela especialidade">
                            <div class="invalid-feedback" id="invalidespecialidade"> </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="crm">CRM</label>
                            <input type="text" class="form-control" id="crm" placeholder="Seu CRM">
                            <div class="invalid-feedback" id="invalidcrm"> </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Endereço de email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Seu email">
                            <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
                            <div class="invalid-feedback" id="invalidemail"> </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="senha" placeholder="Crie uma senha de acesso">
                            <div class="invalid-feedback" id="invalidsenha"> </div>
                        </div>
                    </div>
                    <div class=text-right>
                        <button type="reset" class="btn btn-primary">Limpar</button>
                        <button type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
        <div class="toast" data-delay="1500" style="position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                <strong class="mr-auto"><span id='titulo'></span></strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <span id='conteudo'></span>
            </div>
        </div>
    </div>
</body>

</html>