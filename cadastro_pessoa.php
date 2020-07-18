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
    <link rel="stylesheet" href="index.css">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src=""></script>
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
        <form action="_cadastro.php" method="POST">
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="paciente">
                    <label class="form-check-label" for="inlineRadio1">Paciente</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="medico">
                    <label class="form-check-label" for="inlineRadio2">Médico</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="laboratorio">
                    <label class="form-check-label" for="inlineRadio3">Laboratório</label>
                </div>
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control is-valid" id="nome" placeholder="Seu nome">
            </div>
            <div class="form-group">
                <label for="rua">Endereço</label>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rua">Rua</label>
                        <input type="text" class="form-control is-invalid" id="rua" placeholder="Nome da rua/avenida">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" id="numero" maxlength="5" placeholder="Número da rua">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" placeholder="Nome do bairro">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" id="complemento" placeholder="Complemento bloco/apartamento/fundos">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" placeholder="Nome da cidade">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estado">Estado</label>
                        <select id="estado" class="form-control">
                            <option selected>Escolher...</option>
                            <option>montar com dados do xml</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" placeholder="Seu telefone">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="genero">Gênero</label>
                    <select id="genero" class="form-control">
                        <option selected>Escolher...</option>
                        <option>Feminino</option>
                        <option>Masculino</option>
                        <option>Outro</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="idade">Idade</label>
                    <input type="number" class="form-control" maxlength="3" id="idade" placeholder="Sua idade">
                </div>
                <div class="form-group col-md-4">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" maxlength="" id="cpf" placeholder="Seu CPF">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="tipoexame">Tipo de Exames</label>
                    <select id="tipoexame" class="form-control">
                        <option selected>Escolher...</option>
                        <option>montar pelo xml fazer um opção que vai adicionano</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="cnpj">CNPJ</label>
                    <input type="text" class="form-control" id="cnpj" placeholder="Seu CNPJ">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="especialidade">Especialidade</label>
                    <select id="especialidade" class="form-control">
                        <option selected>Escolher...</option>
                        <option>montar pelo xml</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="crm">CRM</label>
                    <input type="text" class="form-control" id="crm" placeholder="Seu CRM">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Endereço de email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Seu email">
                    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" placeholder="Crie uma senha de acesso">
                </div>
            </div>

            <button type="button" class="btn btn-primary">Salvar</button>
        </form>
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