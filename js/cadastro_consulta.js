var verhora =
    verdata =
    verpaciente =
    versintoma =
    verreceita =
    verobservacao = 0;
$(document).ready(function () {
    $.get("../tools/_pacientes.php", function (data) {
        pacientes_autocomplete(data);
        obternomepaciente(data, "#pacienteid", "#pacienteauto", "#datanascimento");
    }, "JSON");
    $("#dataconsulta").blur(function () {
        verdata = validacampobasico("#dataconsulta", '#invaliddate', 'Necessário informar a data da consulta!');
        if (verdata == 1)
            habilitabtn();
    });
    $("#horarioconsulta").blur(function () {
        verhora = validacampobasico("#horarioconsulta", '#invalidhour', 'Necessário informar a hora da consulta!');
        if (verhora == 1)
            habilitabtn();
    });
    $("#receita").blur(function () {
        verreceita = validacampobasico("#receita", '#invalidreceita', 'Necessário informar a prescrição dada ao paciente!');
        if (verreceita == 1)
            habilitabtn();
    });
    $("#outrosintoma").blur(function () {
        var outro = $("#outrosintoma").val();
        if (outro != '') {
            $("#outro").prop('checked', true)
            versintoma = 1
            habilitabtn();
        } else
            $("#outro").prop('checked', false)

    });
    $("#observacoes").on('keypress', function () {
        verobservacao = validacampobasico("#observacoes", '#invalidobservacao', 'Necessário informar uma descrição sobre o exame!');
        if (verobservacao == 1)
            habilitabtn();
    });
    $(document).on("click", "input[type='checkbox']", function () {
        versintoma = validadcheck();
        if (versintoma == 1)
            habilitabtn();

    });
    habilitabtninicial();
});

function validadcheck() {
    var res = $(document).find("input[type='checkbox']:checked").length > 0;
    if (res)
        return 1;
    else {
        $("#invalidcheck").html('Necessário informar ao menos um sintoma');
        return 0;
    }

}

function habilitabtninicial() {
    var identificador = $("#identificador").val();
    if (identificador != '') {
        $('#btnregister').prop('disabled', false);
        verhora =
            verdata =
            verpaciente =
            versintoma =
            verreceita =
            verobservacao = 1;
    }
}

function habilitabtn() {
    if (verhora == 1 &&
        verdata == 1 &&
        verpaciente == 1 &&
        versintoma == 1 &&
        verreceita == 1 &&
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
        $(campo).attr('class', 'form-control is-invalid');
        $(campovalidacao).html(mensagem);
        return 0;
    } else {
        $(campo).attr('class', 'form-control is-valid');
        return 1;
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

function obternomemedico(data, idcampo, nomecampo) {
    var id = $(idcampo).val();
    $.each(data, function (i, item) {
        if (item.id == id)
            $(nomecampo).val(item.nome);

    });
}
function obternomepaciente(data, idcampo, nomecampo, datacampo) {
    var id = $(idcampo).val();
    $.each(data, function (i, item) {
        if (item.id == id)
            $(nomecampo).val(item.nome);
        $(datacampo).val(item.datanascimento);
    });
}