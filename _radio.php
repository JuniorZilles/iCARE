
<?php
function makeradioadmin()
{
    return "<div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='tipouser' id='tipouser1' value='paciente' checked>
        <label class='form-check-label' for='tipouser1'>Paciente</label>
    </div>
    <div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='tipouser' id='tipouser2' value='medico'>
        <label class='form-check-label' for='tipouser2'>Médico</label>
    </div>
    <div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='tipouser' id='tipouser3' value='laboratorio'>
        <label class='form-check-label' for='tipouser3'>Laboratório</label>
    </div>";
}

function makeradiopaciente()
{
    return "<div class='form-check form-check-inline'>
    <input class='form-check-input' type='radio' name='tipouser' id='tipouser1' value='paciente' checked>
    <label class='form-check-label' for='tipouser1'>Paciente</label>
    </div>";
}

function makeradiomedico()
{
    return "<div class='form-check form-check-inline'>
    <input class='form-check-input' type='radio' name='tipouser' id='tipouser2' value='medico' checked>
    <label class='form-check-label' for='tipouser2'>Médico</label>
    </div>";
}

function makeradiolaboratorio()
{
    return "<div class='form-check form-check-inline'>
    <input class='form-check-input' type='radio' name='tipouser' id='tipouser3' value='laboratorio' checked>
    <label class='form-check-label' for='tipouser3'>Laboratório</label>
    </div>";
}
?>