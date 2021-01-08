<?php

function remove_inseguro($valor)
{
    $valor = trim($valor);
    $valor = stripslashes($valor);
    return $valor;
}

function makeerrortoast($message)
{
    return "<script>
    $(function(){
        toastr.error('" . $message . "', 'Não foi possível realizar a operação!');
    });  
</script>";
}

function makeradioadmin($_opcao)
{
    $_pcheck = $_mcheck = $_lcheck = '';
    if ($_opcao == 'paciente')
        $_pcheck = 'checked';
    else if ($_opcao == 'medico')
        $_mcheck = 'checked';
    else if ($_opcao == 'laboratorio')
        $_lcheck = 'checked';
    else
        $_pcheck = 'checked';
    return "<div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='tipouser' id='tipouser1' value='paciente' " . $_pcheck . ">
        <label class='form-check-label' for='tipouser1'>Paciente</label>
    </div>
    <div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='tipouser' id='tipouser2' value='medico' " . $_mcheck . ">
        <label class='form-check-label' for='tipouser2'>Médico</label>
    </div>
    <div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='tipouser' id='tipouser3' value='laboratorio' " . $_lcheck . ">
        <label class='form-check-label' for='tipouser3'>Laboratório</label>
    </div>";
}

function makesuccesstoast($message)
{
    return "<script>
    $(function(){
        toastr.success('" . $message . "');
    });  
</script>";
}

function pacientform($path, $opcao)
{
    return '<form action="'.$path.'Historico/postHistorico" id="cadastroform" method="POST">
    <div class="form-row">
        <div class="form-group col-md-11">
            <input type="text" class="form-control" id="pacienteauto" placeholder="Nome do Paciente" aria-label="Nome do Paciente" aria-describedby="basic-addon2">
            <input type="hidden" id="pacienteid" name="pacienteid" value="">
            <input type="hidden" id="opcao" name="opcao" value="'.$opcao.'">
        </div>
        <div class="form-group col-md-1">
            <button id="search" class="btn btn-outline-primary" type="button">Buscar</button>
        </div>
    </div>
</form>';
}

function obter_edit_button($tipo, $id, $path)
{
    if ($tipo == 'medico')
        return '<a href="'.$path.'cadastro/getConsulta/' . $id . '" class="btn btn-outline-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>';
    elseif ($tipo == 'laboratorio')
        return '<a href="'.$path.'cadastro/getExame/' . $id . '" class="btn btn-outline-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>';
    return '';
}

function obter_observacao($tipo, $observacao)
{
    if ($tipo == 'medico' || $tipo == 'laboratorio')
        return '<div class="row">
                    <div class="col-2">Observação:</div>
                    <div class="col-10">' . $observacao . '</div>
                </div>';
    return '';
}
