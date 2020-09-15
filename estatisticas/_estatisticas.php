<?php 
function get_data($_id, $_tipo){
    $_exame = $_consulta = null;
    $_exame_array = $_consulta_array = $_user_array = Array();

    $xml = simplexml_load_file('dados.xml');
    if ($_tipo == 'medico')
        $_consulta = $xml->xpath("//consulta[medicoid = '$_id']");
    elseif ($_tipo == 'laboratorio')
        $_exame = $xml->xpath("//exame[laboratorioid = '$_id']");
    elseif ($_tipo == 'paciente'){
        $_exame = $xml->xpath("//exame[pacienteid = '$_id']");
        $_consulta = $xml->xpath("//consulta[pacienteid = '$_id']");
    }elseif ($_tipo == 'admin'){
        $_exame = $xml->xpath("//exame");
        $_consulta = $xml->xpath("//consulta");
        $_pac_cont = count($xml->xpath("//user[tipo = 'paciente']"));
        $_lab_cont = count($xml->xpath("//user[tipo = 'laboratorio']"));
        $_med_cont = count($xml->xpath("//user[tipo = 'medico']"));
        array_push($_user_array, array('tipo' => 'Paciente', 'qtd' => $_pac_cont));
        array_push($_user_array, array('tipo' => 'Laboratório', 'qtd' => $_lab_cont));
        array_push($_user_array, array('tipo' => 'Médico', 'qtd' => $_med_cont));
    }
    for ($i=0; $i < count($_consulta); $i++) {
        $temp = Array();
        $_userid = (string)$_consulta[$i]->medicoid;
        $_mes = substr((string)$_consulta[$i]->data, 0, 7);
        $_nome = (string)$xml->xpath("//user[id = '$_userid']/nome")[0];

        $key1 = array_search($_nome, array_column($_consulta_array, 'nome'));
        if($key1 !== false){
            $key2 = array_search($_mes, array_column($_consulta_array[$key1]['reg'], 'mes'));
            if($key2 !== false)
                $_consulta_array[$key1]['reg'][$key2]['qtd'] += 1;
            else
                array_push($_consulta_array[$key1]['reg'], array( 'mes' => $_mes, 'qtd' => 1));
        }else    
            array_push($_consulta_array, array('nome' => $_nome, 'reg' => [array( 'mes' => $_mes, 'qtd' => 1)]));
    } 
    for ($i=0; $i < count($_exame); $i++) {
        $temp = Array();
        $_userid = (string)$_exame[$i]->laboratorioid;
        $_mes = substr((string)$_exame[$i]->data, 0, 7);
        $_nome = (string)$xml->xpath("//user[id = '$_userid']/nome")[0];

        $key1 = array_search($_nome, array_column($_exame_array, 'nome'));
        if($key1 !== false){
            $key2 = array_search($_mes, array_column($_exame_array[$key1]['reg'], 'mes'));
            if($key2 !== false)
                $_exame_array[$key1]['reg'][$key2]['qtd'] += 1;
            else
                array_push($_exame_array[$key1]['reg'], array( 'mes' => $_mes, 'qtd' => 1));
        }else    
            array_push($_exame_array, array('nome' => $_nome, 'reg' => [array( 'mes' => $_mes, 'qtd' => 1)]));
    } 
    return ['users' => $_user_array,'consultas'=> $_consulta_array,'exames'=> $_exame_array];
}
?>