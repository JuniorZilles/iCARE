<?php
session_start();
//Data, Laboratório, Paciente, TipoExame, Resultado, ...
//validar entradas
//criar e alterar exame
//laboratório cadastra exames só

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
    <script src="cadastro_exame.js"></script>
    <?php
    if (isset($_SESSION['erro'])) {
        echo $_SESSION['erro'];
        unset($_SESSION['erro']);
    }
    ?>
</head>

<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
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
    <!-- Data, Laboratório, Paciente, TipoExame, Resultado -->


    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Cadastro de Exame</h5>
                <form action="_exame.php" id="cadastroform" method="POST">
                    <!-- criar um objeto (usar exemplo do _pessoa_model.php) para permitir a edição -->
                <input type="hidden" id="identificadorexame" value="<?php if (isset($_SESSION['identificadordoexame']))  echo $_exame->id; ?>">
                <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="pacienteauto">Nome do Paciente</label>
                            <input type="text" class="form-control" id="pacienteauto" placeholder="Nome do Paciente" value="">
                            <input type="hidden" id="pacienteid" name="pacienteid" value="<?php if (isset($_exame->pacienteid)) echo $_exame->pacienteid; ?>">
                            <div class="invalid-feedback" id="invalidpacienteauto"> </div>
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
<!-- cnpj do laboratório não precisa isso é repetição de dados, o que não deve ser feito, pois o cnpj já se encontra no xml no perfil do laboratorio -->
<!-- a identificação do usuario(laboratorio) é pego  usando o session[user] que é o id do usuario-->
                    <!-- <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nome">CNPJ do laboratório</label>
                            <input type="text" class="form-control" id="cnpjlab" placeholder="Digite o CNPJ do Laboratório" value=" "onkeypress="$(this).mask('00.000.000/0000-00')">
                            <input type="hidden" id="cnpjlab" name="cnpjlab" value="">
                            <div class="invalid-feedback" id="invalidcnpjlab"> </div>
                        </div>
                    </div> -->
<!-- PEGAR OS TIPOS DE EXAME E MONTAR A PARTIR DOS MARCADOS PERFIL DO LABORATÓRIO NO XML -->
                    <div class="form-group row">
                        <div class="col-sm-10">Qual o tipo de exame?</div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="febre" name="acetilcolinesterase" value="acetilcolinesterase"> <label class="form-check-label" for="acetilcolinesterase">Acetilcolinesterase </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="acidobiliarestotaisjejum" name="acidobiliarestotaisjejum" value="acidobiliarestotaisjejum"> <label class="form-check-label" for="acidobiliarestotaisjejum">Ácido Biliares Totais Jejum </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="acidobBiliarestotaisposjejum" name="acidobBiliarestotaisposjejum" value="acidobBiliarestotaisposjejum"> <label class="form-check-label" for="acidobBiliarestotaisposjejum">Ácido Biliares Totais Pós Jejum </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="acidourico" name="acidourico" value="acidourico"> <label class="form-check-label" for="acidourico">Ácido Úrico </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="albumina" name="albumina" value="albumina"> <label class="form-check-label" for="albumina">Albumina </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="amilase" name="amilase" value="amilase"> <label class="form-check-label" for="amilase">Amilase</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="amonia" name="amonia" value="amonia"> <label class="form-check-label" for="amonia">Amônia </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="bilirrubinadireta" name="bilirrubinadireta" value="bilirrubinadireta"> <label class="form-check-label" for="bilirrubinadireta">Bilirrubina Direta </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="bilirrubinaindireta" name="bilirrubinaindireta" value="bilirrubinaindireta"> <label class="form-check-label" for="bilirrubinaindireta">Bilirrubina Indireta </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="bilirrubinatotal" name="bilirrubinatotal" value="bilirrubinatotal"> <label class="form-check-label" for="bilirrubinatotal">Bilirrubina Total </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="bsp" name="bsp" value="bsp"> <label class="form-check-label" for="bsp">BSP </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="outroexame" name="outroexame" value="outroexame"> <label class="form-check-label" for="outro">Outro </label>
                            </div>
                                <input type="text" class="form-control" id="especifiqueoutro" placeholder="Especifique se for outro exame" value="<?php if (isset($_exame->outroexame)) echo $_exame->outroexame; ?>">
                        </div>
                    </div>

                   
                    <!-- DÁ PRA TIRAR O COMENTADO, POR QUE ESSES DADOS JÁ VÃO ESTAR CONTIDOS NO CADASTRO DO PACIENTE -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="dataexame">Data do Exame</label>
                            <input type="date" class="form-control" maxlength="10" id="dataexame" placeholder="Data de realização do exame" value="<?php if (isset($_exame->dataexame)) echo $_exame->dataexame; ?>">
                            <div class="invalid-feedback" id="invaliddate"> </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="horarioexame">Horário do Exame</label>
                            <input type="time" class="form-control" maxlength="10" id="horarioexame" placeholder="Horário de realização ddo exame" value="<?php if (isset($_exame->horarioexame)) echo $_exame->horarioexame; ?>">
                            <div class="invalid-feedback" id="invaliddate"> </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="resultadoexameapto">Resultado do Exame</label><br>
                            <input type="radio"  id="resultadoexameapto" name="aptoounao" value="apto">
                            <label for="apto">Apto</label><br>
                            <input type="radio" id="resultadoexameinapto" name="aptoounao" value="inapto">
                            <label for="inapto">Inapto</label><br>
                            <div class="invalid-feedback" id="invalidresultado"> </div>
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