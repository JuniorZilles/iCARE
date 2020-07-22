
<?php
function makeradioadmin($_opcao)
{
    $_pcheck = $_mcheck = $_lcheck = '';
    if($_opcao == 'paciente')
        $_pcheck = 'checked';
    else if($_opcao == 'medico')
        $_mcheck = 'checked';
    else if($_opcao == 'laboratorio')
        $_lcheck = 'checked';
    else
        $_pcheck = 'checked';
    return "<div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='tipouser' id='tipouser1' value='paciente' ".$_pcheck.">
        <label class='form-check-label' for='tipouser1'>Paciente</label>
    </div>
    <div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='tipouser' id='tipouser2' value='medico' ".$_mcheck.">
        <label class='form-check-label' for='tipouser2'>Médico</label>
    </div>
    <div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='tipouser' id='tipouser3' value='laboratorio' ".$_lcheck.">
        <label class='form-check-label' for='tipouser3'>Laboratório</label>
    </div>";
}

// function makeradiopaciente()
// {
//     return "<div class='form-check form-check-inline'>
//     <input class='form-check-input' type='radio' name='tipouser' id='tipouser1' value='paciente' checked>
//     <label class='form-check-label' for='tipouser1'>Paciente</label>
//     </div>";
// }

// function makeradiomedico()
// {
//     return "<div class='form-check form-check-inline'>
//     <input class='form-check-input' type='radio' name='tipouser' id='tipouser2' value='medico' checked>
//     <label class='form-check-label' for='tipouser2'>Médico</label>
//     </div>";
// }

// function makeradiolaboratorio()
// {
//     return "<div class='form-check form-check-inline'>
//     <input class='form-check-input' type='radio' name='tipouser' id='tipouser3' value='laboratorio' checked>
//     <label class='form-check-label' for='tipouser3'>Laboratório</label>
//     </div>";
// }
?>