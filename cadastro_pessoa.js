var veremail =
    verpassword =
    vernome =
    vertelefone =
    verrua =
    vernumero =
    verbairro =
    vercidade =
    verestado =
    vercep =
    vergenero =
    verdatanascimento =
    vercpf =
    vertipoexame =
    vercnpj =
    verespecialidade =
    vercrm = 0;
var tipouser = '';

$(document).ready(function () {
    $("#telefone").mask("(00) 00000-0000");
    $('#cpf').mask('000.000.000-00');
    $('#cnpj').mask('00.000.000/0000-00');
    $('#cep').mask('00.000-000');
    habilitabtninicial();
    esconde_campos();
    mostratiposexames()
    $("input[type='radio']").click(function () {
        esconde_campos();
    });

    $.get("cadastro.json", function (data) {
        processaojson(data);
    }, "JSON");

    $("#email").blur(function () {
        validaemail();
    });
    $("#senha").keyup(function () {
        validasenha();
    });
    $("#nome").blur(function () {
        vernome = validacampobasico("#nome", '#invalidnome', 'Nome não pode ficar em branco!');
        if (vernome == 1)
            habilitabtn()
    });
    $("#telefone").blur(function () {
        vertelefone = validacampobasico("#telefone", '#invalidtelefone', 'Telefone não pode ficar em branco!');
        if (vertelefone == 1)
            habilitabtn()
    });
    $("#rua").blur(function () {
        verrua = validacampobasico("#rua", '#invalidrua', 'Nome da rua não pode ficar em branco!');
        if (verrua == 1)
            habilitabtn()
    });
    $("#numero").blur(function () {
        vernumero = validacampobasico("#numero", '#invalidnumero', 'Número da casa não pode ficar em branco!');
        if (vernumero == 1)
            habilitabtn()
    });
    $("#bairro").blur(function () {
        verbairro = validacampobasico("#bairro", '#invalidbairro', 'Bairro não pode ficar em branco!');
        if (verbairro == 1)
            habilitabtn()
    });
    $("#cidade").blur(function () {
        vercidade = validacampobasico("#cidade", '#invalidcidade', 'Nome da cidade não pode ficar em branco!');
        if (vercidade == 1)
            habilitabtn()
    });
    $("#estado").blur(function () {
        verestado = validacampodrop("#estado", '#invalidestado', 'Necessário selecionar o estado!');
        if (verestado == 1)
            habilitabtn()
    });
    $("#cep").blur(function () {
        vercep = validacampobasico("#cep", '#invalidcep', 'Necessário informar o CEP!');
        if (vercep == 1)
            habilitabtn()
    });
    $("#genero").blur(function () {
        vergenero = validacampodrop("#genero", '#invalidgenero', 'Necessário selecionar um gênero!');
        if (vergenero == 1)
            habilitabtn()
    });
    $("#datanascimento").blur(function () {
        verdatanascimento = validacampobasico("#datanascimento", '#invaliddatanascimento', 'Necessário informar a data de nascimento!');
        if (verdatanascimento == 1)
            habilitabtn()
    });
    $("#cpf").blur(function () {
        vercpf = validacampobasico("#cpf", '#invalidcpf', 'Necessário informar o CPF!');
        if (vercpf == 1)
            habilitabtn()
    });
    $("#cnpj").blur(function () {
        vercnpj = validacampobasico("#cnpj", '#invalidcnpj', 'Necessário informar o CNPJ!');
        if (vercnpj == 1)
            habilitabtn()
    });
    $("#especialidade").blur(function () {
        verespecialidade = validacampobasico("#especialidade", '#invalidespecialidade', 'Necessário selecionar uma especialidade!');
        if (verespecialidade == 1)
            habilitabtn()
    });
    $("#crm").blur(function () {
        vercrm = validacampobasico("#crm", '#invalidcrm', 'Necessário informar o CRM!');
        if (vercrm == 1)
            habilitabtn()
    });
});

$(document).on('keypress', function (e) {
    if (e.which == 13) {
        if (habilitabtn()) {
            $('#cadastroform').submit();
        }
    }
});

