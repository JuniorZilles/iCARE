<?php
session_start();

require_once 'utilities.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['erro'] = maketoast('Usuário não logado', 'Necessário realizar login para utilizar os recursos!');
    header("Location: index.php");
}

if (isset($_SESSION['cookieuser'])) {
    $expira = time() + 60 * 60 * 24 * 30;
    setcookie("user", base64_encode($_SESSION['cookieuser']), time() + $expira, "/");
} else {
    setCookie('user');
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
            <a class="navbar-brand" href="<?php echo $_SERVER["PHP_SELF"];?>">iCARE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $_SERVER["PHP_SELF"];?>">Home </a>                    
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cadastrar Médicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cadastrar Laboratórios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cadastrar Pacientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <br>
    <?php
    if ($_SESSION['tipo'] == 'admin') {
        echo ('<div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/medico.jpg" alt="Cadastrar Médico">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Médico</h5>
                        <p class="card-text">O cadastro de um novo médico é feito por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/paciente.jpg" alt="Cadastrar Paciente">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Paciente</h5>
                        <p class="card-text">O cadastro de novos pacientes é feito por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/laboratorio.jpg" alt="Cadastrar Laboratório">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Laboratório</h5>
                        <p class="card-text">O cadastro de um novo laboratório é feito por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/informacoes.jpg" alt="Estatisticas gerais">
                    <div class="card-body">
                        <h5 class="card-title">Estatisticas Gerais</h5>
                        <p class="card-text">A visualização dos gráficos de cada categoria é feita por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>');
    } else if ($_SESSION['tipo'] == 'paciente') {
        echo ('<div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Visualizar minhas consultas">
                    <div class="card-body">
                        <h5 class="card-title">Visualizar minhas consultas</h5>
                        <p class="card-text">A visualização das consultas realizadas é feita por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Visualizar meus exames">
                    <div class="card-body">
                        <h5 class="card-title">Visualizar meus exames</h5>
                        <p class="card-text">A visualização dos exames realizados é feito por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>');
    } else if ($_SESSION['tipo'] == 'laboratorio') {
        echo ('<div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Visualizar Exames">
                    <div class="card-body">
                        <h5 class="card-title">Visualizar Exames</h5>
                        <p class="card-text">A visualização dos exames cadastrados é feita por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Cadastrar Exames">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Exames</h5>
                        <p class="card-text">O cadastro de exames é feito por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Alterar meu Cadastro">
                    <div class="card-body">
                        <h5 class="card-title">Alterar meu Cadastro</h5>
                        <p class="card-text">Alterar sua senha e outros dados do seu perfil pode ser feito por aqui</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/infos." alt="Estatisticas gerais">
                    <div class="card-body">
                        <h5 class="card-title">Estatisticas Gerais</h5>
                        <p class="card-text">A visualização dos gráficos de cada categoria é feita por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>');
    } else if ($_SESSION['tipo'] == 'medico') {
        echo ('<div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/consulta.png" alt="Visualizar Consultas">
                    <div class="card-body">
                        <h5 class="card-title">Visualizar Consultas</h5>
                        <p class="card-text">A visualização dos consultas cadastrados é feita por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Cadastrar Consultas">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Consultas</h5>
                        <p class="card-text">O cadastro de consultas é feito por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Alterar meu Cadastro">
                    <div class="card-body">
                        <h5 class="card-title">Alterar meu Cadastro</h5>
                        <p class="card-text">Alterar sua senha e outros dados do seu perfil pode ser feito por aqui</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="images/infos." alt="Estatisticas gerais">
                    <div class="card-body">
                        <h5 class="card-title">Estatisticas Gerais</h5>
                        <p class="card-text">A visualização dos gráficos de cada categoria é feita por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>');
    }
    ?>
</body>

</html>