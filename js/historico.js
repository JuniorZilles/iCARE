$(document).ready(function () {
    $.get("../tools/_pacientes.php", function (data) {
        pacientes_autocomplete(data);
    }, "JSON");
    $("#search").on('click', function (e) {
        $('#cadastroform').submit();
    });
})

$(document).on('keypress', function (e) {
    if (e.which == 13) {
        $('#cadastroform').submit();
    }
});

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
        $('#btnsearch').prop('disabled', false);
    });
    $('.twitter-typeahead').removeAttr('style');
}