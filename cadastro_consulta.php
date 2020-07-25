<?php
session_start();

require_once '_utilities.php';
require_once '_menu.php';
require_once '_radio.php';


if (!isset($_SESSION['user'])) {
    $_SESSION['erro'] = maketoast('Usuário não logado', 'Necessário realizar login para utilizar os recursos!');
    header("Location: index.php");
}
if ($_SESSION['tipo'] != 'medico') {
    $_SESSION['erro'] = maketoast('Usuário não permitido', 'O recurso não está disponível para esse usuário');
    header("Location: home.php");
}
if (isset($_SESSION['registro']))
    $_consulta = unserialize($_SESSION['registro']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="cadastro.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script src="cadastro_consulta.js"></script>
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
                    if ($_SESSION['tipo'] == 'medico') {
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
                <h5 class="card-title text-center">Cadastro de Consulta</h5>
                <form action="_consulta.php" id="cadastroform" method="POST">
                    <!-- criar um objeto (usar exemplo do _pessoa_model.php) para permitir a edição -->
                <input type="hidden" id="identificador" value="<?php if (isset($_consulta->id)) echo $_consulta->id; ?>">
                <!-- DÁ PRA TIRAR O COMENTADO, POR QUE ESSES DADOS JÁ VÃO ESTAR CONTIDOS NO CADASTRO DO PACIENTE -->
                <!-- Data, Médico, Paciente, Receita, Observações -->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="pacienteauto">Nome do Paciente</label>
                            <input type="text" class="form-control" id="pacienteauto" placeholder="Nome do Paciente" value="">
                            <input type="hidden" id="pacienteid" name="pacienteid" value="">
                            <div class="invalid-feedback" id="invalidnome"> </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="dataconsulta">Data da Consulta</label>
                            <input type="date" class="form-control" maxlength="10" id="dataconsulta" placeholder="Data de realização da consulta" value="<?php if (isset($_consulta->dataconsulta)) echo $_consulta->dataconsulta; ?>">
                            <div class="invalid-feedback" id="invaliddate"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="horarioconsulta">Horário da Consulta</label>
                            <input type="time" class="form-control" maxlength="10" id="horarioconsulta" placeholder="Horário de realização da consulta" value="<?php if (isset($_consulta->horarioconsulta)) echo $_consulta->horarioconsulta; ?>">
                            <div class="invalid-feedback" id="invaliddate"> </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">Qual o sintoma do paciente?</div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="febre" name="febre" value="febre"> <label class="form-check-label" for="febre">Febre </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="dorcabeca" name="dorcabeca" value="dorcabeca"> <label class="form-check-label" for="dorcabeca">Dor Cabeça </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="dorcorpo" name="dorcorpo" value="dorcorpo"> <label class="form-check-label" for="dorcorpo">Dor no Corpo </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="dorpeito" name="dorpeito" value="dorpeito"> <label class="form-check-label" for="dorpeito"> Dor no Peito </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="formigamento" name="formigamento" value="formigamento"> <label class="form-check-label" for="formigamento">Formigamento </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="dorbarriga" name="dorbarriga" value="dorbarriga"> <label class="form-check-label" for="dorbarriga"> Dor de Barriga</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vomito" name="vomito" value="vomito"> <label class="form-check-label" for="vomito">Vômito </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="nausea" name="nausea" value="nausea"> <label class="form-check-label" for="nausea">Náusea </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="perdapeso" name="perdapeso" value="perdapeso"> <label class="form-check-label" for="perdapeso">Perda de Peso </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ganhopeso" name="ganhopeso" value="ganhopeso"> <label class="form-check-label" for="ganhopeso">Ganho de Peso </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cansaco" name="cansaco" value="cansaco"> <label class="form-check-label" for="cansaco">Cansaço </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="outro" name="outro" value="outro"> <label class="form-check-label" for="outro">Outro </label>
                            </div>
                                <input type="text" class="form-control" id="especifiqueoutro" placeholder="Especifique se for outro" value="<?php if (isset($_consulta->outro)) echo $_consulta->outro; ?>">
                        </div>
                    </div>
                    <div class=text-right>
                        <button type="reset" class="btn btn-outline-danger">Limpar</button>
                        <button type="button" id="btnregister" class="btn btn-outline-primary" disabled>Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="display: none;">
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
    </div>

</body>

</html>