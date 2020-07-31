<?php 

require_once '_pessoa_model.php';
require_once '_cadastro_model.php';

function remove_inseguro($valor)
{
    $valor = trim($valor);
    $valor = stripslashes($valor);
    return $valor;
}

function maketoast($title, $message){
    return "<script>
    $(function(){
        $('#titulo').html('$title');
        $('#conteudo').html('$message');
        $('.toast').toast('show');
    });  
</script>";
}

function makeerrortoast($message){
    return "<script>
    $(function(){
        toastr.error('" . $message . "', 'Algo deu errado');
    });  
</script>";
}

function makesuccesstoast($message){
    return "<script>
    $(function(){
        toastr.success('" . $message . "');
    });  
</script>";
}

function obter_usuario($child){
    $_tipo = (string)$child->tipo;
    $_id = (string)$child->id;
    $_senha = (string)$child->senha;
    $_email = (string)$child->email;
    $_nome = (string)$child->nome;
    $_telefone = (string)$child->telefone;
    $_rua = (string)$child->rua;
    $_numero = (string)$child->numero;
    $_bairro = (string)$child->bairro;
    $_complemento = (string)$child->complemento;
    $_cidade = (string)$child->cidade;
    $_estado = (string)$child->estado;
    $_cep = (string)$child->cep;
    if($_tipo == 'medico'){
        $_especialidade = (string)$child->especialidade;
        $_crm = (string)$child->crm;
        return new Medico($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_especialidade, $_crm);
    }else if($_tipo == 'paciente'){
        $_genero = (string)$child->genero;
        $_datanascimento = (string)$child->datanascimento;
        $_cpf = (string)$child->cpf;
        return new Paciente($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_genero, $_datanascimento, $_cpf);
    }else if($_tipo == 'laboratorio'){
        $_tipoexame = obter_exames($child->tipoexame->children());
        $_cnpj = (string)$child->cnpj;
        return new Laboratorio($_id, $_tipo, $_nome, $_telefone, $_rua, $_numero, $_bairro, $_complemento, $_cidade, $_estado, $_cep, $_email, $_senha, $_tipoexame, $_cnpj);
    }   
}

function obter_exames($exames){
    $_tipoexame = '';
    foreach ($exames as $k=>$child) {
        $_tipoexame .= (string)$child.',';
    }
    return $_tipoexame;
}

function obtercadastroexame($child){
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
    $_receita = (string)$child->laboratorireceitaoid;
    return new Consulta($_id, $_hora, $_data, $_pacienteid, $_observacao, $_outro, $_medicoid, $_sintomas, $_receita);
}

function obter_sintomas($sintomas){
    $_sintoms = Array();
    foreach ($sintomas as $k=>$child) {
        array_push($_sintoms,(string)$child);
    }
    return $_sintoms;
}