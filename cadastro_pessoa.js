$(document).ready(function () {
    $.get("cadastro.json", function (data) {
        $.each(data, function (key, val) {
            if (key == 'especialidades') {
                especialidadeautocomplete(val);
            }
            if (key == 'exames') {
                especialidadeautocomplete(val);
            }
            if (key == 'estados') {
                estadosdrop(val);
            }
        });
    }, "JSON");
});

function estadosdrop(list) {
    $.each(list, function (key, item) {
        $('#estado').append('<option value="' + item.sigla + '">' + item.nome + '</option>');
    });
}

function especialidadeautocomplete(list) {
    var especialidade = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: list
    });

    $('#especialidade').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
        {
            name: 'Especialidade',
            source: especialidade
        });
}

function tipoexamesautocomplete(list) {
    var tipoexames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: list
    });

    $('#tipoexame').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
        {
            name: 'tipoexame',
            source: tipoexames
        });
}