function validaemail(){
    var email = $("#email").val();
        var expressao = /^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/;
        if (email == "") {
            $('#btnregister').prop('disabled', true);
            $("#email").attr('class', 'form-control is-invalid')
            $('#invalidemail').html('E-mail não pode ficar em branco!')
            veremail = 0;
        } else if (!expressao.test(email)) {
            $('#btnregister').prop('disabled', true);
            $("#email").attr('class', 'form-control is-invalid')
            $('#invalidemail').html('E-mail contém formato inválido!')
            veremail = 0;
        } else {
            veremail = 1;
            $("#email").attr('class', 'form-control is-valid')
            habilitabtn();
        }
}

function validasenha(){
    var password = $("#senha").val();
        if (password == "") {
            $('#btnregister').prop('disabled', true);
            $("#senha").attr('class', 'form-control is-invalid')
            $('#invalidsenha').html('Senha não pode ficar em branco!')
            verpassword = 0;
        } else if (password.length < 6) {
            $('#btnregister').prop('disabled', true);
            $("#senha").attr('class', 'form-control is-invalid')
            $('#invalidsenha').html('Senha deve conter mais de 6 caracteres!')
            verpassword = 0;
        } else {
            $("#senha").attr('class', 'form-control is-valid')
            verpassword = 1;
            habilitabtn();
        }
}

function validacampobasico(campo, campovalidacao, mensagem) {
    var valor = $(campo).val();
    if (valor == "") {
        $('#btnregister').prop('disabled', true);
        $(campo).attr('class', 'form-control is-invalid')
        $(campovalidacao).html(mensagem)
        return 0;
    } else {
        $(campo).attr('class', 'form-control is-valid');
        return 1;
    }
}

function validacampodrop(campo, campovalidacao, mensagem) {
    var valor = $(campo).val();
    if (valor == "") {
        $('#btnregister').prop('disabled', true);
        $(campo).attr('class', 'form-control is-invalid')
        $(campovalidacao).html(mensagem)
        return 0;
    } else {
        if(valor != 'Escolher...'){
            $(campo).attr('class', 'form-control is-valid');
            return 1;
        }
        return 0;
    }
}

function habilitabtninicial() {
    var identificador = $("#identificador").val();
    if (identificador != undefined) {
        $('#btnregister').prop('disabled', false);
        veremail =
            verpassword =
            vernome =
            vertelefone =
            verrua =
            vernumero =
            verbairro =
            vercidade =
            verestado =
            vercep =
            vergenero =
            verdatanascimento =
            vercpf =
            vertipoexame =
            vercnpj =
            verespecialidade =
            vercrm = 1;
    }
}

function habilitabtn() {
    if (tipouser == 'paciente') {
        if (veremail == 1 &&
            verpassword == 1 &&
            vernome == 1 &&
            vertelefone == 1 &&
            verrua == 1 &&
            vernumero == 1 &&
            verbairro == 1 &&
            vercidade == 1 &&
            verestado == 1 &&
            vercep == 1 &&
            vergenero == 1 &&
            verdatanascimento == 1 &&
            vercpf == 1) {
            $('#btnregister').prop('disabled', false);
            return true;
        }
    } else if (tipouser == 'medico') {
        if (veremail == 1 &&
            verpassword == 1 &&
            vernome == 1 &&
            vertelefone == 1 &&
            verrua == 1 &&
            vernumero == 1 &&
            verbairro == 1 &&
            vercidade == 1 &&
            verestado == 1 &&
            vercep == 1 &&
            verespecialidade == 1 &&
            vercrm == 1) {
            $('#btnregister').prop('disabled', false);
            return true;
        }
    } else if (tipouser == 'laboratorio') {
        if (veremail == 1 &&
            verpassword == 1 &&
            vernome == 1 &&
            vertelefone == 1 &&
            verrua == 1 &&
            vernumero == 1 &&
            verbairro == 1 &&
            vercidade == 1 &&
            verestado == 1 &&
            vercep == 1 &&
            vertipoexame == 1 &&
            vercnpj == 1) {
            $('#btnregister').prop('disabled', false);
            return true;
        }
    }
    $('#btnregister').prop('disabled', true);
    return false;
}

