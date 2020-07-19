var veremail,
    verpassword,
    vernome,
    vertelefone,
    verrua,
    vernumero,
    verbairro,
    vercidade,
    verestado,
    vercep,
    vergenero,
    verdatanascimento,
    vercpf,
    vertipoexame,
    vercnpj,
    verespecialidade,
    vercrm = 0;
var tipouser = '';

$(document).ready(function () {
    $("#telefone").mask("(00) 00000-0000");
    $('#cpf').mask('000.000.000-00');
    $('#cnpj').mask('00.000.000/0000-00');
    $('#cep').mask('00.000-000');

    esconde_campos();
    mostratiposexames()
    $("input[type='radio']").click(function () {
        esconde_campos();
    });

    $.get("cadastro.json", function (data) {
        processaojson(data);
    }, "JSON");

    $("#email").blur(validaemail());
    $("#senha").keyup(validasenha());
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
        verestado = validacampobasico("#estado", '#invalidestado', 'Necessário selecionar o estado!');
        if (verestado == 1)
            habilitabtn()
    });
    $("#cep").blur(function () {
        vercep = validacampobasico("#cep", '#invalidcep', 'Necessário informar o CEP!');
        if (vercep == 1)
            habilitabtn()
    });
    $("#genero").blur(function () {
        vergenero = validacampobasico("#genero", '#invalidgenero', 'Necessário selecionar um gênero!');
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
    $("#tipoexame").blur(function () {
        vertipoexame = validacampobasico("#tipoexame", '#invalidtipoexame', 'Necessário selecionar ao menos um tipo de exame!');
        if (vertipoexame == 1)
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

function validacampobasico(campo, campovalidacao, mensagem) {
    var estado = $(campo).val();
    if (estado == "") {
        $('#btnregister').prop('disabled', true);
        $(campo).attr('class', 'form-control is-invalid')
        $(campovalidacao).html(mensagem)
        return 0;
    } else {
        $(campo).attr('class', 'form-control is-valid');
        return 1;
    }
}

function validasenha() {
    var password = $("#senha").val();
    if (password == "") {
        $('#btnregister').prop('disabled', true);
        $("#senha").attr('class', 'form-control is-invalid')
        $('#invalidsenha').html('Senha não pode ficar em branco!')
        verpassword = 0;
    } else if (count(password) < 6) {
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

function validaemail() {
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
};

function habilitabtn() {
    if (tipouser == 'paciente') {
        if (veremail ==
            verpassword ==
            vernome ==
            vertelefone ==
            verrua ==
            vernumero ==
            verbairro ==
            vercidade ==
            verestado ==
            vercep ==
            vergenero ==
            verdatanascimento ==
            vercpf == 1) {
            $('#btnregister').prop('disabled', false);
            return true;
        }
    } else if (tipouser == 'medico') {
        if (veremail ==
            verpassword ==
            vernome ==
            vertelefone ==
            verrua ==
            vernumero ==
            verbairro ==
            vercidade ==
            verestado ==
            vercep ==
            verespecialidade ==
            vercrm == 1) {
            $('#btnregister').prop('disabled', false);
            return true;
        }
    } else if (tipouser == 'laboratorio') {
        if (veremail ==
            verpassword ==
            vernome ==
            vertelefone ==
            verrua ==
            vernumero ==
            verbairro ==
            vercidade ==
            verestado ==
            vercep ==
            vertipoexame ==
            vercnpj == 1) {
            $('#btnregister').prop('disabled', false);
            return true;
        }
    }
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
    tipouser = radioValue;
    if (radioValue == 'paciente') {
        $("#medico").hide();
        $("#laboratorio").hide();
        $('#paciente').show();
    } else if (radioValue == 'medico') {
        $("#paciente").hide();
        $("#laboratorio").hide();
        $('#medico').show();
    } else if (radioValue == 'laboratorio') {
        $("#medico").hide();
        $("#paciente").hide();
        $('#laboratorio').show();
    }
}

function estados_drop(list) {
    $.each(list, function (key, item) {
        $('#estado').append('<option value="' + item.sigla + '">' + item.nome + '</option>');
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
        minLength: 1
    },
        {
            name: 'tipoexame',
            source: tipoexames,
            updater: function( item ) {
                $('#tipoexamebtns').append('<button id="'+item.replace(' ','')+'" onclick="removetiposexames('+item+')">'+item+'<i class="fa fa-remove"></i></button>');
                return '';
            }
        });
    $('.twitter-typeahead').removeAttr('style');
}

function removetiposexames(valor){
    var tipos = $('#tipoexame').val();
    $('#tipoexame').val(tipos.replace(valor+',',''));
    $('#'+tipos.replace(' ','')).remove();
}

function mostratiposexames(){
    var tipos = $('#tipoexame').val();
    $.each(tipos.split(','), function (key, item) {
        $('#tipoexamebtns').append('<button id="'+item.replace(' ','')+'" onclick="remove('+item+')">'+item+'<i class="fa fa-remove"></i></button>');
    });
}