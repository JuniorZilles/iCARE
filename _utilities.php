<?php 

require_once '_pessoa_model.php';

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

function obter_usuario($child){
    $_tipo = (string)$child['tipo'];
    $_id = (string)$child['id'];
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
    foreach ($exames as $child) {
        $_tipoexame += (string)$child;
    }
    return $_tipoexame;
}
