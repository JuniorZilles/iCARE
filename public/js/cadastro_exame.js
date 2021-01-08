var verhora =
    verdata =
    verpaciente =
    vermedico =
    verresultado =
    verexame =
    verobservacao = 0;
var info = '';
$(document).ready(function () {
    obtertipoexame();

    $.get("../tools/pacientes", function (data) {
        pacientes_autocomplete(data);
        obternomepaciente(data, "#pacienteid", "#pacienteauto", "#datanascimento")
    }, "JSON");
    $.get("../tools/medicos", function (data) {
        medicos_autocomplete(data);
        obternomemedico(data, "#medicoid", "#medicoauto", '#crm', '#telefone', '#especialidade')
    }, "JSON");
    info = $("#labinfo").val();
    $.get("../tools/laboratorioTipoExame/" + info, function (data) {
        obtertipoexameauto(data)
    }, "JSON");
    $("#dataexame").blur(function () {
        verdata = validacampobasico("#dataexame", '#invaliddate', 'Necessário informar a data do exame!');
        if (verdata == 1)
            habilitabtn()
    });
    $("#horarioexame").blur(function () {
        verhora = validacampobasico("#horarioexame", '#invalidhour', 'Necessário informar a hora do exame!');
        if (verhora == 1)
            habilitabtn()
    });
    $("#resultadoexame").blur(function () {
        verresultado = validacampodrop("#resultadoexame", '#invalidresultado', 'Necessário selecionar o resultado do exame!');
        if (verresultado == 1)
            habilitabtn()
    });
    $("#resultado").on('keypress', function () {
        verobservacao = validacampobasico("#resultado", '#invalidtextresultado', 'Necessário informar uma descrição sobre o exame!');
        if (verobservacao == 1)
            habilitabtn()
    });
    habilitabtninicial()
});

function habilitabtninicial() {
    var identificador = $("#identificadorexame").val();
    if (identificador != '') {
        $('#btnregister').prop('disabled', false);
        verhora =
            verdata =
            verpaciente =
            vermedico =
            verresultado =
            verexame =
            verobservacao = 1;
    }
}

function habilitabtn() {
    if (verhora == 1 &&
        verdata == 1 &&
        verpaciente == 1 &&
        vermedico == 1 &&
        verresultado == 1 &&
        verexame == 1 &&
        verobservacao == 1) {
        $('#btnregister').prop('disabled', false);
        return true;
    }
    $('#btnregister').prop('disabled', true);
    return false;
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
        if (valor != 'Escolher...') {
            $(campo).attr('class', 'form-control is-valid');
            return 1;
        }
        return 0;
    }
}

function pacientes_autocomplete(list) {
    var pacientes = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nome'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: list
    });

    $('#pacienteauto').typeahead({
        hint: false,
        highlight: true,
        minLength: 1,
    },
        {
            name: 'nomepaciente',
            displayKey: 'nome',
            source: pacientes.ttAdapter(),
        }
    ).on('typeahead:selected', function (event, selection) {
        $('#pacienteid').val(selection.id);
        $('#datanascimento').val(selection.datanascimento);
        verpaciente = 1;
        habilitabtn()
        //$('#').val(selection.nome);
    });
    $('.twitter-typeahead').removeAttr('style');
}

function medicos_autocomplete(list) {
    var medicos = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nome'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: list
    });

    $('#medicoauto').typeahead({
        hint: false,
        highlight: true,
        minLength: 1,
    },
        {
            name: 'nomemedico',
            displayKey: 'nome',
            source: medicos.ttAdapter(),
        }
    ).on('typeahead:selected', function (event, selection) {
        $('#medicoid').val(selection.id);
        $('#especialidade').val(selection.especialidade);
        $('#crm').val(selection.crm);
        $('#telefone').val(selection.telefone);
        vermedico = 1;
        habilitabtn()

    });
    $('.twitter-typeahead').removeAttr('style');
}

function obtertipoexameauto(list) {
    var tipoexames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: list
    });

    $('#exameauto').typeahead({
        hint: false,
        highlight: true,
        minLength: 1,
    },
        {
            name: 'tipoexame',
            source: tipoexames,
        }
    ).on('typeahead:selected', function (event, selection) {
        var tipos = $('#exame').val();
        var temp = selection + ',';
        if (tipos.indexOf(temp) == -1) {
            $('#exame').val(tipos + temp);
            $('#tipoexamebtns').append("<button type='button' id='" + removeInvalid(selection) + "' class='btn btn-outline-secondary btn-sm' onclick='removetiposexames(this.value)' value='" + selection + "' >" + selection + " &nbsp;<i class='fa fa-trash' aria-hidden='true'></i></button>");
        }
        verexame = 1;
        habilitabtn()
        $('#exameauto').typeahead('val', '');
    });
    $('.twitter-typeahead').removeAttr('style');
}

function removetiposexames(valor) {
    var tipos = $('#exame').val();
    var tp = tipos.replace(valor + ',', '');
    if (tp.lenght > 0) {
        verexame = 1;
        habilitabtn()
    } else {
        verexame = 0;
        habilitabtn()
    }

    $('#exame').val(tp);
    $('#' + removeInvalid(valor)).remove();
}

function obtertipoexame() {
    var exame = $('#exame').val();
    var list = []
    if (exame.length > 0) {
        verexame = 1;
        habilitabtn()
        $.each(exame.split(','), function (key, item) {
            if (item != "") {
                $('#tipoexamebtns').append("<button type='button' id='" + removeInvalid(item) + "' class='btn btn-outline-secondary btn-sm' onclick='removetiposexames(this.value)' value='" + item + "' >" + item + " &nbsp;<i class='fa fa-trash' aria-hidden='true'></i></button>");
            }
        });

    } else {
        verexame = 0;
        habilitabtn()
    }
}

function removeInvalid(value) {
    return value.replace(/\s/g, '').replace(')', '').replace('(', '')
}

function obternomemedico(data, idcampo, nomecampo, crmcampo, telefonecampo, especialidadecampo) {
    var id = $(idcampo).val();
    $.each(data, function (i, item) {
        if (item.id == id) {
            $(nomecampo).val(item.nome);
            $(crmcampo).val(item.crm);
            $(telefonecampo).val(item.telefone);
            $(especialidadecampo).val(item.especialidade);
        }
    });
}

function obternomepaciente(data, idcampo, nomecampo, datacampo) {
    var id = $(idcampo).val();
    $.each(data, function (i, item) {
        if (item.id == id) {
            $(nomecampo).val(item.nome);
            $(datacampo).val(item.datanascimento);
        }
    });
}