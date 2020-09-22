<?php

require_once '../models/pessoa_model.php';
require_once '../models/cadastro_model.php';

function remove_inseguro($valor)
{
    $valor = trim($valor);
    $valor = stripslashes($valor);
    return $valor;
}

function maketoast($title, $message)
{
    return "<script>
    $(function(){
        $('#titulo').html('$title');
        $('#conteudo').html('$message');
        $('.toast').toast('show');
    });  
</script>";
}

function makeerrortoast($message)
{
    return "<script>
    $(function(){
        toastr.error('" . $message . "', 'Algo deu errado');
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

function obter_usuario($child)
{
    $_tipo = (string)$child['tipo'];
    $_id = (string)$child['_id'];
    $_senha = (string)$child['senha'];
    $_email = (string)$child['email'];
    $_nome = (string)$child['nome'];
    $_telefone = (string)$child['telefone'];
    $_rua = (string)$child['rua'];
    $_numero = (string)$child['numero'];
    $_bairro = (string)$child['bairro'];
    $_complemento = (string)$child['complemento'];
    $_cidade = (string)$child['cidade'];
    $_estado = (string)$child['estado'];
    $_cep = (string)$child['cep'];
    if ($_tipo == 'medico') {
        $_especialidade = (string)$child['especialidade'];
        $_crm = (string)$child['crm'];
        return new Medico($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_especialidade, $_crm);
    } else if ($_tipo == 'paciente') {
        $_genero = (string)$child['genero'];
        $_datanascimento = (string)$child['datanascimento'];
        $_cpf = (string)$child['cpf'];
        return new Paciente($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_genero, $_datanascimento, $_cpf);
    } else if ($_tipo == 'laboratorio') {
        $_tipoexame = obter_exames($child['tipoexame']);
        $_cnpj = (string)$child['cnpj'];
        return new Laboratorio($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_tipoexame, $_cnpj);
    }
}

function obter_exames($exames)
{
    $_tipoexame = '';
    foreach ($exames as $k => $child) {
        $_tipoexame .= (string)$child . ',';
    }
    return $_tipoexame;
}

function obtercadastroexame($child)
{
    $_id = (string)$child->id;
    $_hora = (string)$child->hora;
    $_data = (string)$child->data;
    $_pacienteid = (string)$child->pacienteid;
    $_observacao = (string)$child->observacao;
    $_medicoid = (string)$child->medicoid;
    $_outro = (string)$child->outro;
    $_resultado = (string)$child->resultado;
    $_laboratorioid = (string)$child->laboratorioid;
    $_tipoexame = obter_exames($child->tipoexame->children());
    return new Exame($_id, $_hora, $_data, $_pacienteid, $_observacao, $_outro, $_medicoid, $_tipoexame, $_resultado, $_laboratorioid);
}

function obtercadastroconsulta($child)
{
    $_id = (string)$child->id;
    $_hora = (string)$child->hora;
    $_data = (string)$child->data;
    $_pacienteid = (string)$child->pacienteid;
    $_observacao = (string)$child->observacao;
    $_medicoid = (string)$child->medicoid;
    $_outro = (string)$child->outro;
    $_sintomas = obter_sintomas($child->sintomas->children());
    $_receita = (string)$child->receita;
    return new Consulta($_id, $_hora, $_data, $_pacienteid, $_observacao, $_outro, $_medicoid, $_sintomas, $_receita);
}

function obter_sintomas($sintomas)
{
    $_sintoms = array();
    foreach ($sintomas as $k => $child) {
        array_push($_sintoms, (string)$child);
    }
    return $_sintoms;
}

function obter_usuario_visualizacao($child)
{
    $_tipo = (string)$child['tipo'];
    $_id = (string)$child['_id'];
    $_email = (string)$child['email'];
    $_nome = (string)$child['nome'];
    $_telefone = (string)$child['telefone'];
    $_rua = (string)$child['rua'];
    $_numero = (string)$child['numero'];
    $_bairro = (string)$child['bairro'];
    $_complemento = (string)$child['complemento'];
    $_cidade = (string)$child['cidade'];
    $_estado = (string)$child['estado'];
    $_cep = (string)$child['cep'];
    if ($_tipo == 'medico') {
        $_especialidade = (string)$child['especialidade'];
        $_crm = (string)$child['crm'];
        return new Medico($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, "", $_especialidade, $_crm);
    } else if ($_tipo == 'paciente') {
        $_genero = (string)$child['genero'];
        $_datanascimento = (string)$child['datanascimento'];
        $_cpf = (string)$child['cpf'];
        return new Paciente($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, "", $_genero, $_datanascimento, $_cpf);
    } else if ($_tipo == 'laboratorio') {
        $_tipoexame = obter_child_vislualizacao($child['tipoexame']);
        $_cnpj = (string)$child['cnpj'];
        return new Laboratorio($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, "", $_tipoexame, $_cnpj);
    }
}

function obter_child_vislualizacao($children)
{
    $_val = '';
    foreach ($children as $k => $child) {
        $_val .= (string)$child . '<br/>';
    }
    return $_val;
}

function obter_visualizacao_exame($child)
{
    $_id = (string)$child['_id'];
    $_hora = (string)$child['hora'];
    $_data = (string)$child['data'];
    $_pacienteid = (string)$child['pacienteid'];
    $_observacao = (string)$child['observacao'];
    $_medicoid = (string)$child['medicoid'];
    $_outro = (string)$child['outro'];
    $_resultado = (string)$child['resultado'];
    $_laboratorioid = (string)$child['laboratorioid'];
    $_tipoexame = obter_child_vislualizacao($child['tipoexame']);
    return new Exame($_id, $_hora, $_data, $_pacienteid, $_observacao, $_outro, $_medicoid, $_tipoexame, $_resultado, $_laboratorioid);
}

function obter_visualizacao_consulta($child)
{
    $_id = (string)$child['_id'];
    $_hora = (string)$child['hora'];
    $_data = (string)$child['data'];
    $_pacienteid = (string)$child['pacienteid'];
    $_observacao = (string)$child['observacao'];
    $_medicoid = (string)$child['medicoid'];
    $_outro = (string)$child['outro'];
    $_sintomas = obter_child_vislualizacao($child['sintomas']);
    $_receita = (string)$child['receita'];
    return new Consulta($_id, $_hora, $_data, $_pacienteid, $_observacao, $_outro, $_medicoid, $_sintomas, $_receita);
}

function obter_edit_button($tipo, $id)
{
    if ($tipo == 'medico')
        return '<a href="../consulta/_consulta.php?id=' . $id . '" class="btn btn-outline-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>';
    elseif ($tipo == 'laboratorio')
        return '<a href="../exame/_exame.php?id=' . $id . '" class="btn btn-outline-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>';
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
