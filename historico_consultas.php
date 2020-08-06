<?php
session_start();
//Data, Médico, Paciente, Receita, Observações, ...
//é visto apenas pelo medico e o paciente
//o médico só enxerga as consultas realizadas por ele
//o paciente não pode ver informações como observação(apenas o seus dados) 

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
    <link rel="sortcut icon" href="favicon.ico" type="image/x-icon" />
    <title>iCARE - Visualização de Consultas</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="cadastro.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script src="historico_consultas.js"></script>
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
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Visualizar Consultas</li>
                    </ol>
                </nav>
                <h5 class="card-title text-center">Visualizar Consultas</h5>
                <form action="_consulta.php" id="cadastroform" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-11">
                            <input type="text" class="form-control" id="pacienteauto" placeholder="Nome do Paciente" aria-label="Nome do Paciente" aria-describedby="basic-addon2">
                            <input type="hidden" id="pacienteid" name="pacienteid" value="">
                        </div>
                        <div class="form-group col-md-1">
                            <button class="btn btn-outline-primary" type="button">Buscar</button>
                        </div>
                    </div>
                </form>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <h5>Consulta realizada no dia data</h5>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="text-right">
                                        <button class="btn btn-outline-info" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            <i class="fas fa-arrow-down" aria-hidden="true"></i>
                                        </button>
                                        <a href="_consulta.php?id=' .  . '" class="btn btn-outline-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <div id="accordion1_">
                                        <div class="card">
                                            <div class="card-header" id="heading1_">
                                                <div class="form-row">
                                                    <div class="form-group col-md-8">
                                                        <h6>Dados sobre o médico</h6>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="text-right">
                                                            <button class="btn btn-outline-info" data-toggle="collapse" data-target="#collapse1_" aria-expanded="false" aria-controls="collapse1_">
                                                                <i class="fas fa-arrow-down" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse1_" class="collapse" aria-labelledby="heading1_" data-parent="#accordion1_">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accordion2_">
                                        <div class="card">
                                            <div class="card-header" id="heading2_">
                                                <div class="form-row">
                                                    <div class="form-group col-md-8">
                                                        <h6>Dados sobre o paciente</h6>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="text-right">
                                                            <button class="btn btn-outline-info" data-toggle="collapse" data-target="#collapse2_" aria-expanded="false" aria-controls="collapse2_">
                                                                <i class="fas fa-arrow-down" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse2_" class="collapse" aria-labelledby="heading2_" data-parent="#accordion2_">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accordion3_">
                                        <div class="card">
                                            <div class="card-header" id="heading3_">
                                                <div class="form-row">
                                                    <div class="form-group col-md-8">
                                                        <h6>Dados sobre o laboratório</h6>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="text-right">
                                                            <button class="btn btn-outline-info" data-toggle="collapse" data-target="#collapse3_" aria-expanded="false" aria-controls="collapse3_">
                                                                <i class="fas fa-arrow-down" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse3_" class="collapse" aria-labelledby="heading3_" data-parent="#accordion3_">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accordion4_">
                                        <div class="card">
                                            <div class="card-header" id="heading4_">
                                            <div class="form-row">
                                                    <div class="form-group col-md-8">
                                                        <h6>Dados da Consulta</h6>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="text-right">
                                                            <button class="btn btn-outline-info" data-toggle="collapse" data-target="#collapse4_" aria-expanded="false" aria-controls="collapse4_">
                                                                <i class="fas fa-arrow-down" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse4_" class="collapse" aria-labelledby="heading4_" data-parent="#accordion4_">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>