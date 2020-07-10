<?php 
function remove_inseguro($valor)
{
    $valor = trim($valor);
    $valor = stripslashes($valor);
    return $valor;
}

function maketoast($title, $message){
    return "<script>
    $(function(){
        $('#titulo').html('$title')
        $('#conteudo').html('$message')
        $('.toast').toast('show');
    });  
</script>";
}
?>