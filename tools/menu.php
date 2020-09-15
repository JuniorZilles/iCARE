
<?php
function makemenuadmin()
{
    return "<li class='nav-item'>
                <a class='nav-link' href='../cadastro_pessoa/index.php?opcao=medico'>Cadastrar Médicos</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../cadastro_pessoa/index.php?opcao=laboratorio'>Cadastrar Laboratórios</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../cadastro_pessoa/index.php?opcao=paciente'>Cadastrar Pacientes</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href=''../historico/_visualizacao.php?opcao=consulta'>Visualizar Consultas</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../historico/_visualizacao.php?opcao=exame'>Visualizar Exames</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../visualizacao_pessoa/index.php'>Alterar Cadastro</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../estatisticas/index.php'>Estatisticas Gerais</a>
            </li>";
}

function makemenupaciente()
{
    return "<li class='nav-item'>
                <a class='nav-link' href='../historico/_visualizacao.php?opcao=consulta'>Visualizar Consultas</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../historico/_visualizacao.php?opcao=exame'>Visualizar Exames</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../estatisticas/index.php'>Visualizar Quantidade de Consultas e Exames</a>
            </li>
            ";
}

function makemenumedico()
{
    return "<li class='nav-item'>
                <a class='nav-link' href='../historico/_visualizacao.php?opcao=consulta'>Visualizar Consultas</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../consulta/index.php'>Cadastrar Consultas</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../cadastro_pessoa/_cadastro.php'>Alterar Cadastro</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../estatisticas/index.php'>Estatisticas Gerais</a>
            </li>";
}

function makemenulaboratorio()
{
    return "<li class='nav-item'>
                <a class='nav-link' href='../historico/_visualizacao.php?opcao=exame'>Visualizar Exames</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../exame/index.php'>Cadastrar Exames</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../cadastro_pessoa/_cadastro.php'>Alterar Cadastro</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../estatisticas/index.php'>Estatisticas Gerais</a>
            </li>";
}
?>