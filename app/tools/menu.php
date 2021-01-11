
<?php
function makemenuadmin($path)
{
    return "<li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='cadastrar' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Cadastrar
                </a>
                <div class='dropdown-menu' aria-labelledby='cadastrar'>
                <a class='dropdown-item' href='".$path."cadastro/pessoa/medico'>Médicos</a>
                <a class='dropdown-item' href='".$path."cadastro/pessoa/laboratorio'>Laboratórios</a>
                <a class='dropdown-item' href='".$path."cadastro/pessoa/paciente'>Pacientes</a>
                </div>
            </li>
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='visualizar' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Visualizar
                </a>
                <div class='dropdown-menu' aria-labelledby='visualizar'>
                    <a class='dropdown-item' href='".$path."historico/consulta'>Consultas</a>
                    <a class='dropdown-item' href='".$path."historico/exame'>Exames</a>
                    <a class='dropdown-item' href='".$path."visualizacao'>Cadastros</a>
                </div>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='".$path."estatisticas'>Estatisticas Gerais</a>
            </li>";
}

function makemenupaciente($path)
{
    return "<li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='visualizar' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Visualizar
                </a>
                <div class='dropdown-menu' aria-labelledby='visualizar'>
                    <a class='dropdown-item' href='".$path."historico/consulta'>Consultas</a>
                    <a class='dropdown-item' href='".$path."historico/exame'>Exames</a>
                </div>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='".$path."estatisticas'>Visualizar Quantidade de Consultas e Exames</a>
            </li>
            ";
}

function makemenumedico($path)
{
    return "<li class='nav-item'>
                <a class='nav-link' href='".$path."historico/consulta'>Visualizar Consultas</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='".$path."cadastro/consulta'>Cadastrar Consultas</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='".$path."cadastro/getPessoa'>Alterar Cadastro</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='".$path."estatisticas'>Estatisticas Gerais</a>
            </li>";
}

function makemenulaboratorio($path)
{
    return "<li class='nav-item'>
                <a class='nav-link' href='".$path."historico/exame'>Visualizar Exames</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='".$path."cadastro/exame'>Cadastrar Exames</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='".$path."cadastro/getPessoa'>Alterar Cadastro</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='".$path."estatisticas'>Estatisticas Gerais</a>
            </li>";
}
?>