function processaojson(data) {
    $.each(data, function (key, val) {
        if (key == 'especialidades') {
            especialidade_autocomplete(val);
        }
        if (key == 'exames') {
            tipoexames_autocomplete(val);
        }
        if (key == 'estados') {
            estados_drop(val);
        }
    });
}

function esconde_campos() {
    var radioValue = $("input[name='tipouser']:checked").val();
    var hiddenValue = $("#tipouser").val();
    if (radioValue != undefined) {
        tipouser = radioValue;
    } else {
        tipouser = hiddenValue;
        radioValue = hiddenValue;
    }

    if (radioValue == 'paciente') {
        $("#medico").hide();
        $("#laboratorio").hide();
        $('#laboratoriobtn').hide();
        $('#paciente').show();
    } else if (radioValue == 'medico') {
        $("#paciente").hide();
        $("#laboratorio").hide();
        $('#laboratoriobtn').hide();
        $('#medico').show();
    } else if (radioValue == 'laboratorio') {
        $("#medico").hide();
        $("#paciente").hide();
        $('#laboratorio').show();
        $('#laboratoriobtn').show();
    }
}

function estados_drop(list) {
    var select = $('#selectedestado').val();
    if (select == ''){
        $('#estado').append('<option selected>Escolher...</option>');
    }else{
        $('#estado').append('<option>Escolher...</option>');
    }

    $.each(list, function (key, item) {
        if (item.sigla == select) {
            $('#estado').append('<option value="' + item.sigla + '" selected>' + item.nome + '</option>');
        } else {
            $('#estado').append('<option value="' + item.sigla + '">' + item.nome + '</option>');
        }
    });
}

function especialidade_autocomplete(list) {
    var especialidade = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: list
    });

    $('#especialidade').typeahead({
        hint: false,
        highlight: true,
        minLength: 1
    },
        {
            name: 'especialidade',
            source: especialidade
        });
    $('.twitter-typeahead').removeAttr('style');
}

function tipoexames_autocomplete(list) {
    var tipoexames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: list
    });

    $('#tipoexameauto').typeahead({
        hint: false,
        highlight: true,
        minLength: 1,
    },
        {
            name: 'tipoexame',
            source: tipoexames,
        }
    ).on('typeahead:selected', function (event, selection) {
        var tipos = $('#tipoexame').val();
        var temp = selection + ',';
        if (tipos.indexOf(temp) == -1){
            $('#tipoexame').val(tipos + temp);
            $('#tipoexamebtns').append("<button type='button' id='" + removeInvalid(selection) + "' class='btn btn-outline-secondary btn-sm' onclick='removetiposexames(this.value)' value='" + selection + "' >" + selection + " &nbsp;<i class='fa fa-trash' aria-hidden='true'></i></button>");
        }
        vertipoexame = 1;
        habilitabtn()
        $('#tipoexameauto').typeahead('val', '');
    });
    $('.twitter-typeahead').removeAttr('style');
}

function removetiposexames(valor) {
    var tipos = $('#tipoexame').val();
    var tp = tipos.replace(valor + ',', '');
    if (tp.lenght > 0) {
        vertipoexame = 1;
        habilitabtn()
    } else {
        vertipoexame = 0;
        habilitabtn()
    }

    $('#tipoexame').val(tp);
    $('#' + removeInvalid(valor)).remove();
}

function mostratiposexames() {
    var tipos = $('#tipoexame').val();
    if (tipos.length > 0) {
        vertipoexame = 1;
        habilitabtn()
        $.each(tipos.split(','), function (key, item) {
            if (item != "")
                $('#tipoexamebtns').append("<button type='button' id='" + removeInvalid(item) + "' class='btn btn-outline-secondary btn-sm' onclick='removetiposexames(this.value)' value='" + item + "' >" + item + " &nbsp;<i class='fa fa-trash' aria-hidden='true'></i></button>");
        });
    } else {
        vertipoexame = 0;
        habilitabtn()
    }
}

function removeInvalid(value) {
    return value.replace(/\s/g, '').replace(')', '').replace('(', '')
}