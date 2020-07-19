$(document).ready(function () {
    esconde_campos();
    $("input[type='radio']").click(function(){
        esconde_campos();
    });

    $.get("cadastro.json", function (data) {
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
    }, "JSON");
});

function esconde_campos() {
    var radioValue = $("input[name='tipouser']:checked").val();
    if(radioValue == 'paciente'){
        $("#medico").hide();
        $("#laboratorio").hide();
      $('#paciente').show();
    }else if(radioValue == 'medico'){
        $("#paciente").hide();
        $("#laboratorio").hide();
      $('#medico').show();
    }else if(radioValue == 'laboratorio'){
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

    $('#tipoexame').typeahead({
        hint: false,
        highlight: true,
        minLength: 1
    },
        {
            name: 'tipoexame',
            source: tipoexames
        });
    $('.twitter-typeahead').removeAttr('style');
}