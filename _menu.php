
<?php
function makemenuadmin()
{
    return "<li class='nav-item'>
                <a class='nav-link' href='cadastro_pessoa.php?opcao=medico'>Cadastrar Médicos</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='cadastro_pessoa.php?opcao=laboratorio'>Cadastrar Laboratórios</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='cadastro_pessoa.php?opcao=paciente'>Cadastrar Pacientes</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='estatisticas.php'>Estatisticas Gerais</a>
            </li>";
}

function makemenupaciente()
{
    return "<li class='nav-item'>
                <a class='nav-link' href='historico_consultas.php'>Visualizar Consultas</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='historico_exames.php'>Visualizar Exames</a>
            </li>
            ";
}

function makemenumedico()
{
    return "<li class='nav-item'>
                <a class='nav-link' href='historico_consultas.php'>Visualizar Consultas</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='cadastro_consulta.php'>Cadastrar Consultas</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='_cadastro.php'>Alterar Cadastro</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='estatisticas.php'>Estatisticas Gerais</a>
            </li>";
}

function makemenulaboratorio()
{
    return "<li class='nav-item'>
                <a class='nav-link' href='historico_exames.php'>Visualizar Exames</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='cadastro_exame.php'>Cadastrar Exames</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='_cadastro.php'>Alterar Cadastro</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='estatisticas.php'>Estatisticas Gerais</a>
            </li>";
}
?>