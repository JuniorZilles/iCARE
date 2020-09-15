<?php
session_start();

require_once '../tools/menu.php';
require_once '../tools/utilities.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['erro'] = maketoast('Usuário não logado', 'Necessário realizar login para utilizar os recursos!');
    header("Location: ../index.php");
}
if ($_SESSION['tipo'] != 'admin') {
    $_SESSION['erro'] = maketoast('Usuário não permitido', 'O recurso não está disponível para esse usuário');
    header("Location: ../home/index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="sortcut icon" href="../favicon.ico" type="image/x-icon" />
    <title>iCARE - Visualização de Usuário</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="../home/index.php">iCARE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../home/index.php">Home</a>
                    </li>
                    <?php
                    if ($_SESSION['tipo'] == 'admin') {
                        echo makemenuadmin();
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
                        <li class="breadcrumb-item"><a href="../home/index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Usuários Cadastrados</li>
                    </ol>
                </nav>
                <h5 class="card-title text-center">
                    Usuários Cadastrados
                </h5>
                <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $xml = simplexml_load_file('dados.xml');

                        $_users = $xml->xpath("//user[tipo != 'admin']");
                        if (count($_users) > 0) {
                            for ($i = 0; $i < count($_users); $i++) {
                                $tipo = '';
                                if ($_users[$i]->tipo == 'paciente')  $tipo = 'Paciente';
                                else if ($_users[$i]->tipo == 'medico')  $tipo = 'Médico';
                                else $tipo = 'Laboratório';
                                echo '<tr>
                                <th scope="row">' . $i . '</th>
                                    <td>' . $_users[$i]->nome . '</td>
                                    <td>' . $tipo . '</td>
                                    <td>' . $_users[$i]->telefone . '</td>
                                    <td>' . $_users[$i]->email . '</td>
                                    <td><a href="../cadastro_pessoa/_cadastro.php?id=' . $_users[$i]->id . '" class="btn btn-outline-warning"><i class="fas fa-edit" aria-hidden="true"></i></a></td>
                                </tr>';
                            }
                        } else {
                            echo '<tr colspan="6">
                                    <td>Não há registros presentes!</td>
                                </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>