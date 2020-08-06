<?php
session_start();
require_once '_utilities.php';
require_once '_menu.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['erro'] = maketoast('Usuário não logado', 'Necessário realizar login para utilizar os recursos!');
    header("Location: index.php");
}
if ($_SESSION['tipo'] != 'laboratorio') {
    $_SESSION['erro'] = maketoast('Usuário não permitido', 'O recurso não está disponível para esse usuário');
    header("Location: home.php");
}
if (isset($_SESSION['registro']))
    $_exame = unserialize($_SESSION['registro']);
unset($_SESSION['registro']);

$xmlString = file_get_contents('dados.xml');
$xml = new SimpleXMLElement($xmlString);
$nodolab = $xml->xpath("//user[id = '" . $_SESSION['user'] . "']/tipoexame");
if (count($nodolab) > 0) {
    $_tipoexame = obter_exames($nodolab[0]);
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="sortcut icon" href="favicon.ico" type="image/x-icon" />
    <title>iCARE - Cadastro de Exame</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="cadastro.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script src="cadastro_exame.js"></script>
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
                    if ($_SESSION['tipo'] == 'laboratorio') {
                        echo makemenulaboratorio();
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
                                                                                if (isset($_exame->id)) {
                                                                                    echo 'Editar Exame';
                                                                                } else {
                                                                                    echo 'Cadastro de Exame';
                                                                                }
                                                                                ?></li>
                    </ol>
                </nav>
                <h5 class="card-title text-center"><?php
                                                    if (isset($_exame->id)) {
                                                        echo 'Editar Exame';
                                                    } else {
                                                        echo 'Cadastro de Exame';
                                                    }
                                                    ?></h5>
                <form action="_exame.php" id="cadastroform" method="POST">
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
                    <input type="hidden" id="identificadorexame" name="identificadorexame" value="<?php if (isset($_exame->id))  echo $_exame->id; ?>">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="pacienteauto">Nome do Paciente</label>
                            <input type="text" class="form-control" id="pacienteauto" name="pacienteauto" placeholder="Nome do Paciente" value="">
                            <input type="hidden" id="pacienteid" name="pacienteid" value="<?php if (isset($_exame->pacienteid)) echo $_exame->pacienteid; ?>">
                            <div class="invalid-feedback" id="invalidpacienteauto"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="datanascimento">Data Nascimento Paciente</label>
                            <input type="date" class="form-control" maxlength="10" id="datanascimento" placeholder="Data de realização da consulta" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="medicoauto">Médico Responsável</label>
                            <input type="text" class="form-control" id="medicoauto" name="medicoauto" placeholder="Nome do Médico Responsável" value="">
                            <input type="hidden" id="medicoid" name="medicoid" value="<?php if (isset($_exame->medicoid)) echo $_exame->medicoid; ?>">
                            <div class="invalid-feedback" id="invalidmedicoauto"> </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="especialidade">Especialidade</label>
                            <input type="text" class="form-control" id="especialidade" placeholder="Especialidade do médico" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="crm">CRM</label>
                            <input type="text" class="form-control" id="crm" placeholder="CRM do médico" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" id="telefone" placeholder="Telefone do médico" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="exameauto">Exames a serem realizados</label>
                            <input type="text" class="form-control" id="exameauto" placeholder="Busque o tipo de exame">
                            <div class="invalid-feedback" id="invalidexame"> </div>
                            <input type="hidden" name="exame" id="exame" value="<?php if (isset($_exame->tipoexame)) echo $_exame->tipoexame; ?>">
                            <input type="hidden" name="tipoexame" id="tipoexame" value="<?php if (isset($_tipoexame)) echo $_tipoexame; ?>">

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" id="especifiqueoutro" name="outro" placeholder="Especifique se for outro exame" value="<?php if (isset($_exame->outro)) echo $_exame->outro; ?>">
                        </div>
                    </div>
                    <div id="laboratoriobtn" class="form-row">
                        <div id="tipoexamebtns">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="dataexame">Data do Exame</label>
                            <input type="date" class="form-control" maxlength="10" id="dataexame" name="dataexame" placeholder="Data de realização do exame" value="<?php if (isset($_exame->data)) echo $_exame->data; ?>">
                            <div class="invalid-feedback" id="invaliddate"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="horarioexame">Horário do Exame</label>
                            <input type="time" class="form-control" maxlength="10" id="horarioexame" name="horarioexame" placeholder="Horário de realização ddo exame" value="<?php if (isset($_exame->hora)) echo $_exame->hora; ?>">
                            <div class="invalid-feedback" id="invalidhour"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="resultadoexame">Resultado do Exame</label>
                            <select id="resultadoexame" name="resultadoexame" class="form-control">
                                <option <?php if (!isset($_exame->resultado)) echo 'selected' ?>>Escolher...</option>
                                <option value="apto" <?php if (isset($_exame->resultado)) if ($_exame->resultado == 'apto') echo 'selected'; ?>>Apto</option>
                                <option value="inapto" <?php if (isset($_exame->resultado)) if ($_exame->resultado == 'inapto') echo 'selected'; ?>>Inapto</option>
                            </select>
                            <div class="invalid-feedback" id="invalidresultado"> </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea class="form-control" name="resultado" id="resultado" placeholder="Descrição detalhada dos resultados obtidos" rows="5"><?php if (isset($_exame->observacao)) echo $_exame->observacao; ?></textarea>
                            <div class="invalid-feedback" id="invalidtextresultado"> </div>
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