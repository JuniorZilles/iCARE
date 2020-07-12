
<?php
function makemenuadmin()
{
    return "<li class='nav-item'>
                <a class='nav-link' href='cadastro_medico.php'>Cadastrar Médicos</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='cadastro_laboratorio.php'>Cadastrar Laboratórios</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='cadastro_paciente.php'>Cadastrar Pacientes</a>
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
                <a class='nav-link' href='cadastro_medico.php'>Alterar Cadastro</a>
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
                <a class='nav-link' href='cadastro_laboratorio.php'>Alterar Cadastro</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='estatisticas.php'>Estatisticas Gerais</a>
            </li>";
}
?>