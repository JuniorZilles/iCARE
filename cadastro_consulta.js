$(document).ready(function () {
    $.get("_pacientes.php", function (data) {
        pacientes_autocomplete(data);
    }, "JSON");
});

function pacientes_autocomplete(list) {
    var pacientes = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nome'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: list
    });

    $('#nomeauto').typeahead({
        hint: false,
        highlight: true,
        minLength: 1,
    },
        {
            name: 'nomepaciente',
            displayKey:'nome',
            source: pacientes.ttAdapter(),
        }
    ).on('typeahead:selected', function (event, selection) {
        $('#pacienteid').val(selection.id);
        //$('#').val(selection.datanascimento);
        //$('#').val(selection.nome);
    });
    $('.twitter-typeahead').removeAttr('style');
}