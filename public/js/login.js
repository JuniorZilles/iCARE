var veremail, verpassword = 0;
$(document).ready(function () {
    $("#email").blur(function validaemail() {
        var email = $("#email").val();
        var expressao = /^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/;
        if (email == "") {
            $('#btnlogin').prop('disabled', true);
            $('#titulo').html('Entrada Inválida')
            $('#conteudo').html('E-mail não pode ficar em branco!')
            $('.toast').toast('show');
            veremail = 0;
        } else if (!expressao.test(email)) {
            $('#btnlogin').prop('disabled', true);
            $('#titulo').html('Entrada Inválida')
            $('#conteudo').html('E-mail contém formato inválido!')
            $('.toast').toast('show');
            veremail = 0;
        } else {
            veremail = 1;
            if (verpassword == 1) {
                $('#btnlogin').prop('disabled', false);
            }
        }
    });

    $("#password").keyup(function validasenha() {
        var password = $("#password").val();
        if (password == "") {
            $('#btnlogin').prop('disabled', true);
            $('#titulo').html('Entrada Inválida')
            $('#conteudo').html('Senha não pode ficar em branco!')
            $('.toast').toast('show');
            verpassword = 0;
        } else {
            verpassword = 1;
            if (veremail == 1) {
                $('#btnlogin').prop('disabled', false);
            }
        }
    });
});

$(document).on('keypress',function(e) {
    if(e.which == 13) {
        if (veremail == 1 && verpassword == 1) {
            $('#btnlogin').prop('disabled', false);
            $('#loginform').submit();
        }
    }
});